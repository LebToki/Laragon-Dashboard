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
                <form class="navbar-search">
                    <input type="text" name="search" placeholder="Search">
                    <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
                </form>
            </div>
        </div>
        <div class="col-auto">
            <div class="d-flex flex-wrap align-items-center gap-3">
                <button type="button" data-theme-toggle class="w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center"></button>
                <div class="dropdown d-none d-sm-inline-block">
                    <?php
                    $templateImageUrl = defined('TEMPLATE_URL') ? TEMPLATE_URL . '/assets/images' : 'template/assets/images';
                    $langConfig = getLanguageConfig();
                    $currentLangData = $langConfig[$lang] ?? $langConfig['en'] ?? ['flag' => 'US'];
                    $flagCode = $currentLangData['flag'] ?? 'US';
                    ?>
                    <button class="has-indicator w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center" type="button" data-bs-toggle="dropdown">
                        <img
                            src="<?php echo "{$templateImageUrl}/flags/{$flagCode}.png"; ?>"
                            alt="Language"
                            class="w-24 h-24 object-fit-cover rounded-circle"
                            onerror="this.src='<?php echo "{$templateImageUrl}/flags/US.png"; ?>'"
                        >
                    </button>
                    <div class="dropdown-menu to-top dropdown-menu-sm">
                        <div class="py-12 px-16 radius-8 bg-primary-50 mb-16 d-flex align-items-center justify-content-between gap-2">
                            <div>
                                <h6 class="text-lg text-primary-light fw-semibold mb-0">Choose Your Language</h6>
                            </div>
                        </div>
                        <div class="max-h-400-px overflow-y-auto scroll-sm pe-8">
                            <?php
                            if (!empty($langConfig)) {
                                foreach ($langConfig as $langCode => $langData) {
                                    $flagCode = $langData['flag'] ?? 'US';
                                    $flagSrc = "{$templateImageUrl}/flags/{$flagCode}.png";
                                    $langName = $langData['native'] ?? $langData['name'] ?? $langCode;
                                    $isChecked = $lang === $langCode ? 'checked' : '';
                                    echo '<div class="form-check style-check d-flex align-items-center justify-content-between mb-16">';
                                    echo '<label class="form-check-label line-height-1 fw-medium text-secondary-light" for="lang-' . $langCode . '">';
                                    echo '<a href="?lang=' . $langCode . '" class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3">';
                                    echo '<img src="' . $flagSrc . '" alt="' . $langName . '" class="w-36-px h-36-px bg-success-subtle text-success-main rounded-circle flex-shrink-0" onerror="this.src=\'' . $templateImageUrl . '/flags/US.png\'">';
                                    echo '<span class="text-md fw-semibold mb-0">' . htmlspecialchars($langName) . '</span>';
                                    echo '</a>';
                                    echo '</label>';
                                    echo '<input class="form-check-input" type="radio" name="language" id="lang-' . $langCode . '" ' . $isChecked . '>';
                                    echo '</div>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

