<?php
/**
 * Application: Laragon | Project Creation Wizard
 * Description: Step-by-step project creation wizard with framework detection
 * Version: 2.6.0
 */
?>
<div class="project-wizard-modal" id="project-wizard-modal" style="display: none;">
    <div class="wizard-overlay"></div>
    <div class="wizard-container">
        <div class="wizard-header">
            <h3 class="wizard-title">Create New Project</h3>
            <button class="wizard-close" id="wizard-close">
                <iconify-icon icon="mdi:close"></iconify-icon>
            </button>
        </div>
        
        <div class="wizard-steps">
            <div class="wizard-step-indicator">
                <div class="step-item active" data-step="1">
                    <div class="step-number">1</div>
                    <div class="step-label">Project Info</div>
                </div>
                <div class="step-item" data-step="2">
                    <div class="step-number">2</div>
                    <div class="step-label">Framework</div>
                </div>
                <div class="step-item" data-step="3">
                    <div class="step-number">3</div>
                    <div class="step-label">Database</div>
                </div>
                <div class="step-item" data-step="4">
                    <div class="step-number">4</div>
                    <div class="step-label">Finalize</div>
                </div>
            </div>
        </div>
        
        <div class="wizard-content">
            <!-- Step 1: Project Information -->
            <div class="wizard-step active" data-step="1">
                <div class="wizard-form-group">
                    <label for="project-name">Project Name</label>
                    <input type="text" id="project-name" class="wizard-input" placeholder="my-awesome-project" required>
                    <small class="wizard-hint">Only letters, numbers, hyphens, and underscores allowed</small>
                </div>
                <div class="wizard-form-group">
                    <label for="project-path">Project Path</label>
                    <input type="text" id="project-path" class="wizard-input" placeholder="C:/laragon/www/" readonly>
                    <small class="wizard-hint">Project will be created in the www directory</small>
                </div>
                <div class="wizard-form-group">
                    <label>
                        <input type="checkbox" id="init-git" class="wizard-checkbox">
                        Initialize Git Repository
                    </label>
                </div>
            </div>
            
            <!-- Step 2: Framework Selection -->
            <div class="wizard-step" data-step="2">
                <div class="framework-grid">
                    <div class="framework-card" data-framework="wordpress">
                        <iconify-icon icon="mdi:wordpress" class="framework-icon"></iconify-icon>
                        <div class="framework-name">WordPress</div>
                        <div class="framework-desc">Blog & CMS Platform</div>
                    </div>
                    <div class="framework-card" data-framework="laravel">
                        <iconify-icon icon="mdi:laravel" class="framework-icon"></iconify-icon>
                        <div class="framework-name">Laravel</div>
                        <div class="framework-desc">PHP Framework</div>
                    </div>
                    <div class="framework-card" data-framework="symfony">
                        <iconify-icon icon="mdi:symfony" class="framework-icon"></iconify-icon>
                        <div class="framework-name">Symfony</div>
                        <div class="framework-desc">PHP Framework</div>
                    </div>
                    <div class="framework-card" data-framework="drupal">
                        <iconify-icon icon="mdi:drupal" class="framework-icon"></iconify-icon>
                        <div class="framework-name">Drupal</div>
                        <div class="framework-desc">CMS Platform</div>
                    </div>
                    <div class="framework-card" data-framework="joomla">
                        <iconify-icon icon="mdi:joomla" class="framework-icon"></iconify-icon>
                        <div class="framework-name">Joomla</div>
                        <div class="framework-desc">CMS Platform</div>
                    </div>
                    <div class="framework-card" data-framework="custom">
                        <iconify-icon icon="mdi:code-tags" class="framework-icon"></iconify-icon>
                        <div class="framework-name">Custom</div>
                        <div class="framework-desc">Empty Project</div>
                    </div>
                </div>
                <input type="hidden" id="selected-framework" value="">
            </div>
            
            <!-- Step 3: Database Setup -->
            <div class="wizard-step" data-step="3">
                <div class="wizard-form-group">
                    <label>
                        <input type="checkbox" id="create-database" class="wizard-checkbox" checked>
                        Create Database
                    </label>
                </div>
                <div id="database-options" class="wizard-form-group">
                    <label for="database-name">Database Name</label>
                    <input type="text" id="database-name" class="wizard-input" placeholder="auto-generated">
                    <small class="wizard-hint">Leave empty to auto-generate from project name</small>
                </div>
                <div class="wizard-form-group">
                    <label for="database-user">Database User</label>
                    <input type="text" id="database-user" class="wizard-input" value="root" readonly>
                </div>
                <div class="wizard-form-group">
                    <label for="database-password">Database Password</label>
                    <input type="password" id="database-password" class="wizard-input" placeholder="Leave empty for no password">
                </div>
            </div>
            
            <!-- Step 4: Finalize -->
            <div class="wizard-step" data-step="4">
                <div class="wizard-summary">
                    <h4>Project Summary</h4>
                    <div class="summary-item">
                        <strong>Project Name:</strong> <span id="summary-name">-</span>
                    </div>
                    <div class="summary-item">
                        <strong>Framework:</strong> <span id="summary-framework">-</span>
                    </div>
                    <div class="summary-item">
                        <strong>Database:</strong> <span id="summary-database">-</span>
                    </div>
                    <div class="summary-item">
                        <strong>Git:</strong> <span id="summary-git">-</span>
                    </div>
                    <div class="summary-item">
                        <strong>Virtual Host:</strong> <span id="summary-vhost">-</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="wizard-actions">
            <button class="wizard-btn wizard-btn-secondary" id="wizard-prev" style="display: none;">Previous</button>
            <button class="wizard-btn wizard-btn-primary" id="wizard-next">Next</button>
            <button class="wizard-btn wizard-btn-primary" id="wizard-create" style="display: none;">Create Project</button>
        </div>
    </div>
