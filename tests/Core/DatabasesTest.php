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

    public function testDropEscapesDatabaseName() {
        $mockDb = $this->createMock(mysqli::class);

        // Simulating the behavior of real_escape_string
        $mockDb->expects($this->once())
               ->method('real_escape_string')
               ->with('test`; DROP TABLE users; --')
               ->willReturn('test\`; DROP TABLE users; --');

        $mockDb->expects($this->once())
               ->method('query')
               ->with("DROP DATABASE `test\`; DROP TABLE users; --` ")
               ->willReturn(true);

        $this->setMockConnection($mockDb);

        $result = Databases::drop('test`; DROP TABLE users; --');
        $this->assertTrue($result);
    }

    public function testDropReturnsFalseWhenConnectionFails() {
        $this->setMockConnection(false);

        $result = Databases::drop('test_db');
        $this->assertFalse($result);
    }
}
