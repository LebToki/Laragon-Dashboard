# Security Policy

## Security Features

The Laragon Dashboard includes several security features to protect your development environment:

- **CSRF Protection**: All forms protected with CSRF tokens.
- **XSS Prevention**: All user inputs sanitized.
- **SQL Injection Protection**: Prepared statements used throughout.
- **Rate Limiting**: Prevents brute force attacks.
- **Secure Headers**: Comprehensive HTTP security headers including:
    - `X-Frame-Options: DENY`
    - `X-Content-Type-Options: nosniff`
    - `X-XSS-Protection: 1; mode=block`
    - `Strict-Transport-Security` (HTTPS only)
    - `Content-Security-Policy`
    - `Referrer-Policy: strict-origin-when-cross-origin`
- **File Upload Security**: Restricted file types and sizes.

## Reporting a Vulnerability

If you discover a security vulnerability within Laragon Dashboard, please send an e-mail to Tarek Tarabichi via [2tinteractive.com](https://2tinteractive.com). All security vulnerabilities will be promptly addressed.
