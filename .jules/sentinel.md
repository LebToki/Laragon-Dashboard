## 2025-02-14 - Prevent Path Traversal in File Operations
**Vulnerability:** Path traversal and arbitrary file download in backup API (`api/backup.php`) through unsanitized user inputs (`$_GET['project']` and `$_GET['timestamp']`).
**Learning:** Raw string concatenation of user-provided filenames with system paths is unsafe and can be manipulated using `../` or absolute paths.
**Prevention:** Always strictly sanitize user-provided filenames using `basename()` to strip paths, and a regex like `preg_replace('/[^a-zA-Z0-9_-]/', '', ...)` to restrict characters to an allowed safe set before using them in file operations.
