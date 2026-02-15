<!-- AI Agent Chat Widget -->
<div id="ai-agent-widget" class="ai-agent-widget">
    <!-- Chat Toggle Button -->
    <button id="ai-agent-toggle" class="ai-agent-toggle glass-card shadow-lg" title="AI Assistant">
        <iconify-icon icon="solar:magic-stick-3-bold-duotone" width="28" height="28"></iconify-icon>
        <span class="ai-agent-badge d-none"></span>
    </button>

    <!-- Chat Window -->
    <div id="ai-agent-window" class="ai-agent-window glass-card shadow-lg d-none">
        <div class="ai-agent-header d-flex align-items-center justify-content-between p-3 border-bottom border-white-10">
            <div class="d-flex align-items-center gap-2">
                <div class="ai-agent-avatar glass-card p-2 bg-primary-600">
                    <iconify-icon icon="solar:magic-stick-3-bold-duotone" width="20" height="20" class="text-white"></iconify-icon>
                </div>
                <div>
                    <h6 class="mb-0 text-white">Laragon AI Agent</h6>
                    <small class="text-white-50">BYOK Edition • Beta</small>
                </div>
            </div>
            <button id="ai-agent-close" class="btn btn-sm btn-icon btn-ghost-light">
                <iconify-icon icon="material-symbols:close-rounded" width="20" height="20"></iconify-icon>
            </button>
        </div>

        <div id="ai-agent-messages" class="ai-agent-messages p-3 overflow-y-auto">
            <div class="ai-message system glass-card p-2 mb-3">
                <small class="text-white-50 d-block mb-1">System Info</small>
                <div class="text-white small">Welcome! I'm your local BYOK AI Agent. I can help you scaffold projects, troubleshoot services, and manage your Laragon environment.</div>
            </div>
            <div class="ai-message assistant glass-card p-3 mb-3">
                <div class="text-white small">How can I help you today? You can ask me things like "Scaffold a new Laravel project" or "Check why my MySQL is down".</div>
            </div>
        </div>

        <div class="ai-agent-footer p-3 border-top border-white-10">
            <div class="input-group">
                <input type="text" id="ai-agent-input" class="form-control form-control-sm bg-white-5 border-white-10 text-white" placeholder="Ask anything...">
                <button id="ai-agent-send" class="btn btn-sm btn-primary">
                    <iconify-icon icon="solar:plain-3-bold-duotone" width="18" height="18"></iconify-icon>
                </button>
            </div>
            <div class="d-flex align-items-center justify-content-between mt-2">
                <small class="text-white-30" style="font-size: 10px;">Context: <span id="ai-agent-context-status">Scanning...</span></small>
                <a href="index.php?page=preferences#ai-settings" class="text-white-50 small" style="font-size: 10px;">Settings</a>
            </div>
        </div>
    </div>
</div>

<style>
.ai-agent-widget {
    position: fixed;
    bottom: 30px;
    right: 30px;
    z-index: 9999;
}

.ai-agent-toggle {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    border: 1px solid rgba(255, 255, 255, 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    background: rgba(var(--primary-rgb), 0.2);
    color: white;
}

.ai-agent-toggle:hover {
    transform: scale(1.1) rotate(5deg);
    background: rgba(var(--primary-rgb), 0.4);
}

.ai-agent-window {
    position: absolute;
    bottom: 80px;
    right: 0;
    width: 380px;
    height: 550px;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    animation: slideUp 0.3s ease-out;
    background: #020617 !important; /* Extremely solid dark center */
    border: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.8);
    border-radius: 16px;
    z-index: 999999; /* Higher priority */
}

.ai-agent-header {
    background: rgba(15, 23, 42, 0.9) !important;
    backdrop-filter: blur(20px);
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}

.ai-agent-footer {
    background: rgba(15, 23, 42, 0.9) !important;
    backdrop-filter: blur(20px);
    border-top: 1px solid rgba(255, 255, 255, 0.05);
}

.ai-agent-messages {
    flex: 1;
    overflow-y: auto;
    padding: 1.25rem;
    background: #020617 !important; /* Solid dark */
    scrollbar-width: thin;
    scrollbar-color: rgba(255, 255, 255, 0.1) transparent;
}

.ai-agent-messages::-webkit-scrollbar {
    width: 6px;
}

.ai-agent-messages::-webkit-scrollbar-track {
    background: transparent;
}

.ai-agent-messages::-webkit-scrollbar-thumb {
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 10px;
}

.ai-agent-messages::-webkit-scrollbar-thumb:hover {
    background-color: rgba(255, 255, 255, 0.2);
}

.ai-message.assistant {
    background: rgba(var(--primary-rgb), 0.2) !important;
    border-left: 3px solid rgba(var(--primary-rgb), 0.5);
    margin-right: 20%;
}

.ai-message.user {
    background: rgba(255, 255, 255, 0.05);
    border-right: 3px solid rgba(255, 255, 255, 0.2);
    margin-left: 20%;
    text-align: right;
}

.ai-message.system {
    background: rgba(255, 193, 7, 0.15) !important;
    border-left: 3px solid rgba(255, 193, 7, 0.3);
}

.border-white-10 { border-color: rgba(255, 255, 255, 0.1) !important; }
.text-white-30 { color: rgba(255, 255, 255, 0.3) !important; }
.text-white-50 { color: rgba(255, 255, 255, 0.5) !important; }
</style>
