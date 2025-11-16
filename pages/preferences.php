<?php
/**
 * Laragon Dashboard - Preferences Page
 * Version: 3.0.0
 * Description: Dashboard preferences and settings
 */

// Load configuration and helpers
if (file_exists(__DIR__ . '/../config.php')) {
    require_once __DIR__ . '/../config.php';
}

if (file_exists(__DIR__ . '/../includes/helpers.php')) {
    require_once __DIR__ . '/../includes/helpers.php';
}

// Load i18n helper
if (file_exists(__DIR__ . '/../includes/i18n.php')) {
    require_once __DIR__ . '/../includes/i18n.php';
}

// Load translations
$preferencesTranslations = [];
if (function_exists('load_translations')) {
    $preferencesTranslations = load_translations('preferences');
}

function t_preferences($key, $fallback = '') {
    global $preferencesTranslations;
    if (function_exists('t')) {
        $translated = t('preferences.' . $key);
        if ($translated !== 'preferences.' . $key) {
            return $translated;
        }
    }
    return $preferencesTranslations[$key] ?? ($fallback ?: $key);
}

// Get current preferences
$prefs = getDashboardPreferences();
$laragonRoot = defined('LARAGON_ROOT') ? LARAGON_ROOT : '';

include __DIR__ . '/../partials/layouts/layoutTop.php';
?>

