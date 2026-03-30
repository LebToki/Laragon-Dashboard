<?php
namespace LaragonDashboard\Core;

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../includes/Core/System.php';

class SystemTest extends TestCase {

    protected function setUp(): void {
        parent::setUp();
    }

    protected function tearDown(): void {
        parent::tearDown();
    }

    public function testGetLaragonRootFromEnv() {
        putenv('LARAGON_ROOT=/custom/laragon');
        $root = System::getLaragonRoot();
        $this->assertEquals('/custom/laragon', $root);
        putenv('LARAGON_ROOT='); // reset
    }

    public function testGetSendmailDir() {
        putenv('LARAGON_ROOT=' . sys_get_temp_dir());
        $dir = System::getSendmailDir();
        $this->assertStringContainsString('bin/sendmail/output/', $dir);
        $this->assertTrue(is_dir($dir));
        putenv('LARAGON_ROOT='); // reset
    }
}
