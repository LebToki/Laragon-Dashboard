<?php
use PHPUnit\Framework\TestCase;

ob_start();
require_once __DIR__ . '/../server_vitals.php';
ob_end_clean();

class ServerVitalsTest extends TestCase
{
    public function testParseMemInfo()
    {
        $sample = "MemTotal: 2048000 kB\nMemFree: 1024000 kB\n";
        $expected = [
            'MemTotal' => ['value' => 2048000, 'unit' => 'kB'],
            'MemFree' => ['value' => 1024000, 'unit' => 'kB'],
        ];
        $this->assertEquals($expected, parseMemInfo($sample));
    }

    public function testParseDiskUsage()
    {
        $sample = "/dev/sda1 20480000 1024000 19456000 5% /\n";
        $sample .= "/dev/sda2 10240000 512000 9728000 5% /home\n";
        $expected = [
            [
                'filesystem' => '/',
                'total' => 20480000,
                'used' => 1024000,
                'available' => 19456000,
                'use_percent' => 5,
            ],
            [
                'filesystem' => '/home',
                'total' => 10240000,
                'used' => 512000,
                'available' => 9728000,
                'use_percent' => 5,
            ],
        ];
        $this->assertEquals($expected, parseDiskUsage($sample));
    }
}
