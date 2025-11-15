<?php
/**
 * Application: Laragon | Mailbox Tab Partial
 * Description: Mailbox tab content with custom email preview
 * Version: 2.6.0
 * 
 * Uses Mailpit API: http://localhost:8025/api/v1/
 */
?>
<div class="tab-content <?php echo $activeTab === 'mailbox' ? 'active' : ''; ?>" id="mailbox" style="display: <?php echo $activeTab === 'mailbox' ? 'block' : 'none'; ?>;">
<div class="container-fluid px-3 py-4" style="display: flex; flex-direction: column;">
    <!-- KPI Cards Row - Matching Servers Tab Style -->
    <div class="row g-3 mb-3">
        <div class="col" style="flex: 0 0 25%; max-width: 25%;">
            <div class="overviewcard color-1">
                <div class="overviewcard-header">
                    <div class="overviewcard-content">
                        <span class="overviewcard_icon">Total Emails</span>
                        <h6 class="overviewcard_info mb-0" id="mailbox-total-emails">0</h6>
                    </div>
                    <span class="overviewcard-icon-box color-1">
                        <iconify-icon icon="mdi:email-multiple"></iconify-icon>
                    </span>
                </div>
                <a href="javascript:void(0)" class="overviewcard-btn">View More</a>
            </div>
        </div>
        <div class="col" style="flex: 0 0 25%; max-width: 25%;">
            <div class="overviewcard color-2">
                <div class="overviewcard-header">
                    <div class="overviewcard-content">
                        <span class="overviewcard_icon">Today</span>
                        <h6 class="overviewcard_info mb-0" id="mailbox-today-emails">0</h6>
                    </div>
                    <span class="overviewcard-icon-box color-2">
                        <iconify-icon icon="mdi:email-mark-as-unread"></iconify-icon>
                    </span>
                </div>
                <a href="javascript:void(0)" class="overviewcard-btn">View More</a>
            </div>
        </div>
        <div class="col" style="flex: 0 0 25%; max-width: 25%;">
            <div class="overviewcard color-3">
                <div class="overviewcard-header">
                    <div class="overviewcard-content">
                        <span class="overviewcard_icon">This Week</span>
                        <h6 class="overviewcard_info mb-0" id="mailbox-week-emails">0</h6>
                    </div>
                    <span class="overviewcard-icon-box color-3">
                        <iconify-icon icon="mdi:email-open"></iconify-icon>
                    </span>
                </div>
                <a href="javascript:void(0)" class="overviewcard-btn">View More</a>
            </div>
        </div>
        <div class="col" style="flex: 0 0 25%; max-width: 25%;">
            <div class="overviewcard color-4">
                <div class="overviewcard-header">
                    <div class="overviewcard-content">
                        <span class="overviewcard_icon">Unique Senders</span>
                        <h6 class="overviewcard_info mb-0" id="mailbox-unique-senders">0</h6>
                    </div>
                    <span class="overviewcard-icon-box color-4">
                        <iconify-icon icon="mdi:account-multiple"></iconify-icon>
                    </span>
                </div>
                <a href="javascript:void(0)" class="overviewcard-btn">View More</a>
            </div>
        </div>
    </div>

    <!-- Tab Content Container -->
    <div class="tab-content-container" style="background-color: #023e8a; border-radius: 5px; padding: 15px; flex: 1; display: flex; flex-direction: column; overflow: hidden;">
        <div class="email-client-wrapper">
            <!-- Email Sidebar -->
            <div class="email-sidebar">
                <button class="btn-compose">
                    <iconify-icon icon="mdi:email-edit"></iconify-icon>
                    Compose
                </button>
                
                <div class="email-folders">
                    <a href="#" class="email-folder active" data-folder="inbox">
                        <iconify-icon icon="mdi:inbox"></iconify-icon>
                        <span>Inbox</span>
                        <span class="email-count" id="inbox-count">0</span>
                    </a>
                    <a href="#" class="email-folder" data-folder="starred">
                        <iconify-icon icon="mdi:star"></iconify-icon>
                        <span>Starred</span>
                        <span class="email-count" id="starred-count">0</span>
                    </a>
                    <a href="#" class="email-folder" data-folder="sent">
                        <iconify-icon icon="mdi:send"></iconify-icon>
                        <span>Sent</span>
                        <span class="email-count" id="sent-count">0</span>
                    </a>
                    <a href="#" class="email-folder" data-folder="draft">
                        <iconify-icon icon="mdi:file-document-edit"></iconify-icon>
                        <span>Draft</span>
                        <span class="email-count" id="draft-count">0</span>
                    </a>
                    <a href="#" class="email-folder" data-folder="spam">
                        <iconify-icon icon="mdi:alert-octagon"></iconify-icon>
                        <span>Spam</span>
                        <span class="email-count" id="spam-count">0</span>
                    </a>
                    <a href="#" class="email-folder" data-folder="bin">
                        <iconify-icon icon="mdi:delete"></iconify-icon>
                        <span>Bin</span>
                        <span class="email-count" id="bin-count">0</span>
                    </a>
                </div>

                <div class="email-tags">
                    <div class="tags-header">TAGS</div>
                    <a href="#" class="email-tag" data-tag="personal">
                        <span class="tag-color" style="background: #43a047;"></span>
                        Personal
                    </a>
                    <a href="#" class="email-tag" data-tag="social">
                        <span class="tag-color" style="background: #1e88e5;"></span>
                        Social
                    </a>
                    <a href="#" class="email-tag" data-tag="promotions">
                        <span class="tag-color" style="background: #fb8c00;"></span>
                        Promotions
                    </a>
                    <a href="#" class="email-tag" data-tag="business">
                        <span class="tag-color" style="background: #8e24aa;"></span>
                        Business
                    </a>
                </div>
            </div>

            <!-- Email Main Area -->
            <div class="email-main">
                <!-- Email List -->
                <div class="email-list-container" id="email-list-container">
                    <div class="card h-100 p-0">
                        <div class="card-header border-bottom bg-base py-16 px-24">
                            <div class="d-flex align-items-center justify-content-between">
                                <h6 class="text-lg fw-semibold mb-0">Inbox</h6>
                                <div class="email-actions">
                                    <button class="btn-icon" id="refresh-emails" title="Refresh">
                                        <iconify-icon icon="mdi:refresh"></iconify-icon>
                                    </button>
                                    <a href="http://localhost:8025/" target="_blank" class="btn-icon" title="Open Mailpit">
                                        <iconify-icon icon="mdi:open-in-new"></iconify-icon>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-24">
                            <ul class="list-group radius-8" id="email-list">
                                <li class="list-group-item email-list-loading d-flex align-items-center justify-content-center p-24">
                                    <div class="text-center">
                                        <iconify-icon icon="mdi:loading" style="font-size: 24px; animation: spin 1s linear infinite; display: block; margin: 0 auto 12px;"></iconify-icon>
                                        <p class="mb-0">Loading emails...</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Email Preview -->
                <div class="email-preview-container" id="email-preview-container" style="display: none;">
                    <div class="email-preview-header">
                        <button class="btn-back" id="back-to-list">
                            <iconify-icon icon="mdi:arrow-left"></iconify-icon>
                        </button>
                        <div class="email-preview-actions">
                            <button class="btn-icon" id="star-email" title="Star">
                                <iconify-icon icon="mdi:star-outline"></iconify-icon>
                            </button>
                            <button class="btn-icon" id="delete-email" title="Delete">
                                <iconify-icon icon="mdi:delete-outline"></iconify-icon>
                            </button>
                        </div>
                    </div>
                    <div class="email-preview-content" id="email-preview-content">
                        <!-- Email content will be loaded here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const MAILPIT_API = 'http://localhost:8025/api/v1';
