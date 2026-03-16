<?php
namespace LaragonDashboard\Core;

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../includes/Core/System.php';

// Mock disk_total_space for our tests in the LaragonDashboard\Core namespace
function disk_total_space($path) {
    if (isset($GLOBALS['mock_disk_total_space'])) {
        return $GLOBALS['mock_disk_total_space']($path);
    }
    return \disk_total_space($path);
}

// Mock disk_free_space for our tests in the LaragonDashboard\Core namespace
function disk_free_space($path) {
    if (isset($GLOBALS['mock_disk_free_space'])) {
        return $GLOBALS['mock_disk_free_space']($path);
    }
    return \disk_free_space($path);
}

class SystemTest extends TestCase {

    protected function tearDown(): void {
        unset($GLOBALS['mock_disk_total_space']);
        unset($GLOBALS['mock_disk_free_space']);
        parent::tearDown();
    }

    public function testGetDiskInfoNormal() {
        $GLOBALS['mock_disk_total_space'] = function($path) {
            return 100000;
        };
        $GLOBALS['mock_disk_free_space'] = function($path) {
            return 25000;
        };

        $info = System::getDiskInfo('/mock/path');

        $this->assertEquals(100000, $info['total']);
        $this->assertEquals(25000, $info['free']);
        $this->assertEquals(75000, $info['used']);
        $this->assertEquals(75.0, $info['percent']);

        $this->assertEquals(System::formatBytes(100000), $info['formatted_total']);
        $this->assertEquals(System::formatBytes(25000), $info['formatted_free']);
        $this->assertEquals(System::formatBytes(75000), $info['formatted_used']);
    }

    public function testGetDiskInfoZeroTotal() {
        $GLOBALS['mock_disk_total_space'] = function($path) {
            return 0;
        };
        $GLOBALS['mock_disk_free_space'] = function($path) {
            return 0;
        };

        $info = System::getDiskInfo('/mock/path');

        $this->assertEquals(0, $info['total']);
        $this->assertEquals(0, $info['free']);
        $this->assertEquals(0, $info['used']);
        $this->assertEquals(0.0, $info['percent']);
    }

    public function testGetDiskInfoFullDisk() {
        $GLOBALS['mock_disk_total_space'] = function($path) {
            return 100000;
        };
        $GLOBALS['mock_disk_free_space'] = function($path) {
            return 0;
        };

        $info = System::getDiskInfo('/mock/path');

        $this->assertEquals(100000, $info['total']);
        $this->assertEquals(0, $info['free']);
        $this->assertEquals(100000, $info['used']);
        $this->assertEquals(100.0, $info['percent']);
    }
}
