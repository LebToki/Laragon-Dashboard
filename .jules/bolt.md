## 2024-05-24 - N+1 Query in Databases::list

**Learning:** When retrieving a list of multiple databases and calculating their individual sizes, executing individual `SHOW DATABASES` or `information_schema` queries in a loop leads to a severe N+1 query performance bottleneck. This codebase's MySQL fetching logic originally suffered from this because each database's size was calculated using an individual `SELECT SUM` query inside a PHP while loop.

**Action:** Replace looped individual queries with a single bulk query using a `LEFT JOIN` on `information_schema.schemata` and `information_schema.tables`, applying `GROUP BY` and `COALESCE` to efficiently aggregate sizes in one pass. Ensure unit test mocks are properly updated to expect the single-query format and mock associative row arrays accurately.
