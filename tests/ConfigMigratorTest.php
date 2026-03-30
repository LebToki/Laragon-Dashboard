<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../includes/ConfigMigrator.php';

class ConfigMigratorTest extends TestCase {
    private $migrator;
    private $backupDir;
    private $newVersionDir;

    protected function setUp(): void {
        $this->migrator = new ConfigMigrator();

        // Setup temporary directories for testing
        $this->backupDir = sys_get_temp_dir() . '/laragon_dashboard_backup_' . uniqid();
        $this->newVersionDir = sys_get_temp_dir() . '/laragon_dashboard_new_' . uniqid();

        mkdir($this->backupDir);
        mkdir($this->newVersionDir);
    }

    public function testMigrateConfigurationSuccess(): void {
        // Create manifest
        file_put_contents($this->backupDir . '/manifest.json', json_encode(['version' => '3.0.0']));

        // Setup backup config.php.backup
        $oldConfigContent = <<<EOF
<?php
define('APP_VERSION', '3.0.0');
define('MY_CUSTOM_SETTING', 'Custom Value');
define('CUSTOM_BOOLEAN', true);
define('CUSTOM_NUMBER', 42);
?>
EOF;
        file_put_contents($this->backupDir . '/config.php.backup', $oldConfigContent);

        // Setup new version config.php
        $newConfigContent = <<<EOF
<?php
define('APP_VERSION', '4.0.0');
// Auto-generated section
// User customizations
// DO NOT MODIFY ABOVE THIS LINE - Auto-generated
?>
EOF;
        file_put_contents($this->newVersionDir . '/config.php', $newConfigContent);

        // Setup backup preferences.json.backup
        file_put_contents($this->backupDir . '/preferences.json.backup', json_encode(['theme' => 'dark', 'show_hidden' => true]));

        // Setup new version preferences.json
        mkdir($this->newVersionDir . '/data');
        file_put_contents($this->newVersionDir . '/data/preferences.json', json_encode(['theme' => 'light', 'new_feature' => 'enabled']));

        // Setup backup license.json.backup
        file_put_contents($this->backupDir . '/license.json.backup', json_encode(['key' => '12345-ABCDE']));

        // Run migration
        $result = $this->migrator->migrateConfiguration($this->backupDir, $this->newVersionDir);

        $this->assertTrue($result);

        // Verify config.php migration
        $migratedConfig = file_get_contents($this->newVersionDir . '/config.php');
        $this->assertStringContainsString("define('MY_CUSTOM_SETTING', 'Custom Value');", $migratedConfig);
        $this->assertStringContainsString("define('CUSTOM_BOOLEAN', true);", $migratedConfig);
        $this->assertStringContainsString("define('CUSTOM_NUMBER', 42);", $migratedConfig);
        $this->assertStringNotContainsString("define('APP_VERSION', '3.0.0');", $migratedConfig); // Auto-generated ignored

        // Verify preferences.json migration
        $migratedPrefs = json_decode(file_get_contents($this->newVersionDir . '/data/preferences.json'), true);
        $this->assertEquals('dark', $migratedPrefs['theme']); // Old pref preserved
        $this->assertEquals(true, $migratedPrefs['show_hidden']); // Old pref preserved
        $this->assertEquals('enabled', $migratedPrefs['new_feature']); // New default preserved

        // Verify license.json migration
        $migratedLicense = json_decode(file_get_contents($this->newVersionDir . '/data/license.json'), true);
        $this->assertEquals('12345-ABCDE', $migratedLicense['key']);
    }

    public function testMigrateConfigurationMissingManifest(): void {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Backup manifest not found');

        $this->migrator->migrateConfiguration($this->backupDir, $this->newVersionDir);
    }

    protected function tearDown(): void {
        // Clean up temporary directories
        $this->deleteDirectory($this->backupDir);
        $this->deleteDirectory($this->newVersionDir);
    }

    private function deleteDirectory($dir) {
        if (!file_exists($dir)) {
            return true;
        }

        if (!is_dir($dir)) {
            return unlink($dir);
        }

        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }

            if (!$this->deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }

        }

        return rmdir($dir);
    }
}
