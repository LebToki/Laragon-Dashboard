<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . "/../includes/helpers.php";

class FormatLogToHtmlTest extends TestCase
{
    public function testEmptyInputReturnsEmptyString()
    {
        $this->assertEquals("", formatLogToHtml(""));
        $this->assertEquals("", formatLogToHtml(null));
    }

    public function testNormalLogLines()
    {
        $input = "This is a normal log line.";
        $result = formatLogToHtml($input);

        $this->assertStringContainsString('<tr class="">', $result, "Normal line should have empty class");
        $this->assertStringContainsString('<td class="font-monospace ">This is a normal log line.</td>', $result, "Normal line should not have text color classes");
    }

    public function testErrorFatalCriticalLines()
    {
        $input = "PHP Warning: this is just a normal error log line.";
        $result = formatLogToHtml($input);
        $this->assertStringContainsString('<tr class="bg-danger-50">', $result, "Error line should have danger background");
        $this->assertStringContainsString('text-danger-main', $result, "Error line should have danger text color");

        $input = "FATAL: Out of memory";
        $result = formatLogToHtml($input);
        $this->assertStringContainsString('<tr class="bg-danger-50">', $result, "Fatal line should have danger background");
        $this->assertStringContainsString('text-danger-main', $result, "Fatal line should have danger text color");

        $input = "CRITICAL issue detected";
        $result = formatLogToHtml($input);
        $this->assertStringContainsString('<tr class="bg-danger-50">', $result, "Critical line should have danger background");
    }

    public function testWarningLines()
    {
        $input = "WARN: Deprecated function used";
        $result = formatLogToHtml($input);
        $this->assertStringContainsString('<tr class="bg-warning-50">', $result, "Warning line should have warning background");
        $this->assertStringContainsString('text-warning-main', $result, "Warning line should have warning text color");
    }

    public function testInfoLines()
    {
        $input = "INFO: Server started successfully";
        $result = formatLogToHtml($input);
        $this->assertStringContainsString('<tr class="bg-info-50">', $result, "Info line should have info background");
        $this->assertStringContainsString('text-info-main', $result, "Info line should have info text color");
    }

    public function testHtmlEscaping()
    {
        $input = "Normal log with <script>alert(1)</script> tags";
        $result = formatLogToHtml($input);
        $this->assertStringContainsString('&lt;script&gt;alert(1)&lt;/script&gt;', $result, "HTML characters should be escaped");
    }

    public function testMultiLineAndEmptyLinesSkipped()
    {
        $input = "Line 1\n\n  \nLine 2";
        $result = formatLogToHtml($input);
        $this->assertStringContainsString('Line 1', $result, "Should contain first line");
        $this->assertStringContainsString('Line 2', $result, "Should contain second line");
        $this->assertEquals(2, substr_count($result, '<tr'), "Empty or whitespace-only lines should be skipped");
    }
}