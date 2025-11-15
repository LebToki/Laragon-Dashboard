<?php
/**
 * Laragon Dashboard Layout Bottom
 * Version: 3.0.0
 * Includes: Footer, Scripts
 */

// Ensure config is loaded
if (!defined('APP_ROOT')) {
    require_once dirname(__DIR__) . '/config.php';
}
?>
    </main>

    <?php include PARTIALS_ROOT . '/footer.php'; ?>
    
    <!-- Template JavaScript Files -->
    <script src="<?php echo TEMPLATE_URL; ?>/assets/js/lib/jquery-3.7.1.min.js"></script>
    <script src="<?php echo TEMPLATE_URL; ?>/assets/js/lib/bootstrap.bundle.min.js"></script>
    <script src="<?php echo TEMPLATE_URL; ?>/assets/js/lib/apexcharts.min.js"></script>
    <script src="<?php echo TEMPLATE_URL; ?>/assets/js/lib/dataTables.min.js"></script>
    <script src="<?php echo TEMPLATE_URL; ?>/assets/js/lib/iconify-icon.min.js"></script>
    <script src="<?php echo TEMPLATE_URL; ?>/assets/js/lib/jquery-ui.min.js"></script>
    <script src="<?php echo TEMPLATE_URL; ?>/assets/js/lib/jquery-jvectormap-2.0.5.min.js"></script>
    <script src="<?php echo TEMPLATE_URL; ?>/assets/js/lib/jquery-jvectormap-world-mill-en.js"></script>
    <script src="<?php echo TEMPLATE_URL; ?>/assets/js/lib/magnifc-popup.min.js"></script>
    <script src="<?php echo TEMPLATE_URL; ?>/assets/js/lib/slick.min.js"></script>
    <script src="<?php echo TEMPLATE_URL; ?>/assets/js/lib/prism.js"></script>
    <script src="<?php echo TEMPLATE_URL; ?>/assets/js/lib/file-upload.js"></script>
    <script src="<?php echo TEMPLATE_URL; ?>/assets/js/app.js"></script>
    
    <!-- Laragon Dashboard Custom Scripts -->
    <?php if (isset($script) && !empty($script)): ?>
        <?php echo $script; ?>
    <?php endif; ?>
</body>
</html>