let currentFolder = 'inbox';
let currentEmailId = null;
let emails = [];

// Initialize
$(document).ready(function() {
    loadEmails();
    
    // Folder navigation
    $('.email-folder').on('click', function(e) {
        e.preventDefault();
        $('.email-folder').removeClass('active');
        $(this).addClass('active');
        currentFolder = $(this).data('folder');
        loadEmails();
    });

    // Refresh button
    $('#refresh-emails').on('click', function() {
        loadEmails();
    });

    // Back to list
    $('#back-to-list').on('click', function() {
        $('#email-list-container').show();
        $('#email-preview-container').hide();
        currentEmailId = null;
    });

    // Delete email
    $('#delete-email').on('click', function() {
        if (currentEmailId) {
            deleteEmail(currentEmailId);
        }
    });

    // Star email
    $('#star-email').on('click', function() {
        if (currentEmailId) {
            toggleStar(currentEmailId);
        }
    });
});

function loadEmails() {
    $.ajax({
        url: MAILPIT_API + '/messages',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            emails = data.messages || [];
            renderEmailList(emails);
            updateMailboxKPIs(emails);
        },
        error: function(xhr, status, error) {
            $('#email-list').html(`
                <li class="list-group-item email-list-error d-flex flex-column align-items-center justify-content-center p-24 border-0">
                    <iconify-icon icon="mdi:alert-circle" style="font-size: 48px; color: #ffc107; display: block; margin-bottom: 16px;"></iconify-icon>
                    <p class="mb-2" style="color: #1a1a1a; font-weight: 600;">Mailpit is not running</p>
                    <p style="font-size: 0.9rem; color: #6b7280; margin-bottom: 16px;">Please start Mailpit from Laragon's service manager</p>
                    <a href="http://localhost:8025/" target="_blank" class="btn btn-primary" style="background: #43a047; border: none; padding: 8px 16px; border-radius: 6px; color: #ffffff; text-decoration: none;">
                        Open Mailpit
                    </a>
                </li>
            `);
        }
    });
}

