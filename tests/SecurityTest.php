<?php

use PHPUnit\Framework\TestCase;
use LaragonDashboard\Core\Security;

class SecurityTest extends TestCase
{
    protected function setUp(): void
    {
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            @session_start();
        }

        // Clear csrf_token from session before each test
        unset($_SESSION['csrf_token']);
    }

    public function testGenerateCSRFTokenReturnsString()
    {
        $token = Security::generateCSRFToken();

        $this->assertIsString($token, 'The CSRF token should be a string.');
    }

    public function testGenerateCSRFTokenLength()
    {
        $token = Security::generateCSRFToken();

        // bin2hex(random_bytes(32)) generates a 64-character hexadecimal string
        $this->assertEquals(64, strlen($token), 'The CSRF token should be 64 characters long.');
    }

    public function testGenerateCSRFTokenSetsSessionVariable()
    {
        $token = Security::generateCSRFToken();

        $this->assertArrayHasKey('csrf_token', $_SESSION, 'The session should contain a csrf_token key.');
        $this->assertEquals($token, $_SESSION['csrf_token'], 'The returned token should match the session token.');
    }

    public function testGenerateCSRFTokenDoesNotOverwriteExistingToken()
    {
        $existingToken = 'dummy_token_12345';
        $_SESSION['csrf_token'] = $existingToken;

        $token = Security::generateCSRFToken();

        $this->assertEquals($existingToken, $token, 'generateCSRFToken should return the existing token if one is set.');
        $this->assertEquals($existingToken, $_SESSION['csrf_token'], 'generateCSRFToken should not overwrite an existing session token.');
    }

    public function testGenerateCSRFTokenRandomness()
    {
        $token1 = Security::generateCSRFToken();

        // Clear session to generate a new token
        unset($_SESSION['csrf_token']);

        $token2 = Security::generateCSRFToken();

        $this->assertNotEquals($token1, $token2, 'Two generated CSRF tokens should not be identical.');
    }
}
