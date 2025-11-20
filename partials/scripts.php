<?php
// Use root assets directory (same as head.php) - ensure absolute path
$assetsUrl = defined('ASSETS_URL') ? ASSETS_URL : '/assets';
// Ensure ASSETS_URL is always absolute (starts with /)
if (substr($assetsUrl, 0, 1) !== '/') {
    $assetsUrl = '/' . $assetsUrl;
}
?>
    <!-- jQuery library js -->
    <script src="<?php echo $assetsUrl; ?>/js/lib/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap js -->
    <script src="<?php echo $assetsUrl; ?>/js/lib/bootstrap.bundle.min.js"></script>
    <!-- Apex Chart js -->
    <script src="<?php echo $assetsUrl; ?>/js/lib/apexcharts.min.js"></script>
    <!-- Data Table js -->
    <script src="<?php echo $assetsUrl; ?>/js/lib/dataTables.min.js"></script>
    <!-- Iconify Font js -->
    <script src="<?php echo $assetsUrl; ?>/js/lib/iconify-icon.min.js"></script>
    <!-- jQuery UI js -->
    <script src="<?php echo $assetsUrl; ?>/js/lib/jquery-ui.min.js"></script>
    <!-- Vector Map js -->
    <script src="<?php echo $assetsUrl; ?>/js/lib/jquery-jvectormap-2.0.5.min.js"></script>
    <script src="<?php echo $assetsUrl; ?>/js/lib/jquery-jvectormap-world-mill-en.js"></script>
    <!-- Popup js -->
    <script src="<?php echo $assetsUrl; ?>/js/lib/magnifc-popup.min.js"></script>
    <!-- Slick Slider js -->
    <script src="<?php echo $assetsUrl; ?>/js/lib/slick.min.js"></script>
    <!-- prism js -->
    <script src="<?php echo $assetsUrl; ?>/js/lib/prism.js"></script>
    <!-- CodeMirror js -->
    <script src="<?php echo $assetsUrl; ?>/js/lib/codemirror.min.js"></script>
    <script src="<?php echo $assetsUrl; ?>/js/lib/mode/apache/apache.min.js"></script>
    <script src="<?php echo $assetsUrl; ?>/js/lib/mode/php/php.min.js"></script>
    <script src="<?php echo $assetsUrl; ?>/js/lib/mode/sql/sql.min.js"></script>
    <script src="<?php echo $assetsUrl; ?>/js/lib/mode/ini/ini.min.js"></script>
    <script src="<?php echo $assetsUrl; ?>/js/lib/mode/shell/shell.min.js"></script>
    <!-- file upload js -->
    <script src="<?php echo $assetsUrl; ?>/js/lib/file-upload.js"></script>
    <!-- audioplayer -->
    <script src="<?php echo $assetsUrl; ?>/js/lib/audioplayer.js"></script>

    <!-- main js -->
    <script src="<?php echo $assetsUrl; ?>/js/app.js"></script>

    <!-- Time Greeting and Clock Script -->
    <script>
    (function() {
        'use strict';
        
        // Get preferences for time/date format
        const timeFormat = <?php echo defined('TIME_FORMAT') ? json_encode(TIME_FORMAT) : 'null'; ?>;
        const dateFormat = <?php echo defined('DATE_FORMAT') ? json_encode(DATE_FORMAT) : 'null'; ?>;
        
        // Get translations for greetings
        const greetings = {
            morning: '<?php echo function_exists("t") ? t("dashboard.good_morning", "Good morning") : "Good morning"; ?>',
            afternoon: '<?php echo function_exists("t") ? t("dashboard.good_afternoon", "Good afternoon") : "Good afternoon"; ?>',
            evening: '<?php echo function_exists("t") ? t("dashboard.good_evening", "Good evening") : "Good evening"; ?>'
        };
        
        // Get greeting icon based on time
        function getGreetingIcon(hour) {
            if (hour >= 5 && hour < 12) {
                return 'solar:sun-bold'; // Morning
            } else if (hour >= 12 && hour < 17) {
                return 'solar:sun-2-bold'; // Afternoon
            } else {
                return 'solar:moon-bold'; // Evening/Night
            }
        }
        
        // Get greeting text based on time
        function getGreeting(hour) {
            if (hour >= 5 && hour < 12) {
                return greetings.morning;
            } else if (hour >= 12 && hour < 17) {
                return greetings.afternoon;
            } else {
                return greetings.evening;
            }
        }
        
        // Format time based on preferences
        function formatTime(date, format) {
            const hour = date.getHours();
            const minute = date.getMinutes();
            const second = date.getSeconds();
            
            if (format === '12') {
                const hour12 = hour % 12 || 12;
                const ampm = hour >= 12 ? 'PM' : 'AM';
                return String(hour12).padStart(2, '0') + ':' + 
                       String(minute).padStart(2, '0') + ':' + 
                       String(second).padStart(2, '0') + ' ' + ampm;
            } else {
                return String(hour).padStart(2, '0') + ':' + 
                       String(minute).padStart(2, '0') + ':' + 
                       String(second).padStart(2, '0');
            }
        }
        
        // Format date based on preferences
        function formatDate(date, format) {
            if (!format) {
                format = 'Y-m-d'; // Default
            }
            
            const year = date.getFullYear();
            const month = date.getMonth() + 1;
            const day = date.getDate();
            
            const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            const monthFullNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            
            let formatted = format;
            formatted = formatted.replace('Y', year);
            formatted = formatted.replace('y', String(year).slice(-2));
            formatted = formatted.replace('m', String(month).padStart(2, '0'));
            formatted = formatted.replace('M', monthNames[month - 1]);
            formatted = formatted.replace('F', monthFullNames[month - 1]);
            formatted = formatted.replace('d', String(day).padStart(2, '0'));
            formatted = formatted.replace('j', String(day));
            
            return formatted;
        }
        
        // Update greeting and time
        function updateGreetingAndTime() {
            const now = new Date();
            const hour = now.getHours();
            
            // Update greeting
            const greetingEl = document.getElementById('time-greeting');
            const iconEl = document.getElementById('greeting-icon');
            if (greetingEl) {
                greetingEl.textContent = getGreeting(hour);
            }
            if (iconEl) {
                iconEl.setAttribute('icon', getGreetingIcon(hour));
            }
            
            // Update time
            const timeEl = document.getElementById('local-time');
            const dateEl = document.getElementById('local-date');
            if (timeEl) {
                timeEl.textContent = formatTime(now, timeFormat || '24');
            }
            if (dateEl) {
                dateEl.textContent = formatDate(now, dateFormat || 'Y-m-d');
            }
            
            // Update display container to show date and time on one line
            const displayEl = document.getElementById('local-time-display');
            if (displayEl && dateEl && timeEl) {
                displayEl.innerHTML = '<span id="local-date">' + dateEl.textContent + '</span> <span id="local-time">' + timeEl.textContent + '</span>';
            }
        }
        
        // Initialize on page load
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function() {
                updateGreetingAndTime();
                // Update every second
                setInterval(updateGreetingAndTime, 1000);
            });
        } else {
            updateGreetingAndTime();
            // Update every second
            setInterval(updateGreetingAndTime, 1000);
        }
    })();
    </script>

    <!-- Theme Switcher Script -->
    <script>
    (function() {
        'use strict';
        
        // Get current theme from localStorage or default to light
        function getCurrentTheme() {
            return localStorage.getItem('theme') || 'light';
        }
        
        // Update HTML data-theme attribute (monochrome is handled separately in footer.php)
        function updateTheme(theme) {
            const html = document.querySelector('html');
            
            // Only handle light/dark themes here
            if (theme !== 'monochrome') {
                html.setAttribute('data-theme', theme);
                localStorage.setItem('theme', theme);
                localStorage.setItem('lightDarkTheme', theme);
                
                // If monochrome is active, keep it active but update the base theme
                const isMonochrome = localStorage.getItem('monochromeMode') === 'true';
                if (isMonochrome) {
                    // Monochrome stays active, just update the underlying theme
                    html.setAttribute('data-theme', theme);
                }
            }
            
            updateThemeButtons(theme);
        }
        
        // Toggle between light and dark
        function toggleLightDark() {
            const current = getCurrentTheme();
            const isMonochrome = localStorage.getItem('monochromeMode') === 'true';
            
            // Get the actual light/dark theme (not monochrome)
            let currentLightDark;
            if (isMonochrome) {
                currentLightDark = localStorage.getItem('lightDarkTheme') || 'light';
            } else {
                currentLightDark = current !== 'monochrome' ? current : 'light';
            }
            
            const newTheme = (currentLightDark === 'light') ? 'dark' : 'light';
            updateTheme(newTheme);
        }
        
        // Update button states and icons
        function updateThemeButtons(currentTheme) {
            // Handle light/dark toggle button
            const lightDarkBtn = document.querySelector('[data-theme-toggle="light-dark"]');
            if (lightDarkBtn) {
                const lightIcon = lightDarkBtn.querySelector('.theme-icon-light');
                const darkIcon = lightDarkBtn.querySelector('.theme-icon-dark');
                
                // Only update icons if they exist
                if (lightIcon && darkIcon) {
                    if (currentTheme === 'light') {
                        lightIcon.style.display = 'block';
                        darkIcon.style.display = 'none';
                    } else if (currentTheme === 'dark') {
                        lightIcon.style.display = 'none';
                        darkIcon.style.display = 'block';
                    } else {
                        // Monochrome is active, show dark icon but dimmed
                        lightIcon.style.display = 'none';
                        darkIcon.style.display = 'block';
                    }
                }
                
                // Update button background
                lightDarkBtn.classList.remove('bg-primary-600');
                lightDarkBtn.classList.add('bg-neutral-200');
            }
            
            // Handle monochrome button
            const monochromeBtn = document.querySelector('[data-theme-toggle="monochrome"]');
            if (monochromeBtn) {
                if (currentTheme === 'monochrome') {
                    monochromeBtn.classList.add('active');
                    monochromeBtn.classList.add('bg-primary-600');
                    monochromeBtn.classList.remove('bg-neutral-200');
                } else {
                    monochromeBtn.classList.remove('active');
                    monochromeBtn.classList.remove('bg-primary-600');
                    monochromeBtn.classList.add('bg-neutral-200');
                }
            }
        }
        
        // Wait for DOM to be fully loaded before initializing
        function initThemeSwitcher() {
            // Initialize theme on page load
            const currentTheme = getCurrentTheme();
            const isMonochrome = localStorage.getItem('monochromeMode') === 'true';
            
            // If monochrome is active, use the stored light/dark theme for data-theme
            if (isMonochrome) {
                const lightDarkTheme = localStorage.getItem('lightDarkTheme') || 'light';
                document.querySelector('html').setAttribute('data-theme', lightDarkTheme);
            } else {
                // Normal theme initialization
                const theme = currentTheme !== 'monochrome' ? currentTheme : 'light';
                updateTheme(theme);
            }
            
            // Update button states
            updateThemeButtons(isMonochrome ? 'monochrome' : currentTheme);
            
            // Light/Dark toggle button handler
            const lightDarkBtn = document.querySelector('[data-theme-toggle="light-dark"]');
            if (lightDarkBtn) {
                lightDarkBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    toggleLightDark();
                });
            }
            
            // Listen for monochrome mode changes from footer.php
            window.addEventListener('monochromeModeChanged', function(e) {
                const isMonochrome = e.detail.isMonochrome;
                const currentTheme = isMonochrome ? 'monochrome' : (localStorage.getItem('lightDarkTheme') || 'light');
                updateThemeButtons(currentTheme);
            });
        }
        
        // Initialize when DOM is ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initThemeSwitcher);
        } else {
            // DOM is already loaded
            initThemeSwitcher();
        }
    })();
    </script>

    <!-- Service Worker Registration for PWA -->
    <script>
    (function() {
        'use strict';
        
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                // Get base path dynamically
                const basePath = '<?php echo defined("BASE_URL") ? BASE_URL : ""; ?>';
                const swPath = basePath ? basePath + '/sw.js' : '/sw.js';
                
                navigator.serviceWorker.register(swPath)
                    .then(function(registration) {
                        console.log('ServiceWorker registration successful with scope: ', registration.scope);
                        
                        // Clear cache if requested (for troubleshooting CSS issues)
                        if (window.location.search.includes('clearcache=true') || 
                            (typeof sessionStorage !== 'undefined' && sessionStorage.getItem('sw_cleared') !== 'true')) {
                            registration.unregister().then(function() {
                                return caches.keys();
                            }).then(function(cacheNames) {
                                return Promise.all(cacheNames.map(function(cacheName) {
                                    return caches.delete(cacheName);
                                }));
                            }).then(function() {
                                console.log('Service Worker and caches cleared');
                                if (typeof sessionStorage !== 'undefined') {
                                    sessionStorage.setItem('sw_cleared', 'true');
                                }
                                // Reload after clearing
                                setTimeout(function() {
                                    window.location.reload();
                                }, 500);
                            });
                            return;
                        }
                        
                        // Check for updates
                        registration.addEventListener('updatefound', function() {
                            const newWorker = registration.installing;
                            newWorker.addEventListener('statechange', function() {
                                if (newWorker.state === 'installed' && navigator.serviceWorker.controller) {
                                    // New service worker available, prompt user to refresh
                                    console.log('New service worker available. Please refresh the page.');
                                }
                            });
                        });
                    })
                    .catch(function(error) {
                        console.log('ServiceWorker registration failed: ', error);
                    });
            });
        }
    })();
    </script>

    <!-- Project Search Script -->
    <script>
    (function() {
        'use strict';
        
        // Get projects data from PHP
        const allProjects = <?php echo isset($GLOBALS['projectsJson']) ? $GLOBALS['projectsJson'] : '[]'; ?>;
        const searchInput = document.getElementById('project-search-input');
        const searchResults = document.getElementById('project-search-results');
        const projectList = document.getElementById('project-list');
        const projectCount = document.getElementById('project-count');
        const baseUrl = '<?php echo defined("BASE_URL") ? BASE_URL : ""; ?>';
        const assetsImageUrl = '<?php echo defined("ASSETS_URL") ? ASSETS_URL . "/images" : "assets/images"; ?>';
        
        if (!searchInput || !searchResults || !projectList) {
            return; // Elements not found
        }
        
        // Filter projects based on search query
        function filterProjects(query) {
            if (!query || query.trim() === '') {
                return [];
            }
            
            const lowerQuery = query.toLowerCase().trim();
            return allProjects.filter(project => {
                return project.name.toLowerCase().includes(lowerQuery) ||
                       project.platform.toLowerCase().includes(lowerQuery);
            });
        }
        
        // Render project cards
        function renderProjects(projects) {
            if (projects.length === 0) {
                projectList.innerHTML = '<div class="px-24 py-12 text-center"><p class="text-secondary-light mb-0">No projects found</p></div>';
                projectCount.textContent = '0';
                return;
            }
            
            projectCount.textContent = projects.length;
            
            let html = '';
            projects.forEach(project => {
                // Determine icon source (favicon or platform icon)
                let iconHtml = '';
                if (project.favicon) {
                    // Favicon URLs are relative to www root, prepend "/" to make absolute
                    let faviconUrl = '/' + (project.favicon.startsWith('/') ? project.favicon.substring(1) : project.favicon);
                    // Ensure favicon URL doesn't contain login redirects
                    if (faviconUrl.includes('/login') || faviconUrl.includes('redirect=')) {
                        faviconUrl = null; // Skip favicon if it looks like a redirect
                    }
                    if (faviconUrl) {
                        iconHtml = `<img src="${faviconUrl}" alt="${escapeHtml(project.name)}" class="w-40-px h-40-px object-fit-cover rounded" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';" style="max-width: 40px; max-height: 40px;"><iconify-icon icon="${project.iconify || project.icon}" class="text-white text-2xl mb-0" style="display: none;"></iconify-icon>`;
                    } else {
                        iconHtml = `<iconify-icon icon="${project.iconify || project.icon}" class="text-white text-2xl mb-0"></iconify-icon>`;
                    }
                } else {
                    // Platform icon when no favicon
                    iconHtml = `<iconify-icon icon="${project.iconify || project.icon}" class="text-white text-2xl mb-0"></iconify-icon>`;
                }
                
                // WordPress admin link
                const wpAdminLink = project.is_wordpress 
                    ? `<a href="${project.url}/wp-admin" target="_blank" class="text-primary-600 hover-text-primary text-sm fw-medium">Manage your WordPress</a>`
                    : '';
                
                html += `
                    <div class="px-16 py-12 border-bottom project-search-item" data-project-name="${escapeHtml(project.name.toLowerCase())}" data-platform="${escapeHtml(project.platform.toLowerCase())}" style="cursor: pointer;">
                        <div class="d-flex align-items-center gap-3">
                            <div class="w-40-px h-40-px bg-${project.color}-50 rounded d-flex justify-content-center align-items-center flex-shrink-0">
                                ${iconHtml}
                                ${iconFallback}
                            </div>
                            <div class="flex-grow-1 min-w-0">
                                <h6 class="mb-1 text-truncate">${escapeHtml(project.name)}</h6>
                                <p class="text-secondary-light text-sm mb-1">${escapeHtml(project.platform)}</p>
                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                    <a href="${project.url}" target="_blank" class="text-primary-600 hover-text-primary text-sm" onclick="event.stopPropagation();">Open Project</a>
                                    ${wpAdminLink}
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });
            
            projectList.innerHTML = html;
            
            // Add click handlers to redirect to projects page with search
            const projectItems = projectList.querySelectorAll('.project-search-item');
            projectItems.forEach(item => {
                item.addEventListener('click', function() {
                    const query = searchInput.value.trim();
                    // Redirect to projects page with search query
                    window.location.href = 'index.php?page=projects' + (query ? '&search=' + encodeURIComponent(query) : '');
                });
            });
        }
        
        // Escape HTML to prevent XSS
        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }
        
        // Pre-populate search input if search query exists in URL
        const urlParams = new URLSearchParams(window.location.search);
        const searchQuery = urlParams.get('search');
        if (searchQuery && searchInput) {
            searchInput.value = searchQuery;
            // Trigger search to show results dropdown
            if (searchQuery.trim() !== '') {
                const filtered = filterProjects(searchQuery);
                renderProjects(filtered);
                searchResults.style.display = 'block';
            }
        }
        
        // Handle search input
        let searchTimeout;
        searchInput.addEventListener('input', function(e) {
            clearTimeout(searchTimeout);
            const query = e.target.value;
            
            if (query.trim() === '') {
                searchResults.style.display = 'none';
                projectList.innerHTML = '<div class="px-24 py-12 text-center"><p class="text-secondary-light mb-0">Start typing to search projects...</p></div>';
                return;
            }
            
            // Debounce search
            searchTimeout = setTimeout(() => {
                const filtered = filterProjects(query);
                renderProjects(filtered);
                searchResults.style.display = 'block';
            }, 150);
        });
        
        // Handle Enter key to redirect to projects page with search
        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                const query = this.value.trim();
                if (query) {
                    window.location.href = 'index.php?page=projects&search=' + encodeURIComponent(query);
                }
            }
        });
        
        // Show dropdown on focus
        searchInput.addEventListener('focus', function() {
            if (this.value.trim() !== '') {
                const filtered = filterProjects(this.value);
                renderProjects(filtered);
                searchResults.style.display = 'block';
            }
        });
        
        // Hide dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                searchResults.style.display = 'none';
            }
        });
        
        // Prevent form submission
        const searchForm = document.getElementById('project-search-form');
        if (searchForm) {
            searchForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const query = searchInput.value.trim();
                if (query) {
                    window.location.href = 'index.php?page=projects&search=' + encodeURIComponent(query);
                }
            });
        }
    })();
    </script>

    <!-- Project Creation Wizard Script -->
    <script>
    (function() {
        'use strict';
        
        const modal = document.getElementById('projectWizardModal');
        const form = document.getElementById('projectWizardForm');
        const wizardNext = document.getElementById('wizard-next');
        const wizardPrev = document.getElementById('wizard-prev');
        const wizardCreate = document.getElementById('wizard-create');
        const createDatabaseCheck = document.getElementById('create-database');
        const databaseFields = document.getElementById('database-fields');
        const projectNameInput = document.getElementById('project-name');
        const databaseNameInput = document.getElementById('database-name');
        const wizardMessage = document.getElementById('wizard-message');
        
        if (!modal || !form) return;
        
        let currentStep = 1;
        const totalSteps = 3;
        
        // Auto-fill database name from project name
        if (projectNameInput && databaseNameInput) {
            projectNameInput.addEventListener('input', function() {
                if (!databaseNameInput.value || databaseNameInput.value === projectNameInput.value.replace(/[^a-zA-Z0-9_]/g, '_')) {
                    databaseNameInput.value = this.value.replace(/[^a-zA-Z0-9_]/g, '_');
                }
            });
        }
        
        // Toggle database fields
        if (createDatabaseCheck && databaseFields) {
            createDatabaseCheck.addEventListener('change', function() {
                databaseFields.style.display = this.checked ? 'block' : 'none';
            });
        }
        
        // Wizard navigation
        function showStep(step) {
            // Hide all steps
            document.querySelectorAll('.wizard-step').forEach(stepEl => {
                stepEl.style.display = 'none';
                stepEl.classList.remove('active');
            });
            
            // Show current step
            const currentStepEl = document.querySelector(`.wizard-step[data-step="${step}"]`);
            if (currentStepEl) {
                currentStepEl.style.display = 'block';
                currentStepEl.classList.add('active');
            }
            
            // Update buttons
            wizardPrev.style.display = step > 1 ? 'inline-block' : 'none';
            wizardNext.style.display = step < totalSteps ? 'inline-block' : 'none';
            wizardCreate.style.display = step === totalSteps ? 'inline-block' : 'none';
            
            currentStep = step;
        }
        
        // Next button
        if (wizardNext) {
            wizardNext.addEventListener('click', function() {
                if (validateStep(currentStep)) {
                    showStep(currentStep + 1);
                }
            });
        }
        
        // Previous button
        if (wizardPrev) {
            wizardPrev.addEventListener('click', function() {
                showStep(currentStep - 1);
            });
        }
        
        // Validate current step
        function validateStep(step) {
            if (step === 1) {
                const nameInput = document.getElementById('project-name');
                if (!nameInput || !nameInput.value.trim()) {
                    showMessage('Please enter a project name', 'danger');
                    return false;
                }
                if (!nameInput.validity.valid) {
                    showMessage('Project name contains invalid characters', 'danger');
                    return false;
                }
            }
            return true;
        }
        
        // Show message
        function showMessage(text, type) {
            if (!wizardMessage) return;
            wizardMessage.className = 'alert alert-' + (type || 'info') + ' mb-16';
            wizardMessage.textContent = text;
            wizardMessage.classList.remove('d-none');
            setTimeout(() => {
                wizardMessage.classList.add('d-none');
            }, 5000);
        }
        
        // Create project
        if (wizardCreate) {
            wizardCreate.addEventListener('click', function() {
                if (!validateStep(currentStep)) {
                    return;
                }
                
                const formData = new FormData(form);
                const data = {};
                formData.forEach((value, key) => {
                    data[key] = value;
                });
                
                // Show loading state
                wizardCreate.disabled = true;
                wizardCreate.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Creating...';
                
                // Send request
                fetch('api/create_project.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        showMessage('Project created successfully!', 'success');
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    } else {
                        showMessage(result.message || 'Failed to create project', 'danger');
                        wizardCreate.disabled = false;
                        wizardCreate.innerHTML = 'Create Project';
                    }
                })
                .catch(error => {
                    showMessage('Error: ' + error.message, 'danger');
                    wizardCreate.disabled = false;
                    wizardCreate.innerHTML = 'Create Project';
                });
            });
        }
        
        // Reset wizard on modal close
        if (modal) {
            modal.addEventListener('hidden.bs.modal', function() {
                form.reset();
                showStep(1);
                wizardMessage.classList.add('d-none');
                if (wizardCreate) {
                    wizardCreate.disabled = false;
                    wizardCreate.innerHTML = 'Create Project';
                }
            });
        }
    })();
    </script>

    <?php 
    // Mailbox-specific JavaScript
    if (isset($GLOBALS['mailboxScript']) && $GLOBALS['mailboxScript']): 
        $mailpitApiUrl = $GLOBALS['mailpitApiUrl'] ?? 'http://localhost:8025/api/v1';
        $currentFolder = $GLOBALS['currentFolder'] ?? 'inbox';
        $emailId = $GLOBALS['emailId'] ?? null;
        $view = $GLOBALS['view'] ?? 'list';
    ?>
    <script>
    (function() {
        'use strict';
        
        const MAILPIT_API = 'api/mailpit.php';
        const currentFolder = '<?php echo $currentFolder; ?>';
        const emailId = '<?php echo $emailId ?? ''; ?>';
        const view = '<?php echo $view; ?>';
        
        // Load emails
        function loadEmails(folder = 'inbox', limit = 50, start = 0) {
            const container = document.getElementById('email-list');
            if (!container) return;
            
            container.innerHTML = '<div class="p-24 text-center"><div class="spinner-border text-primary-600" role="status"><span class="visually-hidden">Loading...</span></div></div>';
            
            fetch(MAILPIT_API + '?action=messages&limit=' + limit + '&start=' + start)
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => {
                            throw new Error(err.message || err.error || 'Failed to load emails');
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    // Handle both direct Mailpit response and proxy response
                    // Mailpit API returns: { "total": X, "messages": [...] }
                    let emails = [];
                    let total = 0;
                    
                    if (data && typeof data === 'object') {
                        // Check if it's a direct Mailpit response
                        if (Array.isArray(data.messages)) {
                            emails = data.messages;
                            total = data.total || data.messages.length;
                        } else if (Array.isArray(data)) {
                            // Sometimes Mailpit might return array directly
                            emails = data;
                            total = data.length;
                        } else if (data.success === false) {
                            // Error response
                            throw new Error(data.error || data.message || 'Failed to load emails');
                        }
                    }
                    
                    console.log('Mailpit API Response:', { emails: emails.length, total: total, data: data });
                    
                    renderEmailList(emails);
                    updateCounts({ total: total, messages: emails });
                })
                .catch(error => {
                    console.error('Error loading emails:', error);
                    let errorMsg = 'Failed to load emails. ';
                    if (error.message) {
                        errorMsg += error.message;
                    } else {
                        errorMsg += 'Make sure Mailpit is running.';
                    }
                    container.innerHTML = '<div class="p-24 text-center text-danger">' + escapeHtml(errorMsg) + '</div>';
                });
        }
        
        // Load email detail
        function loadEmailDetail(id) {
            const container = document.getElementById('email-detail-view');
            if (!container) return;
            
            container.innerHTML = '<div class="p-24 text-center"><div class="spinner-border text-primary-600" role="status"><span class="visually-hidden">Loading...</span></div></div>';
            
            fetch(MAILPIT_API + '?action=message&id=' + encodeURIComponent(id))
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => {
                            throw new Error(err.message || err.error || 'Failed to load email');
                        });
                    }
                    return response.json();
                })
                .then(email => {
                    renderEmailDetail(email);
                })
                .catch(error => {
                    console.error('Error loading email:', error);
                    let errorMsg = 'Failed to load email. ';
                    if (error.message) {
                        errorMsg += error.message;
                    }
                    container.innerHTML = '<div class="p-24 text-center text-danger">' + escapeHtml(errorMsg) + '</div>';
                });
        }
        
        // Render email list
        function renderEmailList(emails) {
            const container = document.getElementById('email-list');
            if (!container) return;
            
            if (emails.length === 0) {
                container.innerHTML = '<div class="p-24 text-center text-secondary-light">No emails found</div>';
                return;
            }
            
            let html = '';
            emails.forEach((email, index) => {
                const date = new Date(email.Created);
                const timeStr = date.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });
                const from = email.From?.Name || email.From?.Address || 'Unknown';
                const subject = email.Subject || '(No Subject)';
                const preview = email.Text || email.HTML || '';
                const previewText = preview.substring(0, 100).replace(/<[^>]*>/g, '');
                
                html += `
                    <div class="list-group-item border-bottom p-16 hover-bg-neutral-50 cursor-pointer email-item" data-id="${email.ID}">
                        <div class="d-flex align-items-start gap-3">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" value="${email.ID}">
                            </div>
                            <div class="flex-grow-1 min-w-0">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <h6 class="mb-0 text-truncate fw-medium">${escapeHtml(from)}</h6>
                                    <span class="text-secondary-light text-sm">${timeStr}</span>
                                </div>
                                <p class="mb-2 text-truncate fw-medium">${escapeHtml(subject)}</p>
                                <p class="mb-0 text-secondary-light text-sm">${escapeHtml(previewText)}</p>
                            </div>
                        </div>
                    </div>
                `;
            });
            
            container.innerHTML = html;
            
            // Add click handlers
            container.querySelectorAll('.email-item').forEach(item => {
                item.addEventListener('click', function(e) {
                    if (e.target.type !== 'checkbox') {
                        const id = this.dataset.id;
                        window.location.href = 'index.php?page=mailbox&view=detail&id=' + id;
                    }
                });
            });
        }
        
        // Render email detail
        function renderEmailDetail(email) {
            const container = document.getElementById('email-detail-view');
            if (!container) return;
            
            const from = email.From?.Name || email.From?.Address || 'Unknown';
            const fromEmail = email.From?.Address || '';
            const to = (email.To || []).map(t => t.Name || t.Address).join(', ');
            const subject = email.Subject || '(No Subject)';
            const date = new Date(email.Created);
            const dateStr = date.toLocaleString();
            const html = email.HTML || '';
            const text = email.Text || '';
            
            container.innerHTML = `
                <div class="p-24">
                    <div class="mb-16">
                        <h4 class="mb-12">${escapeHtml(subject)}</h4>
                        <div class="d-flex align-items-center gap-2 mb-8">
                            <strong>${escapeHtml(from)}</strong>
                            <span class="text-secondary-light">&lt;${escapeHtml(fromEmail)}&gt;</span>
                        </div>
                        <div class="text-secondary-light text-sm mb-16">
                            <div>To: ${escapeHtml(to)}</div>
                            <div>${escapeHtml(dateStr)}</div>
                        </div>
                    </div>
                    <div class="border-top pt-16">
                        ${html ? html : '<pre style="white-space: pre-wrap;">' + escapeHtml(text) + '</pre>'}
                    </div>
                </div>
            `;
        }
        
        // Update counts
        function updateCounts(data) {
            const total = data.total || 0;
            const totalEl = document.getElementById('total-emails');
            const inboxEl = document.getElementById('inbox-count');
            if (totalEl) totalEl.textContent = total;
            if (inboxEl) inboxEl.textContent = total;
        }
        
        // Escape HTML
        function escapeHtml(text) {
            if (!text) return '';
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }
        
        // Initialize
        if (view === 'detail' && emailId) {
            loadEmailDetail(emailId);
        } else {
            loadEmails(currentFolder);
        }
        
        // Compose button
        const composeBtn = document.getElementById('compose-btn');
        if (composeBtn) {
            composeBtn.addEventListener('click', function() {
                const modalEl = document.getElementById('composeModal');
                if (modalEl) {
                    const modal = new bootstrap.Modal(modalEl);
                    modal.show();
                }
            });
        }
    })();
    </script>
    <?php endif; ?>

    <?php 
    // Logs-specific JavaScript
    if (isset($GLOBALS['logsScript']) && $GLOBALS['logsScript']): 
        $selectedLog = $GLOBALS['selectedLog'] ?? '';
        $logFiles = $GLOBALS['logFiles'] ?? [];
    ?>
    <script>
    (function() {
        'use strict';
        
        const selectedLog = '<?php echo $selectedLog; ?>';
        const LOGS_API = 'api/logs.php';
        const logFiles = <?php echo json_encode($logFiles); ?>;
        
        let codeEditor = null;
        
        // Initialize CodeMirror (read-only for logs)
        function initCodeEditor() {
            const textarea = document.getElementById('code-viewer');
            if (!textarea) return;
            
            codeEditor = CodeMirror.fromTextArea(textarea, {
                lineNumbers: true,
                mode: 'shell',
                theme: 'monokai',
                readOnly: true,
                lineWrapping: true,
                styleActiveLine: true
            });
            
            // Set editor container height
            const container = document.getElementById('code-viewer-container');
            if (container) {
                codeEditor.setSize('100%', '70vh');
            }
        }
        
        // Load log content
        function loadLogContent(logType) {
            const titleEl = document.getElementById('log-viewer-title');
            const pathEl = document.getElementById('log-viewer-path');
            
            if (!codeEditor) {
                initCodeEditor();
            }
            
            if (!codeEditor) return;
            
            codeEditor.setValue('Loading...');
            
            fetch(LOGS_API + '?action=read&type=' + encodeURIComponent(logType))
                .then(response => {
                    if (!response.ok) {
                        throw new Error('HTTP error! status: ' + response.status);
                    }
                    return response.text();
                })
                .then(text => {
                    try {
                        const data = JSON.parse(text);
                        if (data.success) {
                            codeEditor.setValue(data.content || '(Empty log file)');
                            if (titleEl && logFiles[logType]) {
                                titleEl.textContent = logFiles[logType].name || 'Log File';
                            }
                            if (pathEl) {
                                pathEl.textContent = data.path || '';
                            }
                        } else {
                            codeEditor.setValue('Error: ' + (data.error || 'Failed to load log file'));
                        }
                    } catch (e) {
                        console.error('JSON parse error:', e, text);
                        codeEditor.setValue('Error: Invalid response from server. ' + text.substring(0, 200));
                    }
                })
                .catch(error => {
                    console.error('Error loading log:', error);
                    if (codeEditor) {
                        codeEditor.setValue('Error: Failed to load log file. ' + error.message);
                    }
                });
        }
        
        // Refresh log
        function refreshLog() {
            if (selectedLog) {
                loadLogContent(selectedLog);
            }
        }
        
        // Clear log
        function clearLog() {
            if (!selectedLog) return;
            
            if (!confirm('Are you sure you want to clear this log file? This action cannot be undone.')) {
                return;
            }
            
            fetch(LOGS_API + '?action=clear&type=' + encodeURIComponent(selectedLog), {
                method: 'POST'
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('HTTP error! status: ' + response.status);
                    }
                    return response.text();
                })
                .then(text => {
                    try {
                        const data = JSON.parse(text);
                        if (data.success) {
                            loadLogContent(selectedLog);
                            alert('Log file cleared successfully');
                        } else {
                            alert('Error: ' + (data.error || 'Failed to clear log file'));
                        }
                    } catch (e) {
                        console.error('JSON parse error:', e, text);
                        alert('Error: Invalid response from server');
                    }
                })
                .catch(error => {
                    console.error('Error clearing log:', error);
                    alert('Error: Failed to clear log file');
                });
        }
        
        // Download log
        function downloadLog() {
            if (!selectedLog || !logFiles[selectedLog]) return;
            
            const logFile = logFiles[selectedLog];
            window.open(LOGS_API + '?action=read&type=' + encodeURIComponent(selectedLog) + '&download=1', '_blank');
        }
        
        // Initialize
        if (selectedLog) {
            // Wait for CodeMirror to load
            if (typeof CodeMirror !== 'undefined') {
                initCodeEditor();
                loadLogContent(selectedLog);
            } else {
                // Retry after a short delay
                setTimeout(function() {
                    if (typeof CodeMirror !== 'undefined') {
                        initCodeEditor();
                        loadLogContent(selectedLog);
                    }
                }, 100);
            }
        }
        
        // Button handlers
        const refreshBtn = document.getElementById('refresh-log');
        const clearBtn = document.getElementById('clear-log');
        const downloadBtn = document.getElementById('download-log');
        
        if (refreshBtn) {
            refreshBtn.addEventListener('click', refreshLog);
        }
        
        if (clearBtn) {
            clearBtn.addEventListener('click', clearLog);
        }
        
        if (downloadBtn) {
            downloadBtn.addEventListener('click', downloadLog);
        }
    })();
    </script>
    <?php endif; ?>

    <?php 
    // Services-specific JavaScript
    if (isset($GLOBALS['servicesScript']) && $GLOBALS['servicesScript']): 
        $installedServices = $GLOBALS['installedServices'] ?? [];
    ?>
    <script>
    (function() {
        'use strict';
        
        const SERVICES_API = 'api/services.php';
        
        // Reload Apache
        window.reloadApache = function() {
            if (!confirm('Reload Apache? This will restart the Apache service.')) {
                return;
            }
            
            fetch(SERVICES_API + '?action=reload&service=Apache', {
                method: 'POST'
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Apache reloaded successfully');
                        location.reload();
                    } else {
                        alert('Error: ' + (data.error || 'Failed to reload Apache'));
                    }
                })
                .catch(error => {
                    console.error('Error reloading Apache:', error);
                    alert('Error: Failed to reload Apache');
                });
        };
        
        // Refresh service status
        function refreshServiceStatus() {
            fetch(SERVICES_API + '?action=status')
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.services) {
                        // Update status badges for each service
                        Object.keys(data.services).forEach(serviceKey => {
                            const service = data.services[serviceKey];
                            const isRunning = service.status === 'running';
                            
                            // Find the row for this service
                            const serviceCheckbox = document.querySelector(`input[data-service="${serviceKey}"]`);
                            if (!serviceCheckbox) return;
                            
                            const row = serviceCheckbox.closest('tr');
                            if (!row) return;
                            
                            // Update status badge (5th column)
                            const statusCell = row.querySelector('td:nth-child(5)');
                            if (statusCell) {
                                const statusBadge = statusCell.querySelector('span.bg-success-focus, span.bg-secondary-focus');
                                if (statusBadge) {
                                    statusBadge.className = `bg-${isRunning ? 'success' : 'secondary'}-focus text-${isRunning ? 'success' : 'secondary'}-main px-24 py-4 rounded-pill fw-medium text-sm`;
                                    statusBadge.textContent = isRunning ? 'Running' : 'Stopped';
                                    
                                    // Update running ports display
                                    const portsSmall = statusCell.querySelector('small');
                                    if (isRunning && service.running_ports && service.running_ports.length > 0) {
                                        const portsStr = service.running_ports.join('/');
                                        if (portsSmall) {
                                            portsSmall.textContent = portsStr;
                                        } else {
                                            const small = document.createElement('small');
                                            small.className = 'text-secondary-light mt-4 d-block';
                                            small.textContent = portsStr;
                                            statusBadge.parentElement.appendChild(small);
                                        }
                                    } else if (portsSmall) {
                                        portsSmall.remove();
                                    }
                                }
                            }
                            
                            // Update action buttons (last column)
                            const actionCell = row.querySelector('td:last-child');
                            if (actionCell) {
                                const startBtn = actionCell.querySelector('button[onclick*="startService"]');
                                const stopBtn = actionCell.querySelector('button[onclick*="stopService"]');
                                
                                if (isRunning) {
                                    if (startBtn) startBtn.style.display = 'none';
                                    if (stopBtn) stopBtn.style.display = '';
                                } else {
                                    if (startBtn) startBtn.style.display = '';
                                    if (stopBtn) stopBtn.style.display = 'none';
                                }
                            }
                        });
                    }
                })
                .catch(error => {
                    console.error('Error refreshing service status:', error);
                });
        }
        
        // Start service
        window.startService = function(serviceName) {
            fetch(SERVICES_API + '?action=start&service=' + encodeURIComponent(serviceName), {
                method: 'POST'
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Service started successfully');
                        setTimeout(refreshServiceStatus, 1000); // Refresh status after 1 second
                    } else {
                        alert('Error: ' + (data.error || 'Failed to start service'));
                    }
                })
                .catch(error => {
                    console.error('Error starting service:', error);
                    alert('Error: Failed to start service');
                });
        };
        
        // Stop service
        window.stopService = function(serviceName) {
            if (!confirm('Stop ' + serviceName + '?')) {
                return;
            }
            
            fetch(SERVICES_API + '?action=stop&service=' + encodeURIComponent(serviceName), {
                method: 'POST'
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Service stopped successfully');
                        setTimeout(refreshServiceStatus, 1000); // Refresh status after 1 second
                    } else {
                        alert('Error: ' + (data.error || 'Failed to stop service'));
                    }
                })
                .catch(error => {
                    console.error('Error stopping service:', error);
                    alert('Error: Failed to stop service');
                });
        };
        
        // Sync enabled checkboxes
        document.querySelectorAll('.service-enabled-checkbox').forEach(checkbox => {
            const serviceKey = checkbox.dataset.service;
            const switchEl = document.querySelector('.service-enabled-switch[data-service="' + serviceKey + '"]');
            
            if (switchEl) {
                // Sync checkbox to switch
                checkbox.addEventListener('change', function() {
                    switchEl.checked = this.checked;
                });
                
                // Sync switch to checkbox
                switchEl.addEventListener('change', function() {
                    checkbox.checked = this.checked;
                });
            }
        });
        
        // Save form
        const servicesForm = document.getElementById('services-form');
        if (servicesForm) {
            servicesForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                const data = {};
                
                // Convert form data to nested structure
                formData.forEach((value, key) => {
                    const matches = key.match(/services\[([^\]]+)\]\[([^\]]+)\]/);
                    if (matches) {
                        const serviceKey = matches[1];
                        const fieldKey = matches[2];
                        if (!data[serviceKey]) {
                            data[serviceKey] = {};
                        }
                        data[serviceKey][fieldKey] = value;
                    }
                });
                
                // Prepare POST data
                const postData = new FormData();
                Object.keys(data).forEach(serviceKey => {
                    Object.keys(data[serviceKey]).forEach(fieldKey => {
                        postData.append('services[' + serviceKey + '][' + fieldKey + ']', data[serviceKey][fieldKey]);
                    });
                });
                
                fetch(SERVICES_API + '?action=save', {
                    method: 'POST',
                    body: postData
                })
                    .then(response => response.json())
                    .then(result => {
                        if (result.success) {
                            alert('Configuration saved successfully');
                            location.reload();
                        } else {
                            alert('Error: ' + (result.error || 'Failed to save configuration'));
                        }
                    })
                    .catch(error => {
                        console.error('Error saving configuration:', error);
                        alert('Error: Failed to save configuration');
                    });
            });
        }
        
        // Save general settings form
        const generalSettingsForm = document.getElementById('general-settings-form');
        if (generalSettingsForm) {
            generalSettingsForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                
                fetch(SERVICES_API + '?action=save_general', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(result => {
                        if (result.success) {
                            alert(result.message || 'General settings saved successfully');
                            location.reload();
                        } else {
                            alert('Error: ' + (result.error || 'Failed to save general settings'));
                        }
                    })
                    .catch(error => {
                        console.error('Error saving general settings:', error);
                        alert('Error: Failed to save general settings');
                    });
            });
        }
        
        // Auto-refresh service status every 5 seconds
        setInterval(refreshServiceStatus, 5000);
        
        // Initial status refresh after page load
        setTimeout(refreshServiceStatus, 1000);
    })();
    </script>
    <?php endif; ?>

    <?php 
    // Sites (Virtual Hosts) JavaScript
    if (isset($GLOBALS['sitesScript']) && $GLOBALS['sitesScript']): 
        $selectedFile = $GLOBALS['selectedFile'] ?? '';
        $sitesEnabledDir = $GLOBALS['sitesEnabledDir'] ?? '';
    ?>
    <script>
    (function() {
        'use strict';
        
        const FILES_API = 'api/files.php';
        const selectedFile = '<?php echo $selectedFile; ?>';
        const sitesEnabledDir = '<?php echo $sitesEnabledDir; ?>';
        let codeEditor = null;
        
        // Initialize CodeMirror
        function initCodeEditor() {
            const textarea = document.getElementById('code-editor');
            if (!textarea) return;
            
            codeEditor = CodeMirror.fromTextArea(textarea, {
                lineNumbers: true,
                mode: 'apache',
                theme: 'monokai',
                indentUnit: 4,
                indentWithTabs: false,
                lineWrapping: true,
                autofocus: true,
                styleActiveLine: true,
                matchBrackets: true
            });
            
            // Set editor container height
            const container = document.getElementById('code-editor-container');
            if (container) {
                codeEditor.setSize('100%', '70vh');
            }
        }
        
        // Load file content
        function loadFileContent(fileName) {
            const titleEl = document.getElementById('editor-title');
            const pathEl = document.getElementById('editor-path');
            const saveBtn = document.getElementById('save-file');
            const refreshBtn = document.getElementById('refresh-file');
            
            if (!codeEditor) {
                initCodeEditor();
            }
            
            if (!codeEditor) return;
            
            codeEditor.setValue('Loading...');
            
            const filePath = sitesEnabledDir + '/' + fileName;
            
            fetch(FILES_API + '?action=read&path=' + encodeURIComponent(filePath))
                .then(response => {
                    if (!response.ok) {
                        throw new Error('HTTP error! status: ' + response.status);
                    }
                    // Check if response is JSON
                    const contentType = response.headers.get('content-type');
                    if (contentType && contentType.includes('application/json')) {
                        return response.json();
                    } else {
                        // Try to parse as text first, then JSON
                        return response.text().then(text => {
                            // Try to extract JSON from response (in case there's HTML before it)
                            const jsonMatch = text.match(/\{[\s\S]*\}/);
                            if (jsonMatch) {
                                return JSON.parse(jsonMatch[0]);
                            }
                            throw new Error('Invalid JSON response: ' + text.substring(0, 200));
                        });
                    }
                })
                .then(data => {
                    if (data.success) {
                        codeEditor.setValue(data.content || '');
                        if (titleEl) titleEl.textContent = fileName;
                        if (pathEl) pathEl.textContent = data.path || '';
                        if (saveBtn) saveBtn.style.display = 'block';
                        if (refreshBtn) refreshBtn.style.display = 'block';
                    } else {
                        codeEditor.setValue('Error: ' + (data.error || 'Failed to load file'));
                    }
                })
                .catch(error => {
                    console.error('Error loading file:', error);
                    if (codeEditor) {
                        codeEditor.setValue('Error: Failed to load file. ' + error.message);
                    }
                });
        }
        
        // Save file
        window.saveFile = function() {
            if (!codeEditor || !selectedFile) return;
            
            const content = codeEditor.getValue();
            const filePath = sitesEnabledDir + '/' + selectedFile;
            
            fetch(FILES_API + '?action=write&path=' + encodeURIComponent(filePath), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ content: content })
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('HTTP error! status: ' + response.status);
                    }
                    // Check if response is JSON
                    const contentType = response.headers.get('content-type');
                    if (contentType && contentType.includes('application/json')) {
                        return response.json();
                    } else {
                        // Try to parse as text first, then JSON
                        return response.text().then(text => {
                            // Try to extract JSON from response (in case there's HTML before it)
                            const jsonMatch = text.match(/\{[\s\S]*\}/);
                            if (jsonMatch) {
                                return JSON.parse(jsonMatch[0]);
                            }
                            throw new Error('Invalid JSON response: ' + text.substring(0, 200));
                        });
                    }
                })
                .then(data => {
                    if (data.success) {
                        alert('File saved successfully');
                    } else {
                        alert('Error: ' + (data.error || 'Failed to save file'));
                    }
                })
                .catch(error => {
                    console.error('Error saving file:', error);
                    alert('Error: Failed to save file. ' + error.message);
                });
        };
        
        // Refresh file
        window.refreshFile = function() {
            if (selectedFile) {
                loadFileContent(selectedFile);
            }
        };
        
        // Create new site
        window.createNewSite = function() {
            const fileName = prompt('Enter virtual host filename (e.g., mysite.conf):');
            if (fileName) {
                window.location.href = 'index.php?page=sites&file=' + encodeURIComponent(fileName);
            }
        };
        
        // Initialize
        if (selectedFile) {
            // Wait for CodeMirror to load
            if (typeof CodeMirror !== 'undefined') {
                initCodeEditor();
                loadFileContent(selectedFile);
            } else {
                // Retry after a short delay
                setTimeout(function() {
                    if (typeof CodeMirror !== 'undefined') {
                        initCodeEditor();
                        loadFileContent(selectedFile);
                    }
                }, 100);
            }
        }
    })();
    </script>
    <?php endif; ?>

    <?php 
    // httpd.conf JavaScript
    if (isset($GLOBALS['httpdScript']) && $GLOBALS['httpdScript']): 
        $httpdConf = $GLOBALS['httpdConf'] ?? '';
    ?>
    <script>
    (function() {
        'use strict';
        
        const FILES_API = 'api/files.php';
        const httpdConf = '<?php echo $httpdConf; ?>';
        let codeEditor = null;
        
        // Initialize CodeMirror
        function initCodeEditor() {
            const textarea = document.getElementById('httpd-editor');
            if (!textarea) return;
            
            codeEditor = CodeMirror.fromTextArea(textarea, {
                lineNumbers: true,
                mode: 'apache',
                theme: 'monokai',
                indentUnit: 4,
                indentWithTabs: false,
                lineWrapping: true,
                autofocus: true,
                styleActiveLine: true,
                matchBrackets: true
            });
            
            // Set editor container height
            const container = document.getElementById('httpd-editor-container');
            if (container) {
                codeEditor.setSize('100%', '70vh');
            }
        }
        
        // Load httpd.conf
        function loadHttpdConf() {
            if (!codeEditor) {
                initCodeEditor();
            }
            
            if (!codeEditor || !httpdConf) return;
            
            codeEditor.setValue('Loading...');
            
            fetch(FILES_API + '?action=read&path=' + encodeURIComponent(httpdConf))
                .then(response => {
                    if (!response.ok) {
                        throw new Error('HTTP error! status: ' + response.status);
                    }
                    // Check if response is JSON
                    const contentType = response.headers.get('content-type');
                    if (contentType && contentType.includes('application/json')) {
                        return response.json();
                    } else {
                        // Try to parse as text first, then JSON
                        return response.text().then(text => {
                            // Try to extract JSON from response (in case there's HTML before it)
                            const jsonMatch = text.match(/\{[\s\S]*\}/);
                            if (jsonMatch) {
                                return JSON.parse(jsonMatch[0]);
                            }
                            throw new Error('Invalid JSON response: ' + text.substring(0, 200));
                        });
                    }
                })
                .then(data => {
                    if (data.success) {
                        codeEditor.setValue(data.content || '');
                    } else {
                        codeEditor.setValue('Error: ' + (data.error || 'Failed to load file'));
                    }
                })
                .catch(error => {
                    console.error('Error loading httpd.conf:', error);
                    if (codeEditor) {
                        codeEditor.setValue('Error: Failed to load file. ' + error.message);
                    }
                });
        }
        
        // Save httpd.conf
        window.saveHttpdConf = function() {
            if (!codeEditor || !httpdConf) return;
            
            const content = codeEditor.getValue();
            
            fetch(FILES_API + '?action=write&path=' + encodeURIComponent(httpdConf), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ content: content })
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('HTTP error! status: ' + response.status);
                    }
                    return response.text();
                })
                .then(text => {
                    try {
                        const data = JSON.parse(text);
                        if (data.success) {
                            alert('httpd.conf saved successfully');
                        } else {
                            alert('Error: ' + (data.error || 'Failed to save file'));
                        }
                    } catch (e) {
                        console.error('JSON parse error:', e, text);
                        alert('Error: Invalid response from server');
                    }
                })
                .catch(error => {
                    console.error('Error saving httpd.conf:', error);
                    alert('Error: Failed to save file');
                });
        };
        
        // Reload Apache
        window.reloadApache = function() {
            if (!confirm('Reload Apache? This will restart the Apache service.')) {
                return;
            }
            
            fetch('api/services.php?action=reload&service=Apache', {
                method: 'POST'
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Apache reloaded successfully');
                    } else {
                        alert('Error: ' + (data.error || 'Failed to reload Apache'));
                    }
                })
                .catch(error => {
                    console.error('Error reloading Apache:', error);
                    alert('Error: Failed to reload Apache');
                });
        };
        
        // Initialize
        if (httpdConf) {
            // Wait for CodeMirror to load
            if (typeof CodeMirror !== 'undefined') {
                initCodeEditor();
                loadHttpdConf();
            } else {
                // Retry after a short delay
                setTimeout(function() {
                    if (typeof CodeMirror !== 'undefined') {
                        initCodeEditor();
                        loadHttpdConf();
                    }
                }, 100);
            }
        }
    })();
    </script>
    <?php endif; ?>

    <?php 
    // Server Vitals JavaScript
    if (isset($GLOBALS['vitalsScript']) && $GLOBALS['vitalsScript']): 
    ?>
    <script>
    (function() {
        'use strict';
        
        const VITALS_API = 'api/vitals.php';
        let charts = {};
        
        // Fetch vitals data
        function fetchVitals() {
            return fetch(VITALS_API)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        return data.data;
                    }
                    throw new Error(data.error || 'Failed to fetch vitals');
                });
        }
        
        // Initialize mini sparkline charts
        function initMiniCharts(data) {
            // CPU Mini Chart
            if (document.getElementById('cpu-chart-mini')) {
                const cpuMiniOptions = {
                    series: [{
                        name: 'CPU',
                        data: data.cpu.history.slice(-10).map(h => h.value)
                    }],
                    chart: {
                        type: 'area',
                        height: 50,
                        sparkline: { enabled: true },
                        toolbar: { show: false }
                    },
                    stroke: {
                        curve: 'smooth',
                        colors: ['#487FFF'],
                        width: 2
                    },
                    fill: {
                        type: 'gradient',
                        colors: ['#487FFF'],
                        gradient: {
                            shade: 'light',
                            type: 'vertical',
                            shadeIntensity: 0.5,
                            gradientToColors: ['#487FFF00'],
                            opacityFrom: 0.6,
                            opacityTo: 0.1,
                            stops: [0, 100]
                        }
                    },
                    tooltip: { enabled: false }
                };
                charts.cpuMini = new ApexCharts(document.querySelector("#cpu-chart-mini"), cpuMiniOptions);
                charts.cpuMini.render();
            }
            
            // Memory Mini Chart
            if (document.getElementById('memory-chart-mini')) {
                const memoryMiniOptions = {
                    series: [{
                        name: 'Memory',
                        data: data.memory.history.slice(-10).map(h => h.value)
                    }],
                    chart: {
                        type: 'area',
                        height: 50,
                        sparkline: { enabled: true },
                        toolbar: { show: false }
                    },
                    stroke: {
                        curve: 'smooth',
                        colors: ['#10B981'],
                        width: 2
                    },
                    fill: {
                        type: 'gradient',
                        colors: ['#10B981'],
                        gradient: {
                            shade: 'light',
                            type: 'vertical',
                            shadeIntensity: 0.5,
                            gradientToColors: ['#10B98100'],
                            opacityFrom: 0.6,
                            opacityTo: 0.1,
                            stops: [0, 100]
                        }
                    },
                    tooltip: { enabled: false }
                };
                charts.memoryMini = new ApexCharts(document.querySelector("#memory-chart-mini"), memoryMiniOptions);
                charts.memoryMini.render();
            }
            
            // Disk Mini Chart
            if (document.getElementById('disk-chart-mini')) {
                const diskMiniOptions = {
                    series: [data.disk.current],
                    chart: {
                        type: 'radialBar',
                        height: 50,
                        sparkline: { enabled: true }
                    },
                    plotOptions: {
                        radialBar: {
                            hollow: { size: '50%' },
                            track: { background: '#E5E7EB' },
                            dataLabels: {
                                name: { show: false },
                                value: { show: false }
                            }
                        }
                    },
                    colors: ['#F59E0B']
                };
                charts.diskMini = new ApexCharts(document.querySelector("#disk-chart-mini"), diskMiniOptions);
                charts.diskMini.render();
            }
        }
        
        // Initialize CPU Chart
        function initCPUChart(data) {
            const cpuEl = document.getElementById('cpu-chart');
            if (!cpuEl) return;
            
            // Convert to format that supports appendData (x/y pairs)
            const chartData = data.cpu.history.map((h, index) => ({
                x: h.time,
                y: h.value
            }));
            
            const options = {
                series: [{
                    name: 'CPU Usage',
                    data: chartData
                }],
                chart: {
                    height: 300,
                    type: 'line',
                    toolbar: { show: false },
                    zoom: { enabled: false },
                    animations: {
                        enabled: true,
                        easing: 'linear',
                        dynamicAnimation: {
                            speed: 1000
                        }
                    }
                },
                dataLabels: { enabled: false },
                stroke: {
                    curve: 'smooth',
                    colors: ['#487FFF'],
                    width: 4
                },
                markers: {
                    size: 0,
                    strokeWidth: 3,
                    hover: { size: 8 }
                },
                grid: {
                    borderColor: '#D1D5DB',
                    strokeDashArray: 3
                },
                xaxis: {
                    type: 'category',
                    labels: { 
                        style: { fontSize: '14px' },
                        rotate: -45,
                        rotateAlways: false
                    }
                },
                yaxis: {
                    min: 0,
                    max: 100,
                    labels: {
                        formatter: function(value) {
                            return value + '%';
                        },
                        style: { fontSize: '14px' }
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(value) {
                            return value + '%';
                        }
                    }
                }
            };
            
            charts.cpu = new ApexCharts(cpuEl, options);
            charts.cpu.render();
        }
        
        // Initialize Memory Chart
        function initMemoryChart(data) {
            const memoryEl = document.getElementById('memory-chart');
            if (!memoryEl) return;
            
            // Convert to format that supports appendData (x/y pairs)
            const chartData = data.memory.history.map((h, index) => ({
                x: h.time,
                y: h.value
            }));
            
            const options = {
                series: [{
                    name: 'Memory Usage',
                    data: chartData
                }],
                chart: {
                    height: 300,
                    type: 'area',
                    toolbar: { show: false },
                    animations: {
                        enabled: true,
                        easing: 'linear',
                        dynamicAnimation: {
                            speed: 1000
                        }
                    }
                },
                dataLabels: { enabled: false },
                stroke: {
                    curve: 'smooth',
                    colors: ['#10B981'],
                    width: 4
                },
                fill: {
                    type: 'gradient',
                    colors: ['#10B981'],
                    gradient: {
                        shade: 'light',
                        type: 'vertical',
                        shadeIntensity: 0.5,
                        gradientToColors: ['#10B98100'],
                        opacityFrom: 0.6,
                        opacityTo: 0.1,
                        stops: [0, 100]
                    }
                },
                grid: {
                    borderColor: '#D1D5DB',
                    strokeDashArray: 3
                },
                xaxis: {
                    type: 'category',
                    labels: { 
                        style: { fontSize: '14px' },
                        rotate: -45,
                        rotateAlways: false
                    }
                },
                yaxis: {
                    min: 0,
                    max: 100,
                    labels: {
                        formatter: function(value) {
                            return value + '%';
                        },
                        style: { fontSize: '14px' }
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(value) {
                            return value + '%';
                        }
                    }
                }
            };
            
            charts.memory = new ApexCharts(memoryEl, options);
            charts.memory.render();
        }
        
        // Initialize Disk Chart (Donut)
        function initDiskChart(data) {
            const diskEl = document.getElementById('disk-chart');
            if (!diskEl) return;
            
            const usedPercent = data.disk.current;
            const freePercent = 100 - usedPercent;
            
            const options = {
                series: [usedPercent, freePercent],
                chart: {
                    type: 'donut',
                    height: 300
                },
                labels: ['Used', 'Free'],
                colors: ['#F59E0B', '#E5E7EB'],
                legend: {
                    position: 'bottom',
                    fontSize: '14px'
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val) {
                        return val.toFixed(1) + '%';
                    }
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '70%',
                            labels: {
                                show: true,
                                total: {
                                    show: true,
                                    label: 'Total',
                                    formatter: function() {
                                        return data.disk.total.toFixed(1) + ' GB';
                                    }
                                }
                            }
                        }
                    }
                }
            };
            
            charts.disk = new ApexCharts(diskEl, options);
            charts.disk.render();
        }
        
        // Initialize Services Chart (Pie)
        function initServicesChart(data) {
            const servicesEl = document.getElementById('services-chart');
            if (!servicesEl) return;
            
            const options = {
                series: [data.services.running, data.services.stopped],
                chart: {
                    type: 'pie',
                    height: 300
                },
                labels: ['Running', 'Stopped'],
                colors: ['#10B981', '#EF4444'],
                legend: {
                    position: 'bottom',
                    fontSize: '14px'
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val) {
                        return val.toFixed(1) + '%';
                    }
                }
            };
            
            charts.services = new ApexCharts(servicesEl, options);
            charts.services.render();
        }
        
        // Initialize Network Chart (Column)
        function initNetworkChart(data) {
            const networkEl = document.getElementById('network-chart');
            if (!networkEl) return;
            
            // Convert to format that supports appendData
            const uploadData = data.network.history.map(h => ({
                x: h.time,
                y: h.upload
            }));
            const downloadData = data.network.history.map(h => ({
                x: h.time,
                y: h.download
            }));
            
            const options = {
                series: [{
                    name: 'Upload',
                    data: uploadData
                }, {
                    name: 'Download',
                    data: downloadData
                }],
                colors: ['#487FFF', '#10B981'],
                chart: {
                    type: 'bar',
                    height: 350,
                    toolbar: { show: false },
                    animations: {
                        enabled: true,
                        easing: 'linear',
                        dynamicAnimation: {
                            speed: 1000
                        }
                    }
                },
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        columnWidth: '50%'
                    }
                },
                dataLabels: { enabled: false },
                grid: {
                    borderColor: '#D1D5DB',
                    strokeDashArray: 4
                },
                xaxis: {
                    type: 'category',
                    labels: { 
                        style: { fontSize: '14px' },
                        rotate: -45,
                        rotateAlways: false
                    }
                },
                yaxis: {
                    labels: {
                        formatter: function(value) {
                            return value + ' Mbps';
                        },
                        style: { fontSize: '14px' }
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(value) {
                            return value + ' Mbps';
                        }
                    }
                }
            };
            
            charts.network = new ApexCharts(networkEl, options);
            charts.network.render();
        }
        
        // Update KPI values
        function updateKPIs(data) {
            const cpuEl = document.getElementById('cpu-usage');
            const memoryEl = document.getElementById('memory-usage');
            const diskEl = document.getElementById('disk-usage');
            const networkSpeedEl = document.getElementById('network-speed');
            
            if (cpuEl) cpuEl.textContent = data.cpu.current.toFixed(1) + '%';
            if (memoryEl) memoryEl.textContent = data.memory.current.toFixed(1) + '%';
            if (diskEl) diskEl.textContent = data.disk.current.toFixed(1) + '%';
            if (networkSpeedEl) networkSpeedEl.textContent = data.network.speed;
        }
        
        // Initialize all charts
        function initCharts() {
            fetchVitals()
                .then(data => {
                    updateKPIs(data);
                    initMiniCharts(data);
                    initCPUChart(data);
                    initMemoryChart(data);
                    initDiskChart(data);
                    initServicesChart(data);
                    initNetworkChart(data);
                })
                .catch(error => {
                    console.error('Error loading vitals:', error);
                });
        }
        
        // Real-time monitoring with ApexCharts update methods
        let refreshInterval = null;
        let isRealTimeEnabled = true;
        let refreshRate = 5000; // 5 seconds for real-time monitoring
        
        // Update main charts in real-time
        function updateMainCharts(data) {
            const now = new Date();
            const timeLabel = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
            
            // Update CPU Chart (line chart) - append new data point
            if (charts.cpu) {
                charts.cpu.appendData([{
                    data: [{
                        x: timeLabel,
                        y: data.cpu.current
                    }]
                }], false); // false = keep all data points, limit to last 50
                
                // Limit to last 50 data points for performance
                const seriesData = charts.cpu.w.globals.series[0];
                if (seriesData && seriesData.length > 50) {
                    charts.cpu.updateSeries([{
                        data: seriesData.slice(-50)
                    }]);
                }
            }
            
            // Update Memory Chart (area chart) - append new data point
            if (charts.memory) {
                charts.memory.appendData([{
                    data: [{
                        x: timeLabel,
                        y: data.memory.current
                    }]
                }], false);
                
                // Limit to last 50 data points
                const seriesData = charts.memory.w.globals.series[0];
                if (seriesData && seriesData.length > 50) {
                    charts.memory.updateSeries([{
                        data: seriesData.slice(-50)
                    }]);
                }
            }
            
            // Update Network Chart (bar chart) - append new data points for both series
            if (charts.network) {
                charts.network.appendData([{
                    data: [{
                        x: timeLabel,
                        y: data.network.upload
                    }]
                }, {
                    data: [{
                        x: timeLabel,
                        y: data.network.download
                    }]
                }], false);
                
                // Limit to last 50 data points
                const uploadData = charts.network.w.globals.series[0];
                const downloadData = charts.network.w.globals.series[1];
                if (uploadData && uploadData.length > 50) {
                    charts.network.updateSeries([{
                        data: uploadData.slice(-50)
                    }, {
                        data: downloadData.slice(-50)
                    }]);
                }
            }
            
            // Update Disk Chart (donut - update series values)
            if (charts.disk) {
                const usedPercent = data.disk.current;
                const freePercent = 100 - usedPercent;
                charts.disk.updateSeries([usedPercent, freePercent]);
            }
            
            // Update Services Chart (pie - update series values)
            if (charts.services) {
                charts.services.updateSeries([
                    data.services.running,
                    data.services.stopped
                ]);
            }
        }
        
        // Refresh charts in real-time
        function startAutoRefresh() {
            if (refreshInterval) {
                clearInterval(refreshInterval);
            }
            
            refreshInterval = setInterval(() => {
                if (!isRealTimeEnabled) return;
                
                fetchVitals()
                    .then(data => {
                        updateKPIs(data);
                        
                        // Update mini charts
                        if (charts.cpuMini) {
                            charts.cpuMini.updateSeries([{
                                data: data.cpu.history.slice(-10).map(h => h.value)
                            }]);
                        }
                        if (charts.memoryMini) {
                            charts.memoryMini.updateSeries([{
                                data: data.memory.history.slice(-10).map(h => h.value)
                            }]);
                        }
                        if (charts.diskMini) {
                            charts.diskMini.updateSeries([data.disk.current]);
                        }
                        
                        // Update main charts in real-time
                        updateMainCharts(data);
                    })
                    .catch(error => {
                        console.error('Error refreshing vitals:', error);
                    });
            }, refreshRate);
        }
        
        // Stop real-time monitoring
        function stopAutoRefresh() {
            if (refreshInterval) {
                clearInterval(refreshInterval);
                refreshInterval = null;
            }
        }
        
        // Toggle real-time monitoring
        function toggleRealTime() {
            isRealTimeEnabled = !isRealTimeEnabled;
            const btn = document.getElementById('realtime-toggle');
            if (btn) {
                if (isRealTimeEnabled) {
                    btn.classList.add('active');
                    btn.querySelector('.icon').setAttribute('icon', 'solar:play-circle-bold');
                    startAutoRefresh();
                } else {
                    btn.classList.remove('active');
                    btn.querySelector('.icon').setAttribute('icon', 'solar:pause-circle-bold');
                    stopAutoRefresh();
                }
            }
        }
        
        // Add real-time toggle button to page
        function addRealTimeToggle() {
            const header = document.querySelector('.dashboard-main-body .d-flex.flex-wrap.align-items-center.justify-content-between');
            if (header && !document.getElementById('realtime-toggle')) {
                const toggleBtn = document.createElement('button');
                toggleBtn.id = 'realtime-toggle';
                toggleBtn.className = 'btn btn-sm btn-primary-600 d-flex align-items-center gap-2 active';
                toggleBtn.innerHTML = '<iconify-icon icon="solar:play-circle-bold" class="icon"></iconify-icon><span>Real-time</span>';
                toggleBtn.title = 'Toggle real-time monitoring';
                toggleBtn.addEventListener('click', toggleRealTime);
                
                const ul = header.querySelector('ul');
                if (ul) {
                    const li = document.createElement('li');
                    li.appendChild(toggleBtn);
                    ul.insertBefore(li, ul.firstChild);
                }
            }
        }
        
        // Initialize on page load
        function initializeVitals() {
            initCharts();
            setTimeout(() => {
                addRealTimeToggle();
                startAutoRefresh();
            }, 1000); // Wait for charts to initialize
        }
        
        // Wait for DOM to be ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initializeVitals);
        } else {
            // DOM is already ready
            initializeVitals();
        }
        
        // Cleanup on page unload
        window.addEventListener('beforeunload', () => {
            stopAutoRefresh();
        });
    })();
    </script>
    <?php endif; ?>

    <?php 
    // Preferences JavaScript
    if (isset($GLOBALS['preferencesScript']) && $GLOBALS['preferencesScript']): 
    ?>
    <script>
    (function() {
        'use strict';
        
        const PREFERENCES_API = 'api/preferences.php';
        
        // Save preferences
        const preferencesForm = document.getElementById('preferences-form');
        if (preferencesForm) {
            preferencesForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                const data = {};
                formData.forEach((value, key) => {
                    data[key] = value;
                });
                
                // Explicitly include all checkbox fields to handle unchecked state
                // Checkboxes that are unchecked don't appear in FormData, so we need to add them explicitly
                const checkboxFields = ['debug_banner', 'auto_update_check', 'auto_update_install'];
                checkboxFields.forEach(field => {
                    if (!data.hasOwnProperty(field)) {
                        data[field] = '0'; // Explicitly set to '0' when unchecked
                    }
                });
                
                fetch(PREFERENCES_API, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                    .then(response => response.json())
                    .then(result => {
                        if (result.success) {
                            alert('Preferences saved successfully');
                            location.reload();
                        } else {
                            alert('Error: ' + (result.error || 'Failed to save preferences'));
                        }
                    })
                    .catch(error => {
                        console.error('Error saving preferences:', error);
                        alert('Error: Failed to save preferences');
                    });
            });
        }
        
        // Reset preferences
        window.resetPreferences = function() {
            if (!confirm('Reset all preferences to default values?')) {
                return;
            }
            
            fetch(PREFERENCES_API + '?action=reset', {
                method: 'POST'
            })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        alert('Preferences reset successfully');
                        location.reload();
                    } else {
                        alert('Error: ' + (result.error || 'Failed to reset preferences'));
                    }
                })
                .catch(error => {
                    console.error('Error resetting preferences:', error);
                    alert('Error: Failed to reset preferences');
                });
        };
    })();
    </script>
    <?php endif; ?>

    <?php 
    // Tools JavaScript
    if (isset($GLOBALS['toolsScript']) && $GLOBALS['toolsScript']): 
    ?>
    <script>
    (function() {
        'use strict';
        
        const TOOLS_API = 'api/tools.php';
        
        // Run Composer command
        window.runComposer = function(command) {
            const project = document.getElementById('project-select').value;
            if (!project) {
                alert('Please select a project first');
                return;
            }
            
            const outputEl = document.getElementById('composer-output');
            const textEl = document.getElementById('composer-output-text');
            
            outputEl.style.display = 'block';
            textEl.textContent = 'Running composer ' + command + '...\n';
            
            const formData = new FormData();
            formData.append('action', 'composer');
            formData.append('project', project);
            formData.append('command', command);
            
            fetch(TOOLS_API, {
                method: 'POST',
                body: formData
            })
                .then(response => {
                    const contentType = response.headers.get('content-type');
                    if (contentType && contentType.includes('application/json')) {
                        return response.json();
                    } else {
                        return response.text().then(text => {
                            const jsonMatch = text.match(/\{[\s\S]*\}/);
                            if (jsonMatch) {
                                return JSON.parse(jsonMatch[0]);
                            }
                            throw new Error('Invalid JSON response');
                        });
                    }
                })
                .then(data => {
                    if (data.success) {
                        textEl.textContent += data.output || '';
                        if (data.error) {
                            textEl.textContent += '\nError: ' + data.error;
                        }
                    } else {
                        textEl.textContent += 'Error: ' + (data.error || 'Command failed');
                    }
                })
                .catch(error => {
                    textEl.textContent += 'Error: ' + error.message;
                });
        };
        
        // Run NPM command
        window.runNPM = function(command, script = null) {
            const project = document.getElementById('project-select').value;
            if (!project) {
                alert('Please select a project first');
                return;
            }
            
            const outputEl = document.getElementById('npm-output');
            const textEl = document.getElementById('npm-output-text');
            
            outputEl.style.display = 'block';
            textEl.textContent = 'Running npm ' + command + (script ? ' ' + script : '') + '...\n';
            
            const formData = new FormData();
            formData.append('action', 'npm');
            formData.append('project', project);
            formData.append('command', command);
            if (script) {
                formData.append('script', script);
            }
            
            fetch(TOOLS_API, {
                method: 'POST',
                body: formData
            })
                .then(response => {
                    const contentType = response.headers.get('content-type');
                    if (contentType && contentType.includes('application/json')) {
                        return response.json();
                    } else {
                        return response.text().then(text => {
                            const jsonMatch = text.match(/\{[\s\S]*\}/);
                            if (jsonMatch) {
                                return JSON.parse(jsonMatch[0]);
                            }
                            throw new Error('Invalid JSON response');
                        });
                    }
                })
                .then(data => {
                    if (data.success) {
                        textEl.textContent += data.output || '';
                        if (data.error) {
                            textEl.textContent += '\nError: ' + data.error;
                        }
                    } else {
                        textEl.textContent += 'Error: ' + (data.error || 'Command failed');
                    }
                })
                .catch(error => {
                    textEl.textContent += 'Error: ' + error.message;
                });
        };
        
        // Run Git command
        window.runGit = function(command) {
            const project = document.getElementById('project-select').value;
            if (!project) {
                alert('Please select a project first');
                return;
            }
            
            const outputEl = document.getElementById('git-output');
            const textEl = document.getElementById('git-output-text');
            
            outputEl.style.display = 'block';
            textEl.textContent = 'Running git ' + command + '...\n';
            
            const formData = new FormData();
            formData.append('action', 'git');
            formData.append('project', project);
            formData.append('command', command);
            
            fetch(TOOLS_API, {
                method: 'POST',
                body: formData
            })
                .then(response => {
                    const contentType = response.headers.get('content-type');
                    if (contentType && contentType.includes('application/json')) {
                        return response.json();
                    } else {
                        return response.text().then(text => {
                            const jsonMatch = text.match(/\{[\s\S]*\}/);
                            if (jsonMatch) {
                                return JSON.parse(jsonMatch[0]);
                            }
                            throw new Error('Invalid JSON response');
                        });
                    }
                })
                .then(data => {
                    if (data.success) {
                        textEl.textContent += data.output || '';
                        if (data.error) {
                            textEl.textContent += '\nError: ' + data.error;
                        }
                    } else {
                        textEl.textContent += 'Error: ' + (data.error || 'Command failed');
                    }
                })
                .catch(error => {
                    textEl.textContent += 'Error: ' + error.message;
                });
        };
        
        // Clear cache
        window.clearCache = function(type) {
            const project = document.getElementById('project-select').value;
            if (!project) {
                alert('Please select a project first');
                return;
            }
            
            if (!confirm('Clear ' + type + ' cache for ' + project + '?')) {
                return;
            }
            
            const outputEl = document.getElementById('cache-output');
            const textEl = document.getElementById('cache-output-text');
            
            outputEl.style.display = 'block';
            textEl.textContent = 'Clearing cache...\n';
            
            const formData = new FormData();
            formData.append('action', 'clear_cache');
            formData.append('project', project);
            formData.append('type', type);
            
            fetch(TOOLS_API, {
                method: 'POST',
                body: formData
            })
                .then(response => {
                    const contentType = response.headers.get('content-type');
                    if (contentType && contentType.includes('application/json')) {
                        return response.json();
                    } else {
                        return response.text().then(text => {
                            const jsonMatch = text.match(/\{[\s\S]*\}/);
                            if (jsonMatch) {
                                return JSON.parse(jsonMatch[0]);
                            }
                            throw new Error('Invalid JSON response');
                        });
                    }
                })
                .then(data => {
                    if (data.success) {
                        textEl.textContent += data.message || 'Cache cleared successfully';
                    } else {
                        textEl.textContent += 'Error: ' + (data.error || 'Failed to clear cache');
                    }
                })
                .catch(error => {
                    textEl.textContent += 'Error: ' + error.message;
                });
        };
        
        // Show PHP Info
        window.showPhpInfo = function() {
            fetch(TOOLS_API + '?action=php_info')
                .then(response => {
                    const contentType = response.headers.get('content-type');
                    if (contentType && contentType.includes('application/json')) {
                        return response.json();
                    } else {
                        return response.text().then(text => {
                            const jsonMatch = text.match(/\{[\s\S]*\}/);
                            if (jsonMatch) {
                                return JSON.parse(jsonMatch[0]);
                            }
                            throw new Error('Invalid JSON response');
                        });
                    }
                })
                .then(data => {
                    if (data.success && data.phpinfo) {
                        const win = window.open('', 'phpinfo', 'width=1000,height=700,scrollbars=yes');
                        win.document.write(data.phpinfo);
                        win.document.close();
                    } else {
                        alert('Error: ' + (data.error || 'Failed to load PHP info'));
                    }
                })
                .catch(error => {
                    alert('Error: ' + error.message);
                });
        };
        
        // SMTP Configuration Fix
        const SMTP_API = 'api/fix_smtp.php';
        
        // Check SMTP status on page load
        function checkSmtpStatus() {
            const statusEl = document.getElementById('smtp-status');
            const formEl = document.getElementById('smtp-config-form');
            const spinnerEl = document.getElementById('smtp-status-spinner');
            
            fetch(SMTP_API + '?action=check')
                .then(response => response.json())
                .then(data => {
                    spinnerEl.style.display = 'none';
                    
                    if (!data.success) {
                        statusEl.innerHTML = '<div class="alert alert-danger mb-0"><iconify-icon icon="solar:danger-triangle-bold" class="icon"></iconify-icon> ' + (data.error || 'Failed to check SMTP configuration') + '</div>';
                        return;
                    }
                    
                    // Show status
                    let statusHtml = '<div class="mb-8">';
                    statusHtml += '<p class="text-sm mb-4"><strong>PHP ini:</strong> <code class="text-xs">' + (data.php_ini_path || 'Not found') + '</code></p>';
                    statusHtml += '<p class="text-sm mb-4"><strong>Writable:</strong> ' + (data.php_ini_writable ? '<span class="text-success-main">Yes</span>' : '<span class="text-danger-main">No</span>') + '</p>';
                    
                    if (data.mailpit) {
                        statusHtml += '<p class="text-sm mb-4"><strong>Mailpit:</strong> ';
                        statusHtml += data.mailpit.enabled ? '<span class="text-success-main">Enabled</span>' : '<span class="text-warning-main">Disabled</span>';
                        statusHtml += ' (Port: ' + (data.mailpit.port || 'N/A') + ')</p>';
                    }
                    
                    if (data.current_config) {
                        statusHtml += '<p class="text-sm mb-4"><strong>Current SMTP:</strong> ' + (data.current_config.smtp || 'Not set') + '</p>';
                        statusHtml += '<p class="text-sm mb-0"><strong>SMTP Port:</strong> ' + (data.current_config.smtp_port || 'Not set') + '</p>';
                    }
                    
                    statusHtml += '</div>';
                    
                    // Show recommendation
                    if (data.recommendation === 'ok') {
                        statusHtml += '<div class="alert alert-success mb-0"><iconify-icon icon="solar:check-circle-bold" class="icon"></iconify-icon> SMTP is already configured for Mailpit!</div>';
                    } else if (data.recommendation === 'configure') {
                        statusHtml += '<div class="alert alert-warning mb-0"><iconify-icon icon="solar:danger-triangle-bold" class="icon"></iconify-icon> SMTP needs to be configured for Mailpit.</div>';
                        formEl.style.display = 'block';
                        if (data.mailpit && data.mailpit.port) {
                            document.getElementById('smtp-port').value = data.mailpit.port;
                        }
                    } else {
                        statusHtml += '<div class="alert alert-info mb-0"><iconify-icon icon="solar:info-circle-bold" class="icon"></iconify-icon> Please enable Mailpit in Laragon first.</div>';
                    }
                    
                    statusEl.innerHTML = statusHtml;
                })
                .catch(error => {
                    spinnerEl.style.display = 'none';
                    statusEl.innerHTML = '<div class="alert alert-danger mb-0"><iconify-icon icon="solar:danger-triangle-bold" class="icon"></iconify-icon> Error: ' + error.message + '</div>';
                });
        }
        
        // Fix SMTP configuration
        document.addEventListener('DOMContentLoaded', function() {
            const fixBtn = document.getElementById('fix-smtp-btn');
            if (fixBtn) {
                checkSmtpStatus();
                
                fixBtn.addEventListener('click', function() {
                    if (!confirm('This will modify your php.ini file. A backup will be created automatically. Continue?')) {
                        return;
                    }
                    
                    const btn = this;
                    const originalText = btn.innerHTML;
                    btn.disabled = true;
                    btn.innerHTML = '<iconify-icon icon="solar:loading-bold" class="icon spin"></iconify-icon> Configuring...';
                    
                    const smtpPort = document.getElementById('smtp-port').value;
                    const fromEmail = document.getElementById('from-email').value;
                    const outputEl = document.getElementById('smtp-output');
                    const alertEl = document.getElementById('smtp-alert');
                    const messageEl = document.getElementById('smtp-message');
                    
                    const formData = new FormData();
                    formData.append('smtp_port', smtpPort);
                    formData.append('from_email', fromEmail);
                    
                    fetch(SMTP_API + '?action=configure', {
                        method: 'POST',
                        body: formData
                    })
                        .then(response => response.json())
                        .then(data => {
                            outputEl.style.display = 'block';
                            
                            if (data.success) {
                                alertEl.className = 'alert alert-success';
                                let message = '<iconify-icon icon="solar:check-circle-bold" class="icon"></iconify-icon> <strong>Success!</strong> ';
                                message += data.message || 'SMTP configuration updated successfully.';
                                if (data.backup) {
                                    message += '<br><small>Backup created: ' + data.backup.split(/[\\/]/).pop() + '</small>';
                                }
                                if (data.config) {
                                    message += '<br><small>SMTP: ' + data.config.smtp + ':' + data.config.smtp_port + '</small>';
                                }
                                messageEl.innerHTML = message;
                                
                                // Reload status after 2 seconds
                                setTimeout(() => {
                                    checkSmtpStatus();
                                }, 2000);
                            } else {
                                alertEl.className = 'alert alert-danger';
                                messageEl.innerHTML = '<iconify-icon icon="solar:danger-triangle-bold" class="icon"></iconify-icon> <strong>Error:</strong> ' + (data.error || 'Failed to configure SMTP');
                            }
                            
                            btn.disabled = false;
                            btn.innerHTML = originalText;
                        })
                        .catch(error => {
                            outputEl.style.display = 'block';
                            alertEl.className = 'alert alert-danger';
                            messageEl.innerHTML = '<iconify-icon icon="solar:danger-triangle-bold" class="icon"></iconify-icon> <strong>Error:</strong> ' + error.message;
                            btn.disabled = false;
                            btn.innerHTML = originalText;
                        });
                });
            }
        });
    })();
    </script>
    <?php endif; ?>

    <!-- Auto-Update Check Script -->
    <script>
    (function() {
        'use strict';
        
        const UPDATE_API = '<?php echo defined("BASE_URL") ? BASE_URL : ""; ?>/api/update.php';
        const PREFERENCES_API = '<?php echo defined("BASE_URL") ? BASE_URL : ""; ?>/api/preferences.php';
        
        // Check if auto-update is enabled
        let autoUpdateEnabled = true;
        let autoInstallEnabled = false;
        let lastCheckTime = null;
        const CHECK_INTERVAL = 3600000; // 1 hour in milliseconds
        
        // Load preferences
        function loadPreferences() {
            return fetch(PREFERENCES_API + '?action=get')
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.preferences) {
                        autoUpdateEnabled = data.preferences.auto_update_check !== false;
                        autoInstallEnabled = data.preferences.auto_update_install === true;
                        lastCheckTime = data.preferences.last_update_check;
                    }
                })
                .catch(error => {
                    console.error('Failed to load preferences:', error);
                });
        }
        
        // Check for updates
        function checkForUpdates(showNotification = true) {
            if (!autoUpdateEnabled) {
                return;
            }
            
            // Don't check too frequently (at least 30 minutes between checks)
            if (lastCheckTime) {
                const timeSinceLastCheck = Date.now() - (lastCheckTime * 1000);
                if (timeSinceLastCheck < 1800000) { // 30 minutes
                    return;
                }
            }
            
            fetch(UPDATE_API + '?action=check')
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.data && data.data.available) {
                        showUpdateNotification(data.data);
                        
                        // Update last check time
                        saveLastCheckTime();
                    } else {
                        // No update available
                        if (showNotification) {
                            saveLastCheckTime();
                        }
                    }
                })
                .catch(error => {
                    console.error('Update check failed:', error);
                });
        }
        
        // Show update notification
        function showUpdateNotification(updateInfo) {
            const indicator = document.getElementById('update-indicator');
            const notificationCount = document.getElementById('notification-count');
            const notificationsList = document.getElementById('notifications-list');
            
            if (indicator) {
                indicator.style.display = 'block';
            }
            
            if (notificationCount) {
                const currentCount = parseInt(notificationCount.textContent) || 0;
                notificationCount.textContent = currentCount + 1;
            }
            
            if (notificationsList) {
                const existingUpdate = notificationsList.querySelector('.update-notification');
                if (existingUpdate) {
                    existingUpdate.remove();
                }
                
                const notification = document.createElement('div');
                notification.className = 'update-notification px-24 py-16 border-bottom';
                notification.innerHTML = `
                    <div class="d-flex align-items-start gap-3">
                        <div class="w-40-px h-40-px bg-success-subtle rounded-circle d-flex justify-content-center align-items-center flex-shrink-0">
                            <iconify-icon icon="solar:download-bold" class="text-success-main text-xl"></iconify-icon>
                        </div>
                        <div class="flex-grow-1">
                            <p class="fw-semibold mb-4">Update Available: ${updateInfo.latest_version}</p>
                            <p class="text-secondary-light text-sm mb-8">Current: ${updateInfo.current_version}</p>
                            <div class="d-flex gap-2">
                                <button class="btn btn-primary-600 btn-sm" onclick="installUpdate('${updateInfo.download_url}', '${updateInfo.version}')">
                                    <iconify-icon icon="solar:download-bold" class="icon"></iconify-icon>
                                    Update Now
                                </button>
                                <a href="${updateInfo.release_url}" target="_blank" class="btn btn-secondary btn-sm">
                                    View Release
                                </a>
                            </div>
                        </div>
                    </div>
                `;
                
                const emptyMsg = notificationsList.querySelector('.px-24.py-12.text-center');
                if (emptyMsg) {
                    emptyMsg.remove();
                }
                
                notificationsList.insertBefore(notification, notificationsList.firstChild);
            }
        }
        
        // Install update
        window.installUpdate = function(downloadUrl, version) {
            if (!confirm(`Install update to version ${version}? This will create a backup and may take a few minutes.`)) {
                return;
            }
            
            const progressModal = document.createElement('div');
            progressModal.className = 'modal fade show';
            progressModal.style.display = 'block';
            progressModal.innerHTML = `
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Installing Update</h5>
                        </div>
                        <div class="modal-body">
                            <div class="progress mb-16">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%"></div>
                            </div>
                            <p id="update-status">Preparing update...</p>
                        </div>
                    </div>
                </div>
            `;
            document.body.appendChild(progressModal);
            
            const progressBar = progressModal.querySelector('.progress-bar');
            const statusText = progressModal.querySelector('#update-status');
            
            // Store backup path for use in install step
            let backupPath = null;
            
            // Step 1: Backup
            statusText.textContent = 'Creating backup...';
            progressBar.style.width = '25%';
            
            fetch(UPDATE_API + '?action=backup')
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        throw new Error(data.error || 'Backup failed');
                    }
                    
                    // Store backup path for later use
                    backupPath = data.backup_path;
                    if (!backupPath) {
                        throw new Error('Backup path not returned from backup operation');
                    }
                    
                    // Step 2: Download
                    statusText.textContent = 'Downloading update...';
                    progressBar.style.width = '50%';
                    
                    return fetch(UPDATE_API + '?action=download', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ download_url: downloadUrl })
                    });
                })
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        throw new Error(data.error || 'Download failed');
                    }
                    
                    if (!data.zip_path) {
                        throw new Error('Download path not returned from download operation');
                    }
                    
                    // Step 3: Install
                    statusText.textContent = 'Installing update...';
                    progressBar.style.width = '75%';
                    
                    return fetch(UPDATE_API + '?action=install', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({
                            zip_path: data.zip_path,
                            backup_path: backupPath
                        })
                    });
                })
                .then(response => response.json())
                .then(data => {
                    progressBar.style.width = '100%';
                    
                    if (data.success && data.verified) {
                        statusText.textContent = 'Update installed successfully! Reloading...';
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    } else {
                        throw new Error(data.message || 'Installation failed');
                    }
                })
                .catch(error => {
                    console.error('Update installation error:', error);
                    statusText.textContent = 'Error: ' + (error.message || 'Unknown error occurred');
                    progressBar.className = 'progress-bar bg-danger';
                    progressBar.style.width = '100%';
                    
                    // Add a close button
                    const closeBtn = document.createElement('button');
                    closeBtn.className = 'btn btn-secondary mt-3';
                    closeBtn.textContent = 'Close';
                    closeBtn.onclick = () => progressModal.remove();
                    progressModal.querySelector('.modal-body').appendChild(closeBtn);
                    
                    // Auto-remove after 10 seconds instead of 5
                    setTimeout(() => {
                        if (progressModal.parentNode) {
                            progressModal.remove();
                        }
                    }, 10000);
                });
        };
        
        // Save last check time
        function saveLastCheckTime() {
            fetch(PREFERENCES_API, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    last_update_check: Math.floor(Date.now() / 1000)
                })
            }).catch(error => {
                console.error('Failed to save last check time:', error);
            });
        }
        
        // Initialize
        loadPreferences().then(() => {
            // Check on page load (after a short delay)
            setTimeout(() => {
                checkForUpdates(false);
            }, 3000);
            
            // Check periodically if enabled
            if (autoUpdateEnabled) {
                setInterval(() => {
                    checkForUpdates(false);
                }, CHECK_INTERVAL);
            }
        });
    })();
    </script>

    <?php echo (isset($script) ? $script   : '')?>