function renderEmailList(emailList) {
    if (emailList.length === 0) {
        $('#email-list').html(`
            <li class="list-group-item email-list-empty d-flex flex-column align-items-center justify-content-center p-24">
                <iconify-icon icon="mdi:email-outline" style="font-size: 64px; color: rgba(0,0,0,0.3); display: block; margin-bottom: 16px;"></iconify-icon>
                <p class="mb-0">No emails found</p>
            </li>
        `);
        return;
    }

    let html = '';
    emailList.forEach(function(email, index) {
        const from = email.From ? parseEmailAddress(email.From) : { name: 'Unknown', email: '' };
        const subject = email.Subject || '(No Subject)';
        const date = formatDate(email.Created);
        const preview = email.Text || email.HTML ? (email.Text || email.HTML).substring(0, 80) + '...' : '';
        const avatarInitial = from.name.charAt(0).toUpperCase();
        
        // Determine priority badge (you can customize this logic)
        let priority = 'Low';
        let priorityClass = 'bg-danger-100 text-danger-600';
        if (email.Subject && (email.Subject.toLowerCase().includes('urgent') || email.Subject.toLowerCase().includes('important'))) {
            priority = 'High';
            priorityClass = 'bg-success-100 text-success-600';
        } else if (email.Subject && email.Subject.toLowerCase().includes('notification')) {
            priority = 'Medium';
            priorityClass = 'bg-lilac-100 text-lilac-600';
        }
        
        // Last item doesn't have border-bottom-0
        const isLast = index === emailList.length - 1;
        const borderClass = isLast ? '' : 'border-bottom-0';
        
        html += `
            <li class="list-group-item d-flex align-items-center justify-content-between border text-secondary-light p-16 bg-base ${borderClass}" data-id="${email.ID}" style="cursor: pointer;">
                <div class="d-flex align-items-center gap-2" style="flex: 1; min-width: 0;">
                    <div class="email-avatar-circle">
                        <span>${avatarInitial}</span>
                    </div>
                    <div style="flex: 1; min-width: 0;">
                        <div class="email-item-from-name" style="font-weight: 600; color: #1a1a1a; margin-bottom: 4px;">${escapeHtml(from.name)}</div>
                        <div class="email-item-subject-text" style="font-size: 13px; color: #6b7280; margin-bottom: 2px;">${escapeHtml(subject)}</div>
                        <div class="email-item-preview-text" style="font-size: 12px; color: #9ca3af;">${escapeHtml(preview)}</div>
                    </div>
                </div>
                <span class="text-xs ${priorityClass} radius-4 px-10 py-2 fw-semibold">${priority}</span>
            </li>
        `;
    });
    
    $('#email-list').html(html);
    
    // Click handler
    $('.list-group-item[data-id]').on('click', function() {
        const emailId = $(this).data('id');
        loadEmailPreview(emailId);
    });
}