</div>

<style>
.project-wizard-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 10000;
}

.wizard-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(4px);
}

.wizard-container {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #ffffff;
    border-radius: 12px;
    width: 90%;
    max-width: 700px;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
}

.wizard-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 30px;
    border-bottom: 1px solid #e5e7eb;
}

.wizard-title {
    font-size: 24px;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0;
    font-family: "Nunito", sans-serif;
}

.wizard-close {
    background: transparent;
    border: none;
    cursor: pointer;
    padding: 8px;
    color: #6b7280;
    transition: color 0.2s ease;
}

.wizard-close:hover {
    color: #1a1a1a;
}

.wizard-steps {
    padding: 20px 30px;
    border-bottom: 1px solid #e5e7eb;
}

.wizard-step-indicator {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.step-item {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
}

.step-item::after {
    content: '';
    position: absolute;
    top: 20px;
    left: 50%;
    width: 100%;
    height: 2px;
    background: #e5e7eb;
    z-index: 0;
}

.step-item:last-child::after {
    display: none;
}

.step-item.active .step-number {
    background: #00adef;
    color: #ffffff;
}

.step-number {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #e5e7eb;
    color: #6b7280;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    position: relative;
    z-index: 1;
    transition: all 0.3s ease;
}

.step-label {
    margin-top: 8px;
    font-size: 12px;
    color: #6b7280;
    font-family: "Nunito", sans-serif;
}

.step-item.active .step-label {
    color: #00adef;
    font-weight: 600;
}

.wizard-content {
    padding: 30px;
    min-height: 300px;
}

.wizard-step {
    display: none;
}

.wizard-step.active {
    display: block;
}

.wizard-form-group {
    margin-bottom: 20px;
}

.wizard-form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    color: #1a1a1a;
    font-family: "Nunito", sans-serif;
}

.wizard-input {
    width: 100%;
    padding: 12px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 14px;
    font-family: "Nunito", sans-serif;
    transition: border-color 0.2s ease;
}

.wizard-input:focus {
    outline: none;
    border-color: #00adef;
}

.wizard-hint {
    display: block;
    margin-top: 4px;
    font-size: 12px;
    color: #6b7280;
}

.wizard-checkbox {
    margin-right: 8px;
}

.framework-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
}

.framework-card {
    padding: 20px;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    text-align: center;
    cursor: pointer;
    transition: all 0.2s ease;
}

.framework-card:hover {
    border-color: #00adef;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 173, 239, 0.15);
}

.framework-card.selected {
    border-color: #00adef;
    background: rgba(0, 173, 239, 0.05);
}

.framework-icon {
    font-size: 48px;
    color: #6b7280;
    margin-bottom: 10px;
}

.framework-card.selected .framework-icon {
    color: #00adef;
}

.framework-name {
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 4px;
    font-family: "Nunito", sans-serif;
}

.framework-desc {
    font-size: 12px;
    color: #6b7280;
}

.wizard-summary {
    background: #f5f7fa;
    padding: 20px;
    border-radius: 8px;
}

.wizard-summary h4 {
    margin-top: 0;
    margin-bottom: 15px;
    font-family: "Nunito", sans-serif;
}

.summary-item {
    margin-bottom: 10px;
    font-family: "Nunito", sans-serif;
}

.wizard-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    padding: 20px 30px;
    border-top: 1px solid #e5e7eb;
}

.wizard-btn {
    padding: 10px 24px;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    font-family: "Nunito", sans-serif;
}

.wizard-btn-primary {
    background: #00adef;
    color: #ffffff;
}

.wizard-btn-primary:hover {
    background: #0099d6;
}

