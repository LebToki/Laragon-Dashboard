<?php 
// Use absolute path to ensure it works regardless of where it's included from
$footerPath = defined('PARTIALS_ROOT') ? PARTIALS_ROOT . '/footer.php' : __DIR__ . '/../footer.php';
include $footerPath;
?>
</main>

<?php 
// Use absolute path to ensure it works regardless of where it's included from
$aiWidgetPath = defined('PARTIALS_ROOT') ? PARTIALS_ROOT . '/ai_agent_widget.php' : __DIR__ . '/../ai_agent_widget.php';
include $aiWidgetPath;

$scriptsPath = defined('PARTIALS_ROOT') ? PARTIALS_ROOT . '/scripts.php' : __DIR__ . '/../scripts.php';
include $scriptsPath;
?>
</body>

</html>