function updateMailboxKPIs(emailList) {
    const total = emailList.length;
    const now = Date.now();
    const oneDayAgo = now - (24 * 60 * 60 * 1000);
    const oneWeekAgo = now - (7 * 24 * 60 * 60 * 1000);
    
    // Count emails from today
    const todayCount = emailList.filter(function(email) {
        const emailDate = new Date(email.Created).getTime();
        return emailDate >= oneDayAgo;
    }).length;
    
    // Count emails from this week
    const weekCount = emailList.filter(function(email) {
        const emailDate = new Date(email.Created).getTime();
        return emailDate >= oneWeekAgo;
    }).length;
    
    // Count unique senders
    const uniqueSenders = new Set();
    emailList.forEach(function(email) {
        if (email.From) {
            const parsed = parseEmailAddress(email.From);
            uniqueSenders.add(parsed.email || parsed.name);
        }
    });
    
    // Update KPI cards
    $('#mailbox-total-emails').text(total);
    $('#mailbox-today-emails').text(todayCount);
    $('#mailbox-week-emails').text(weekCount);
    $('#mailbox-unique-senders').text(uniqueSenders.size);
}

function loadEmailPreview(emailId) {
    currentEmailId = emailId;
    
    $.ajax({
        url: MAILPIT_API + '/message/' + emailId,
        method: 'GET',
        dataType: 'json',
        success: function(email) {
            renderEmailPreview(email);
            $('#email-list-container').hide();
            $('#email-preview-container').show();
        },
        error: function() {
            alert('Failed to load email');
        }
    });
}

function renderEmailPreview(email) {
    const from = email.From ? parseEmailAddress(email.From) : { name: 'Unknown', email: '' };
    const to = email.To ? parseEmailAddress(email.To) : { name: '', email: '' };
    const subject = email.Subject || '(No Subject)';
    const date = formatDate(email.Created);
    const html = email.HTML || email.Text || '';
    
    let previewHtml = `
        <div class="email-preview-header-info">
            <div class="email-preview-avatar">
                <span>${from.name.charAt(0).toUpperCase()}</span>
            </div>
            <div class="email-preview-info">
                <div class="email-preview-name">${escapeHtml(from.name)}</div>
                <div class="email-preview-email">${escapeHtml(from.email)}</div>
            </div>
        </div>
        <div class="email-preview-meta">
            <div class="email-meta-item">
                <strong>To:</strong> ${escapeHtml(to.email)}
            </div>
            <div class="email-meta-item">
                <strong>Date:</strong> ${date}
            </div>
        </div>
        <div class="email-preview-subject">
            ${escapeHtml(subject)}
        </div>
        <div class="email-preview-body">
            ${html || '<p style="color: rgba(255,255,255,0.7);">No content</p>'}
        </div>
    `;
    
    $('#email-preview-content').html(previewHtml);
}

function deleteEmail(emailId) {
    if (!confirm('Are you sure you want to delete this email?')) return;
    
    $.ajax({
        url: MAILPIT_API + '/message/' + emailId,
        method: 'DELETE',
        success: function() {
            loadEmails();
            $('#email-list-container').show();
            $('#email-preview-container').hide();
        },
        error: function() {
            alert('Failed to delete email');
        }
    });
}

function toggleStar(emailId) {
    // Mailpit doesn't have native star support, but we can track it locally
    const icon = $('#star-email iconify-icon');
    if (icon.attr('icon') === 'mdi:star-outline') {
        icon.attr('icon', 'mdi:star');
    } else {
        icon.attr('icon', 'mdi:star-outline');
    }
}

function updateCounts(data) {
    const total = data.total || 0;
    $('#inbox-count').text(total);
    // Other counts would need to be calculated based on folder filtering
}

function parseEmailAddress(addressString) {
    const match = addressString.match(/^(.+?)\s*<(.+?)>$/);
    if (match) {
        return { name: match[1].trim(), email: match[2].trim() };
    }
    return { name: addressString, email: addressString };
}

