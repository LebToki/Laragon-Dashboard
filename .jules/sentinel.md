## 2025-02-14 - Prevent Path Traversal in File Operations
**Vulnerability:** Path traversal and arbitrary file download in backup API (`api/backup.php`) through unsanitized user inputs (`$_GET['project']` and `$_GET['timestamp']`).
**Learning:** Raw string concatenation of user-provided filenames with system paths is unsafe and can be manipulated using `../` or absolute paths.
**Prevention:** Always strictly sanitize user-provided filenames using `basename()` to strip paths, and a regex like `preg_replace('/[^a-zA-Z0-9_-]/', '', ...)` to restrict characters to an allowed safe set before using them in file operations.

## 2024-05-18 - Missing System Database Protection in Core Classes
**Vulnerability:** The core `Databases::drop($name)` function lacked safeguards against deleting system databases (e.g., `mysql`, `information_schema`), meaning an API call to delete a database named "mysql" would succeed, potentially bricking the database server.
**Learning:** While the API layer (`api/delete_project.php`) implemented a check against system databases, this logic was not centralized in the core `Databases` class (`includes/Core/Databases.php`) where the actual dropping occurs.
**Prevention:** Always implement critical business logic constraints and security checks (like preventing deletion of system resources) in the core domain models or service classes, rather than relying on API endpoints to perform these checks consistently.

## 2024-05-18 - Safe Parameter Validation vs Mutating Data
**Vulnerability:** A previous proposed fix attempted to sanitize database names for `DROP DATABASE` via `preg_replace` (stripping characters). This introduces a critical data loss bug because it silently mutates an invalid identifier into a valid one, and drops *that* database instead (e.g., `test;db` becomes `testdb`).
**Learning:** For destructive operations (like dropping tables, deleting files), NEVER silently mutate user input before executing the operation.
**Prevention:** Always validate user input using regular expressions (`preg_match`). If validation fails, reject the request entirely (return `false` or throw an error).
