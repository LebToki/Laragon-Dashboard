<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../includes/autoload.php';
require_once __DIR__ . '/../includes/helpers.php';

class LaragonRootTest extends TestCase
{
    private $originalEnv;
    private $originalServer;

    protected function setUp(): void
    {
        // Save original state
        $this->originalEnv = getenv('LARAGON_ROOT');
        $this->originalServer = $_SERVER;

        // Clear environment and server for testing
        putenv('LARAGON_ROOT'); // remove it
        unset($_SERVER['DOCUMENT_ROOT']);
    }

    protected function tearDown(): void
    {
        // Restore original state
        if ($this->originalEnv !== false) {
            putenv('LARAGON_ROOT=' . $this->originalEnv);
        } else {
            putenv('LARAGON_ROOT');
        }
        $_SERVER = $this->originalServer;
    }

    public function testEnvVariable()
    {
        putenv('LARAGON_ROOT=/test/env/laragon');
        $result = getLaragonRoot();
        $this->assertEquals('/test/env/laragon', $result, 'Should use LARAGON_ROOT env var');
    }

    public function testDocRootWithWww()
    {
        $_SERVER['DOCUMENT_ROOT'] = 'C:/test/laragon/www/project';
        $result = getLaragonRoot();
        $this->assertEquals('C:/test/laragon', $result, 'Should parse path with /www');
    }

    public function testDocRootWithLaragonButNoWww()
    {
        $_SERVER['DOCUMENT_ROOT'] = 'D:/apps/laragon/dashboard';
        $result = getLaragonRoot();
        $this->assertEquals('D:/apps/laragon', $result, 'Should parse path containing laragon');
    }

    public function testFallbackPaths()
    {
        // Without vfsStream, we can't truly mock the filesystem for is_dir easily
        // Instead we verify the fallback logic based on what actually exists on the system
        $expected = 'C:/laragon';
        $possiblePaths = ['C:/laragon', 'D:/laragon', 'E:/laragon'];
        foreach ($possiblePaths as $path) {
            if (is_dir($path)) {
                $expected = $path;
                break;
            }
        }

        $result = getLaragonRoot();
        $this->assertEquals($expected, $result, 'Should return first existing fallback path or C:/laragon default');
    }
}
