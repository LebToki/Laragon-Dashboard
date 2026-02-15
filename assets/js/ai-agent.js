/**
 * Laragon Dashboard AI Agent JS
 * Version: 4.0.0
 */

(function() {
    'use strict';

    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('ai-agent-toggle');
        const closeBtn = document.getElementById('ai-agent-close');
        const windowEl = document.getElementById('ai-agent-window');
        const inputEl = document.getElementById('ai-agent-input');
        const sendBtn = document.getElementById('ai-agent-send');
        const messagesEl = document.getElementById('ai-agent-messages');
        const contextStatus = document.getElementById('ai-agent-context-status');

        if (!toggleBtn) return;

        // Toggle Chat Window
        toggleBtn.addEventListener('click', () => {
            windowEl.classList.toggle('d-none');
            if (!windowEl.classList.contains('d-none')) {
                inputEl.focus();
                updateContext();
            }
        });

        // Close Chat Window
        closeBtn.addEventListener('click', () => {
            windowEl.classList.add('d-none');
        });

        let systemContext = null;

        // Send Message
        const sendMessage = () => {
            const text = inputEl.value.trim();
            if (!text) return;

            // Add User Message
            addMessage(text, 'user');
            inputEl.value = '';

            // Simulate Agent Response
            setTimeout(() => {
                const response = getSimulatedResponse(text);
                addMessage(response, 'assistant');
            }, 500);
        };

        sendBtn.addEventListener('click', sendMessage);
        inputEl.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') sendMessage();
        });

        function addMessage(text, type) {
            const msg = document.createElement('div');
            msg.className = `ai-message ${type} glass-card p-3 mb-3`;
            msg.innerHTML = `<div class="text-white small">${text}</div>`;
            messagesEl.appendChild(msg);
            messagesEl.scrollTop = messagesEl.scrollHeight;
        }

        function getSimulatedResponse(text) {
            const lower = text.toLowerCase();
            
            // Thinking animation simulation
            const thinkingMsg = document.createElement('div');
            thinkingMsg.className = 'ai-message assistant thinking p-2 mb-3';
            thinkingMsg.innerHTML = '<span class="text-secondary-light small italic">Agent is analyzing system state...</span>';
            messagesEl.appendChild(thinkingMsg);
            
            setTimeout(() => {
                thinkingMsg.remove();
                
                // Real Context Logic
                if (lower.includes('php')) {
                    const version = systemContext?.php_version || 'parsing...';
                    if (lower.includes('version')) {
                        return addMessage(`You are running **PHP ${version}**. I can help you manage extensions or view the php.ini directly.`, 'assistant');
                    }
                    return addMessage(`Your current PHP environment is **v${version}**. Most of your projects are optimized for this version.`, 'assistant');
                }

                if (lower.includes('os') || lower.includes('operating system') || lower.includes('windows')) {
                    const os = systemContext?.os || 'Windows';
                    return addMessage(`You are running on **${os}**. I have full visibility of local system paths and environment variables.`, 'assistant');
                }

                if (lower.includes('mysql') || lower.includes('database')) {
                    return addMessage("Your MySQL service is running on Port 3306. Would you like me to analyze your slow query logs?", 'assistant');
                }

                if (lower.includes('laravel')) return addMessage("I can help you scaffold a Laravel project. I'll automatically detect your PHP version for compatibility.", 'assistant');
                if (lower.includes('help')) return addMessage("I can help with project scaffolding, service monitoring, and Laragon configuration. Try: 'Show my PHP version'.", 'assistant');
                
                return addMessage("That's an interesting question! As a local AI agent, I specialize in your Laragon environment and local services.", 'assistant');
            }, 800);
            
            return null; // Handle via addMessage inside timeout
        }

        function updateContext() {
            contextStatus.textContent = 'Active (Laragon Dashboard v4.0.0)';
            fetch('api/ai_agent.php?action=snapshot')
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        systemContext = data.data;
                        contextStatus.textContent = `Active (OS: ${data.data.os}, PHP: ${data.data.php_version})`;
                    }
                })
                .catch(() => {
                    contextStatus.textContent = 'Connected (v4.0.0)';
                });
        }
    });
})();
