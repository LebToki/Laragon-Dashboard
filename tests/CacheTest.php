<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use LaragonDashboard\Core\Cache;
use ReflectionClass;

class CacheTest extends TestCase
{
    private $tempDir;

    protected function setUp(): void
    {
        parent::setUp();
        // Set up a temporary directory for tests
        $this->tempDir = sys_get_temp_dir() . '/laragon_dashboard_test_cache_' . uniqid();
        if (!is_dir($this->tempDir)) {
            mkdir($this->tempDir, 0777, true);
        }

        // Set the cache directory using reflection to ensure test isolation
        // and avoid relying on init() signature that may or may not take an argument.
        $reflection = new ReflectionClass(Cache::class);
        $property = $reflection->getProperty('cacheDir');
        $property->setAccessible(true);
        $property->setValue(null, $this->tempDir);
    }

    protected function tearDown(): void
    {
        // Clean up: delete all files in the test cache directory
        if (is_dir($this->tempDir)) {
            $files = glob($this->tempDir . '/*');
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }
            rmdir($this->tempDir);
        }

        // Reset the static state of the Cache class
        $reflection = new ReflectionClass(Cache::class);
        $property = $reflection->getProperty('cacheDir');
        $property->setAccessible(true);
        $property->setValue(null, null);

        parent::tearDown();
    }

    public function testSetCreatesCacheFileWithCorrectStructure()
    {
        $key = 'test_key';
        $value = ['data' => 'test_data'];
        $ttl = 300; // 5 minutes

        // 1. Call Cache::set()
        $result = Cache::set($key, $value, $ttl);

        // 2. Assert return value is true
        $this->assertTrue($result, 'Cache::set() should return true on success.');

        // 3. Assert file exists
        $expectedFile = $this->tempDir . '/' . md5($key) . '.json';
        $this->assertFileExists($expectedFile, 'Cache file should be created.');

        // 4. Read file content and verify structure
        $fileContent = file_get_contents($expectedFile);
        $data = json_decode($fileContent, true);

        // Verify JSON was correctly decoded
        $this->assertIsArray($data, 'Cache file should contain valid JSON.');

        // Verify expected keys exist
        $this->assertArrayHasKey('expires', $data, 'Cache data must have an "expires" key.');
        $this->assertArrayHasKey('value', $data, 'Cache data must have a "value" key.');

        // Verify stored value
        $this->assertSame($value, $data['value'], 'Stored value should match the original value.');

        // Verify TTL/expiry structure
        $expectedExpiry = time() + $ttl;
        // Allow a small delta (e.g. 2 seconds) for test execution time
        $this->assertEqualsWithDelta($expectedExpiry, $data['expires'], 2, 'Expiry time should be correct within 2 seconds delta.');
    }
}