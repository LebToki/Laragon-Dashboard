<?php
namespace LaragonDashboard\Core;

require_once __DIR__ . '/../includes/autoload.php';

// Mock shell_exec globally for LaragonDashboard\Core namespace
function shell_exec($command) {
    if (!empty($GLOBALS['useMockShellExec'])) {
        $GLOBALS['mockShellExecCommand'] = $command;
        if (is_callable($GLOBALS['mockShellExecCallback'])) {
            return call_user_func($GLOBALS['mockShellExecCallback'], $command);
        }
        return $GLOBALS['mockShellExecOutput'];
    }
    return \shell_exec($command);
}

use PHPUnit\Framework\TestCase;

class ServicesTest extends TestCase
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

    public function testGetRealName()
    {
        $this->assertEquals('Apache2.4', Services::getRealName('Apache'));
        $this->assertEquals('MySQL', Services::getRealName('MySQL'));
        $this->assertEquals('UnknownService', Services::getRealName('UnknownService'));
    }

    public function testIsRunningWhenServiceIsRunning()
    {
        $GLOBALS['mockShellExecOutput'] = "SERVICE_NAME: Apache2.4\n        TYPE               : 10  WIN32_OWN_PROCESS\n        STATE              : 4  RUNNING\n                                (STOPPABLE, NOT_PAUSABLE, IGNORES_SHUTDOWN)\n        WIN32_EXIT_CODE    : 0  (0x0)\n        SERVICE_EXIT_CODE  : 0  (0x0)\n        CHECKPOINT         : 0x0\n        WAIT_HINT          : 0x0\n";
        $this->assertTrue(Services::isRunning('Apache'));
        $this->assertEquals('sc query "Apache2.4" 2>&1', $GLOBALS['mockShellExecCommand']);
    }

    public function testIsRunningWhenServiceIsStopped()
    {
        $GLOBALS['mockShellExecOutput'] = "SERVICE_NAME: Apache2.4\n        TYPE               : 10  WIN32_OWN_PROCESS\n        STATE              : 1  STOPPED\n                                (NOT_STOPPABLE, NOT_PAUSABLE, IGNORES_SHUTDOWN)\n        WIN32_EXIT_CODE    : 0  (0x0)\n        SERVICE_EXIT_CODE  : 0  (0x0)\n        CHECKPOINT         : 0x0\n        WAIT_HINT          : 0x0\n";
        $this->assertFalse(Services::isRunning('Apache'));
    }

    public function testStartServiceSuccessfully()
    {
        $GLOBALS['mockShellExecOutput'] = "The Apache2.4 service was started successfully.\n";
        $this->assertTrue(Services::start('Apache'));
        $this->assertEquals('net start "Apache2.4" 2>&1', $GLOBALS['mockShellExecCommand']);
    }

    public function testStartServiceAlreadyRunning()
    {
        $GLOBALS['mockShellExecOutput'] = "The requested service has already been started.\nMore help is available by typing NET HELPMSG 2182.\n";
        $this->assertFalse(Services::start('Apache'));
    }

    public function testStartServiceFails()
    {
        $GLOBALS['mockShellExecOutput'] = "System error 5 has occurred.\nAccess is denied.\n";
        $this->assertFalse(Services::start('Apache'));
    }

    public function testStartServiceShowsRunning()
    {
        $GLOBALS['mockShellExecOutput'] = "The service is running...\n";
        $this->assertTrue(Services::start('Apache'));
    }

    public function testStopServiceSuccessfully()
    {
        $GLOBALS['mockShellExecOutput'] = "The Apache2.4 service was stopped successfully.\n";
        $this->assertTrue(Services::stop('Apache'));
        $this->assertEquals('net stop "Apache2.4" 2>&1', $GLOBALS['mockShellExecCommand']);
    }

    public function testStopServiceAlreadyStopped()
    {
        $GLOBALS['mockShellExecOutput'] = "The Apache2.4 service is not started.\nMore help is available by typing NET HELPMSG 3521.\n";
        $this->assertFalse(Services::stop('Apache'));
    }

    public function testIsPortInUseInUse()
    {
        $GLOBALS['mockShellExecOutput'] = "  TCP    0.0.0.0:80             0.0.0.0:0              LISTENING       1234\n";
        $this->assertTrue(Services::isPortInUse(80));
        $this->assertEquals('netstat -an | findstr :80 2>&1', $GLOBALS['mockShellExecCommand']);
    }

    public function testIsPortInUseNotInUse()
    {
        $GLOBALS['mockShellExecOutput'] = "  \n\r";
        $this->assertFalse(Services::isPortInUse(80));
    }

    public function testGetResourceUsageWhenProcessExists()
    {
        $GLOBALS['mockShellExecCallback'] = function($command) {
            if (strpos($command, 'tasklist') !== false) {
                // Return output WITHOUT header since the command has /NH (no header)
                return "\"httpd.exe\",\"1234\",\"Services\",\"0\",\"12,345 K\"\n";
            }
            if (strpos($command, 'wmic') !== false) {
                return "PercentProcessorTime=25\n";
            }
            return '';
        };

        $result = Services::getResourceUsage('Apache');
        $this->assertEquals(1234, $result['pid']);
        $this->assertEquals(25, $result['cpu']);
        $this->assertEquals(round(12345 / 1024, 2), $result['ram']);
    }

    public function testGetResourceUsageWhenProcessDoesNotExist()
    {
        $GLOBALS['mockShellExecCallback'] = function($command) {
            if (strpos($command, 'tasklist') !== false) {
                return "INFO: No tasks are running which match the specified criteria.\n";
            }
            return '';
        };

        $result = Services::getResourceUsage('Apache');
        $this->assertEquals(0, $result['pid']);
        $this->assertEquals(0, $result['cpu']);
        $this->assertEquals(0, $result['ram']);
    }

    public function testGetResourceUsageInvalidOutput()
    {
        $GLOBALS['mockShellExecCallback'] = function($command) {
            if (strpos($command, 'tasklist') !== false) {
                return "Invalid Output\n";
            }
            return '';
        };

        $result = Services::getResourceUsage('Apache');
        $this->assertEquals(0, $result['pid']);
        $this->assertEquals(0, $result['cpu']);
        $this->assertEquals(0, $result['ram']);
    }
}