<div class="dashboard-main-body">
    <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <strong><p class="fw-semibold mb-0"><?php echo t_preferences('preferences', 'Preferences'); ?></p></strong>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        <?php echo t_preferences('dashboard', 'Dashboard'); ?>
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium"><?php echo t_preferences('preferences', 'Preferences'); ?></li>
            </ul>
        </div>

        <div class="row g-3">
            <div class="col-lg-8">
                <div class="card shadow-none border radius-12">
                    <div class="card-body p-24">
                        <form id="preferences-form">
                            <div class="mb-24">
                                <strong><p class="fw-semibold mb-16"><?php echo t_preferences('laragon_settings', 'Laragon Settings'); ?></p></strong>
                                
                                <div class="row mb-16">
                                    <div class="col-12">
                                        <label class="form-label fw-medium mb-8"><?php echo t_preferences('laragon_root', 'Laragon Root Path'); ?></label>
                                        <input type="text" class="form-control" id="laragon-root" name="laragon_root" value="<?php echo htmlspecialchars($prefs['laragon_root'] ?? $laragonRoot); ?>" placeholder="C:\laragon">
                                        <small class="text-secondary-light text-sm mt-4 d-block"><?php echo t_preferences('laragon_root_desc', 'Override auto-detected Laragon installation path'); ?></small>
                                    </div>
                                </div>
                                
                                <div class="row mb-16">
                                    <div class="col-md-4">
                                        <label class="form-label fw-medium mb-8"><?php echo t_preferences('mysql_host', 'MySQL Host'); ?></label>
                                        <input type="text" class="form-control" id="mysql-host" name="mysql_host" value="<?php echo htmlspecialchars($prefs['mysql_host'] ?? 'localhost'); ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-medium mb-8"><?php echo t_preferences('mysql_user', 'MySQL User'); ?></label>
                                        <input type="text" class="form-control" id="mysql-user" name="mysql_user" value="<?php echo htmlspecialchars($prefs['mysql_user'] ?? 'root'); ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-medium mb-8"><?php echo t_preferences('mysql_password', 'MySQL Password'); ?></label>
                                        <input type="password" class="form-control" id="mysql-password" name="mysql_password" value="<?php echo htmlspecialchars($prefs['mysql_password'] ?? ''); ?>">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-24">
                                <strong><p class="fw-semibold mb-16"><?php echo t_preferences('display_settings', 'Display Settings'); ?></p></strong>
                                
                                <div class="row mb-16">
                                    <div class="col-md-6">
                                        <label class="form-label fw-medium mb-8"><?php echo t_preferences('time_format', 'Time Format'); ?></label>
                                        <select class="form-select" id="time-format" name="time_format">
                                            <option value="" <?php echo (empty($prefs['time_format'])) ? 'selected' : ''; ?>><?php echo t_preferences('auto_detect', 'Auto-detect'); ?></option>
                                            <option value="12" <?php echo (isset($prefs['time_format']) && $prefs['time_format'] === '12') ? 'selected' : ''; ?>>12-hour (AM/PM)</option>
                                            <option value="24" <?php echo (isset($prefs['time_format']) && $prefs['time_format'] === '24') ? 'selected' : ''; ?>>24-hour</option>
                                        </select>
                                        <small class="text-secondary-light text-sm mt-4 d-block"><?php echo t_preferences('time_format_desc', 'Choose how time is displayed in the navbar'); ?></small>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-medium mb-8"><?php echo t_preferences('date_format', 'Date Format'); ?></label>
                                        <select class="form-select" id="date-format" name="date_format">
                                            <option value="" <?php echo (empty($prefs['date_format'])) ? 'selected' : ''; ?>><?php echo t_preferences('auto_detect', 'Auto-detect'); ?></option>
                                            <option value="Y-m-d" <?php echo (isset($prefs['date_format']) && $prefs['date_format'] === 'Y-m-d') ? 'selected' : ''; ?>>YYYY-MM-DD (ISO)</option>
                                            <option value="m/d/Y" <?php echo (isset($prefs['date_format']) && $prefs['date_format'] === 'm/d/Y') ? 'selected' : ''; ?>>MM/DD/YYYY (US)</option>
                                            <option value="d/m/Y" <?php echo (isset($prefs['date_format']) && $prefs['date_format'] === 'd/m/Y') ? 'selected' : ''; ?>>DD/MM/YYYY (EU)</option>
                                            <option value="d M Y" <?php echo (isset($prefs['date_format']) && $prefs['date_format'] === 'd M Y') ? 'selected' : ''; ?>>DD Mon YYYY</option>
                                            <option value="M d, Y" <?php echo (isset($prefs['date_format']) && $prefs['date_format'] === 'M d, Y') ? 'selected' : ''; ?>>Mon DD, YYYY</option>
                                        </select>
                                        <small class="text-secondary-light text-sm mt-4 d-block"><?php echo t_preferences('date_format_desc', 'Choose how date is displayed in the navbar'); ?></small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-24">
                                <strong><p class="fw-semibold mb-16"><?php echo t_preferences('debug_settings', 'Debug Settings'); ?></p></strong>
                                
                                <div class="mb-16">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="debug_banner" id="debug-banner" value="1" <?php echo (isset($prefs['debug_banner']) && $prefs['debug_banner'] !== false) ? 'checked' : ''; ?>>
                                        <label class="form-check-label fw-medium" for="debug-banner">
                                            <?php echo t_preferences('show_debug_banner', 'Show Debug Banner'); ?>
                                        </label>
                                        <small class="text-secondary-light text-sm d-block mt-4">
                                            <?php echo t_preferences('debug_banner_desc', 'Display diagnostic information banner at the top of pages (useful for troubleshooting CSS loading and path issues)'); ?>
                                        </small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-24">
                                <strong><p class="fw-semibold mb-16"><?php echo t_preferences('update_settings', 'Update Settings'); ?></p></strong>
                                
                                <div class="mb-16">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="auto_update_check" id="auto-update-check" value="1" <?php echo (isset($prefs['auto_update_check']) && $prefs['auto_update_check'] !== false) ? 'checked' : ''; ?>>
                                        <label class="form-check-label fw-medium" for="auto-update-check">
                                            <?php echo t_preferences('auto_update_check', 'Automatically Check for Updates'); ?>
                                        </label>
                                        <small class="text-secondary-light text-sm mt-4 d-block"><?php echo t_preferences('auto_update_check_desc', 'Check for updates when the dashboard loads'); ?></small>
                                    </div>
                                </div>
                                
                                <div class="mb-16">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="auto_update_install" id="auto-update-install" value="1" <?php echo (isset($prefs['auto_update_install']) && $prefs['auto_update_install'] == true) ? 'checked' : ''; ?>>
                                        <label class="form-check-label fw-medium" for="auto-update-install">
                                            <?php echo t_preferences('auto_update_install', 'Auto-Install Updates (with confirmation)'); ?>
                                        </label>
                                        <small class="text-secondary-light text-sm mt-4 d-block"><?php echo t_preferences('auto_update_install_desc', 'Automatically download and install updates after user confirmation'); ?></small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center justify-content-end gap-2">
                                <button type="button" class="btn btn-secondary" onclick="resetPreferences()"><?php echo t_preferences('reset', 'Reset'); ?></button>
                                <button type="submit" class="btn btn-primary-600">
                                    <iconify-icon icon="solar:diskette-bold" class="icon"></iconify-icon>
                                    <?php echo t_preferences('save', 'Save'); ?>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card shadow-none border radius-12">
                    <div class="card-body p-24">
                        <strong><p class="fw-semibold mb-16"><?php echo t_preferences('info', 'Information'); ?></p></strong>
                        <p class="text-secondary-light text-sm mb-16"><?php echo t_preferences('preferences_desc', 'Dashboard preferences override auto-detected values. These settings are stored locally and only affect the dashboard interface.'); ?></p>
                        <div class="d-flex align-items-center gap-2 mb-8">
                            <iconify-icon icon="solar:info-circle-bold" class="text-info-600"></iconify-icon>
                            <span class="text-secondary-light text-sm"><?php echo t_preferences('detected_path', 'Detected Path'); ?>: <code><?php echo htmlspecialchars($laragonRoot); ?></code></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Store script variables for later inclusion
$GLOBALS['preferencesScript'] = true;
?>

<?php include __DIR__ . '/../partials/layouts/layoutBottom.php'; ?>

