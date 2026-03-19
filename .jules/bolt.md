## 2026-03-18 - Database Size N+1 Query Optimization
**Learning:** Getting database sizes for multiple databases by querying `SHOW DATABASES` and then running a separate query for each DB's size creates an N+1 query problem, which severely degrades performance when managing many databases.
**Action:** Replace sequential queries with a single optimized query using `LEFT JOIN` and `GROUP BY` on `information_schema.schemata` and `information_schema.tables`. Use `COALESCE` to handle databases with no tables.
