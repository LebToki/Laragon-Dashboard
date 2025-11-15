// Chat History Manager Class
class ChatHistoryManager {
    constructor() {
        this.currentChatId = null;
        this.chatHistory = [];
        this.isInitialized = this.initElements();
        
        if (this.isInitialized) {
            this.initEventListeners();
            this.loadChats();
        } else {
            console.error('Failed to initialize chat history manager');
        }
    }

    initElements() {
        try {
            // Wait for the DOM to be fully loaded
            if (document.readyState === 'loading') {
                console.log('Document not fully loaded, deferring element initialization');
                return false;
            }

            const chatHistoryList = document.getElementById('chatHistoryList');
            const chatItemTemplate = document.getElementById('chatItemTemplate');
            const newChatBtn = document.getElementById('newChatBtn');
            
            if (!chatHistoryList) console.error('chatHistoryList element not found');
            if (!chatItemTemplate) console.error('chatItemTemplate element not found');
            if (!newChatBtn) console.error('newChatBtn element not found');
            
            if (!chatHistoryList || !chatItemTemplate || !newChatBtn) {
                return false;
            }
            
            this.elements = {
                chatHistoryList: chatHistoryList,
                chatItemTemplate: chatItemTemplate,
                newChatBtn: newChatBtn,
                currentChatTitle: document.querySelector('.chat-sidebar-single .text-line-1')
            };
            
            // Store the rename context
            this.renameContext = {
                chatId: null,
                element: null,
                input: null,
                display: null
            };
            
            console.log('Elements initialized successfully');
            return true;
        } catch (error) {
            console.error('Error initializing elements:', error);
            return false;
        }
    }

    initEventListeners() {
        // New chat button
        this.elements.newChatBtn.addEventListener('click', () => this.createNewChat());
        
        // Save chat title
        this.elements.saveChatTitleBtn.addEventListener('click', () => this.saveChatTitle());
        
        // Handle Enter key in rename input
        this.elements.newChatTitle.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                this.saveChatTitle();
            }
        });
    }

    async loadChats() {
        try {
            const response = await fetch('api/chat.php?action=list');
            const data = await response.json();
            
            if (data.success) {
                this.chatHistory = data.chats || [];
                this.renderChatList();
                
                // If there are chats but none is selected, select the most recent one
                if (this.chatHistory.length > 0 && !this.currentChatId) {
                    this.loadChat(this.chatHistory[0].id);
                }
            }
        } catch (error) {
            console.error('Error loading chats:', error);
            this.showError('Failed to load chat history');
        }
    }

    async createNewChat() {
        try {
            const response = await fetch('api/chat.php?action=new', { method: 'POST' });
            const data = await response.json();
            
            if (data.success) {
                // Add the new chat to the beginning of the list
                this.chatHistory.unshift(data.chat);
                this.renderChatList();
                this.loadChat(data.chat.id);
            }
        } catch (error) {
            console.error('Error creating new chat:', error);
            this.showError('Failed to create new chat');
        }
    }

    async loadChat(chatId) {
        try {
            const response = await fetch(`api/chat.php?action=get&chat_id=${chatId}`);
            const data = await response.json();
            
            if (data.success) {
                this.currentChatId = chatId;
                this.updateActiveChat(chatId);
                
                // Update the chat title in the header
                if (this.elements.currentChatTitle) {
                    this.elements.currentChatTitle.textContent = data.chat.title || 'New Chat';
                }
                
                // Clear existing messages
                const chatMessages = document.getElementById('chatMessages');
                if (chatMessages) {
                    chatMessages.innerHTML = '';
                }
                
                // Add messages to the chat
                if (data.chat.messages && data.chat.messages.length > 0) {
                    data.chat.messages.forEach(msg => {
                        this.addMessageToChat(msg.role, msg.content);
                    });
                } else {
                    // Show welcome message if no messages
                    const welcomeMessage = document.getElementById('welcomeMessage');
                    if (welcomeMessage) {
                        chatMessages.appendChild(welcomeMessage);
                    }
                }
                
                // Scroll to bottom
                if (chatMessages) {
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                }
                
                // Update URL without page reload
                const url = new URL(window.location);
                url.searchParams.set('chat', chatId);
                window.history.pushState({ chatId }, '', url);
            }
        } catch (error) {
            console.error('Error loading chat:', error);
            this.showError('Failed to load chat');
        }
    }

    async addMessage(role, content) {
        if (!this.currentChatId) {
            await this.createNewChat();
        }
        
        try {
            const response = await fetch('api/chat.php?action=message', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    chat_id: this.currentChatId,
                    role,
                    content
                })
            });
            
            const data = await response.json();
            
            if (data.success) {
                // Update the chat list to show the latest message
                this.loadChats();
                return true;
            }
        } catch (error) {
            console.error('Error adding message:', error);
        }
        return false;
    }

    renderChatList() {
        if (!this.elements.chatHistoryList) return;
        
        if (this.chatHistory.length === 0) {
            this.elements.chatHistoryList.innerHTML = `
                <div class="text-center py-4 text-muted">
                    No chats yet. Start a new conversation!
                </div>
            `;
            return;
        }
        
        this.elements.chatHistoryList.innerHTML = '';
        
        this.chatHistory.forEach(chat => {
            const chatItem = this.createChatItem(chat);
            this.elements.chatHistoryList.appendChild(chatItem);
        });
        
        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }

    createChatItem(chat) {
        const template = this.elements.chatItemTemplate;
        const chatItem = template.content.cloneNode(true);
        const chatElement = chatItem.querySelector('.chat-item');
        
        // Set chat ID
        chatElement.dataset.chatId = chat.id;
        
        // Set active class if this is the current chat
        if (this.currentChatId === chat.id) {
            chatElement.classList.add('active');
        }
        
        // Get title elements
        const titleDisplay = chatElement.querySelector('.chat-title-display span');
        const editButton = chatElement.querySelector('.edit-title-btn');
        const titleInput = chatElement.querySelector('.chat-title-edit');
        
        // Set initial title
        const title = chat.title || 'New Chat';
        titleDisplay.textContent = title;
        titleInput.value = title;
        
        // Set chat preview (last message)
        const previewElement = chatElement.querySelector('.chat-preview');
        if (chat.messages && chat.messages.length > 0) {
            const lastMessage = chat.messages[chat.messages.length - 1];
            previewElement.textContent = lastMessage.content.substring(0, 50) + 
                                      (lastMessage.content.length > 50 ? '...' : '');
        } else {
            previewElement.textContent = 'No messages yet';
        }
        
        // Set last updated time
        const timeElement = chatElement.querySelector('.chat-time');
        if (chat.updated_at && timeElement) {
            timeElement.textContent = this.formatTimeAgo(chat.updated_at);
            timeElement.title = new Date(chat.updated_at).toLocaleString();
        }
        
        return chatElement;
    } catch (error) {
        console.error('Error creating chat item:', error);
        return null;
    }
}


            
            // Add messages to the chat
            if (data.chat.messages && data.chat.messages.length > 0) {
                data.chat.messages.forEach(msg => {
                    this.addMessageToChat(msg.role, msg.content);
                });
            } else {
                // Show a welcome message if no messages
                const welcomeMessage = document.getElementById('welcomeMessage');
                if (welcomeMessage) {
                    chatMessages.appendChild(welcomeMessage);
                }
            }
            
            // Scroll to bottom
            if (chatMessages) {
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }
            
            // Update URL without page reload
            const url = new URL(window.location);
            url.searchParams.set('chat', chatId);
            window.history.pushState({ chatId }, '', url);
        }
    } catch (error) {
        console.error('Error loading chat:', error);
        this.showError('Failed to load chat');
    }
}

