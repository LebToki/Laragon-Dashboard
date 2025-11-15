<footer class="d-footer">
    <div class="row align-items-center justify-content-between">
        <div class="col-auto">
            <p class="mb-0">© <?php echo date('Y'); ?> Laragon Dashboard by Tarek Tarabichi All Rights Reserved.</p>
        </div>
        <div class="col-auto">
            <p class="mb-0">Made with ❤️ by <a href="https://2tinteractive.com" target="_blank" class="text-primary-600 hover-text-primary">2TInteractive</a></p>
        </div>
    </div>
</footer>

<script>
// Monochrome Mode Toggle (loaded in footer.php)
(function() {
    'use strict';
    
    // Wait for DOM to be ready
    function initMonochromeToggle() {
        const monochromeBtn = document.querySelector('[data-theme-toggle="monochrome"]');
        const isMonochrome = localStorage.getItem('monochromeMode') === 'true';
        
        // Apply monochrome mode on page load if it was active
        if (isMonochrome) {
            document.body.classList.add('monochrome-mode');
        }
        
        // Add click handler for monochrome button
        if (monochromeBtn) {
            monochromeBtn.addEventListener('click', function(e) {
                e.preventDefault();
                
                const isCurrentlyMonochrome = document.body.classList.contains('monochrome-mode');
                
                if (isCurrentlyMonochrome) {
                    // Turn off monochrome
                    document.body.classList.remove('monochrome-mode');
                    localStorage.setItem('monochromeMode', 'false');
                    // Update theme to current light/dark (not monochrome)
                    const lightDarkTheme = localStorage.getItem('lightDarkTheme') || localStorage.getItem('theme') || 'light';
                    if (lightDarkTheme !== 'monochrome') {
                        localStorage.setItem('theme', lightDarkTheme);
                    }
                } else {
                    // Turn on monochrome
                    document.body.classList.add('monochrome-mode');
                    localStorage.setItem('monochromeMode', 'true');
                    // Store current theme before switching to monochrome
                    const currentTheme = localStorage.getItem('theme') || 'light';
                    if (currentTheme !== 'monochrome') {
                        localStorage.setItem('lightDarkTheme', currentTheme);
                    }
                    localStorage.setItem('theme', 'monochrome');
                }
                
                // Update button state
                updateMonochromeButton();
                
                // Trigger a custom event so scripts.php can update other button states
                window.dispatchEvent(new CustomEvent('monochromeModeChanged', {
                    detail: { isMonochrome: !isCurrentlyMonochrome }
                }));
            });
        }
    }
    
    // Update monochrome button visual state
    function updateMonochromeButton() {
        const monochromeBtn = document.querySelector('[data-theme-toggle="monochrome"]');
        const isMonochrome = document.body.classList.contains('monochrome-mode');
        
        if (monochromeBtn) {
            if (isMonochrome) {
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
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            initMonochromeToggle();
            updateMonochromeButton();
        });
    } else {
        initMonochromeToggle();
        updateMonochromeButton();
    }
})();
</script>