.wizard-btn-secondary {
    background: #e5e7eb;
    color: #1a1a1a;
}

.wizard-btn-secondary:hover {
    background: #d1d5db;
}
</style>

<script>
$(document).ready(function() {
    let currentStep = 1;
    const totalSteps = 4;
    
    // Open wizard
    $(document).on('click', '.open-project-wizard', function(e) {
        e.preventDefault();
        $('#project-wizard-modal').fadeIn(300);
        resetWizard();
    });
    
    // Close wizard
    $('#wizard-close, .wizard-overlay').on('click', function() {
        $('#project-wizard-modal').fadeOut(300);
    });
    
    // Prevent closing when clicking inside wizard
    $('.wizard-container').on('click', function(e) {
        e.stopPropagation();
    });
    
    // Next button
    $('#wizard-next').on('click', function() {
        if (validateStep(currentStep)) {
            if (currentStep < totalSteps) {
                goToStep(currentStep + 1);
            }
        }
    });
    
    // Previous button
    $('#wizard-prev').on('click', function() {
        if (currentStep > 1) {
            goToStep(currentStep - 1);
        }
    });
    
    // Framework selection
    $('.framework-card').on('click', function() {
        $('.framework-card').removeClass('selected');
        $(this).addClass('selected');
        $('#selected-framework').val($(this).data('framework'));
    });
    
    // Database checkbox
    $('#create-database').on('change', function() {
        if ($(this).is(':checked')) {
            $('#database-options').show();
        } else {
            $('#database-options').hide();
        }
    });
    
    // Create project
    $('#wizard-create').on('click', function() {
        createProject();
    });
    
    function goToStep(step) {
        currentStep = step;
        
        // Update step indicators
        $('.step-item').removeClass('active');
        $('.step-item[data-step="' + step + '"]').addClass('active');
        
        // Update wizard steps
        $('.wizard-step').removeClass('active');
        $('.wizard-step[data-step="' + step + '"]').addClass('active');
        
        // Update buttons
        if (step === 1) {
            $('#wizard-prev').hide();
        } else {
            $('#wizard-prev').show();
        }
        
        if (step === totalSteps) {
            $('#wizard-next').hide();
            $('#wizard-create').show();
            updateSummary();
        } else {
            $('#wizard-next').show();
            $('#wizard-create').hide();
        }
    }
    
    function validateStep(step) {
        if (step === 1) {
            const projectName = $('#project-name').val().trim();
            if (!projectName || !/^[a-zA-Z0-9_-]+$/.test(projectName)) {
                alert('Please enter a valid project name (letters, numbers, hyphens, underscores only)');
                return false;
            }
        } else if (step === 2) {
            if (!$('#selected-framework').val()) {
                alert('Please select a framework');
                return false;
            }
        }
        return true;
    }
    
    function updateSummary() {
        $('#summary-name').text($('#project-name').val() || '-');
        $('#summary-framework').text($('#selected-framework').val() || '-');
        const dbName = $('#create-database').is(':checked') ? ($('#database-name').val() || $('#project-name').val() || 'auto') : 'No';
        $('#summary-database').text(dbName);
        $('#summary-git').text($('#init-git').is(':checked') ? 'Yes' : 'No');
        $('#summary-vhost').text($('#project-name').val() + '.test');
    }
    
    function resetWizard() {
        currentStep = 1;
        goToStep(1);
        $('#project-name').val('');
        $('#selected-framework').val('');
        $('.framework-card').removeClass('selected');
        $('#create-database').prop('checked', true);
        $('#database-name').val('');
        $('#database-password').val('');
        $('#init-git').prop('checked', false);
    }
    
    function createProject() {
        const projectData = {
            name: $('#project-name').val(),
            framework: $('#selected-framework').val(),
            create_database: $('#create-database').is(':checked'),
            database_name: $('#database-name').val() || $('#project-name').val(),
            database_user: $('#database-user').val(),
            database_password: $('#database-password').val(),
            init_git: $('#init-git').is(':checked')
        };
        
        $('#wizard-create').prop('disabled', true).text('Creating...');
        
        $.ajax({
            url: 'Laragon-Dashboard/api/project_wizard.php',
            method: 'POST',
            data: projectData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert('Project created successfully!');
                    $('#project-wizard-modal').fadeOut(300);
                    // Reload projects list
                    if (typeof loadProjects === 'function') {
                        loadProjects();
                    }
                } else {
                    alert('Error: ' + (response.message || 'Failed to create project'));
                    $('#wizard-create').prop('disabled', false).text('Create Project');
                }
            },
            error: function() {
                alert('An error occurred while creating the project');
                $('#wizard-create').prop('disabled', false).text('Create Project');
            }
        });
    }
});
</script>

