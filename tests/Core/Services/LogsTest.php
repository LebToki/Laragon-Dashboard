<?php

namespace LaragonDashboard\Tests\Core\Services;

use PHPUnit\Framework\TestCase;
use LaragonDashboard\Core\Services\Logs;

class LogsTest extends TestCase
{
    private $tempDir;

    protected function setUp(): void
    {
        if (!class_exists(Logs::class)) {
            require_once __DIR__ . '/../../../includes/Core/Services/Logs.php';
        }

        $this->tempDir = sys_get_temp_dir() . '/laragon_dashboard_test_' . uniqid();
        mkdir($this->tempDir, 0777, true);
    }

    protected function tearDown(): void
    {
        $this->removeDirectory($this->tempDir);
    }

    private function removeDirectory($dir)
    {
        if (!file_exists($dir)) return;

        $files = array_diff(scandir($dir), ['.', '..']);
        foreach ($files as $file) {
            $path = "$dir/$file";
            is_dir($path) ? $this->removeDirectory($path) : unlink($path);
        }
        rmdir($dir);
    }

    public function testReadSmallFile()
    {
        $filePath = $this->tempDir . '/small.log';
        $content = "Line 1\nLine 2\nLine 3";
        file_put_contents($filePath, $content);

        $result = Logs::read($filePath, 2);

        $this->assertIsArray($result);
        $this->assertEquals("Line 2\nLine 3", $result['content']);
        $this->assertEquals(3, $result['total_lines']);
        $this->assertEquals(2, $result['displayed_lines']);
        $this->assertEquals($filePath, $result['path']);
    }

    public function testReadLargeFile()
    {
        $filePath = $this->tempDir . '/large.log';
        $lineCount = 10000;

        $baseStr = str_repeat('A', 50);

        $handle = fopen($filePath, 'w');
        for ($i = 1; $i <= $lineCount; $i++) {
            fwrite($handle, "Line $i $baseStr\n");
        }
        fclose($handle);

        $this->assertGreaterThan(1024 * 512, filesize($filePath), "File must be > 512KB to test large file logic");

        $linesToRead = 5;
        $result = Logs::read($filePath, $linesToRead);

        $this->assertIsArray($result);

        // Since explode("\n", $output) gives an empty string at the end due to the final \n,
        // the last line is empty and sliced. So 5 elements slice includes the empty one.
        // It slices: Line 9997, Line 9998, Line 9999, Line 10000, empty string
        $expectedContentArr = [
            "Line 9997 $baseStr",
            "Line 9998 $baseStr",
            "Line 9999 $baseStr",
            "Line 10000 $baseStr",
            ""
        ];
        $expectedContent = implode("\n", $expectedContentArr);

        $this->assertEquals($expectedContent, $result['content']);
        $this->assertEquals($linesToRead, $result['displayed_lines']);
        $this->assertIsInt($result['total_lines']);
    }

    public function testReadNonExistentFile()
    {
        $filePath = $this->tempDir . '/non_existent.log';
        $result = Logs::read($filePath);
        $this->assertFalse($result);
    }

    public function testReadEmptyFile()
    {
        $filePath = $this->tempDir . '/empty.log';
        file_put_contents($filePath, '');

        $result = Logs::read($filePath);

        $this->assertIsArray($result);
        $this->assertEquals('(Empty log file)', $result['content']);
        $this->assertEquals(1, $result['total_lines']);
        $this->assertEquals(1, $result['displayed_lines']);
    }
}
