<?php

use PHPUnit\Framework\TestCase;

class GetServicesStatusTest extends TestCase {
    private string $mockBinDir;
    private string $originalPath;
    private string $originalPathExt;

    protected function setUp(): void {
        parent::setUp();

        $this->mockBinDir = sys_get_temp_dir() . '/laragon_test_mock_bin_' . uniqid();
        mkdir($this->mockBinDir);

        $this->originalPath = getenv('PATH');
        putenv('PATH=' . $this->mockBinDir . PATH_SEPARATOR . $this->originalPath);

        // Ensure .bat and .cmd are in PATHEXT for Windows compatibility during testing if we are on Windows,
        // but since we are running tests on both Unix and Windows potentially, we should handle both.
        // PHP's shell_exec runs through cmd.exe on Windows, which automatically looks for .bat/.cmd.

        require_once __DIR__ . '/../includes/helpers.php';
    }

    protected function tearDown(): void {
        putenv('PATH=' . $this->originalPath);

        if (is_dir($this->mockBinDir)) {
            $files = glob($this->mockBinDir . '/*');
            foreach ($files as $file) {
                unlink($file);
            }
            rmdir($this->mockBinDir);
        }

        parent::tearDown();
    }

    private function createMockCommand(string $command, string $output): void {
        // Create Unix shell script
        $pathUnix = $this->mockBinDir . '/' . $command;
        $contentUnix = "#!/bin/sh\n" . "cat << 'EOMOCK'\n" . $output . "\nEOMOCK\n";
        file_put_contents($pathUnix, $contentUnix);
        chmod($pathUnix, 0777);

        // Create Windows batch script
        $pathWin = $this->mockBinDir . '/' . $command . '.bat';
        // Simple echo for each line to avoid cmd.exe escaping hell
        $lines = explode("\n", str_replace("\r", "", $output));
        $contentWin = "@echo off\r\n";
        foreach ($lines as $line) {
            // Escape special chars for echo if needed, though for our simple mock outputs this should be enough
            $contentWin .= "echo " . str_replace(['<', '>', '|', '&'], ['^<', '^>', '^|', '^&'], $line) . "\r\n";
        }
        file_put_contents($pathWin, $contentWin);
    }

    public function testGetServicesStatusAllStopped(): void {
        $this->createMockCommand('netstat', '');
        $this->createMockCommand('sc', '');
        $this->createMockCommand('findstr', '');

        $status = getServicesStatus();

        $this->assertIsArray($status);
        $this->assertArrayHasKey('Apache', $status);
        $this->assertFalse($status['Apache']['running']);
        $this->assertFalse($status['Apache']['windows_service']);
        $this->assertArrayHasKey('MySQL', $status);
        $this->assertFalse($status['MySQL']['running']);
        $this->assertFalse($status['MySQL']['windows_service']);
    }

    public function testGetServicesStatusApacheRunning(): void {
        $netstatOutput = "Active Connections\n  TCP    0.0.0.0:80             0.0.0.0:0              LISTENING\n";
        $this->createMockCommand('netstat', $netstatOutput);

        $scOutput = "SERVICE_NAME: Apache\n        TYPE               : 10  WIN32_OWN_PROCESS\n        STATE              : 4  RUNNING\n";
        $this->createMockCommand('sc', $scOutput);
        $this->createMockCommand('findstr', '');

        $status = getServicesStatus();

        $this->assertTrue($status['Apache']['running'], 'Apache should be running (port 80)');
        $this->assertTrue($status['Apache']['windows_service'], 'Apache windows service should be running');
        $this->assertFalse($status['MySQL']['running'], 'MySQL should not be running');
        $this->assertFalse($status['MySQL']['windows_service'], 'MySQL windows service should not be running');
    }

    public function testGetServicesStatusRegexBoundary(): void {
        // Test that port 8080 does NOT falsely trigger port 80
        $netstatOutput = "Active Connections\n  TCP    0.0.0.0:8080           0.0.0.0:0              LISTENING\n";
        $this->createMockCommand('netstat', $netstatOutput);
        $this->createMockCommand('sc', '');
        $this->createMockCommand('findstr', '');

        $status = getServicesStatus();
        $this->assertFalse($status['Apache']['running'], 'Apache should not match port 8080');
    }

    public function testGetServicesStatusMySQLRunning(): void {
        $netstatOutput = "  TCP    0.0.0.0:3306           0.0.0.0:0              LISTENING\n";
        $this->createMockCommand('netstat', $netstatOutput);

        $scOutput = "SERVICE_NAME: MySQL\n        STATE              : 4  RUNNING\n";
        $this->createMockCommand('sc', $scOutput);
        $this->createMockCommand('findstr', '');

        $status = getServicesStatus();

        $this->assertTrue($status['MySQL']['running']);
        $this->assertTrue($status['MySQL']['windows_service']);
        $this->assertFalse($status['Apache']['running']);
        $this->assertFalse($status['Apache']['windows_service']);
    }

    public function testGetServicesStatusFallbackToIsPortInUse(): void {
        // Empty netstat output triggers fallback.
        // We cannot use cat with EOMOCK here for netstat, because that emits an empty line which PHP shell_exec returns as "\n".
        // A non-empty string means it DOESN'T fallback!
        // To make it truly empty, we overwrite the command script.
        $netstatPath = $this->mockBinDir . '/netstat';
        file_put_contents($netstatPath, "#!/bin/sh\n\n");
        chmod($netstatPath, 0777);
        $netstatPathBat = $this->mockBinDir . '/netstat.bat';
        file_put_contents($netstatPathBat, "@echo off\r\n");

        // findstr mock
        $findstrScript = "#!/bin/sh\n" .
                         "if echo \"\$@\" | grep -q \":3306\"; then\n" .
                         "  echo \"  TCP    0.0.0.0:3306           0.0.0.0:0              LISTENING\"\n" .
                         "fi\n";
        $findstrPath = $this->mockBinDir . '/findstr';
        file_put_contents($findstrPath, $findstrScript);
        chmod($findstrPath, 0777);

        // findstr batch script mock for windows
        // In windows, findstr is called like: findstr :3306
        // We can just use a simple PHP script as the mock to handle args cross-platform more easily,
        // but for simplicity, let's just use a bat file that checks if %1 contains 3306
        $findstrBat = "@echo off\r\n" .
                      "echo %* | find \":3306\" >nul\r\n" .
                      "if not errorlevel 1 (\r\n" .
                      "  echo   TCP    0.0.0.0:3306           0.0.0.0:0              LISTENING\r\n" .
                      ")\r\n";
        file_put_contents($this->mockBinDir . '/findstr.bat', $findstrBat);

        $this->createMockCommand('sc', '');

        $status = getServicesStatus();

        $this->assertTrue($status['MySQL']['running'], 'MySQL should be running via findstr fallback');
        $this->assertFalse($status['Apache']['running']);
    }
}