function formatDate(timestamp) {
    const date = new Date(timestamp * 1000);
    const now = new Date();
    const diff = now - date;
    const minutes = Math.floor(diff / 60000);
    const hours = Math.floor(diff / 3600000);
    const days = Math.floor(diff / 86400000);
    
    if (minutes < 1) return 'Just now';
    if (minutes < 60) return minutes + 'm ago';
    if (hours < 24) return hours + 'h ago';
    if (days < 7) return days + 'd ago';
    return date.toLocaleDateString();
}

function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}
</script>
	
	<style>
.email-client-wrapper {
    display: flex;
    height: 100%;
    gap: 20px;
    background: #ffffff;
    border-radius: 8px;
    overflow: hidden;
}

/* WowDash Card Styles */
.card {
    background: #ffffff;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08), 0 1px 4px rgba(0, 0, 0, 0.04);
}

.card-header {
    background: #ffffff;
    border-bottom: 1px solid #e0e0e0;
}

.bg-base {
    background: #ffffff !important;
}

.text-lg {
    font-size: 18px;
}

.fw-semibold {
    font-weight: 600;
}

.py-16 {
    padding-top: 16px;
    padding-bottom: 16px;
}

.px-24 {
    padding-left: 24px;
    padding-right: 24px;
}

.p-24 {
    padding: 24px;
}

.radius-8 {
    border-radius: 8px;
}

.radius-4 {
    border-radius: 4px;
}

.list-group {
    list-style: none;
    padding: 0;
    margin: 0;
}

.list-group-item {
    background: #ffffff;
    border: 1px solid #e0e0e0;
    transition: all 0.2s ease;
}

.list-group-item:hover {
    background: #f8f9fa;
}

.text-secondary-light {
    color: #6b7280;
}

.text-xs {
    font-size: 12px;
}

.px-10 {
    padding-left: 10px;
    padding-right: 10px;
}

.py-2 {
    padding-top: 2px;
    padding-bottom: 2px;
}

/* Priority Badge Colors */
.bg-danger-100 {
    background-color: #ffebee !important;
}

.text-danger-600 {
    color: #e53935 !important;
}

.bg-success-100 {
    background-color: #e8f5e9 !important;
}

.text-success-600 {
    color: #43a047 !important;
}

.bg-lilac-100 {
    background-color: #f3e5f5 !important;
}

.text-lilac-600 {
    color: #8e24aa !important;
}

