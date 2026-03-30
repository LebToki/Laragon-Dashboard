<?php
require_once "includes/helpers.php";

use PHPUnit\Framework\TestCase;

class FindFileTest extends TestCase {
    private $tempDir;

    protected function setUp(): void {
        $this->tempDir = sys_get_temp_dir() . '/test_findfile_' . uniqid();
        mkdir($this->tempDir);
        mkdir($this->tempDir . '/level1');
        mkdir($this->tempDir . '/level1/level2');
        mkdir($this->tempDir . '/level1/level2/level3');
        mkdir($this->tempDir . '/level1/level2/level3/level4');
    }

    protected function tearDown(): void {
        $this->rmrf($this->tempDir);
    }

    private function rmrf($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir."/".$object) == "dir") {
                        $this->rmrf($dir."/".$object);
                    } else {
                        unlink($dir."/".$object);
                    }
                }
            }
            reset($objects);
            rmdir($dir);
        }
    }

    public function testFindFileInRoot() {
        touch($this->tempDir . '/target.txt');
        $result = findFile($this->tempDir, ['target.txt'], 0);
        $this->assertEquals($this->tempDir . '/target.txt', $result);
    }

    public function testFindFileInSubdirWithinDepth() {
        touch($this->tempDir . '/level1/target.txt');
        $result = findFile($this->tempDir, ['target.txt'], 1);
        $this->assertEquals($this->tempDir . '/level1/target.txt', $result);
    }

    public function testFindFileInSubdirExceedingDepth() {
        touch($this->tempDir . '/level1/level2/target.txt');
        $result = findFile($this->tempDir, ['target.txt'], 1);
        $this->assertNull($result, "Should not find file because max depth is 1");
    }

    public function testFindFileDeepStructure() {
        touch($this->tempDir . '/level1/level2/level3/target.txt');

        // At maxDepth=2, should be null (root=0, level1=1, level2=2, level3=3)
        $result2 = findFile($this->tempDir, ['target.txt'], 2);
        $this->assertNull($result2);

        // At maxDepth=3, should be found
        $result3 = findFile($this->tempDir, ['target.txt'], 3);
        $this->assertEquals($this->tempDir . '/level1/level2/level3/target.txt', $result3);
    }

    public function testFindFileMultipleFilenames() {
        touch($this->tempDir . '/level1/secondary.txt');
        $result = findFile($this->tempDir, ['primary.txt', 'secondary.txt'], 1);
        $this->assertEquals($this->tempDir . '/level1/secondary.txt', $result);
    }

    public function testFindFileExcludedDirectories() {
        mkdir($this->tempDir . '/vendor');
        touch($this->tempDir . '/vendor/target.txt');

        $result = findFile($this->tempDir, ['target.txt'], 2);
        $this->assertNull($result, "Should ignore 'vendor' directory");
    }
}
