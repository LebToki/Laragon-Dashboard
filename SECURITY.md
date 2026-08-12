# Security Policy

## Supported Versions

| Version | Supported | Platform |
|---------|-----------|----------|
| 4.0.5   | ✅        | Windows  |
| 4.0.6   | ✅        | Windows  |
| Nucleus (latest) | ✅ | Linux |

## Reporting a Vulnerability

If you discover a security vulnerability in Laragon Dashboard or Nucleus, please report it responsibly.

**DO NOT** open a public GitHub issue for security vulnerabilities.

### How to Report

1. **Email**: Send details to security@2tinteractive.com
2. **GitHub**: Use [GitHub Security Advisories](https://github.com/LebToki/Laragon-Dashboard/security/advisories/new) (private)

### What to Include

- Description of the vulnerability
- Steps to reproduce
- Potential impact
- Suggested fix (if any)

### Response Timeline

- **Acknowledgment**: Within 48 hours
- **Assessment**: Within 7 days
- **Fix timeline**: Depends on severity — critical fixes within 48 hours of confirmation

### Disclosure Policy

- We follow coordinated disclosure
- We ask that you do not publicly disclose the vulnerability before we have had a chance to address it
- We will credit reporters in the changelog (unless you prefer to remain anonymous)

## Security Features

- CSRF token protection on all forms
- HTTP security headers (X-Frame-Options, CSP, HSTS, etc.)
- Rate limiting on authentication endpoints
- Input sanitization (XSS prevention)
- SQL injection protection (prepared statements)
- Secure session management (HTTPOnly cookies)
- File upload restrictions

## Linux Users

For the Linux-native version (Nucleus), please report security issues at:
https://github.com/LebToki/Nucleus/security/advisories/new