.email-avatar-circle {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: linear-gradient(135deg, #43a047 0%, #66bb6a 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    font-weight: 600;
    font-size: 14px;
    flex-shrink: 0;
}

.email-sidebar {
    width: 250px;
    background: #f8f9fa;
    padding: 20px;
    display: flex;
    flex-direction: column;
    gap: 20px;
    border-right: 1px solid #e0e0e0;
}

.btn-compose {
    background: #43a047;
    color: #ffffff;
    border: none;
    padding: 12px 20px;
    border-radius: 8px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-compose:hover {
    background: #388e3c;
    transform: translateY(-2px);
}

.email-folders {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.email-folder {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    border-radius: 8px;
    color: #1a1a1a;
    text-decoration: none;
    transition: all 0.2s ease;
    font-weight: 500;
}

.email-folder:hover {
    background: #e8f5e9;
    color: #43a047;
}

.email-folder.active {
    background: #c8e6c9;
    color: #43a047;
}

.email-count {
    margin-left: auto;
    background: rgba(67, 160, 71, 0.1);
    color: #43a047;
    padding: 2px 8px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
}

.email-tags {
    margin-top: auto;
}

.tags-header {
    font-size: 11px;
    font-weight: 600;
    color: #6b7280;
    text-transform: uppercase;
    margin-bottom: 12px;
    letter-spacing: 0.5px;
}

.email-tag {
			display: flex;
			align-items: center;
    gap: 10px;
    padding: 8px 12px;
    border-radius: 6px;
    color: #1a1a1a;
    text-decoration: none;
    transition: all 0.2s ease;
			font-size: 14px;
		}
		
.email-tag:hover {
    background: #f0f0f0;
}

.tag-color {
    width: 12px;
    height: 12px;
    border-radius: 50%;
}

.email-main {
    flex: 1;
    display: flex;
    flex-direction: column;
    background: #ffffff;
    overflow: hidden;
}

.email-list-container {
    flex: 1;
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

.email-list-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    border-bottom: 1px solid #e0e0e0;
}

.email-actions {
    display: flex;
    gap: 8px;
}

.btn-icon {
    background: transparent;
			border: none;
    padding: 8px;
    border-radius: 6px;
    color: #6b7280;
    cursor: pointer;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-icon:hover {
    background: #f0f0f0;
    color: #1a1a1a;
}

.email-list {
    flex: 1;
    overflow-y: auto;
}

/* List group item styling for emails */
.list-group-item[data-id] {
    cursor: pointer;
}

.list-group-item[data-id]:hover {
    background: #f8f9fa !important;
}

/* Gap utility for flex items */
.gap-2 {
    gap: 8px;
}

/* Bootstrap-like utility classes */
.d-flex {
    display: flex;
}

.align-items-center {
    align-items: center;
}

.justify-content-between {
    justify-content: space-between;
}

.justify-content-center {
    justify-content: center;
}

.flex-column {
    flex-direction: column;
}

.mb-0 {
    margin-bottom: 0;
}

.mb-2 {
    margin-bottom: 8px;
}

.h-100 {
    height: 100%;
}

.p-0 {
    padding: 0;
}

.border {
    border: 1px solid #e0e0e0;
}

.border-bottom {
    border-bottom: 1px solid #e0e0e0;
}

.border-bottom-0 {
    border-bottom: none !important;
}

.border-0 {
    border: none !important;
}

.text-center {
    text-align: center;
}

.email-preview-container {
    flex: 1;
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

.email-preview-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    border-bottom: 1px solid #e0e0e0;
}

.btn-back {
    background: transparent;
    border: none;
    padding: 8px;
    border-radius: 6px;
    color: #6b7280;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-back:hover {
    background: #f0f0f0;
}

.email-preview-content {
    flex: 1;
    overflow-y: auto;
    padding: 30px;
}

.email-preview-header-info {
    display: flex;
    gap: 16px;
    margin-bottom: 24px;
}

.email-preview-avatar {
    width: 64px;
    height: 64px;
    border-radius: 50%;
    background: linear-gradient(135deg, #43a047 0%, #66bb6a 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    font-weight: 600;
    font-size: 24px;
    flex-shrink: 0;
}

.email-preview-info {
    flex: 1;
}

.email-preview-name {
    font-size: 20px;
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 4px;
}

.email-preview-email {
    font-size: 14px;
    color: #6b7280;
}

.email-preview-meta {
    display: flex;
    flex-direction: column;
    gap: 8px;
    padding: 16px;
    background: #f8f9fa;
    border-radius: 8px;
    margin-bottom: 24px;
}

.email-meta-item {
    font-size: 14px;
    color: #1a1a1a;
}

.email-preview-subject {
    font-size: 24px;
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 24px;
    padding-bottom: 16px;
    border-bottom: 1px solid #e0e0e0;
}

.email-preview-body {
    font-size: 15px;
    line-height: 1.6;
    color: #1a1a1a;
}

.email-list-loading,
.email-list-empty {
    border: none !important;
    background: #ffffff !important;
}

.email-list-loading iconify-icon,
.email-list-empty iconify-icon {
    color: #6b7280;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

/* Scrollbar styling */
.email-list::-webkit-scrollbar,
.email-preview-content::-webkit-scrollbar {
    width: 8px;
}

.email-list::-webkit-scrollbar-track,
.email-preview-content::-webkit-scrollbar-track {
    background: #f0f0f0;
}

.email-list::-webkit-scrollbar-thumb,
.email-preview-content::-webkit-scrollbar-thumb {
    background: #c0c0c0;
    border-radius: 4px;
}

.email-list::-webkit-scrollbar-thumb:hover,
.email-preview-content::-webkit-scrollbar-thumb:hover {
    background: #a0a0a0;
    }
</style>
    </div>
</div>
