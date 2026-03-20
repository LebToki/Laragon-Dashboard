## 2026-03-18 - Database Size N+1 Query Optimization
**Learning:** Getting database sizes for multiple databases by querying `SHOW DATABASES` and then running a separate query for each DB's size creates an N+1 query problem, which severely degrades performance when managing many databases.
**Action:** Replace sequential queries with a single optimized query using `LEFT JOIN` and `GROUP BY` on `information_schema.schemata` and `information_schema.tables`. Use `COALESCE` to handle databases with no tables.

## 2026-03-18 - Disk Space Calculation Redundancy
**Learning:** Native PHP disk functions (e.g. `disk_total_space`, `disk_free_space`) were being called redundantly in single array constructions (e.g. 6 total calls instead of 2).
**Action:** Cache the results of filesystem checks in variables before constructing arrays to prevent redundant I/O operations and avoid potential division by zero errors by adding a `$totalSpace > 0` check.
