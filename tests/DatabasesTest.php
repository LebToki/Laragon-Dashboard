<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use LaragonDashboard\Core\Databases;

class DatabasesTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        if (!class_exists('LaragonDashboard\Core\Databases')) {
            require_once __DIR__ . '/../includes/autoload.php';
        }

        // Reset the private static connection property before each test
        $reflection = new \ReflectionClass(Databases::class);
        $property = $reflection->getProperty('connection');
        $property->setAccessible(true);
        $property->setValue(null, null);
    }

    protected function tearDown(): void
    {
        // Reset the connection after tests too
        $reflection = new \ReflectionClass(Databases::class);
        $property = $reflection->getProperty('connection');
        $property->setAccessible(true);
        $property->setValue(null, null);

        parent::tearDown();
    }

    private function setConnectionMock($mockConnection)
    {
        $reflection = new \ReflectionClass(Databases::class);
        $property = $reflection->getProperty('connection');
        $property->setAccessible(true);
        $property->setValue(null, $mockConnection);
    }

    public function testListWithValidDatabasesAndFilteredSystemDatabases()
    {
        // Mock connection
        $mysqliMock = $this->createMock(\mysqli::class);

        // Mock result for single query fetching DBs and sizes
        $databasesResultMock = $this->createMock(\mysqli_result::class);

        // Return the databases with sizes directly
        $databasesResultMock->expects($this->exactly(3))
            ->method('fetch_assoc')
            ->willReturnOnConsecutiveCalls(
                ['name' => 'test_db1', 'size' => '5.25'],
                ['name' => 'test_db2', 'size' => '10.5'],
                null // End of results
            );

        $mysqliMock->expects($this->once())
            ->method('query')
            ->willReturnCallback(function($query) use ($databasesResultMock) {
                if (strpos($query, "SELECT") !== false && strpos($query, "information_schema.schemata") !== false) {
                    return $databasesResultMock;
                }
                return false;
            });

        $this->setConnectionMock($mysqliMock);

        $databases = Databases::list();

        $this->assertIsArray($databases);
        $this->assertCount(2, $databases);

        $this->assertEquals('test_db1', $databases[0]['name']);
        $this->assertEquals(5.25, $databases[0]['size']);

        $this->assertEquals('test_db2', $databases[1]['name']);
        $this->assertEquals(10.5, $databases[1]['size']);
    }

    public function testListWhenConnectionFails()
    {
        // Do not set mock connection, so it will try to connect and fail (since no actual DB is running or we mock connection to fail)
        // Wait, actually `getConnection()` will try to connect to 127.0.0.1, we can just let it fail,
        // OR we can set connection to `false` using mock to simulate failure.
        // Actually getConnection() catches Exception and returns null on failure.

        // Since our test runner doesn't have a MySQL database running locally on default port,
        // it will naturally fail to connect and return an empty array, but it's better to mock it
        // so it doesn't wait for connection timeout.

        // Wait, self::$connection is expected to be a \mysqli object.
        // If we want getConnection() to return null, we can't easily mock `new \mysqli()` directly,
        // but wait, if self::$connection is not null, it just returns it.
        // Let's set it to `false` to test the `if (!$db) return [];` branch inside `list()`.

        $this->setConnectionMock(false);

        $databases = Databases::list();
        $this->assertIsArray($databases);
        $this->assertEmpty($databases);
    }

    public function testListWhenQueryFails()
    {
        $mysqliMock = $this->createMock(\mysqli::class);

        // Mock query to return false
        $mysqliMock->expects($this->once())
            ->method('query')
            ->willReturn(false);

        $this->setConnectionMock($mysqliMock);

        $databases = Databases::list();

        $this->assertIsArray($databases);
        $this->assertEmpty($databases);
    }
}
