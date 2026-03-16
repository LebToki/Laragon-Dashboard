<?php

namespace Tests\Core;

use PHPUnit\Framework\TestCase;
use LaragonDashboard\Core\Security;

class SecurityTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        // Ensure session is started for tests if it isn't already
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    protected function tearDown(): void
    {
        // Clean up session data
        unset($_SESSION['csrf_token']);
        parent::tearDown();
    }

    public function testVerifyCSRFTokenReturnsFalseWhenSessionTokenEmptyAndInputTokenEmpty()
    {
        $_SESSION['csrf_token'] = '';
        $this->assertFalse(Security::verifyCSRFToken(''));
    }

    public function testVerifyCSRFTokenReturnsFalseWhenSessionTokenEmptyButInputTokenValid()
    {
        $_SESSION['csrf_token'] = '';
        $this->assertFalse(Security::verifyCSRFToken('some_token'));
    }

    public function testVerifyCSRFTokenReturnsFalseWhenSessionTokenValidButInputTokenEmpty()
    {
        $_SESSION['csrf_token'] = 'valid_session_token';
        $this->assertFalse(Security::verifyCSRFToken(''));
    }

    public function testVerifyCSRFTokenReturnsFalseWhenTokensDoNotMatch()
    {
        $_SESSION['csrf_token'] = 'valid_session_token';
        $this->assertFalse(Security::verifyCSRFToken('invalid_input_token'));
    }

    public function testVerifyCSRFTokenReturnsTrueWhenTokensMatch()
    {
        $_SESSION['csrf_token'] = 'matching_token';
        $this->assertTrue(Security::verifyCSRFToken('matching_token'));
    }
}
