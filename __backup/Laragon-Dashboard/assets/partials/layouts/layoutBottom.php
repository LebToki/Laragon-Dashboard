<?php include PARTIALS_ROOT . '/footer.php' ?>
</main>

<!-- Load JavaScript libraries before custom scripts -->
<?php
// Web-relative paths (from /Laragon-Dashboard/ base)
$templateAssets = 'template/assets';
$dashboardAssets = 'assets';
?>
<!-- jQuery from Template -->
<script src="<?php echo $templateAssets; ?>/js/lib/jquery-3.7.1.min.js"></script>
<!-- Bootstrap JS from Template -->
<script src="<?php echo $templateAssets; ?>/js/lib/bootstrap.bundle.min.js"></script>
<!-- Chart.js (keep local for now, template uses ApexCharts) -->
<script src="<?php echo $dashboardAssets; ?>/libs/chartjs/chart.umd.min.js?v=<?php echo defined('APP_VERSION') ? APP_VERSION : '2.6.1'; ?>"></script>
<!-- Iconify from Template -->
<script src="<?php echo $templateAssets; ?>/js/lib/iconify-icon.min.js"></script>

<?php include PARTIALS_ROOT . '/scripts.php' ?>
</body>

</html>

