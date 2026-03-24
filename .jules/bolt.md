## 2026-03-24 - Array Search vs Hash Map Lookup in Loops
**Learning:** Using `in_array()` inside loops (like iterating over database rows) for membership checking creates an O(n) lookup on every iteration. While the array may be small, this operation scales poorly and allocates memory redundantly if the array is defined inline within the loop condition.
**Action:** Lift static array definitions outside of loops and flip them into associative arrays. Then use `isset()` to perform O(1) membership lookups instead of `in_array()`.

## 2026-03-18 - Disk Space Calculation Redundancy
**Learning:** Native PHP disk functions (e.g. `disk_total_space`, `disk_free_space`) were being called redundantly in single array constructions (e.g. 6 total calls instead of 2).
**Action:** Cache the results of filesystem checks in variables before constructing arrays to prevent redundant I/O operations and avoid potential division by zero errors by adding a `$totalSpace > 0` check.

## 2026-03-21 - Service Status N+1 Shell Commands
**Learning:** In Windows environment, querying service, process, and port status iteratively using `sc query`, `tasklist`, and `netstat` shell commands for each service (N+1 shell executions) creates significant, avoidable overhead.
**Action:** Replace sequential shell executions with batched `tasklist` and `netstat -an` commands run outside the loop. Use batched commands like `sc query X & sc query Y` where needed and then use `strpos` or `preg_match` (with negative lookaheads) on the cached output to extract status information, dramatically reducing subprocess spawning time.
## 2026-03-22 - PowerShell Subprocess Overhead for Log Reading
**Learning:** Using `powershell -Command "Get-Content... | Select-Object -Last"` to read the end of log files creates massive subprocess spawning overhead on Windows environments, significantly blocking performance when reading logs in helpers.
**Action:** Replaced `powershell` execution with native PHP `fseek` and `fread` implementation (via `Logs::read()`), executing in <3ms compared to ~200-500ms startup latency for PowerShell.

## 2026-03-23 - Prevent regex false positives in batched sc query output
 **Learning:** When parsing consolidated output from batched shell commands (like multiple `sc query` commands joined by `&`), greedy regular expressions (using `.*?`) combined with the `/s` modifier can match across entity boundaries, leading to false positives (e.g., matching the RUNNING state of a subsequent service).
 **Action:** Use precise regular expressions with negative lookaheads (e.g., `(?:(?!SERVICE_NAME:).)*?`) instead of greedy wildcards to strictly bound the search within a single entity's output block.
