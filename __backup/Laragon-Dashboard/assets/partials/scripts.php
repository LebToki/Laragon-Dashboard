<script>
// Ensure jQuery is loaded before executing jQuery-dependent code
(function() {
    // Wait for jQuery to be available
    function initDashboard() {
        if (typeof jQuery === 'undefined') {
            console.error('jQuery is not loaded. Retrying...');
            setTimeout(initDashboard, 100);
            return;
        }
        
        // jQuery is available, proceed with initialization
        // All jQuery code below will use the global jQuery/$
        
        $(document).ready(function() {
            // Sidebar navigation handler
            $('.sidebar-menu-link').on('click', function(e) {
        e.preventDefault();
        var page_id = $(this).attr('data-page');
        
        // Update active states
        $('.sidebar-menu-link').removeClass('active');
        $('.tab-content').removeClass('active');
        
        $(this).addClass('active');
        $('#' + page_id).addClass('active');
        
        // Update breadcrumb
        var pageNames = {
            'servers': <?php 
                $text = $translations['servers_tab'] ?? 'Servers';
                echo json_encode($text, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); 
            ?>,
            'mailbox': <?php 
                $text = $translations['inbox_tab'] ?? 'Mailbox';
                echo json_encode($text, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); 
            ?>,
            'vitals': <?php 
                $text = $translations['vitals_tab'] ?? 'Server Vitals';
                echo json_encode($text, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); 
            ?>,
            'databases': <?php 
                $text = $translations['databases_tab'] ?? 'Databases';
                echo json_encode($text, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); 
            ?>,
            'services': <?php 
                $text = $translations['services_tab'] ?? 'Services';
                echo json_encode($text, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); 
            ?>,
            'logs': <?php 
                $text = $translations['logs_tab'] ?? 'Logs';
                echo json_encode($text, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); 
            ?>,
            'tools': <?php 
                $text = $translations['tools_tab'] ?? 'Tools';
                echo json_encode($text, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); 
            ?>
        };
        $('#breadcrumb-current').text(pageNames[page_id] || 'Dashboard');
        
        // Close mobile sidebar if open
        if ($(window).width() <= 768) {
            $('#sidebar').removeClass('open');
        }
        
        // Handle page-specific logic
        handlePageSwitch(page_id);
    });
    
    // Legacy tab handler for backward compatibility
    $('.tab').click(function() {
        var tab_id = $(this).attr('data-tab');

        $('.tab').removeClass('active');
        $('.tab-content').removeClass('active');

        $(this).addClass('active');
        $("#" + tab_id).addClass('active');
        
        handlePageSwitch(tab_id);
    });
    
    // Page switch handler
    function handlePageSwitch(tab_id) {
        // Hide servers container when other tabs are active
        if (tab_id !== 'servers') {
            $('#servers .container-fluid').hide();
        } else {
            $('#servers .container-fluid').show();
        }
        
        // Initialize charts when vitals tab is clicked
        if (tab_id === 'vitals') {
            // Wait for tab content to be visible and Chart.js to load
            setTimeout(function() {
                if (typeof initializeCharts === 'function') {
                    initializeCharts();
                }
                // Also fetch vitals data and start interval
                if (typeof fetchServerVitals === 'function') {
                    fetchServerVitals();
                }
                if (typeof startVitalsInterval === 'function') {
                    startVitalsInterval();
                }
            }, 300);
        } else {
            // Stop interval when switching away from vitals
            if (window.vitalsInterval) {
                clearInterval(window.vitalsInterval);
                window.vitalsInterval = undefined;
            }
        }
        
        // Load services when services tab is clicked
        if (tab_id === 'services') {
            setTimeout(function() {
                if (typeof loadServices === 'function') {
                    loadServices();
                }
            }, 100);
        }
    }
    
    // Sidebar toggle handlers
    $('#sidebar-toggle, #mobile-sidebar-toggle').on('click', function(e) {
        e.stopPropagation();
        $('#sidebar').toggleClass('open');
    });
    
    // Close sidebar when clicking outside on mobile
    $(document).on('click', function(e) {
        if ($(window).width() <= 768 && !$(e.target).closest('.sidebar, #mobile-sidebar-toggle').length) {
            $('#sidebar').removeClass('open');
        }
    });
    
    // Mobile sidebar toggle visibility
    function updateMobileToggle() {
        if ($(window).width() <= 768) {
            $('#mobile-sidebar-toggle').show();
        } else {
            $('#mobile-sidebar-toggle').hide();
            $('#sidebar').removeClass('open');
        }
    }
    
    $(window).on('resize', updateMobileToggle);
    updateMobileToggle();

    // Language flag click handler (already handled by href, but add smooth transition)
    $('.language-flag').on('click', function(e) {
        // Add loading state
        $(this).addClass('loading');
    });

    // Initialize Iconify icons - robust initialization with MutationObserver
    function initIconify() {
        // Iconify 3.1.1 uses web components, check for proper API
        if (typeof Iconify !== 'undefined' && Iconify.scan) {
            try {
                Iconify.scan();
                return true;
            } catch (e) {
                console.warn('Iconify.scan() error:', e);
            }
        } else if (typeof window.Iconify !== 'undefined' && window.Iconify.scan) {
            try {
                window.Iconify.scan();
                return true;
            } catch (e) {
                console.warn('window.Iconify.scan() error:', e);
            }
        }
        return false;
    }

    // MutationObserver for dynamic content
    function setupIconifyObserver() {
        if (typeof MutationObserver === 'undefined') return;
        
        const observer = new MutationObserver(function(mutations) {
            let shouldScan = false;
            mutations.forEach(function(mutation) {
                if (mutation.addedNodes.length > 0) {
                    mutation.addedNodes.forEach(function(node) {
                        if (node.nodeType === 1) { // Element node
                            if (node.tagName === 'ICONIFY-ICON' || 
                                node.querySelector && node.querySelector('iconify-icon')) {
                                shouldScan = true;
                            }
                        }
                    });
                }
            });
            if (shouldScan) {
                setTimeout(initIconify, 50);
            }
        });

        // Observe the entire document for changes
        observer.observe(document.body || document.documentElement, {
            childList: true,
            subtree: true
        });
    }

    // Initialize on DOM ready
    $(document).ready(function() {
        // Wait for Iconify to be fully loaded
        function waitForIconify(retries) {
            retries = retries || 20;
            if (typeof Iconify !== 'undefined' || typeof window.Iconify !== 'undefined') {
                initIconify();
                setupIconifyObserver();
                // Also scan after a short delay to catch any initial icons
                setTimeout(initIconify, 100);
                setTimeout(initIconify, 500);
            } else if (retries > 0) {
                setTimeout(function() {
                    waitForIconify(retries - 1);
                }, 100);
            } else {
                console.warn('Iconify library not loaded after 2 seconds');
            }
        }
        waitForIconify();
    });

    // Re-scan after AJAX content updates
    $('#project-search').on('input', function() {
        var q = $(this).val();
        $.get('project_search.php', {q: q}, function(data) {
            $('#project-list').html(data);
            // Re-scan for Iconify icons after content update
            setTimeout(initIconify, 50);
            setTimeout(initIconify, 200);
        });
    });
});

function fetchServerVitals() {
    $.ajax({
        url: 'server_vitals.php',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            if (data.error) {
                console.error('Error fetching server vitals:', data.error);
                return;
            }
            
            // Update vitals card values
            $('#uptime').text(data.uptime || 'N/A');
            $('#memory-usage').text(data.memoryUsage || '0%');
            $('#php-memory').text(formatBytes(data.phpMemory.current) + ' / ' + formatBytes(data.phpMemory.peak));
            $('#cpu-usage').text(data.cpuUsage || '0%');
            
            // Update CPU progress bar
            if (data.cpuUsage) {
                const cpuPercent = parseInt(data.cpuUsage.replace('%', ''));
                $('#cpu-progress').css('width', cpuPercent + '%');
            }
            
            // Format disk usage
            let diskInfo = '';
            if (data.diskUsage && data.diskUsage.length > 0) {
                const firstDisk = data.diskUsage[0];
                if (firstDisk.caption && firstDisk.size && firstDisk.freespace) {
                    const used = firstDisk.size - firstDisk.freespace;
                    const percent = Math.round((used / firstDisk.size) * 100);
                    diskInfo = percent + '%';
                }
            }
            $('#disk-usage').text(diskInfo || '0%');
            
            // Update memory details
            if (data.memoryDetails) {
                let memoryHtml = '';
                memoryHtml += '<div class="vitals-details-item"><span>Total:</span><span>' + formatBytes(data.memoryDetails.total) + '</span></div>';
                memoryHtml += '<div class="vitals-details-item"><span>Used:</span><span>' + formatBytes(data.memoryDetails.used) + '</span></div>';
                memoryHtml += '<div class="vitals-details-item"><span>Free:</span><span>' + formatBytes(data.memoryDetails.free) + '</span></div>';
                $('#memory-details-list').html(memoryHtml);
                $('#memory-details').text(formatBytes(data.memoryDetails.used) + ' / ' + formatBytes(data.memoryDetails.total));
            }
            
            // Update disk details
            if (data.diskUsage && data.diskUsage.length > 0) {
                let diskHtml = '';
                data.diskUsage.forEach(function(disk) {
                    if (disk.caption && disk.size && disk.freespace) {
                        const used = disk.size - disk.freespace;
                        const percent = Math.round((used / disk.size) * 100);
                        diskHtml += '<div class="vitals-details-item"><span>' + disk.caption + ':</span><span>' + percent + '%</span></div>';
                    }
                });
                $('#disk-details-list').html(diskHtml || '<div class="vitals-details-item"><span>No disks found</span></div>');
            }

            // Update charts (only if they exist and are initialized)
            if (typeof window.uptimeChart !== 'undefined' && window.uptimeChart && window.uptimeChart.data && data.uptimeLabels && data.uptimeData) {
                window.uptimeChart.data.labels = data.uptimeLabels;
                if (window.uptimeChart.data.datasets && window.uptimeChart.data.datasets[0]) {
                    window.uptimeChart.data.datasets[0].data = data.uptimeData;
                    window.uptimeChart.update();
                }
            }

            if (typeof window.memoryUsageChart !== 'undefined' && window.memoryUsageChart && window.memoryUsageChart.data && data.memoryUsageLabels && data.memoryUsageData) {
                window.memoryUsageChart.data.labels = data.memoryUsageLabels;
                if (window.memoryUsageChart.data.datasets && window.memoryUsageChart.data.datasets[0]) {
                    window.memoryUsageChart.data.datasets[0].data = data.memoryUsageData;
                    window.memoryUsageChart.update();
                }
            }

            if (typeof window.diskUsageChart !== 'undefined' && window.diskUsageChart && window.diskUsageChart.data && data.diskUsageLabels && data.diskUsageData) {
                window.diskUsageChart.data.labels = data.diskUsageLabels;
                if (window.diskUsageChart.data.datasets && window.diskUsageChart.data.datasets[0]) {
                    window.diskUsageChart.data.datasets[0].data = data.diskUsageData;
                    window.diskUsageChart.update();
                }
            }
            
            if (typeof window.phpMemoryChart !== 'undefined' && window.phpMemoryChart && window.phpMemoryChart.data && data.phpMemory) {
                const currentMB = Math.round(data.phpMemory.current / (1024 * 1024));
                const peakMB = Math.round(data.phpMemory.peak / (1024 * 1024));
                if (window.phpMemoryChart.data.datasets && window.phpMemoryChart.data.datasets[0]) {
                    window.phpMemoryChart.data.datasets[0].data = [currentMB, peakMB];
                    window.phpMemoryChart.update();
                }
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', error);
            $('#uptime').text('Error loading uptime');
            $('#memory-usage').text('Error loading memory usage');
            $('#disk-usage').text('Error loading disk usage');
            $('#php-memory').text('Error loading PHP memory');
        }
    });
}

function formatBytes(bytes, decimals = 2) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const dm = decimals < 0 ? 0 : decimals;
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
}

// Only start interval if vitals tab is active
function startVitalsInterval() {
    const vitalsTab = document.getElementById('vitals');
    if (vitalsTab && vitalsTab.classList.contains('active')) {
        fetchServerVitals();
        // Clear existing interval if any
        if (window.vitalsInterval) {
            clearInterval(window.vitalsInterval);
        }
        window.vitalsInterval = setInterval(fetchServerVitals, 5000);
    }
}

// Start interval on page load if vitals is active
$(document).ready(function() {
    if ($('#vitals').hasClass('active')) {
        startVitalsInterval();
        initializeCharts();
    }
});

// Toast notification function
function showToast(message, type = 'info', duration = 3000) {
    type = type || 'info';
    const toastContainer = $('.toast-container').length ? $('.toast-container') : $('<div class="toast-container"></div>').appendTo('body');
    
    const toast = $('<div class="toast ' + type + '">' + message + '</div>');
    toastContainer.append(toast);
    
    setTimeout(function() {
        toast.addClass('fade-out');
        setTimeout(function() {
            toast.remove();
        }, 300);
    }, duration);
}

function startServer() {
    alert('Starting server...');
    // Add your server start logic here
}

function stopServer() {
    alert('Stopping server...');
    // Add your server stop logic here
}

// Database Manager Functions
$(document).ready(function() {
    loadDatabases();
    loadServices();
    loadLogs();
    loadProjects();
});

function loadDatabases() {
    $.get('database_manager.php?action=list_databases', function(data) {
        if (data.success) {
            const select = $('#database-select');
            select.empty();
            select.append('<option value="">Select Database</option>');
            data.databases.forEach(function(db) {
                select.append('<option value="' + db + '">' + db + '</option>');
            });
        }
    });
}

$('#database-select').change(function() {
    const db = $(this).val();
    if (db) {
        loadTables(db);
        getDatabaseSize(db);
    }
});

function loadTables(database) {
    $.get('database_manager.php?action=get_tables&database=' + encodeURIComponent(database), function(data) {
        if (data.success) {
            const tbody = $('#tables-tbody');
            tbody.empty();
            data.tables.forEach(function(table) {
                const size = formatBytes((table.DATA_LENGTH || 0) + (table.INDEX_LENGTH || 0));
                tbody.append('<tr><td>' + table.TABLE_NAME + '</td><td>' + (table.TABLE_ROWS || 0) + '</td><td>' + size + '</td><td><button class="btn btn-sm btn-info" onclick="viewTableStructure(\'' + database + '\', \'' + table.TABLE_NAME + '\')">Structure</button></td></tr>');
            });
        }
    });
}

function getDatabaseSize(database) {
    $.get('database_manager.php?action=get_database_size&database=' + encodeURIComponent(database), function(data) {
        if (data.success) {
            $('#database-size').text(data.size_mb + ' MB');
        }
    });
}

function executeQuery() {
    const query = $('#query-input').val();
    if (!query) {
        alert('Please enter a query');
        return;
    }
    $.post('database_manager.php?action=execute_query', {query: query}, function(data) {
        if (data.success) {
            let html = '<table class="table table-striped"><thead><tr>';
            if (data.results.length > 0) {
                Object.keys(data.results[0]).forEach(function(key) {
                    html += '<th>' + key + '</th>';
                });
                html += '</tr></thead><tbody>';
                data.results.forEach(function(row) {
                    html += '<tr>';
                    Object.values(row).forEach(function(val) {
                        html += '<td>' + (val !== null ? val : 'NULL') + '</td>';
                    });
                    html += '</tr>';
                });
                html += '</tbody></table>';
            } else {
                html = '<p>No results</p>';
            }
            $('#query-results').html(html);
        } else {
            alert('Error: ' + data.error);
        }
    });
}

// Services Manager Functions
function loadServices() {
    $.get('services_manager.php?action=status', function(data) {
        if (data.success) {
            const container = $('#services-list');
            container.empty();
            
            // Show preferences info if available
            if (data.preferences) {
                const prefs = data.preferences;
                if (prefs.StartAllAutomatically) {
                    container.append(`
                        <div class="col-12 mb-3">
                            <div class="alert alert-info" style="background-color: rgba(0, 173, 239, 0.2); border-color: #00adef; color: #fff;">
                                <i class="bi bi-info-circle"></i> <strong>Laragon Preferences:</strong> "Start All automatically" is enabled. 
                                Services will start automatically when Laragon starts.
                            </div>
                        </div>
                    `);
                }
            }
            
            Object.keys(data.services).forEach(function(serviceName) {
                const service = data.services[serviceName];
                const isRunning = service.status === 'running';
                const statusClass = isRunning ? 'success' : 'danger';
                const statusText = isRunning ? 'Running' : 'Stopped';
                const version = service.version || 'Unknown';
                const ports = service.ports || [];
                const configuredPorts = service.configuredPorts || [];
                const enabled = service.enabled !== false; // Default to true if not specified
                
                // Format ports like Laragon: "80/443" for Apache, "3306" for MySQL, "1025/8025" for Mailpit
                // Use configured ports if available, otherwise use detected ports
                let portsText = '-';
                const portsToShow = configuredPorts.length > 0 ? configuredPorts : ports;
                if (portsToShow.length > 0) {
                    portsText = portsToShow.join('/');
                }
                
                // Icon mapping
                let iconClass = 'bi-circle';
                let iconHtml = '';
                if (service.icon === 'lock') {
                    iconClass = 'bi-shield-lock';
                    iconHtml = '<i class="bi bi-shield-lock" style="color: #00adef;"></i>';
                } else if (service.icon === 'database') {
                    iconClass = 'bi-database';
                    iconHtml = '<i class="bi bi-database" style="color: #00adef;"></i>';
                } else if (service.icon === 'envelope') {
                    iconClass = 'bi-envelope';
                    iconHtml = '<i class="bi bi-envelope" style="color: #00adef;"></i>';
                } else if (service.icon === 'server') {
                    iconClass = 'bi-server';
                    iconHtml = '<i class="bi bi-server" style="color: #00adef;"></i>';
                } else if (service.icon === 'memory') {
                    iconClass = 'bi-memory';
                    iconHtml = '<i class="bi bi-memory" style="color: #00adef;"></i>';
                }
                
                // Toggle switch HTML
                const toggleSwitch = `
                    <div class="form-check form-switch" style="display: inline-block; margin-right: 10px;">
                        <input class="form-check-input" type="checkbox" role="switch" 
                               id="toggle-${serviceName}" 
                               ${isRunning ? 'checked' : ''}
                               ${!enabled ? 'disabled' : ''}
                               onchange="toggleService('${serviceName}', this.checked)"
                               style="cursor: ${enabled ? 'pointer' : 'not-allowed'}; width: 2.5rem; height: 1.25rem; ${!enabled ? 'opacity: 0.5;' : ''}">
                    </div>
                `;
                
                // Service card HTML matching Laragon's style
                // Show all services, but indicate disabled ones
                const cardHtml = `
                    <div class="col-md-4 mb-3">
                        <div class="overviewcard" style="flex-direction: row; align-items: center; justify-content: space-between; padding: 15px; ${!enabled ? 'opacity: 0.7;' : ''}">
                            <div style="display: flex; align-items: center; flex: 1;">
                                ${toggleSwitch}
                                <div style="flex: 1;">
                                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 5px;">
                                        <strong style="color: #fff; font-size: 16px;">${serviceName} ${version}</strong>
                                        ${iconHtml}
                                    </div>
                                    <div style="display: flex; align-items: center; gap: 15px; font-size: 14px;">
                                        <span style="color: rgba(255, 255, 255, 0.7);">Ports: <strong style="color: #fff;">${portsText}</strong></span>
                                        <span class="badge bg-${statusClass}" style="font-size: 12px;">${statusText}</span>
                                        ${!enabled ? '<span class="badge bg-secondary" style="font-size: 11px; opacity: 0.8;">Disabled</span>' : ''}
                                    </div>
                                </div>
                            </div>
                            ${serviceName === 'Apache' ? '<a href="javascript:void(0);" onclick="reloadApache()" style="color: #00adef; text-decoration: none; margin-left: 10px;">Reload</a>' : ''}
                        </div>
                    </div>
                `;
                
                container.append(cardHtml);
            });
        }
    }).fail(function(xhr, status, error) {
        console.error('Error loading services:', error);
        $('#services-list').html('<div class="col-12"><div class="alert alert-danger">Error loading services: ' + error + '</div></div>');
    });
}

function toggleService(service, isOn) {
    const action = isOn ? 'start' : 'stop';
    controlService(service, action);
}

function reloadApache() {
    controlService('Apache', 'restart');
}

function controlService(service, action) {
    // For toggle switches, don't show confirmation
    if (action !== 'start' && action !== 'stop') {
        if (!confirm('Are you sure you want to ' + action + ' ' + service + '?')) {
            return;
        }
    }
    
    // Show loading state
    const toggle = $('#toggle-' + service);
    if (toggle.length) {
        toggle.prop('disabled', true);
    }
    
    $.get('services_manager.php?action=' + action + '&service=' + encodeURIComponent(service), function(data) {
        if (data.success) {
            // Refresh services after a short delay
            setTimeout(function() {
                loadServices();
            }, 1000);
        } else {
            alert('Error: ' + (data.error || 'Unknown error'));
            // Revert toggle if it failed
            if (toggle.length) {
                toggle.prop('checked', !toggle.prop('checked'));
            }
        }
    }).fail(function(xhr, status, error) {
        alert('Error: ' + error);
        // Revert toggle if it failed
        if (toggle.length) {
            toggle.prop('checked', !toggle.prop('checked'));
        }
    }).always(function() {
        if (toggle.length) {
            toggle.prop('disabled', false);
        }
    });
}

function refreshPorts() {
    $.get('services_manager.php?action=get_ports', function(data) {
        if (data.success) {
            let html = '<table class="table table-striped"><thead><tr><th>Address</th><th>Port</th></tr></thead><tbody>';
            data.ports.forEach(function(port) {
                html += '<tr><td>' + port.address + '</td><td>' + port.port + '</td></tr>';
            });
            html += '</tbody></table>';
            $('#ports-list').html(html);
        }
    });
}

// Log Viewer Functions
function loadLogs() {
    $.get('log_viewer.php?action=list_logs', function(data) {
        if (data.success) {
            const select = $('#log-select');
            select.empty();
            select.append('<option value="">Select Log File</option>');
            data.logs.forEach(function(log) {
                select.append('<option value="' + log.path + '">' + log.type + ' - ' + log.name + ' (' + formatBytes(log.size) + ')</option>');
            });
        }
    });
}

function loadLog() {
    const logPath = $('#log-select').val();
    const lines = $('#log-lines').val();
    if (!logPath) {
        alert('Please select a log file');
        return;
    }
    $.get('log_viewer.php?action=read_log&path=' + encodeURIComponent(logPath) + '&lines=' + lines, function(data) {
        if (data.success) {
            $('#log-text').text(data.lines.join('\n'));
        } else {
            alert('Error: ' + data.error);
        }
    });
}

function clearLog() {
    const logPath = $('#log-select').val();
    if (!logPath) {
        alert('Please select a log file');
        return;
    }
    if (!confirm('Are you sure you want to clear this log file?')) {
        return;
    }
    $.get('log_viewer.php?action=clear_log&path=' + encodeURIComponent(logPath), function(data) {
        if (data.success) {
            alert('Log cleared successfully');
            loadLog();
        } else {
            alert('Error: ' + data.error);
        }
    });
}

// Quick Tools Functions
function clearCache() {
    $.post('quick_tools.php', {action: 'clear_cache'}, function(data) {
        if (data.success) {
            alert('Cache cleared successfully');
        } else {
            alert('Error: ' + data.error);
        }
    });
}

function optimizeDatabase() {
    const database = $('#optimize-db-select').val();
    if (!database) {
        alert('Please select a database');
        return;
    }
    if (!confirm('This may take a while. Continue?')) {
        return;
    }
    $.post('quick_tools.php', {action: 'optimize_database', database: database}, function(data) {
        if (data.success) {
            alert('Database optimized successfully. Tables optimized: ' + data.optimized_tables.length);
        } else {
            alert('Error: ' + data.error);
        }
    });
}

function loadProjects() {
    // SECURITY: Don't expose full server paths in client-side code
    const wwwPath = <?php 
        // Only expose full path in debug mode
        if (defined('APP_DEBUG') && APP_DEBUG) {
            $path = dirname($_SERVER["DOCUMENT_ROOT"]);
        } else {
            $path = '/www'; // Generic path for production
        }
        echo json_encode($path, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
    ?>;
    const folders = <?php 
        $rootPath = APP_ROOT ?? dirname(dirname(dirname(__DIR__)));
        $folders = array_filter(glob($rootPath . '/*'), 'is_dir');
        $ignore = ['.', '..', 'logs', 'access-logs', 'vendor', 'favicon_io', 'ablepro-90', 'assets', 'Laragon-Dashboard'];
        $projects = [];
        foreach ($folders as $folder) {
            $name = basename($folder);
            if (!in_array($name, $ignore)) {
                $projects[] = ['name' => $name, 'path' => $folder];
            }
        }
        echo json_encode($projects, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_SLASHES);
    ?>;
    
    const select = $('#project-select');
    const optimizeSelect = $('#optimize-db-select');
    select.empty();
    optimizeSelect.empty();
    select.append('<option value="">Select Project</option>');
    optimizeSelect.append('<option value="">Select Database</option>');
    
    folders.forEach(function(project) {
        select.append('<option value="' + project.path + '">' + project.name + '</option>');
    });
    
    // Load databases for optimize select
    loadDatabases();
    $('#database-select').change(function() {
        optimizeSelect.append('<option value="' + $(this).val() + '">' + $(this).val() + '</option>');
    });
}

function gitStatus() {
    const projectPath = $('#project-select').val();
    if (!projectPath) {
        alert('Please select a project');
        return;
    }
    $.post('quick_tools.php', {action: 'git_status', project_path: projectPath}, function(data) {
        if (data.success) {
            $('#tools-output').html('<div class="alert alert-info"><strong>Git Status:</strong><pre>' + data.status + '</pre><strong>Branch:</strong> ' + data.branch + '</div>');
        } else {
            alert('Error: ' + data.error);
        }
    });
}

function composerInstall() {
    const projectPath = $('#project-select').val();
    if (!projectPath) {
        alert('Please select a project');
        return;
    }
    if (!confirm('Run composer install? This may take a while.')) {
        return;
    }
    $.post('quick_tools.php', {action: 'composer_command', project_path: projectPath, command: 'install'}, function(data) {
        $('#tools-output').html('<div class="alert alert-info"><strong>Composer Output:</strong><pre>' + (data.output || '') + '</pre></div>');
    });
}

function npmInstall() {
    const projectPath = $('#project-select').val();
    if (!projectPath) {
        alert('Please select a project');
        return;
    }
    if (!confirm('Run npm install? This may take a while.')) {
        return;
    }
    $.post('quick_tools.php', {action: 'npm_command', project_path: projectPath, command: 'install'}, function(data) {
        $('#tools-output').html('<div class="alert alert-info"><strong>NPM Output:</strong><pre>' + (data.output || '') + '</pre></div>');
    });
}

function showPhpInfo() {
    $.get('quick_tools.php?action=php_info', function(data) {
        if (data.success) {
            const win = window.open('', 'phpinfo', 'width=800,height=600');
            win.document.write(data.phpinfo);
        }
    });
}

function viewTableStructure(database, table) {
    $.get('database_manager.php?action=get_table_structure&database=' + encodeURIComponent(database) + '&table=' + encodeURIComponent(table), function(data) {
        if (data.success) {
            let html = '<table class="table table-striped"><thead><tr><th>Column</th><th>Type</th><th>Nullable</th><th>Key</th><th>Default</th><th>Extra</th></tr></thead><tbody>';
            data.columns.forEach(function(col) {
                html += '<tr><td>' + col.COLUMN_NAME + '</td><td>' + col.DATA_TYPE + '</td><td>' + col.IS_NULLABLE + '</td><td>' + col.COLUMN_KEY + '</td><td>' + (col.COLUMN_DEFAULT || 'NULL') + '</td><td>' + col.EXTRA + '</td></tr>';
            });
            html += '</tbody></table>';
            $('#query-results').html(html);
        }
    });
}

// Self-Update Functions
function checkForUpdates() {
    $('#update-status').html('<div class="alert alert-info">Checking for updates...</div>');
    $.get('update_manager.php?action=check', function(data) {
        if (data.success) {
            if (data.update_available) {
                let statusHtml = '<div class="alert alert-success">' +
                    '<strong>Update Available!</strong><br>' +
                    'Current: ' + data.current_version;
                if (data.current_commit) {
                    statusHtml += ' (' + data.current_commit + ')';
                }
                statusHtml += '<br>Latest: ' + data.latest_version;
                if (data.latest_commit) {
                    statusHtml += ' (' + data.latest_commit + ')';
                }
                if (data.branch) {
                    statusHtml += '<br>Branch: ' + data.branch;
                }
                statusHtml += '<br><button class="btn btn-success btn-sm mt-2" onclick="installUpdate()">Pull & Install Update</button>' +
                    '</div>';
                $('#update-status').html(statusHtml);
            } else {
                let statusHtml = '<div class="alert alert-success">You are running the latest version (' + data.current_version + ')';
                if (data.current_commit) {
                    statusHtml += ' - Commit: ' + data.current_commit;
                }
                if (data.branch) {
                    statusHtml += '<br>Branch: ' + data.branch;
                }
                statusHtml += '</div>';
                $('#update-status').html(statusHtml);
            }
        } else {
            $('#update-status').html('<div class="alert alert-warning">Unable to check for updates: ' + (data.error || 'Unknown error') + '</div>');
        }
    }).fail(function() {
        $('#update-status').html('<div class="alert alert-danger">Failed to check for updates. Please try again later.</div>');
    });
}

function installUpdate() {
    if (!confirm('This will pull the latest changes from Git. Continue?')) {
        return;
    }

    $('#update-progress').show();
    $('#progress-bar').css('width', '0%').text('0%');
    $('#progress-text').text('Pulling latest changes from Git...');

    const csrfToken = <?php echo json_encode(SecurityHelper::getCSRFToken(), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
    
    $.post('update_manager.php?action=install', {
        csrf_token: csrfToken
    }, function(data) {
        if (data.success) {
            $('#progress-bar').css('width', '100%').text('100%');
            $('#progress-text').text('Update installed successfully!');
            $('#update-status').html(
                '<div class="alert alert-success">' +
                '<strong>Update Installed!</strong><br>' +
                'The update has been installed successfully via Git pull.' +
                (data.branch ? '<br>Branch: ' + data.branch : '') +
                '<br><button class="btn btn-primary btn-sm mt-2" onclick="location.reload()">Refresh Page</button>' +
                '</div>'
            );
        } else {
            $('#update-progress').hide();
            $('#update-status').html('<div class="alert alert-danger">Installation failed: ' + (data.error || 'Unknown error') + '</div>');
        }
    }).fail(function() {
        $('#update-progress').hide();
        $('#update-status').html('<div class="alert alert-danger">Installation failed. Please try again.</div>');
    });
}

// Initialize charts only when vitals tab is active
function initializeCharts() {
    // Wait for Chart.js to be available
    if (typeof Chart === 'undefined') {
        console.warn('Chart.js not loaded yet, retrying...');
        setTimeout(initializeCharts, 200);
        return;
    }
    
    // Check if vitals tab is visible
    const vitalsTab = document.getElementById('vitals');
    if (!vitalsTab || !vitalsTab.classList.contains('active')) {
        console.log('Vitals tab not active, skipping chart initialization');
        return; // Don't initialize if tab is not active
    }
    
    console.log('Initializing charts for vitals tab...');
    
    const uptimeChartEl = document.getElementById('uptimeChart');
    const memoryChartEl = document.getElementById('memoryUsageChart');
    const diskChartEl = document.getElementById('diskUsageChart');
    const phpMemoryChartEl = document.getElementById('phpMemoryChart');
    
    if (!uptimeChartEl || !memoryChartEl || !diskChartEl || !phpMemoryChartEl) {
        console.warn('Chart canvas elements not found, retrying...', {
            uptime: !!uptimeChartEl,
            memory: !!memoryChartEl,
            disk: !!diskChartEl,
            php: !!phpMemoryChartEl
        });
        setTimeout(initializeCharts, 300);
        return;
    }
    
    if (uptimeChartEl && typeof window.uptimeChart === 'undefined') {
        const ctxUptime = uptimeChartEl.getContext('2d');
        window.uptimeChart = new Chart(ctxUptime, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'Uptime',
                    data: [],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
    
    if (memoryChartEl && typeof window.memoryUsageChart === 'undefined') {
        const ctxMemory = memoryChartEl.getContext('2d');
        window.memoryUsageChart = new Chart(ctxMemory, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    label: 'Memory Usage (MB)',
                    data: [],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
    
    if (diskChartEl && typeof window.diskUsageChart === 'undefined') {
        const ctxDisk = diskChartEl.getContext('2d');
        window.diskUsageChart = new Chart(ctxDisk, {
            type: 'doughnut',
            data: {
                labels: [],
                datasets: [{
                    label: 'Disk Usage',
                    data: [],
                    backgroundColor: [
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }
    
    if (phpMemoryChartEl && typeof window.phpMemoryChart === 'undefined') {
        const ctxPhpMemory = phpMemoryChartEl.getContext('2d');
        window.phpMemoryChart = new Chart(ctxPhpMemory, {
            type: 'bar',
            data: {
                labels: ['Current', 'Peak'],
                datasets: [{
                    label: 'PHP Memory Usage (MB)',
                    data: [0, 0],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
}

    // Initialize charts if vitals tab is already active on page load
    $(document).ready(function() {
        if ($('.tab[data-tab="vitals"]').hasClass('active')) {
            setTimeout(initializeCharts, 500);
        }
    });
} // End initDashboard function
    
    // Start initialization
    initDashboard();
})(); // End IIFE
</script>

