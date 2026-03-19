<?php

namespace LaragonDashboard\Tests\Core;

use PHPUnit\Framework\TestCase;
use LaragonDashboard\Core\Databases;
use ReflectionClass;
use mysqli;

class DatabasesTest extends TestCase {

    private function setMockConnection($mockDb) {
        $reflection = new ReflectionClass(Databases::class);
        $property = $reflection->getProperty('connection');
        $property->setAccessible(true);
        $property->setValue(null, $mockDb);
    }

    protected function tearDown(): void {
        $this->setMockConnection(null);
        parent::tearDown();
    }

    public function testDropSuccessfullyDropsDatabase() {
        $mockDb = $this->createMock(mysqli::class);

        $mockDb->expects($this->once())
               ->method('real_escape_string')
               ->with('test_db')
               ->willReturn('test_db');

        $mockDb->expects($this->once())
               ->method('query')
               ->with("DROP DATABASE `test_db` ")
               ->willReturn(true);

        $this->setMockConnection($mockDb);

        $result = Databases::drop('test_db');
        $this->assertTrue($result);
    }

    public function testDropReturnsFalseWhenQueryFails() {
        $mockDb = $this->createMock(mysqli::class);

        $mockDb->expects($this->once())
               ->method('real_escape_string')
               ->with('test_db')
               ->willReturn('test_db');

        $mockDb->expects($this->once())
               ->method('query')
               ->with("DROP DATABASE `test_db` ")
               ->willReturn(false);

        $this->setMockConnection($mockDb);

        $result = Databases::drop('test_db');
        $this->assertFalse($result);
    }

    public function testDropValidatesDatabaseName() {
        $mockDb = $this->createMock(mysqli::class);

        // Invalid characters should cause the drop to fail immediately without querying
        $mockDb->expects($this->never())->method('real_escape_string');
        $mockDb->expects($this->never())->method('query');

        $this->setMockConnection($mockDb);

        $result = Databases::drop('test`; DROP TABLE users; --');
        $this->assertFalse($result);

        $result = Databases::drop('');
        $this->assertFalse($result);
    }

    public function testDropPreventsSystemDatabaseDeletion() {
        $mockDb = $this->createMock(mysqli::class);

        // real_escape_string and query should NOT be called if it's a system DB
        $mockDb->expects($this->never())->method('real_escape_string');
        $mockDb->expects($this->never())->method('query');

        $this->setMockConnection($mockDb);

        $result = Databases::drop('mysql');
        $this->assertFalse($result);

        $result = Databases::drop('INFORMATION_SCHEMA');
        $this->assertFalse($result);
    }

    public function testDropReturnsFalseWhenConnectionFails() {
        $this->setMockConnection(false);

        $result = Databases::drop('test_db');
        $this->assertFalse($result);
    }
}
