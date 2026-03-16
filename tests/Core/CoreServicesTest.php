<?php
namespace LaragonDashboard\Core;

use PHPUnit\Framework\TestCase;

class CoreServicesTest extends TestCase
{
    protected function setUp(): void
    {
        $GLOBALS['useMockShellExec'] = true;
        $GLOBALS['mockShellExecOutput'] = '';
        $GLOBALS['mockShellExecCommand'] = '';
        $GLOBALS['mockShellExecCallback'] = null;
    }

    protected function tearDown(): void
    {
        $GLOBALS['useMockShellExec'] = false;
        $GLOBALS['mockShellExecOutput'] = '';
        $GLOBALS['mockShellExecCommand'] = '';
        $GLOBALS['mockShellExecCallback'] = null;
    }

    public function testStopServiceSuccessfully()
    {
        $GLOBALS['mockShellExecOutput'] = "The Apache2.4 service was stopped successfully.";
        $this->assertTrue(Services::stop('Apache'));
    }

    public function testStopServiceAlreadyStopped()
    {
        $GLOBALS['mockShellExecOutput'] = "The service is already stopped.";
        $this->assertTrue(Services::stop('MySQL'));
    }

    public function testStopServiceFails()
    {
        $GLOBALS['mockShellExecOutput'] = "System error 5 has occurred.\nAccess is denied.";
        $this->assertFalse(Services::stop('Nginx'));
    }
}
