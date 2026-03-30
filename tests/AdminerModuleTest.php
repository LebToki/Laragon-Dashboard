<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../includes/AdminerModule.php';

class AdminerModuleTest extends TestCase
{
    private $tempDir;

    protected function setUp(): void
    {
        // Create a temporary directory to act as the base path
        $this->tempDir = sys_get_temp_dir() . '/adminer_test_' . uniqid();
        mkdir($this->tempDir, 0777, true);
    }

    protected function tearDown(): void
    {
        // Clean up the temporary directory
        if (is_dir($this->tempDir)) {
            $this->removeDirectory($this->tempDir);
        }
    }

    private function removeDirectory($dir)
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (is_dir($dir . DIRECTORY_SEPARATOR . $object) && !is_link($dir . "/" . $object)) {
                        $this->removeDirectory($dir . DIRECTORY_SEPARATOR . $object);
                    } else {
                        unlink($dir . DIRECTORY_SEPARATOR . $object);
                    }
                }
            }
            rmdir($dir);
        }
    }

    public function testIsInstalledReturnsTrueWhenAdminerExists()
    {
        // Setup config with temporary directory
        $config = [
            'base_path' => $this->tempDir,
            'adminer_file' => 'adminer.php'
        ];

        $adminer = new AdminerModule($config);

        // Ensure dummy adminer file exists
        $adminerPath = $adminer->getAdminerPath();
        file_put_contents($adminerPath, 'dummy content');

        // Test that isInstalled returns true
        $this->assertTrue($adminer->isInstalled(), "isInstalled() should return true when adminer file exists");
    }

    public function testIsInstalledReturnsFalseWhenAdminerDoesNotExist()
    {
        // Setup config with temporary directory
        $config = [
            'base_path' => $this->tempDir,
            'adminer_file' => 'adminer.php'
        ];

        $adminer = new AdminerModule($config);

        // Ensure dummy adminer file does NOT exist
        $adminerPath = $adminer->getAdminerPath();
        if (file_exists($adminerPath)) {
            unlink($adminerPath);
        }

        // Test that isInstalled returns false
        $this->assertFalse($adminer->isInstalled(), "isInstalled() should return false when adminer file does not exist");
    }
}