async addMessage(role, content) {
    if (!this.currentChatId) {
        await this.createNewChat();
    }
    
    try {
        const response = await fetch('api/chat.php?action=message', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                chat_id: this.currentChatId,
                role,
                content
            })
        });
        
        const data = await response.json();
        
        if (data.success) {
            // Update the chat list to show the latest message
            this.loadChats();
            return true;
        }
    } catch (error) {
        console.error('Error adding message:', error);
    }
    return false;
}

renderChatList() {
    if (!this.elements.chatHistoryList) return;
    
    if (this.chatHistory.length === 0) {
        this.elements.chatHistoryList.innerHTML = `
            <div class="text-center py-4 text-muted">
                No chats yet. Start a new conversation!
            </div>
        `;
        return;
    }
    
    this.elements.chatHistoryList.innerHTML = '';
    
    this.chatHistory.forEach(chat => {
        const chatItem = this.createChatItem(chat);
        this.elements.chatHistoryList.appendChild(chatItem);
    });
    
    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
}

createChatItem(chat) {
    const template = this.elements.chatItemTemplate;
    const chatItem = template.content.cloneNode(true);
    const chatElement = chatItem.querySelector('.chat-item');
    
    // Set chat ID
    chatElement.dataset.chatId = chat.id;
    
    // Set active class if this is the current chat
    if (this.currentChatId === chat.id) {
        chatElement.classList.add('active');
    }
    
    // Get title elements
    const titleDisplay = chatElement.querySelector('.chat-title-display span');
    const editButton = chatElement.querySelector('.edit-title-btn');
    const titleInput = chatElement.querySelector('.chat-title-edit');
    
    // Set initial title
    const title = chat.title || 'New Chat';
    titleDisplay.textContent = title;
    titleInput.value = title;
    
    // Set chat preview (last message)
    const previewElement = chatElement.querySelector('.chat-preview');
    if (chat.messages && chat.messages.length > 0) {
        const lastMessage = chat.messages[chat.messages.length - 1];
        previewElement.textContent = lastMessage.content.substring(0, 50) + 
                                  (lastMessage.content.length > 50 ? '...' : '');
    } else {
        previewElement.textContent = 'No messages yet';
    }
    
    // Set last updated time
    const timeElement = chatElement.querySelector('.chat-time');
    if (chat.updated_at) {
        timeElement.textContent = this.formatTimeAgo(chat.updated_at);
        timeElement.title = new Date(chat.updated_at).toLocaleString();
    }
    
    // Add click event to load chat
    chatElement.addEventListener('click', (e) => {
        // Don't trigger if clicking on dropdown, edit button, or their children
        if (e.target.closest('.dropdown, .dropdown *, .edit-title-btn, .chat-title-edit')) {
            return;
        }
        this.loadChat(chat.id);
    });
    
    // Add event listener for edit button
    editButton.addEventListener('click', (e) => {
        e.stopPropagation();
        this.startRenaming(chatElement, chat.id, titleDisplay, titleInput);
    });
    
    // Add event listener for input field
    titleInput.addEventListener('keydown', (e) => {
        if (e.key === 'Enter') {
            this.finishRenaming(chat.id, titleDisplay, titleInput);
        } else if (e.key === 'Escape') {
            this.cancelRenaming(titleDisplay, titleInput);
        }
    });
        
        return chatItem;
    }

    updateActiveChat(activeChatId) {
        // Remove active class from all chat items
        document.querySelectorAll('.chat-item').forEach(item => {
            item.classList.remove('active');
            
            // Add active class to the selected chat
            if (item.dataset.chatId === activeChatId) {
                item.classList.add('active');
                
                // Scroll the active chat into view
                item.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
        });
    }

    startRenaming(chatElement, chatId, displayElement, inputElement) {
        // Store context
        this.renameContext = {
            chatId: chatId,
            element: chatElement,
            display: displayElement,
            input: inputElement,
            originalTitle: displayElement.textContent
        };
        
        // Show input and hide display
        displayElement.parentElement.classList.add('d-none');
        inputElement.classList.remove('d-none');
        inputElement.focus();
        inputElement.select();
    }
    
    cancelRenaming(displayElement, inputElement) {
        // Hide input and show display
        inputElement.classList.add('d-none');
        displayElement.parentElement.classList.remove('d-none');
        
        // Reset context
        this.renameContext = {
            chatId: null,
            element: null,
            input: null,
            display: null
        };
    }
    
    async finishRenaming(chatId, displayElement, inputElement) {
        const newTitle = inputElement.value.trim();
        const chatElement = inputElement.closest('.chat-item');
        
        // Hide input and show display
        inputElement.classList.add('d-none');
        displayElement.parentElement.classList.remove('d-none');
        
        // If title didn't change or is empty, do nothing
        if (newTitle === displayElement.textContent || !newTitle) {
            inputElement.value = displayElement.textContent;
            return;
        }
        
        try {
            const response = await fetch('api/chat.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    action: 'update',
                    chat_id: chatId,
                    title: newTitle
                })
            });
            
            const data = await response.json();
            
            if (data.success) {
                // Update the title in the UI
                displayElement.textContent = newTitle;
                
                // Update the chat title in the header if this is the current chat
                if (this.currentChatId === chatId && this.elements.currentChatTitle) {
                    this.elements.currentChatTitle.textContent = newTitle;
                }
                
                // Update the chat in the local history
                const chatIndex = this.chatHistory.findIndex(c => c.id === chatId);
                if (chatIndex !== -1) {
                    this.chatHistory[chatIndex].title = newTitle;
                    this.chatHistory[chatIndex].updated_at = new Date().toISOString();
                }
            } else {
                // Revert to original title if update failed
                displayElement.textContent = this.renameContext.originalTitle;
                inputElement.value = this.renameContext.originalTitle;
                this.showError(data.error || 'Failed to rename chat');
            }
        } catch (error) {
            console.error('Error renaming chat:', error);
            displayElement.textContent = this.renameContext.originalTitle;
            inputElement.value = this.renameContext.originalTitle;
            this.showError('Failed to rename chat');
        }
        
        // Reset context
        this.renameContext = {
            chatId: null,
            element: null,
            input: null,
            display: null
        };
    }

    async deleteChat(chatId, element) {
        if (!confirm('Are you sure you want to delete this chat? This action cannot be undone.')) {
            return;
        }
        
        try {
            const response = await fetch(`api/chat.php?action=delete&chat_id=${chatId}`, {
                method: 'DELETE'
            });
            
            const data = await response.json();
            
            if (data.success) {
                // Remove from local history
                this.chatHistory = this.chatHistory.filter(chat => chat.id !== chatId);
                
                // Remove from UI
                if (element && element.parentNode) {
                    element.parentNode.removeChild(element);
                }
                
                // If we deleted the current chat, load the most recent one or create a new one
                if (this.currentChatId === chatId) {
                    if (this.chatHistory.length > 0) {
                        this.loadChat(this.chatHistory[0].id);
                    } else {
                        this.createNewChat();
                    }
                }
                
                // If no chats left, show empty state
                if (this.chatHistory.length === 0) {
                    this.renderChatList();
                }
            }
        } catch (error) {
            console.error('Error deleting chat:', error);
            this.showError('Failed to delete chat');
        }
    }

    addMessageToChat(role, content) {
        const chatMessages = document.getElementById('chatMessages');
        if (!chatMessages) return;
        
        // Hide welcome message if it's visible
        const welcomeMessage = document.getElementById('welcomeMessage');
        if (welcomeMessage && welcomeMessage.parentNode === chatMessages) {
            chatMessages.removeChild(welcomeMessage);
        }
        
        // Create message element
        const messageDiv = document.createElement('div');
        messageDiv.className = `chat-message ${role}-message`;
        
        const avatar = role === 'user' 
            ? 'assets/images/user-avatar.png' 
            : 'assets/images/favicon.png';
        
        const formattedContent = content.replace(/\n/g, '<br>');
        
        messageDiv.innerHTML = `
            <div class="message-avatar">
                <img src="${avatar}" alt="${role}" loading="lazy">
            </div>
            <div class="message-content">
                <p>${formattedContent}</p>
            </div>
        `;
        
        chatMessages.appendChild(messageDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    formatTimeAgo(dateString) {
        const date = new Date(dateString);
        const now = new Date();
        const diffInSeconds = Math.floor((now - date) / 1000);
        
        if (diffInSeconds < 60) {
            return 'Just now';
        }
        
        const diffInMinutes = Math.floor(diffInSeconds / 60);
        if (diffInMinutes < 60) {
            return `${diffInMinutes}m ago`;
        }
        
        const diffInHours = Math.floor(diffInMinutes / 60);
        if (diffInHours < 24) {
            return `${diffInHours}h ago`;
        }
        
        const diffInDays = Math.floor(diffInHours / 24);
        if (diffInDays < 7) {
            return `${diffInDays}d ago`;
        }
        
        return date.toLocaleDateString();
    }
    
    showError(message) {
        console.error(message);
    }
}

// Make it globally available
window.ChatHistoryManager = ChatHistoryManager;

// Initialize when DOM is fully loaded
document.addEventListener('DOMContentLoaded', function() {
    try {
        console.log('DOM fully loaded, initializing chat history...');
        
        // Make sure required elements exist
        const chatHistoryList = document.getElementById('chatHistoryList');
        const chatItemTemplate = document.getElementById('chatItemTemplate');
        const newChatBtn = document.getElementById('newChatBtn');
        
        if (!chatHistoryList || !chatItemTemplate || !newChatBtn) {
            console.error('Required elements not found:', { 
                chatHistoryList: !!chatHistoryList, 
                chatItemTemplate: !!chatItemTemplate,
                newChatBtn: !!newChatBtn
            });
            return;
        }
        
        // Initialize the chat history manager
        const chatManager = new ChatHistoryManager();
        
        // Only proceed if initialization was successful
        if (chatManager && chatManager.isInitialized) {
            console.log('Chat history manager initialized successfully');
            window.chatHistoryManager = chatManager; // Make it globally available
            
            // Load chat from URL parameter or create a new one
            const urlParams = new URLSearchParams(window.location.search);
            const chatId = urlParams.get('chat');
            
            if (chatId && chatId !== 'undefined') {
                console.log('Loading chat from URL:', chatId);
                chatManager.loadChat(chatId).catch(error => {
                    console.error('Error loading chat:', error);
                    chatManager.createNewChat().catch(console.error);
                });
            } else {
                console.log('No chat ID in URL, creating new chat');
                chatManager.createNewChat().catch(console.error);
            }
            
            // Handle browser back/forward buttons
            window.addEventListener('popstate', (event) => {
                if (event.state?.chatId) {
                    console.log('Pop state - loading chat:', event.state.chatId);
                    chatManager.loadChat(event.state.chatId).catch(console.error);
                }
            });
        } else {
            console.error('Failed to initialize chat history manager');
        }
    } catch (error) {
        console.error('Error initializing chat history:', error);
    }
});

// Make sure the manager is available globally
if (typeof window.chatHistoryManager === 'undefined') {
    window.chatHistoryManager = null;
}
