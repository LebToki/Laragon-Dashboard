# Palette's Journal

## 2024-05-17 - [Initial Setup]
**Learning:** Initializing journal for tracking critical UX and accessibility learnings.
**Action:** Use this file to record important insights.

## 2024-05-24 - [ARIA Labels and i18n]
**Learning:** When adding ARIA labels to a localized application with PHP templates, accessibility labels should use existing translation functions (like `t_projects`) where available to ensure screen readers match the user's selected language.
**Action:** Always check if a translation function exists in the current file scope before hardcoding English ARIA labels.

## 2024-05-25 - [Contextual ARIA Labels in Tables]
**Learning:** Icon-only action buttons inside tables or lists (like "Start" or "Stop" buttons for services) lack context when read by a screen reader in isolation. Hearing "Start, Start, Start" is confusing.
**Action:** Always append the relevant entity name (e.g. the service name) to the ARIA label for repeated action buttons in a list or table (e.g. `aria-label="Start MySQL"`).