## 2026-03-24 - Array Search vs Hash Map Lookup in Loops
**Learning:** Using `in_array()` inside loops (like iterating over database rows) for membership checking creates an O(n) lookup on every iteration. While the array may be small, this operation scales poorly and allocates memory redundantly if the array is defined inline within the loop condition.
**Action:** Lift static array definitions outside of loops and flip them into associative arrays. Then use `isset()` to perform O(1) membership lookups instead of `in_array()`.

