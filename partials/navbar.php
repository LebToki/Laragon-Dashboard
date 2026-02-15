<?php
/**
 * Navbar Component
 * Includes: Search, Theme Switcher, Language Selector, Notifications, User Profile
 */

// Load language configuration
$langConfig = [];
$langConfigFile = __DIR__ . '/../i18n/languages.php';
if (file_exists($langConfigFile)) {
    $langConfig = require $langConfigFile;
}

// Get current language
$currentLang = strtolower($_GET['lang'] ?? $_COOKIE['lang'] ?? 'en');
$currentLangData = $langConfig[$currentLang] ?? $langConfig['en'] ?? ['flag' => 'US', 'name' => 'English'];

// Set up asset paths - use root assets directory
$assetsImageUrl = defined('ASSETS_URL') ? ASSETS_URL . '/images' : 'assets/images';

// Load projects for search
$allProjects = [];
if (function_exists('getAllProjects')) {
    $allProjects = getAllProjects();
}

// Convert projects to JSON for JavaScript (make available globally for scripts.php)
$GLOBALS['projectsJson'] = json_encode($allProjects);
$GLOBALS['navbarAssetsImageUrl'] = $assetsImageUrl;
?>
<div class="navbar-header">
    <div class="row align-items-center justify-content-between">
        <div class="col-auto">
            <div class="d-flex flex-wrap align-items-center gap-4">
                <button type="button" class="sidebar-toggle">
                    <iconify-icon icon="heroicons:bars-3-solid" class="icon text-2xl non-active"></iconify-icon>
                    <iconify-icon icon="iconoir:arrow-right" class="icon text-2xl active"></iconify-icon>
                </button>
                <button type="button" class="sidebar-mobile-toggle">
                    <iconify-icon icon="heroicons:bars-3-solid" class="icon"></iconify-icon>
                </button>
                <!-- Search Dropdown -->
                <div class="dropdown">
                    <form class="navbar-search" id="project-search-form">
                        <input type="text" name="search" id="project-search-input" placeholder="Search projects..." autocomplete="off">
                        <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
                    </form>
                    <div class="dropdown-menu dropdown-menu-lg p-0" id="project-search-results" style="display: none; min-width: 400px; max-width: 500px;">
                        <div class="py-12 px-16 radius-8 bg-primary-50 mb-16 d-flex align-items-center justify-content-between gap-2">
                            <div>
                                <p class="text-lg text-primary-light fw-semibold mb-0">Projects</p>
                            </div>
                            <span class="text-primary-600 fw-semibold text-lg" id="project-count">0</span>
                        </div>
                        <div class="max-h-400-px overflow-y-auto scroll-sm pe-4" id="project-list">
                            <div class="px-24 py-12 text-center">
                                <p class="text-secondary-light mb-0">Start typing to search projects...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-auto d-none d-md-flex">
            <div class="d-flex flex-wrap align-items-center gap-3">
                <!-- Time-based Greeting and Clock -->
                <div class="d-flex align-items-center gap-2 px-12 py-6 bg-neutral-100 rounded-8">
                    <iconify-icon icon="solar:clock-circle-bold" class="text-primary-600 text-lg" id="greeting-icon"></iconify-icon>
                    <div>
                        <div class="fw-semibold text-xs text-secondary-light mb-1" id="time-greeting">Good Evening</div>
                        <div class="fw-medium text-xxs text-secondary-light" id="local-time-display">
                            <span id="local-date"></span> <span id="local-time"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-auto">
            <div class="d-flex flex-wrap align-items-center gap-3">
                <!-- Theme Switcher: Light/Dark Toggle -->
                <button type="button" data-theme-toggle="light-dark" class="w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center" title="Toggle Light/Dark Theme">
                    <iconify-icon icon="solar:sun-bold" class="icon text-lg theme-icon-light" style="display: none;"></iconify-icon>
                    <iconify-icon icon="solar:moon-bold" class="icon text-lg theme-icon-dark"></iconify-icon>
                </button>
                
                <!-- Theme Switcher: Monochrome -->
                <button type="button" data-theme-toggle="monochrome" class="w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center" title="Toggle Monochrome Mode">
                    <iconify-icon icon="tabler:palette" class="text-primary-light text-xl"></iconify-icon>
                </button>
                
                <!-- Language Selector -->
                <div class="dropdown d-none d-sm-inline-block">
                    <button class="has-indicator w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center" type="button" data-bs-toggle="dropdown" title="Select Language">
                        <img 
                            src="<?php echo $assetsImageUrl; ?>/flags/<?php echo $currentLangData['flag']; ?>.png" 
                            alt="<?php echo htmlspecialchars($currentLangData['name']); ?>" 
                            class="w-24 h-24 object-fit-cover rounded-circle"
                            onerror="this.src='<?php echo $assetsImageUrl; ?>/flags/US.png'"
                        >
                    </button>
                    <div class="dropdown-menu to-top dropdown-menu-sm">
                        <div class="py-12 px-16 radius-8 bg-primary-50 mb-16 d-flex align-items-center justify-content-between gap-2">
                            <div>
                                <p class="text-lg text-primary-light fw-semibold mb-0">Choose Your Language</p>
                            </div>
                        </div>
                        <div class="max-h-400-px overflow-y-auto scroll-sm pe-8">
                            <?php foreach ($langConfig as $langCode => $langData): 
                                $isActive = $currentLang === $langCode;
                                $flagPath = $assetsImageUrl . '/flags/' . $langData['flag'] . '.png';
                            ?>
                            <a href="?lang=<?php echo $langCode; ?>" class="form-check style-check d-flex align-items-center justify-content-between mb-16 text-decoration-none <?php echo $isActive ? 'bg-primary-50' : ''; ?>">
                                <label class="form-check-label line-height-1 fw-medium text-secondary-light w-100 mb-0" for="lang-<?php echo $langCode; ?>">
                                    <span class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3">
                                        <img 
                                            src="<?php echo $flagPath; ?>" 
                                            alt="<?php echo htmlspecialchars($langData['name']); ?>" 
                                            class="w-36-px h-36-px bg-success-subtle text-success-main rounded-circle flex-shrink-0"
                                            onerror="this.src='<?php echo $assetsImageUrl; ?>/flags/US.png'"
                                        >
                                        <span class="text-md fw-semibold mb-0"><?php echo htmlspecialchars($langData['native']); ?></span>
                                    </span>
                                </label>
                                <?php if ($isActive): ?>
                                <iconify-icon icon="solar:check-circle-bold" class="text-success-main text-xl"></iconify-icon>
                                <?php endif; ?>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div><!-- Language dropdown end -->

                <!-- Notifications Dropdown -->
                <div class="dropdown">
                    <button class="has-indicator w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center" type="button" data-bs-toggle="dropdown" id="notifications-btn" aria-label="Notifications" title="View Notifications">
                        <iconify-icon icon="iconoir:bell" class="text-primary-light text-xl"></iconify-icon>
                        <span class="indicator bg-danger-main" id="update-indicator" style="display: none;"></span>
                    </button>
                    <div class="dropdown-menu to-top dropdown-menu-lg p-0" aria-labelledby="notifications-btn">
                        <div class="m-16 py-12 px-16 radius-8 bg-primary-50 mb-16 d-flex align-items-center justify-content-between gap-2">
                            <div>
                                <p class="text-lg text-primary-light fw-semibold mb-0">Notifications</p>
                            </div>
                            <span class="text-primary-600 fw-semibold text-lg w-40-px h-40-px rounded-circle bg-base d-flex justify-content-center align-items-center" id="notification-count">0</span>
                        </div>
                        <div class="max-h-400-px overflow-y-auto scroll-sm pe-4" id="notifications-list">
                            <div class="px-24 py-12 text-center">
                                <p class="text-secondary-light mb-0">No new notifications</p>
                            </div>
                        </div>
                        <div class="text-center py-12 px-16">
                            <a href="javascript:void(0)" class="text-primary-600 fw-semibold text-md">See All Notifications</a>
                        </div>
                    </div>
                </div><!-- Notifications dropdown end -->

                <!-- User Profile Dropdown -->
                <div class="dropdown">
                    <button class="d-flex justify-content-center align-items-center rounded-circle" type="button" data-bs-toggle="dropdown">
                        <img 
                            src="<?php echo $assetsImageUrl; ?>/logo-icon.png" 
                            alt="User" 
                            class="w-40-px h-40-px object-fit-cover rounded-circle"
                            onerror="this.src='<?php echo $assetsImageUrl; ?>/user.png'"
                        >
                    </button>
                    <div class="dropdown-menu to-top dropdown-menu-sm">
                        <div class="py-12 px-16 radius-8 bg-primary-50 mb-16 d-flex align-items-center justify-content-between gap-2">
                            <div>
                                <p class="text-lg text-primary-light fw-semibold mb-2">Laragon Dashboard</p>
                                <span class="text-secondary-light fw-medium text-sm">System User</span>
                            </div>
                            <button type="button" class="hover-text-danger">
                                <iconify-icon icon="radix-icons:cross-1" class="icon text-xl"></iconify-icon>
                            </button>
                        </div>
                        <ul class="to-top-list">
                            <li>
                                <a class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-primary d-flex align-items-center gap-3" href="javascript:void(0)">
                                    <iconify-icon icon="solar:user-linear" class="icon text-xl"></iconify-icon> My Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-primary d-flex align-items-center gap-3" href="javascript:void(0)">
                                    <iconify-icon icon="icon-park-outline:setting-two" class="icon text-xl"></iconify-icon> Settings
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-danger d-flex align-items-center gap-3" href="javascript:void(0)">
                                    <iconify-icon icon="lucide:power" class="icon text-xl"></iconify-icon> Log Out
                                </a>
                            </li>
                        </ul>
                    </div>
                </div><!-- Profile dropdown end -->
            </div>
        </div>
    </div>
</div>
