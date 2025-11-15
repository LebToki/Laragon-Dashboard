# WowDash UI Patterns for PetSphere

## Standardized Layout Patterns

### Column Distribution & Field Grouping (Mandatory)

- Always build rows using `col-12`-based columns and distribute with breakpoints:
  - Example: `div.row > div.col-12 col-md-6`, `div.col-12 col-md-4`, etc.
- Replace legacy `form-row`/`form-group col-md-*` with `row` + `col-12 col-md-* mb-3`.
- Group fields by operational and business context:
  - Operational: owner, identifiers, species/breed, sex, DOB, weight.
  - Medical: allergies, preexisting conditions, medications, vet, insurance.
  - Behavioral: temperament, compatibility, handling instructions, dietary/grooming.
  - Emergency & Boarding: emergency contact, sleep preferences, fears, toys.
  - Documents: photo, passport/certificates.

Applied starting with: `admin/modules/services/pets/create.php`, `edit.php`, and `view.php`.

---

## 1. Page Header Pattern (Breadcrumb + Title)

**Location**: Top of every page, inside `dashboard-main-body`

**Structure**:

```html
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <strong><p class="fw-semibold mb-0"><?php echo $title; ?></p></strong>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="<?php echo DASHBOARD_URL; ?>/" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                Dashboard
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium"><?php echo $subtitle; ?></li>
    </ul>
</div>
```

**Variables**:

- `$title` - Main page title (e.g., "Species", "Invoice List", "Add Species")
- `$subtitle` - Breadcrumb subtitle (e.g., "Species", "Invoice List", "Add Species")

**Important**:

- ❌ **NO h1-h6 tags** - Use `<strong><p>` instead
- Title is on the LEFT
- Breadcrumb is on the RIGHT
- Iconify icon: `solar:home-smile-angle-outline` for home link

---

## 2. Card Header Pattern (Filters + Main Action Button)

**Location**: Inside `<div class="card">`, at `<div class="card-header">`

**Structure**:

```html
<div class="card">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-3">
        <!-- LEFT: Filters, Search, Size Selector -->
        <div class="d-flex flex-wrap align-items-center gap-3">
            <!-- Size Selector (Show 10/20/50/100) -->
            <div class="d-flex align-items-center gap-2">
                <span>Show</span>
                <select class="form-select form-select-sm w-auto" name="per_page" onchange="this.form.submit()">
                    <option value="10" <?php echo ($perPage == 10) ? 'selected' : ''; ?>>10</option>
                    <option value="20" <?php echo ($perPage == 20) ? 'selected' : ''; ?>>20</option>
                    <option value="50" <?php echo ($perPage == 50) ? 'selected' : ''; ?>>50</option>
                    <option value="100" <?php echo ($perPage == 100) ? 'selected' : ''; ?>>100</option>
                </select>
            </div>
            
            <!-- Search Field (when relevant) -->
            <div class="icon-field">
                <input type="text" name="search" class="form-control form-control-sm w-auto" placeholder="Search" value="<?php echo htmlspecialchars($search ?? ''); ?>">
                <span class="icon">
                    <iconify-icon icon="ion:search-outline"></iconify-icon>
                </span>
            </div>
            
            <!-- Status/Filter Dropdown (when relevant) -->
            <select class="form-select form-select-sm w-auto" name="status" onchange="this.form.submit()">
                <option value="">All Status</option>
                <option value="active" <?php echo ($statusFilter == 'active') ? 'selected' : ''; ?>>Active</option>
                <option value="inactive" <?php echo ($statusFilter == 'inactive') ? 'selected' : ''; ?>>Inactive</option>
            </select>
        </div>
        
        <!-- RIGHT: Main Action Button -->
        <div class="d-flex flex-wrap align-items-center gap-3">
            <a href="create.php" class="btn btn-sm btn-primary-600">
                <iconify-icon icon="ri-add-line"></iconify-icon>
                Create <?php echo $title; ?>
            </a>
        </div>
    </div>
    <div class="card-body">
        <!-- Table content -->
    </div>
</div>
```

**Layout**:

- **LEFT side**: Filters, Search, Size selector
- **RIGHT side**: Main action button (Create, Add, etc.)

**Important**:

- Filters and search go in card-header LEFT
- Main action button goes in card-header RIGHT
- Size selector: 10, 20, 50, 100 options
- Search uses `icon-field` class with iconify icon

---

## 3. Action Buttons Pattern (Table Actions Column)

**Location**: Last column in table rows

**Structure**:

```html
<td>
    <div class="d-flex align-items-center gap-2">
        <!-- View Button (Primary) -->
        <a href="view.php?id=<?php echo $id; ?>" class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center" title="View">
            <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
        </a>
        
        <!-- Edit Button (Success) -->
        <a href="edit.php?id=<?php echo $id; ?>" class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center" title="Edit">
            <iconify-icon icon="lucide:edit"></iconify-icon>
        </a>
        
        <!-- Delete Button (Danger) -->
        <a href="delete.php?id=<?php echo $id; ?>" onclick="return confirm('Delete this item?');" class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center" title="Delete">
            <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
        </a>
    </div>
</td>
```

**Color Variants** (change background and text color classes):

- **Primary**: `bg-primary-light text-primary-600` (View)
- **Success**: `bg-success-focus text-success-main` (Edit)
- **Danger**: `bg-danger-focus text-danger-main` (Delete)
- **Info**: `bg-info-focus text-info-main`
- **Warning**: `bg-warning-focus text-warning-main`
- **Lilac**: `bg-lilac-focus text-lilac-main`
- **Cyan**: `bg-cyan-focus text-cyan-main`

**Iconify Icons** (endless possibilities):

- View: `iconamoon:eye-light`, `solar:eye-outline`, `ri-eye-line`
- Edit: `lucide:edit`, `solar:pen-outline`, `ri-edit-line`
- Delete: `mingcute:delete-2-line`, `solar:trash-bin-outline`, `ri-delete-bin-line`
- Add: `ri-add-line`, `solar:add-circle-outline`
- Download: `solar:download-outline`, `ri-download-line`
- Print: `solar:printer-outline`, `ri-printer-line`
- More: [Iconify Icons](https://icon-sets.iconify.design/)

**Size**: Always `w-32-px h-32-px` (32px × 32px circular buttons)

---

## 4. Status Badges Pattern

**Location**: In table cells for status indicators

**Structure**:

```html
<span class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Paid</span>
<span class="bg-warning-focus text-warning-main px-24 py-4 rounded-pill fw-medium text-sm">Pending</span>
<span class="bg-danger-focus text-danger-main px-24 py-4 rounded-pill fw-medium text-sm">Canceled</span>
```

**Pattern**:

- `bg-{color}-focus text-{color}-main` for colored backgrounds
- `px-24 py-4` for padding
- `rounded-pill` for pill shape
- `fw-medium text-sm` for typography

**Color Variants**:

- `bg-success-focus text-success-main` - Green (Paid, Active, Completed)
- `bg-warning-focus text-warning-main` - Yellow/Orange (Pending, Waiting)
- `bg-danger-focus text-danger-main` - Red (Canceled, Deleted, Failed)
- `bg-info-focus text-info-main` - Blue (Info, New)
- `bg-primary-focus text-primary-main` - Primary color

---

## 5. Accounting UI Patterns (Invoices, Payments, Vouchers, Journals)

These patterns standardize financial pages and ensure consistency across `orders/invoices`, `payments`, and future `accounting` modules.

### 5.1 Currency & Amount Formatting

- Always display amounts with two decimals and currency symbol.
- Respect tenant default currency; show secondary currency when dual-currency is enabled.
- Use monospace for columns to improve legibility in tables with amounts.

Example:

```html
<td class="text-end"><code class="monospace">$1,234.56</code></td>
<td class="text-end text-secondary-light"><small>LBP 110,000,000</small></td>
```

### 5.2 Debit/Credit Tables

- Column order: Date | Account | Description | Debit | Credit | Balance (optional)
- Right-align numeric columns; keep consistent width.
- Totals row is sticky at the bottom of the card for long tables.

```html
<tfoot>
  <tr>
    <th colspan="3" class="text-end">Total</th>
    <th class="text-end">$12,345.67</th>
    <th class="text-end">$12,345.67</th>
  </tr>
  <tr>
    <th colspan="3" class="text-end">Difference</th>
    <th colspan="2" class="text-end">
      <span class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Balanced</span>
    </th>
  </tr>
 </tfoot>
```

### 5.3 Voucher/Payment Forms

- Group by: Payer/Payee, Payment Details, Allocation/Lines, Notes/Attachments.
- Use `col-12 col-md-4` or `col-12 col-md-6` layout.
- Inline validation near fields; summary alert at top on error.

### 5.4 Status & Lifecycle

- Common statuses: Draft, Posted, Voided, Refunded, Partially Paid, Paid.
- Use status badges (Section 4). Transitions via dropdown + confirm modal.

### 5.5 Actions

- Primary actions on the right of the card-header: Save/Update, Post, Void, Print, Export PDF.
- Secondary actions in a kebab menu if crowded.

### 5.6 i18n in Accounting

- Any user-facing name fields should support tri-lingual keys: `name_en`, `name_fr`, `name_ar`.
- Tables recommended for multilingual columns:
  - `tax_rate` (name_*)
  - `tax_rule` (name_*)
  - `payment_method` (name_*)
  - `chart_of_account` (account_name_*)
  - `voucher_type` (name_*)
  - `invoice_template` (display_name_*)
- Use `db_get_text($row, 'name')` helpers in UI.

---

## 5. Pagination Pattern

**Location**: Below table, after `</div>` closing `card-body`

**Structure**:

```html
<div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mt-24">
    <span>Showing <?php echo $start; ?> to <?php echo $end; ?> of <?php echo $total; ?> entries</span>
    <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center">
        <!-- Previous Button -->
        <li class="page-item">
            <a class="page-link text-secondary-light fw-medium radius-4 border-0 px-10 py-10 d-flex align-items-center justify-content-center h-32-px w-32-px bg-base" href="?page=<?php echo $prevPage; ?>&per_page=<?php echo $perPage; ?>">
                <iconify-icon icon="ep:d-arrow-left" class="text-xl"></iconify-icon>
            </a>
        </li>
        
        <!-- Page Numbers -->
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <li class="page-item">
            <a class="page-link <?php echo ($i == $currentPage) ? 'bg-primary-600 text-white' : 'bg-primary-50 text-secondary-light'; ?> fw-medium radius-4 border-0 px-10 py-10 d-flex align-items-center justify-content-center h-32-px w-32-px" href="?page=<?php echo $i; ?>&per_page=<?php echo $perPage; ?>">
                <?php echo $i; ?>
            </a>
        </li>
        <?php endfor; ?>
        
        <!-- Next Button -->
        <li class="page-item">
            <a class="page-link text-secondary-light fw-medium radius-4 border-0 px-10 py-10 d-flex align-items-center justify-content-center h-32-px w-32-px bg-base" href="?page=<?php echo $nextPage; ?>&per_page=<?php echo $perPage; ?>">
                <iconify-icon icon="ep:d-arrow-right" class="text-xl"></iconify-icon>
            </a>
        </li>
    </ul>
</div>
```

**Icons**:

- Previous: `ep:d-arrow-left`
- Next: `ep:d-arrow-right`

**Active Page**: `bg-primary-600 text-white`
**Inactive Page**: `bg-primary-50 text-secondary-light`

---

## 6. Tabs & Button Tabs with Icons

### Button Tabs with Icons (Preferred)

Use WowDash "button-tab nav-pills" with iconify icons:

```html
<ul class="nav button-tab nav-pills mb-16" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link d-flex align-items-center gap-2 fw-semibold text-primary-light radius-4 px-16 py-10 active" data-bs-toggle="pill" data-bs-target="#tab-one" type="button" role="tab">
      <iconify-icon icon="solar:home-smile-angle-outline" class="text-xl"></iconify-icon>
      <span class="line-height-1">Home</span>
    </button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link d-flex align-items-center gap-2 fw-semibold text-primary-light radius-4 px-16 py-10" data-bs-toggle="pill" data-bs-target="#tab-two" type="button" role="tab">
      <iconify-icon icon="hugeicons:folder-details" class="text-xl"></iconify-icon>
      <span class="line-height-1">Details</span>
    </button>
  </li>
</ul>
```

Notes:

- Keep icon size `text-xl`, label wrapped in `<span class="line-height-1">`.
- Maintain consistent padding `px-16 py-10`, rounded `radius-4`.
- Use `text-primary-light` for inactive tabs.

Applied: Pets `create.php`, `edit.php`.

---

## 7. Table Structure Pattern

**Structure**:

```html
<div class="card">
    <div class="card-header"><!-- filters and buttons --></div>
    <div class="card-body">
        <div class="table-responsive scroll-sm">
            <table class="table bordered-table mb-0">
                <thead>
                    <tr>
                        <th scope="col" class="bg-transparent rounded-0">Column 1</th>
                        <th scope="col" class="bg-transparent rounded-0">Column 2</th>
                        <th scope="col" class="bg-transparent rounded-0">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Data 1</td>
                        <td>Data 2</td>
                        <td><!-- Action buttons --></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
```

**Classes**:

- Table wrapper: `table-responsive scroll-sm`
- Table: `table bordered-table mb-0`
- Header cells: `bg-transparent rounded-0`

---

## 7. Complete Page Template

**Full Example** (List Page):

```php
<?php
require_once(dirname(__DIR__, 2) . '/include/db_util.php');
include dirname(__DIR__, 2) . '/include/layouts/layoutTop.php';

// Page variables
$title = "Species";
$subtitle = "Species";

// Pagination
$perPage = isset($_GET['per_page']) ? (int)$_GET['per_page'] : 10;
$perPage = in_array($perPage, [10, 20, 50, 100]) ? $perPage : 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $perPage;

// Search
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Calculate totals and pagination
$total = $conn->query("SELECT COUNT(*) FROM species WHERE deleted_at IS NULL")->fetchColumn();
$totalPages = ceil($total / $perPage);
$start = $offset + 1;
$end = min($offset + $perPage, $total);
?>

<div class="dashboard-main-body">
    <!-- Page Header: Title + Breadcrumb -->
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <strong><p class="fw-semibold mb-0"><?php echo $title; ?></p></strong>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="<?php echo DASHBOARD_URL; ?>/" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium"><?php echo $subtitle; ?></li>
        </ul>
    </div>

    <!-- Card with Filters and Table -->
    <div class="card">
        <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-3">
            <!-- LEFT: Filters -->
            <form method="GET" class="d-flex flex-wrap align-items-center gap-3">
                <div class="d-flex align-items-center gap-2">
                    <span>Show</span>
                    <select class="form-select form-select-sm w-auto" name="per_page" onchange="this.form.submit()">
                        <option value="10" <?php echo ($perPage == 10) ? 'selected' : ''; ?>>10</option>
                        <option value="20" <?php echo ($perPage == 20) ? 'selected' : ''; ?>>20</option>
                        <option value="50" <?php echo ($perPage == 50) ? 'selected' : ''; ?>>50</option>
                        <option value="100" <?php echo ($perPage == 100) ? 'selected' : ''; ?>>100</option>
                    </select>
                </div>
                <div class="icon-field">
                    <input type="text" name="search" class="form-control form-control-sm w-auto" placeholder="Search" value="<?php echo htmlspecialchars($search); ?>">
                    <span class="icon">
                        <iconify-icon icon="ion:search-outline"></iconify-icon>
                    </span>
                </div>
                <button type="submit" class="btn btn-sm btn-primary-600">Search</button>
            </form>
            
            <!-- RIGHT: Main Action Button -->
            <div class="d-flex flex-wrap align-items-center gap-3">
                <a href="create.php" class="btn btn-sm btn-primary-600">
                    <iconify-icon icon="ri-add-line"></iconify-icon>
                    Add <?php echo $title; ?>
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <div class="table-responsive scroll-sm">
                <table class="table bordered-table mb-0">
                    <thead>
                        <tr>
                            <th scope="col" class="bg-transparent rounded-0">ID</th>
                            <th scope="col" class="bg-transparent rounded-0">Name</th>
                            <th scope="col" class="bg-transparent rounded-0">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch data with pagination
                        $stmt = $conn->prepare("SELECT * FROM species WHERE deleted_at IS NULL LIMIT ? OFFSET ?");
                        $stmt->execute([$perPage, $offset]);
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):
                        ?>
                        <tr>
                            <td><?php echo $row['species_id']; ?></td>
                            <td><?php echo htmlspecialchars($row['name_en']); ?></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <a href="view.php?id=<?php echo $row['species_id']; ?>" class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center" title="View">
                                        <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                                    </a>
                                    <a href="edit.php?id=<?php echo $row['species_id']; ?>" class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center" title="Edit">
                                        <iconify-icon icon="lucide:edit"></iconify-icon>
                                    </a>
                                    <a href="delete.php?id=<?php echo $row['species_id']; ?>" onclick="return confirm('Delete this species?');" class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center" title="Delete">
                                        <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mt-24">
                <span>Showing <?php echo $start; ?> to <?php echo $end; ?> of <?php echo $total; ?> entries</span>
                <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center">
                    <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link text-secondary-light fw-medium radius-4 border-0 px-10 py-10 d-flex align-items-center justify-content-center h-32-px w-32-px bg-base" href="?page=<?php echo $page - 1; ?>&per_page=<?php echo $perPage; ?>">
                            <iconify-icon icon="ep:d-arrow-left" class="text-xl"></iconify-icon>
                        </a>
                    </li>
                    <?php endif; ?>
                    
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item">
                        <a class="page-link <?php echo ($i == $page) ? 'bg-primary-600 text-white' : 'bg-primary-50 text-secondary-light'; ?> fw-medium radius-4 border-0 px-10 py-10 d-flex align-items-center justify-content-center h-32-px w-32-px" href="?page=<?php echo $i; ?>&per_page=<?php echo $perPage; ?>">
                            <?php echo $i; ?>
                    </a>
                    </li>
                    <?php endfor; ?>
                    
                    <?php if ($page < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link text-secondary-light fw-medium radius-4 border-0 px-10 py-10 d-flex align-items-center justify-content-center h-32-px w-32-px bg-base" href="?page=<?php echo $page + 1; ?>&per_page=<?php echo $perPage; ?>">
                            <iconify-icon icon="ep:d-arrow-right" class="text-xl"></iconify-icon>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php include dirname(__DIR__, 2) . '/include/layouts/layoutBottom.php'; ?>
```

---

## 8. Color System

**Reference**: [WowDash Colors](https://wowdash.wowtheme7.com/demo/colors.html)

### Color Naming Convention

WowDash uses a systematic color naming with shades from 50-900:

**Format**: `bg-{color}-{shade}` or `text-{color}-{shade}`

**Available Colors**:

- `primary` - Blue (#487FFF)
- `success` - Green (#22C55E)
- `info` - Cyan/Blue (#3B82F6)
- `warning` - Yellow (#EAB308)
- `danger` - Red (#EF4444)
- `lilac` - Purple/Lavender
- `neutral` - Gray (#737373)
- `cyan` - Light Blue
- `error` - Red (same as danger)

**Shades**: 50, 100, 200, 300, 400, 500, 600, 700, 800, 900

**Common Patterns**:

- `bg-primary-600` - Solid primary color
- `bg-primary-100` - Light tint (soft background)
- `text-primary-600` - Text color
- `bg-primary-light` - Very light variant
- `bg-primary-focus` - Focus/hover state
- `text-primary-main` - Main text variant

**Examples**:

```html
<!-- Background colors -->
<div class="bg-primary-600">Primary Solid</div>
<div class="bg-success-100">Success Light</div>
<div class="bg-danger-focus">Danger Focus</div>

<!-- Text colors -->
<span class="text-primary-600">Primary Text</span>
<span class="text-success-main">Success Text</span>
```

---

## 9. Button Components

**Reference**: [WowDash Buttons](https://wowdash.wowtheme7.com/demo/button.html)

### Default Buttons

**Solid Buttons**:

```html
<button type="button" class="btn btn-primary-600 radius-8 px-20 py-11">Primary</button>
<button type="button" class="btn btn-success-600 radius-8 px-20 py-11">Success</button>
<button type="button" class="btn btn-info-600 radius-8 px-20 py-11">Info</button>
<button type="button" class="btn btn-warning-600 radius-8 px-20 py-11">Warning</button>
<button type="button" class="btn btn-danger-600 radius-8 px-20 py-11">Danger</button>
<button type="button" class="btn btn-lilac-600 radius-8 px-20 py-11">Secondary</button>
```

**Outline Buttons**:

```html
<button type="button" class="btn btn-outline-primary-600 radius-8 px-20 py-11">Primary</button>
<button type="button" class="btn btn-outline-success-600 radius-8 px-20 py-11">Success</button>
```

**Rounded/Pill Buttons**:

```html
<button type="button" class="btn rounded-pill btn-primary-600 radius-8 px-20 py-11">Primary</button>
<button type="button" class="btn rounded-pill btn-outline-primary-600 radius-8 px-20 py-11">Primary</button>
```

**Soft Buttons** (Light background):

```html
<button type="button" class="btn rounded-pill btn-primary-100 text-primary-600 radius-8 px-20 py-11">Primary</button>
<button type="button" class="btn rounded-pill btn-success-100 text-success-600 radius-8 px-20 py-11">Success</button>
```

### Secondary Back/Utility Buttons (Standard)

- Avoid `btn-neutral-100 text-secondary-light` for back/utility; it renders too dull.
- Prefer soft primary or outline variants for clearer contrast:
  - Soft Primary Back: `bg-primary-50 text-primary-600` (anchor/button)
  - Outline Primary Back: `btn btn-outline-primary-600`
- General rule: use background-100/50 with text-600 to follow material-like contrast across the system.

**Text Buttons**:

```html
<button type="button" class="btn rounded-pill text-primary-600 radius-8 px-20 py-11">Primary</button>
<button type="button" class="btn rounded-pill text-success-600 radius-8 px-20 py-11">Success</button>
```

### Buttons with Icons

**Left Icon**:

```html
<button type="button" class="btn btn-primary-600 radius-8 px-20 py-11 d-flex align-items-center gap-2">
    <iconify-icon icon="ri-add-line" class="text-xl"></iconify-icon>
    Add Item
</button>
```

**Right Icon**:

```html
<button type="button" class="btn btn-success-600 radius-8 px-20 py-11 d-flex align-items-center gap-2">
    Save
    <iconify-icon icon="solar:check-circle-outline" class="text-xl"></iconify-icon>
</button>
```

**Icon Only**:

```html
<button type="button" class="btn btn-warning-600 radius-8 p-20 w-60-px h-50-px d-flex align-items-center justify-content-center">
    <iconify-icon icon="solar:settings-outline" class="text-xl"></iconify-icon>
</button>
```

### Button Sizes

**Large**: `px-20 py-11` (default)
**Medium**: `px-16 py-9`
**Small**: `px-14 py-6 text-sm`

```html
<button class="btn btn-primary-600 radius-8 px-20 py-11">Large Button</button>
<button class="btn btn-success-600 radius-8 px-16 py-9">Medium Button</button>
<button class="btn btn-warning-600 radius-8 px-14 py-6 text-sm">Small Button</button>
```

### Button Groups

```html
<div class="btn-group" role="group">
    <button type="button" class="btn btn-outline-primary-600 px-20 py-11 radius-8">Left</button>
    <button type="button" class="btn btn-outline-primary-600 px-20 py-11">Middle</button>
    <button type="button" class="btn btn-outline-primary-600 px-20 py-11 radius-8">Right</button>
</div>
```

---

## 10. Dropdown Components

**Reference**: [WowDash Dropdowns](https://wowdash.wowtheme7.com/demo/dropdown.html)

### Basic Dropdown

**Default Style**:

```html
<div class="dropdown">
    <button class="btn btn-primary-600 px-18 py-11 dropdown-toggle toggle-icon" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        Default Action
    </button>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="#">Action</a></li>
        <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="#">Primary action</a></li>
        <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="#">Something else</a></li>
    </ul>
</div>
```

**Outline Style**:

```html
<button class="btn btn-outline-primary-600 px-18 py-11 dropdown-toggle toggle-icon" type="button" data-bs-toggle="dropdown">
    Outline Action
</button>
```

**Focus Style** (Light background):

```html
<button class="btn btn-primary-600 bg-primary-50 border-primary-50 text-primary-600 hover-text-primary px-18 py-11 dropdown-toggle toggle-icon" type="button" data-bs-toggle="dropdown">
    Focus Action
</button>
```

**Text Style**:

```html
<button class="btn text-primary-600 hover-text-primary px-18 py-11 dropdown-toggle toggle-icon" type="button" data-bs-toggle="dropdown">
    Focus Action
</button>
```

### Dropdown Directions

**Dropup**:

```html
<div class="btn-group dropup">
    <button class="btn btn-primary-600 px-18 py-11 dropdown-toggle toggle-icon icon-up" type="button" data-bs-toggle="dropdown">
        Dropup Action
    </button>
    <ul class="dropdown-menu">
        <!-- items -->
    </ul>
</div>
```

**Dropright**:

```html
<div class="btn-group dropend">
    <button class="btn btn-warning-600 px-18 py-11 dropdown-toggle toggle-icon icon-right" type="button" data-bs-toggle="dropdown">
        Dropright Action
    </button>
    <ul class="dropdown-menu">
        <!-- items -->
    </ul>
</div>
```

**Dropleft**:

```html
<div class="btn-group dropstart">
    <button class="btn btn-warning-600 px-18 py-11 dropdown-toggle toggle-icon icon-left" type="button" data-bs-toggle="dropdown">
        Dropleft Action
    </button>
    <ul class="dropdown-menu">
        <!-- items -->
    </ul>
</div>
```

### Custom Dropdown Menu

```html
<ul class="dropdown-menu p-12 border bg-base shadow">
    <li>
        <button type="button" class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-10">
            <iconify-icon icon="hugeicons:view" class="icon text-lg line-height-1"></iconify-icon>
            View
        </button>
    </li>
    <li>
        <button type="button" class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-10">
            <iconify-icon icon="lucide:edit" class="icon text-lg line-height-1"></iconify-icon>
            Edit
        </button>
    </li>
    <li>
        <button type="button" class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-danger-100 text-hover-danger-600 d-flex align-items-center gap-10">
            <iconify-icon icon="fluent:delete-24-regular" class="icon text-lg line-height-1"></iconify-icon>
            Delete
        </button>
    </li>
</ul>
```

### Dropdown Sizes

**Default**: `px-18 py-11`
**Small**: `btn-sm`
**Large**: `btn-lg`

---

## 11. Pagination Components

**Reference**: [WowDash Pagination](https://wowdash.wowtheme7.com/demo/pagination.html)

### Default Solid Pagination

```html
<ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center">
    <!-- First/Previous -->
    <li class="page-item">
        <a class="page-link bg-primary-50 text-secondary-light fw-medium radius-8 border-0 px-20 py-10 d-flex align-items-center justify-content-center h-48-px" href="?page=1">First</a>
    </li>
    <li class="page-item">
        <a class="page-link bg-primary-50 text-secondary-light fw-medium radius-8 border-0 px-20 py-10 d-flex align-items-center justify-content-center h-48-px" href="?page=<?php echo $prevPage; ?>">Previous</a>
    </li>
    
    <!-- Icon Previous -->
    <li class="page-item">
        <a class="page-link bg-primary-50 text-secondary-light fw-medium radius-8 border-0 px-20 py-10 d-flex align-items-center justify-content-center h-48-px w-48-px" href="?page=<?php echo $prevPage; ?>">
            <iconify-icon icon="ep:d-arrow-left" class="text-xl"></iconify-icon>
        </a>
    </li>
    
    <!-- Page Numbers -->
    <li class="page-item">
        <a class="page-link bg-primary-50 text-secondary-light fw-medium radius-8 border-0 px-20 py-10 d-flex align-items-center justify-content-center h-48-px w-48-px" href="?page=1">1</a>
    </li>
    <li class="page-item">
        <a class="page-link bg-primary-600 text-white fw-medium radius-8 border-0 px-20 py-10 d-flex align-items-center justify-content-center h-48-px w-48-px" href="?page=2">2</a>
    </li>
    <li class="page-item">
        <a class="page-link bg-primary-50 text-secondary-light fw-medium radius-8 border-0 px-20 py-10 d-flex align-items-center justify-content-center h-48-px w-48-px" href="?page=3">3</a>
    </li>
    
    <!-- Icon Next -->
    <li class="page-item">
        <a class="page-link bg-primary-50 text-secondary-light fw-medium radius-8 border-0 px-20 py-10 d-flex align-items-center justify-content-center h-48-px w-48-px" href="?page=<?php echo $nextPage; ?>">
            <iconify-icon icon="ep:d-arrow-right" class="text-xl"></iconify-icon>
        </a>
    </li>
    
    <!-- Next/Last -->
    <li class="page-item">
        <a class="page-link bg-primary-50 text-secondary-light fw-medium radius-8 border-0 px-20 py-10 d-flex align-items-center justify-content-center h-48-px" href="?page=<?php echo $nextPage; ?>">Next</a>
    </li>
    <li class="page-item">
        <a class="page-link bg-primary-50 text-secondary-light fw-medium radius-8 border-0 px-20 py-10 d-flex align-items-center justify-content-center h-48-px" href="?page=<?php echo $totalPages; ?>">Last</a>
    </li>
</ul>
```

**Active Page**: `bg-primary-600 text-white`
**Inactive Page**: `bg-primary-50 text-secondary-light`

### Outline Pagination

```html
<a class="page-link bg-base border text-secondary-light fw-medium radius-8 border-0 px-20 py-10 d-flex align-items-center justify-content-center h-48-px" href="?page=1">Previous</a>
```

---

## 12. Badge Components

**Reference**: [WowDash Badges](https://wowdash.wowtheme7.com/demo/badges.html)

### Default Badges

```html
<span class="badge text-sm fw-semibold bg-primary-600 px-20 py-9 radius-4 text-white">Primary</span>
<span class="badge text-sm fw-semibold bg-success-600 px-20 py-9 radius-4 text-white">Success</span>
<span class="badge text-sm fw-semibold bg-info-600 px-20 py-9 radius-4 text-white">Info</span>
<span class="badge text-sm fw-semibold bg-warning-600 px-20 py-9 radius-4 text-white">Warning</span>
<span class="badge text-sm fw-semibold bg-danger-600 px-20 py-9 radius-4 text-white">Danger</span>
```

### Outline Badges

```html
<span class="badge text-sm fw-semibold border border-primary-600 text-primary-600 bg-transparent px-20 py-9 radius-4">Primary</span>
<span class="badge text-sm fw-semibold border border-success-600 text-success-600 bg-transparent px-20 py-9 radius-4">Success</span>
```

### Soft Badges

```html
<span class="badge text-sm fw-semibold text-primary-600 bg-primary-100 px-20 py-9 radius-4">Primary</span>
<span class="badge text-sm fw-semibold text-success-600 bg-success-100 px-20 py-9 radius-4">Success</span>
```

### Pill Badges (Rounded)

```html
<span class="badge text-sm fw-semibold rounded-pill bg-primary-600 px-20 py-9 radius-4 text-white">Primary</span>
<span class="badge text-sm fw-semibold rounded-pill bg-success-600 px-20 py-9 radius-4 text-white">Success</span>
```

### Status Badges (Common Pattern)

```html
<!-- Completed/Paid -->
<span class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Paid</span>

<!-- Pending -->
<span class="bg-warning-focus text-warning-main px-24 py-4 rounded-pill fw-medium text-sm">Pending</span>

<!-- Canceled/Deleted -->
<span class="bg-danger-focus text-danger-main px-24 py-4 rounded-pill fw-medium text-sm">Canceled</span>
```

---

## 13. Tag Components

**Reference**: [WowDash Tags](https://wowdash.wowtheme7.com/demo/tags.html)

### Default Tags

```html
<ul class="d-flex flex-wrap align-items-center gap-32">
    <li class="text-secondary-light border radius-4 px-8 py-4 text-sm line-height-1 fw-medium">Label</li>
    <li class="text-secondary-light border radius-4 px-8 py-4 text-sm line-height-1 fw-medium">Label</li>
    <li class="text-secondary-light border radius-4 px-8 py-4 text-sm line-height-1 fw-medium">Label</li>
</ul>
```

### Colored Tags

```html
<ul class="d-flex flex-wrap align-items-center gap-32">
    <li class="text-white bg-primary-600 border border-primary-600 radius-4 px-8 py-4 text-sm line-height-1 fw-medium">Label</li>
    <li class="text-white bg-lilac-600 border border-lilac-600 radius-4 px-8 py-4 text-sm line-height-1 fw-medium">Label</li>
    <li class="text-white bg-warning-600 border border-warning-600 radius-4 px-8 py-4 text-sm line-height-1 fw-medium">Label</li>
</ul>
```

### Removable Tags

```html
<ul class="tag-list d-flex flex-wrap align-items-center gap-20">
    <li class="text-secondary-light border radius-4 px-8 py-2 text-sm line-height-1 fw-medium d-flex align-items-center gap-1">
        Label
        <button class="remove-tag text-lg d-flex justify-content-center align-items-center" type="button">
            <iconify-icon icon="iconamoon:sign-times-light" class="icon line-height-1"></iconify-icon>
        </button>
    </li>
</ul>
```

### Tags with Images

```html
<li class="text-secondary-light border radius-4 px-8 py-4 text-sm line-height-1 fw-medium d-flex align-items-center gap-1">
    <img src="assets/images/flags/flag-tag.png" class="w-16-px h-16-px rounded-circle" alt="">
    Label
</li>
```

**JavaScript for Removal**:

```javascript
$(".remove-tag").on("click", function() {
    $(this).closest("li").remove();
});
```

---

## 14. Calendar Components

**Reference**: [WowDash Calendar](https://wowdash.wowtheme7.com/demo/calendar.html)

### Calendar Event Item

```html
<div class="event-item d-flex align-items-center justify-content-between gap-4 pb-16 mb-16 border border-start-0 border-end-0 border-top-0">
    <div>
        <div class="d-flex align-items-center gap-10">
            <span class="w-12-px h-12-px bg-warning-600 rounded-circle fw-medium"></span>
            <span class="text-secondary-light">Today, 10:30 PM - 02:30 AM</span>
        </div>
        <span class="text-primary-light fw-semibold text-md mt-4">Design Conference</span>
    </div>
    <div class="dropdown">
        <button type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <iconify-icon icon="entypo:dots-three-vertical" class="icon text-secondary-light"></iconify-icon>
        </button>
        <ul class="dropdown-menu p-12 border bg-base shadow">
            <li>
                <button type="button" class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-10">
                    <iconify-icon icon="hugeicons:view" class="icon text-lg line-height-1"></iconify-icon>
                    View
                </button>
            </li>
            <li>
                <button type="button" class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-10">
                    <iconify-icon icon="lucide:edit" class="icon text-lg line-height-1"></iconify-icon>
                    Edit
                </button>
            </li>
            <li>
                <button type="button" class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-danger-100 text-hover-danger-600 d-flex align-items-center gap-10">
                    <iconify-icon icon="fluent:delete-24-regular" class="icon text-lg line-height-1"></iconify-icon>
                    Delete
                </button>
            </li>
        </ul>
    </div>
</div>
```

### Date Picker (Flatpickr)

```html
<input type="text" id="startDate" class="form-control" placeholder="Select Date">
<input type="text" id="endDate" class="form-control" placeholder="Select Date">

<script src="assets/js/flatpickr.js"></script>
<script>
function getDatePicker(receiveID) {
    flatpickr(receiveID, {
        enableTime: true,
        dateFormat: "d/m/Y H:i",
    });
}
getDatePicker("#startDate");
getDatePicker("#endDate");
</script>
```

### Full Calendar Integration

The template uses FullCalendar.js. See `template/calendar.php` for full implementation.

---

## 15. KPI Card Components

**Pattern**: `bg-gradient-start-{1-12}` or `bg-gradient-end-{1-12}`

### KPI Card Structure

```html
<div class="col">
    <div class="card shadow-none border bg-gradient-start-1 h-100">
        <div class="card-body p-20">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                <!-- Left: Label and Value -->
                <div>
                    <p class="fw-medium text-primary-light mb-1">Total Users</p>
                    <h6 class="mb-0">20,000</h6>
                </div>
                
                <!-- Right: Icon Circle -->
                <div class="w-50-px h-50-px bg-cyan rounded-circle d-flex justify-content-center align-items-center">
                    <iconify-icon icon="gridicons:multiple-users" class="text-white text-2xl mb-0"></iconify-icon>
                </div>
            </div>
            
            <!-- Trend Indicator -->
            <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                <span class="d-inline-flex align-items-center gap-1 text-success-main">
                    <iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon>
                    +5000
                </span>
                Last 30 days users
            </p>
        </div>
    </div>
</div>
```

### Alternative KPI Card Structure (Medical Dashboard Style)

```html
<div class="col-xxl-3 col-xl-4 col-sm-6">
    <div class="card p-3 shadow-2 radius-8 h-100 bg-gradient-end-6">
        <div class="card-body p-0">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                <div class="d-flex align-items-center gap-2">
                    <!-- Icon Circle -->
                    <span class="mb-0 w-48-px h-48-px bg-cyan-100 text-cyan-600 flex-shrink-0 text-white d-flex justify-content-center align-items-center rounded-circle h6 mb-0">
                        <iconify-icon icon="ri-group-fill" class="text-xl"></iconify-icon>
                    </span>
                    <!-- Value and Label -->
                    <div>
                        <h6 class="fw-semibold mb-2">650</h6>
                        <span class="fw-medium text-secondary-light text-sm">Doctors</span>
                    </div>
                </div>
            </div>
            <!-- Sub-metric -->
            <p class="text-sm mb-0">
                <span class="text-cyan-600">4</span> Doctors joined this week
            </p>
        </div>
    </div>
</div>
```

### KPI Card Classes

**Card Container**:

- `card shadow-none border` (or `shadow-2` for stronger shadow)
- `bg-gradient-start-{1-12}` or `bg-gradient-end-{1-12}`
- `h-100` (full height)
- `radius-8` (optional)

**Card Body**:

- `card-body p-20` (or `p-3` for compact)

**Icon Circle**:

- `w-50-px h-50-px` (or `w-48-px h-48-px`)
- `bg-{color}` or `bg-{color}-100` (matching gradient theme)
- `rounded-circle`
- `d-flex justify-content-center align-items-center`

**Trend Indicators**:

- Up: `text-success-main` with `bxs:up-arrow` icon
- Down: `text-danger-main` with `bxs:down-arrow` icon
- Neutral: `text-secondary-light`

---

## 16. Expanded Gradient System (12 Shades)

### Current WowDash Gradients (5-6 shades)

**bg-gradient-start-{1-5}** (Left to Right):

- `bg-gradient-start-1`: `#E6F9FF → #FEFFFF` (Cyan)
- `bg-gradient-start-2`: `#F7E9FF → #FFFEFD` (Lavender)
- `bg-gradient-start-3`: `#E6EBFF → #FFFFFF` (Light Blue)
- `bg-gradient-start-4`: `#E8FFF5 → #FFFFFF` (Mint Green)
- `bg-gradient-start-5`: `#FFEEEE → #FFFCFC` (Soft Pink)

**bg-gradient-end-{1-6}** (Left to Right):

- `bg-gradient-end-1`: `#FFFFFF → #EFF4FF` (Light Blue)
- `bg-gradient-end-2`: `#FFFFFF → #EAFFF9` (Mint)
- `bg-gradient-end-3`: `#FFFFFF → #FFF5E9` (Peach)
- `bg-gradient-end-4`: `#FFFFFF → #F3EEFF` (Lavender)
- `bg-gradient-end-5`: `#FFFFFF → #FFF2FE` (Pink)
- `bg-gradient-end-6`: `#FFFFFF → #EEFBFF` (Cyan)

### Proposed Expanded System (12 Shades)

**bg-gradient-start-{1-12}** (Left to Right, Light Pastels):

```css
/* Existing 5 */
.bg-gradient-start-1 { background: linear-gradient(to right, #E6F9FF, #FEFFFF); } /* Cyan */
.bg-gradient-start-2 { background: linear-gradient(to right, #F7E9FF, #FFFEFD); } /* Lavender */
.bg-gradient-start-3 { background: linear-gradient(to right, #E6EBFF, #FFFFFF); } /* Light Blue */
.bg-gradient-start-4 { background: linear-gradient(to right, #E8FFF5, #FFFFFF); } /* Mint Green */
.bg-gradient-start-5 { background: linear-gradient(to right, #FFEEEE, #FFFCFC); } /* Soft Pink */

/* New 7 shades - Pleasant hues */
.bg-gradient-start-6 { background: linear-gradient(to right, #FFF8E6, #FFFFFF); } /* Soft Yellow */
.bg-gradient-start-7 { background: linear-gradient(to right, #E8F5E9, #FFFFFF); } /* Light Green */
.bg-gradient-start-8 { background: linear-gradient(to right, #E3F2FD, #FFFFFF); } /* Sky Blue */
.bg-gradient-start-9 { background: linear-gradient(to right, #F3E5F5, #FFFFFF); } /* Light Purple */
.bg-gradient-start-10 { background: linear-gradient(to right, #FFF3E0, #FFFFFF); } /* Warm Orange */
.bg-gradient-start-11 { background: linear-gradient(to right, #E0F7FA, #FFFFFF); } /* Aqua */
.bg-gradient-start-12 { background: linear-gradient(to right, #F1F8E9, #FFFFFF); } /* Lime Green */
```

**bg-gradient-end-{1-12}** (Left to Right, White to Light):

```css
/* Existing 6 */
.bg-gradient-end-1 { background: linear-gradient(to right, #FFFFFF, #EFF4FF); } /* Light Blue */
.bg-gradient-end-2 { background: linear-gradient(to right, #FFFFFF, #EAFFF9); } /* Mint */
.bg-gradient-end-3 { background: linear-gradient(to right, #FFFFFF, #FFF5E9); } /* Peach */
.bg-gradient-end-4 { background: linear-gradient(to right, #FFFFFF, #F3EEFF); } /* Lavender */
.bg-gradient-end-5 { background: linear-gradient(to right, #FFFFFF, #FFF2FE); } /* Pink */
.bg-gradient-end-6 { background: linear-gradient(to right, #FFFFFF, #EEFBFF); } /* Cyan */

/* New 6 shades - Pleasant hues */
.bg-gradient-end-7 { background: linear-gradient(to right, #FFFFFF, #F0FDF4); } /* Light Green */
.bg-gradient-end-8 { background: linear-gradient(to right, #FFFFFF, #EFF6FF); } /* Sky Blue */
.bg-gradient-end-9 { background: linear-gradient(to right, #FFFFFF, #F5F3FF); } /* Light Purple */
.bg-gradient-end-10 { background: linear-gradient(to right, #FFFFFF, #FFF7ED); } /* Warm Orange */
.bg-gradient-end-11 { background: linear-gradient(to right, #FFFFFF, #ECFEFF); } /* Aqua */
.bg-gradient-end-12 { background: linear-gradient(to right, #FFFFFF, #F7FEE7); } /* Lime Green */
```

### Color Palette Summary

**12 Shades** (Pleasant, Light Hues):

1. **Cyan** - `#E6F9FF` / `#EEFBFF`
2. **Lavender** - `#F7E9FF` / `#F3EEFF`
3. **Light Blue** - `#E6EBFF` / `#EFF4FF`
4. **Mint Green** - `#E8FFF5` / `#EAFFF9`
5. **Soft Pink** - `#FFEEEE` / `#FFF2FE`
6. **Soft Yellow** - `#FFF8E6` / `#FFF7ED`
7. **Light Green** - `#E8F5E9` / `#F0FDF4`
8. **Sky Blue** - `#E3F2FD` / `#EFF6FF`
9. **Light Purple** - `#F3E5F5` / `#F5F3FF`
10. **Warm Orange** - `#FFF3E0` / `#FFF7ED`
11. **Aqua** - `#E0F7FA` / `#ECFEFF`
12. **Lime Green** - `#F1F8E9` / `#F7FEE7`

### Usage Guidelines

1. **System-wide enforcement**: Use these 12 shades consistently across all KPI cards
2. **Pleasant hues only**: All gradients are light pastels - no heavy/saturated colors
3. **Icon matching**: Match icon circle background color to gradient theme
   - Example: `bg-gradient-start-1` (cyan) → icon circle `bg-cyan` or `bg-cyan-100`
4. **Semantic usage** (optional):
   - Revenue/Financial: Cyan, Light Blue, Sky Blue
   - Success/Positive: Mint Green, Light Green, Lime Green
   - Users/People: Lavender, Light Purple
   - Warning/Attention: Soft Yellow, Warm Orange
   - Alerts/Info: Soft Pink, Aqua

### Implementation

Add these CSS classes to your custom stylesheet or extend `template/assets/css/style.css`:

```css
/* Add to admin/assets/libs/css/style.css or custom CSS file */
.bg-gradient-start-6 { background: linear-gradient(to right, #FFF8E6, #FFFFFF); }
.bg-gradient-start-7 { background: linear-gradient(to right, #E8F5E9, #FFFFFF); }
.bg-gradient-start-8 { background: linear-gradient(to right, #E3F2FD, #FFFFFF); }
.bg-gradient-start-9 { background: linear-gradient(to right, #F3E5F5, #FFFFFF); }
.bg-gradient-start-10 { background: linear-gradient(to right, #FFF3E0, #FFFFFF); }
.bg-gradient-start-11 { background: linear-gradient(to right, #E0F7FA, #FFFFFF); }
.bg-gradient-start-12 { background: linear-gradient(to right, #F1F8E9, #FFFFFF); }

.bg-gradient-end-7 { background: linear-gradient(to right, #FFFFFF, #F0FDF4); }
.bg-gradient-end-8 { background: linear-gradient(to right, #FFFFFF, #EFF6FF); }
.bg-gradient-end-9 { background: linear-gradient(to right, #FFFFFF, #F5F3FF); }
.bg-gradient-end-10 { background: linear-gradient(to right, #FFFFFF, #FFF7ED); }
.bg-gradient-end-11 { background: linear-gradient(to right, #FFFFFF, #ECFEFF); }
.bg-gradient-end-12 { background: linear-gradient(to right, #FFFFFF, #F7FEE7); }
```

---

## 17. Language Switcher (Simplified)

**Pattern**: Flag icon + Language name (no card header, no radio buttons)

### Simplified Language Switcher Structure

```html
<div class="dropdown d-none d-sm-inline-block">
    <button class="has-indicator w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center" type="button" data-bs-toggle="dropdown" id="languageDropdown" title="Change Language">
        <img src="<?php echo IMAGE_BASE_URL; ?>/flags/<?php echo get_current_language() === 'ar' ? 'lb.png' : (get_current_language() === 'fr' ? 'fr.png' : 'us.png'); ?>" alt="Language" class="w-24 h-24 object-fit-cover rounded-circle">
    </button>
    <div class="dropdown-menu to-top dropdown-menu-sm p-8">
        <a class="dropdown-item language-option d-flex align-items-center gap-2 px-12 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="#" data-lang="en">
            <img src="<?php echo IMAGE_BASE_URL; ?>/flags/us.png" alt="English" class="w-20-px h-16-px object-fit-cover rounded flex-shrink-0">
            <span class="fw-medium"><?php echo t('english') ?: 'English'; ?></span>
        </a>
        <a class="dropdown-item language-option d-flex align-items-center gap-2 px-12 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="#" data-lang="fr">
            <img src="<?php echo IMAGE_BASE_URL; ?>/flags/fr.png" alt="Français" class="w-20-px h-16-px object-fit-cover rounded flex-shrink-0">
            <span class="fw-medium"><?php echo t('french') ?: 'Français'; ?></span>
        </a>
        <a class="dropdown-item language-option d-flex align-items-center gap-2 px-12 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="#" data-lang="ar">
            <img src="<?php echo IMAGE_BASE_URL; ?>/flags/lb.png" alt="العربية" class="w-20-px h-16-px object-fit-cover rounded flex-shrink-0">
            <span class="fw-medium"><?php echo t('arabic') ?: 'العربية'; ?></span>
        </a>
    </div>
</div>
```

### Key Features

- **No card header** - Removed "Choose Your Language" header card
- **No radio buttons** - Simple clickable dropdown items
- **Flag + Language Name** - Clean, minimal design
- **Flag size**: `w-20-px h-16-px` (maintains aspect ratio)
- **Gap**: `gap-2` between flag and text
- **Hover**: `bg-hover-neutral-200 text-hover-neutral-900`

---

## 18. Monochrome Mode

**Purpose**: Reduces eye strain by limiting color constraints, useful for extended use and accessibility

### Implementation

**Toggle Button** (in navbar):

```html
<button type="button" class="w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center" id="monochromeToggle" title="Toggle Monochrome Mode">
    <iconify-icon icon="tabler:palette" id="monochromeIcon" class="text-primary-light text-xl"></iconify-icon>
</button>
```

**CSS Class Applied**: `.monochrome-mode` on `<body>`

**JavaScript** (in scripts.php):

```javascript
var monochromeToggle = document.getElementById('monochromeToggle');
var isMonochrome = localStorage.getItem('monochromeMode') === 'true';

if (monochromeToggle) {
    if (isMonochrome) {
        document.body.classList.add('monochrome-mode');
    }
    
    monochromeToggle.addEventListener('click', function(e) {
        e.preventDefault();
        isMonochrome = !isMonochrome;
        if (isMonochrome) {
            document.body.classList.add('monochrome-mode');
            localStorage.setItem('monochromeMode', 'true');
        } else {
            document.body.classList.remove('monochrome-mode');
            localStorage.setItem('monochromeMode', 'false');
        }
    });
}
```

**CSS Effect**: Applies `filter: grayscale(100%)` to body when active

---

## 19. Form Field Size Adjustments

**Purpose**: Compact form fields for multi-column layouts in medical modules. WowDash default fields are too large for efficient multi-column forms.

### Size Classes

**Small Compact** (`form-control-sm-compact`):

- Padding: `8px 12px`
- Font size: `0.875rem`
- Min height: `36px`
- Border radius: `6px`

**Extra Small** (`form-control-xs`):

- Padding: `6px 10px`
- Font size: `0.813rem`
- Min height: `32px`
- Border radius: `4px`

### Usage Examples

**3-Column Medical Form**:

```html
<div class="row form-row-compact">
    <div class="col-md-4">
        <label class="form-label-sm">Patient Name</label>
        <input type="text" class="form-control form-control-sm-compact" name="patient_name">
    </div>
    <div class="col-md-4">
        <label class="form-label-sm">Age</label>
        <input type="number" class="form-control form-control-sm-compact" name="age">
    </div>
    <div class="col-md-4">
        <label class="form-label-sm">Weight (kg)</label>
        <input type="number" class="form-control form-control-sm-compact" name="weight">
    </div>
</div>
```

**4-Column Compact Form**:

```html
<div class="row form-row-compact">
    <div class="col-md-3">
        <label class="form-label-xs">Field 1</label>
        <input type="text" class="form-control form-control-xs" name="field1">
    </div>
    <div class="col-md-3">
        <label class="form-label-xs">Field 2</label>
        <select class="form-select form-select-xs" name="field2">
            <option>Option 1</option>
        </select>
    </div>
    <div class="col-md-3">
        <label class="form-label-xs">Field 3</label>
        <input type="date" class="form-control form-control-xs" name="field3">
    </div>
    <div class="col-md-3">
        <label class="form-label-xs">Field 4</label>
        <input type="text" class="form-control form-control-xs" name="field4">
    </div>
</div>
```

### Available Classes

**Input Fields**:

- `.form-control-sm-compact` - Small compact (36px height)
- `.form-control-xs` - Extra small (32px height)

**Select Fields**:

- `.form-select-sm-compact` - Small compact select
- `.form-select-xs` - Extra small select

**Labels**:

- `.form-label-sm` - Small label (0.875rem)
- `.form-label-xs` - Extra small label (0.813rem)

**Layout Helpers**:

- `.form-row-compact` - Compact row with reduced margins
- `.form-group-compact` - Compact form group (16px margin)
- `.form-section-compact` - Compact section (24px margin)
- `.card-body-compact` - Compact card body (16px padding)
- `.card-body-compact-sm` - Smaller card body (12px padding)

**Input Groups**:

- `.input-group-sm-compact` - Compact input group (36px)
- `.input-group-xs` - Extra small input group (32px)

### Responsive Behavior

On mobile (≤768px), fields automatically increase to minimum 40px/36px for better touch targets.

---

## Summary of Rules

1. ❌ **NO h1-h6 tags** - Use `<strong><p>` for titles
2. ✅ **Page Header**: Title (left) + Breadcrumb (right) with `mb-24`
3. ✅ **Card Header**: Filters/Search (left) + Main Action Button (right)
4. ✅ **Action Buttons**: Circular `w-32-px h-32-px` with iconify icons
5. ✅ **Size Selector**: 10, 20, 50, 100 options in card-header
6. ✅ **Pagination**: Below table with "Showing X to Y of Z entries"
7. ✅ **Color Variants**: Change `bg-{color}-focus text-{color}-main` for different button colors
8. ✅ **Iconify Icons**: Endless possibilities - use appropriate icons per action

---

**Reference**: [WowDash Invoice List](https://wowdash.wowtheme7.com/demo/invoice-list.html)

---

## 20. Unified Component System

**Purpose**: Standardize avatar displays, phone number formatting, and service rules across the entire platform for consistency and maintainability.

### Component Utility Functions

All component utilities are located in `admin/include/service_utils.php`:

- `getSpeciesIcon($speciesCode)` - Returns Iconify icon for species
- `getBreedIcon($breedCode, $speciesCode)` - Returns Iconify icon for breed (falls back to species)
- `getBreedColor($speciesCode)` - Returns color scheme for breed avatars
- `getServiceIcon($code, $name)` - Returns Iconify icon for service
- `getServiceColor($code, $name)` - Returns color scheme for service avatars

Phone formatting function is located in `admin/index.php` (can be moved to a shared utility):

- `formatPhoneLebanon($rawPhone)` - Formats Lebanese phone numbers

---

## 21. Species Avatar Component

**Purpose**: Display species identification with photo fallback to icon.

### Standard Structure

```php
<?php
require_once(dirname(__DIR__, 2) . '/admin/include/service_utils.php');

$speciesCode = $row['species_code'] ?? '';
$petPhoto = !empty($row['photo_path']) ? BASE_URL . $row['photo_path'] : '';
$speciesIcon = getSpeciesIcon($speciesCode);
$speciesColor = ['bg' => '#BBDEFB', 'text' => '#1976D2', 'border' => '#1976D2']; // Default blue

// Species avatar HTML
$speciesAvatarHtml = '';
if ($petPhoto) {
    $speciesAvatarHtml = '<img src="'.htmlspecialchars($petPhoto).'" alt="'.htmlspecialchars($petName).'" style="width: 32px; height: 32px; object-fit: cover; border-radius: 50%; border: 2px solid '.htmlspecialchars($speciesColor['border']).'; flex-shrink: 0;" onerror="this.onerror=null; this.nextElementSibling.style.display=\'flex\';">';
}
$speciesAvatarHtml .= '<div style="'.($petPhoto ? 'display: none; ' : '').'width: 32px; height: 32px; background: linear-gradient(135deg, '.htmlspecialchars($speciesColor['bg']).' 0%, '.htmlspecialchars($speciesColor['bg']).' 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 2px solid '.htmlspecialchars($speciesColor['border']).'; flex-shrink: 0;">';
$speciesAvatarHtml .= '<iconify-icon icon="'.htmlspecialchars($speciesIcon).'" style="font-size: 16px; color: '.htmlspecialchars($speciesColor['text']).';"></iconify-icon>';
$speciesAvatarHtml .= '</div>';

echo $speciesAvatarHtml;
?>
```

### Size Variations

**Small (24px)** - Used in compact lists:

```php
// Width/height: 24px, icon size: 12px, border: 1px
```

**Medium (32px)** - Standard size for most displays:

```php
// Width/height: 32px, icon size: 16px, border: 2px
```

**Large (40px)** - Used in detailed views:

```php
// Width/height: 40px, icon size: 20px, border: 2px
```

### Service-Specific Color Coding

When species avatar is used in service context (appointments, bookings), use service color:

```php
$serviceColor = getServiceColor($serviceCode, $serviceName);
// Apply service color to species avatar border and background
```

### Usage Examples

**Dashboard Widgets**:

```php
<div class="d-flex align-items-center gap-2">
    <?= $speciesAvatarHtml ?>
    <div>
        <strong><?= htmlspecialchars($petName) ?></strong>
        <br><small><?= htmlspecialchars($speciesName) ?></small>
    </div>
</div>
```

**Table Cells**:

```php
<td>
    <div class="d-flex align-items-center gap-2">
        <?= $speciesAvatarHtml ?>
        <div>
            <strong><?= htmlspecialchars($petName) ?></strong>
            <br><small><?= htmlspecialchars($speciesName) ?> • <?= htmlspecialchars($breedName) ?></small>
        </div>
    </div>
</td>
```

---

## 22. Breed Avatar Component

**Purpose**: Display breed identification alongside species avatar. Uses actual breed images from the `breed.image_url` field when available.

### Standard Structure

```php
<?php
$breedCode = $row['breed_code'] ?? '';
$breedImageUrl = !empty($row['breed_image_url']) ? BASE_URL . $row['breed_image_url'] : '';
$speciesCode = $row['species_code'] ?? '';
$breedIcon = getBreedIcon($breedCode, $speciesCode);
$breedColor = getBreedColor($speciesCode);

// Breed avatar (32px, same size as species) - use breed image if available, otherwise icon
$breedAvatarHtml = '';
if ($breedName) {
    if ($breedImageUrl) {
        // Use actual breed image from database (only show if image loads successfully)
        $breedAvatarHtml = '<img src="'.htmlspecialchars($breedImageUrl).'" alt="'.htmlspecialchars($breedName).'" style="width: 32px; height: 32px; object-fit: cover; border-radius: 50%; border: 2px solid '.htmlspecialchars($breedColor['border']).'; flex-shrink: 0; margin-left: 8px;" onerror="this.style.display=\'none\'; this.nextElementSibling.style.display=\'flex\';">';
    }
    // Fallback to icon-based avatar (only show if no image or image fails)
    $breedAvatarHtml .= '<div style="'.($breedImageUrl ? 'display: none; ' : '').'width: 32px; height: 32px; background: linear-gradient(135deg, '.htmlspecialchars($breedColor['bg']).' 0%, '.htmlspecialchars($breedColor['bg']).' 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 2px solid '.htmlspecialchars($breedColor['border']).'; flex-shrink: 0; margin-left: 8px;">';
    $breedAvatarHtml .= '<iconify-icon icon="'.htmlspecialchars($breedIcon).'" style="font-size: 16px; color: '.htmlspecialchars($breedColor['text']).';"></iconify-icon>';
    $breedAvatarHtml .= '</div>';
}

echo $breedAvatarHtml;
?>
```

### Size Guidelines

- **Standard**: 32px × 32px (same size as species avatar)
- **Icon size**: 16px
- **Border**: 2px solid
- **Spacing**: 8px margin-left from species avatar

### Usage Pattern

**Always display breed avatar next to species avatar**:

```php
<div class="d-flex align-items-center gap-2">
    <?= $speciesAvatarHtml ?>
    <?= htmlspecialchars($speciesName) ?>
    <?= $breedAvatarHtml ?>
    <br><small><?= htmlspecialchars($breedName) ?></small>
</div>
```

---

## 23. Service Avatar Component

**Purpose**: Display service identification with icon and color coding.

### Standard Structure

```php
<?php
$serviceCode = $row['service_code'] ?? '';
$serviceName = $row['service_name'] ?? '';
$serviceIcon = getServiceIcon($serviceCode, $serviceName);
$serviceColor = getServiceColor($serviceCode, $serviceName);

// Service icon with color
$serviceIconHtml = '<div style="width: 24px; height: 24px; background: '.htmlspecialchars($serviceColor['bg']).'; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; border: 1px solid '.htmlspecialchars($serviceColor['border']).'; margin-right: 8px; flex-shrink: 0;">';
$serviceIconHtml .= '<iconify-icon icon="'.htmlspecialchars($serviceIcon).'" style="font-size: 12px; color: '.htmlspecialchars($serviceColor['text']).';"></iconify-icon>';
$serviceIconHtml .= '</div>';

echo $serviceIconHtml;
?>
```

### Service Color Mapping

Services have unique color schemes stored in `getServiceColor()`:

- **Wellness Exam (WE)**: Blue (`#BBDEFB` / `#1976D2`)
- **Grooming (SG)**: Purple (`#E1BEE7` / `#7B1FA2`)
- **Vaccination (CV/RV)**: Green (`#C8E6C9` / `#2E7D32`)
- **Dental (DC)**: Orange (`#FFE0B2` / `#E65100`)
- **Boarding (DB)**: Teal (`#B2DFDB` / `#00695C`)
- **Surgery**: Red (`#FFCDD2` / `#C62828`)

### Usage in Appointments/Bookings

```php
<div class="d-flex align-items-center gap-2">
    <?= $serviceIconHtml ?>
    <strong><?= htmlspecialchars($serviceName) ?></strong>
</div>
```

---

## 24. Phone Number Formatting Component

**Purpose**: Standardize Lebanese phone number display across the platform.

### Standard Function

```php
/**
 * Formats Lebanese phone numbers: +961 [operator] [pairs of digits]
 * Examples: +961 3 03 58 93 or +961 70 12 34 56
 * 
 * @param string $rawPhone Raw phone number (can be any format)
 * @return string Formatted phone number or empty string
 */
function formatPhoneLebanon($rawPhone) {
    $raw = (string)$rawPhone;
    if ($raw === '') { return ''; }
    $digits = preg_replace('/\D+/', '', $raw);
    if ($digits === '') { return ''; }
    
    // Normalize leading zeros (e.g., 03xxxxxx -> 3xxxxxx)
    if (strpos($digits, '00') === 0) { $digits = substr($digits, 2); }
    if (strpos($digits, '0') === 0) { $digits = ltrim($digits, '0'); }
    
    // If already formatted with + and spaces, keep as-is
    if (strpos($raw, '+') === 0 && preg_match('/\+\d+\s+\d+/', $raw)) { return $raw; }
    
    // Extract country code 961 if present
    if (strpos($digits, '961') === 0) {
        $cc = '961';
        $rest = substr($digits, 3);
    } else {
        $cc = '961';
        $rest = $digits;
    }
    
    if ($rest === '') { return '+'.$cc; }
    
    // Known 2-digit mobile operator codes in Lebanon
    $twoDigitOps = ['70','71','76','78','79','81'];
    
    // Check for 2-digit operator first
    if (strlen($rest) >= 2 && in_array(substr($rest,0,2), $twoDigitOps, true)) {
        $op = substr($rest,0,2);
        $num = substr($rest,2);
        // Group remaining digits in pairs
        return '+'.$cc.' '.$op.' '.trim(chunk_split($num,2,' '));
    }
    
    // 1-digit mobile operator (e.g., 3)
    if (strlen($rest) >= 1) {
        $op = substr($rest,0,1);
        $num = substr($rest,1);
        // Group remaining digits in pairs
        return '+'.$cc.' '.$op.' '.trim(chunk_split($num,2,' '));
    }
    
    // Fallback: group all digits in pairs
    return '+'.$cc.' '.trim(chunk_split($rest,2,' '));
}
```

### Usage Pattern

**Always format phone numbers before display**:

```php
<?php
$rawPhone = $row['phone'] ?? '';
$formattedPhone = formatPhoneLebanon($rawPhone);
?>

<small>
    <?= htmlspecialchars($customerName) ?>
    <?php if ($formattedPhone): ?>
        • <?= htmlspecialchars($formattedPhone) ?>
    <?php endif; ?>
</small>
```

### Display Format

**Standard Layout**:

```html
<br><small>Customer Name • +961 3 03 58 93</small>
```

**In Tables**:

```html
<td>
    <strong>Pet Name</strong>
    <br><small>Species • Breed</small>
    <br><small>Customer Name • +961 3 03 58 93</small>
</td>
```

---

## 25. Service Availability Rules Component

**Purpose**: Filter services based on species compatibility (e.g., vet doesn't deal with cats).

### Database Structure

Services have availability rules stored in `service_availability_rule` table:

```sql
CREATE TABLE service_availability_rule (
    service_id INT,
    species_id INT,
    -- If a rule exists, only that species is allowed
    -- If no rules exist, service is available to all species
);
```

### Query Pattern

**Check if service is available for species**:

```php
<?php
// Check if service has availability rules
$hasRules = $conn->prepare("SELECT COUNT(*) FROM service_availability_rule WHERE service_id = ?");
$hasRules->execute([$serviceId]);
$ruleCount = $hasRules->fetchColumn();

if ($ruleCount > 0) {
    // Service has rules - check if species is allowed
    $allowed = $conn->prepare("SELECT COUNT(*) FROM service_availability_rule WHERE service_id = ? AND species_id = ?");
    $allowed->execute([$serviceId, $speciesId]);
    $isAllowed = $allowed->fetchColumn() > 0;
    
    if (!$isAllowed) {
        // Service not available for this species
        continue; // Skip this service
    }
}
// Service is available (either no rules or species is allowed)
?>
```

### Usage in Appointments

```php
<?php
// When displaying available services for appointment booking
$services = $conn->query("SELECT * FROM service WHERE active = 1");
foreach ($services as $service) {
    // Check service availability rules
    $hasRules = $conn->prepare("SELECT COUNT(*) FROM service_availability_rule WHERE service_id = ?");
    $hasRules->execute([$service['service_id']]);
    
    if ($hasRules->fetchColumn() > 0) {
        // Service has rules - check if customer's pet species is allowed
        $allowed = $conn->prepare("SELECT COUNT(*) FROM service_availability_rule WHERE service_id = ? AND species_id = ?");
        $allowed->execute([$service['service_id'], $petSpeciesId]);
        
        if ($allowed->fetchColumn() === 0) {
            continue; // Skip this service - not available for this species
        }
    }
    
    // Display service option
    echo '<option value="'.$service['service_id'].'">'.$service['name_en'].'</option>';
}
?>
```

### Usage in Dashboard Schedule

```php
<?php
// When displaying appointments in Today's Schedule widget
$appointments = $conn->query("SELECT * FROM appointment WHERE ...");

foreach ($appointments as $apt) {
    // Check service availability rules
    $hasRules = $conn->prepare("SELECT COUNT(*) FROM service_availability_rule WHERE service_id = ?");
    $hasRules->execute([$apt['service_id']]);
    
    if ($hasRules->fetchColumn() > 0) {
        // Service has rules - check if pet species is allowed
        $allowed = $conn->prepare("SELECT COUNT(*) FROM service_availability_rule WHERE service_id = ? AND species_id = ?");
        $allowed->execute([$apt['service_id'], $petSpeciesId]);
        
        if ($allowed->fetchColumn() === 0) {
            continue; // Skip this appointment - service not available for this species
        }
    }
    
    // Display appointment
}
?>
```

---

## 26. Component Unification Checklist

When implementing or updating components across the platform, ensure:

### ✅ Species Avatar

- [ ] Uses `getSpeciesIcon()` from `service_utils.php`
- [ ] Shows pet photo if available, falls back to species icon
- [ ] Uses consistent size (32px standard, 24px/40px for variants)
- [ ] Includes proper error handling for image load failures
- [ ] Uses service color when in service context

### ✅ Breed Avatar

- [ ] Uses `getBreedIcon()` and `getBreedColor()` from `service_utils.php`
- [ ] **Uses actual breed image from `breed.image_url` when available** (falls back to icon)
- [ ] **Same size as species avatar (32px)** - not smaller
- [ ] Always displayed alongside species avatar
- [ ] Only shows when breed data is available
- [ ] Uses species-based color scheme for icon fallback
- [ ] Includes proper error handling for image load failures
- [ ] **No double icons** - shows image OR icon, never both

### ✅ Service Avatar

- [ ] Uses `getServiceIcon()` and `getServiceColor()` from `service_utils.php`
- [ ] Consistent 24px size with circular background
- [ ] Color coding matches service type

### ✅ Phone Numbers

- [ ] Always uses `formatPhoneLebanon()` function
- [ ] Displays in format: `Customer Name • +961 3 03 58 93`
- [ ] Handles empty/null phone numbers gracefully
- [ ] Consistent `<small>` tag usage

### ✅ Service Availability Rules

- [ ] Checks `service_availability_rule` table before displaying services
- [ ] Filters appointments/bookings based on species compatibility
- [ ] Handles both "no rules" (all species) and "has rules" (specific species) cases

---

## 26.1. Module Completion Checklist (100% Compliance)

When completing a module to 100% compliance, ensure all items below are checked:

### ✅ Include Paths & Layout

- [ ] All include paths use `dirname(__DIR__, 3)` to reach project root
- [ ] Migrated from `head.php/header.php/sidebar.php/footer.php` to `layoutTop.php/layoutBottom.php`
- [ ] Uses `dashboard-main-body` instead of `dashboard-wrapper`
- [ ] No duplicate includes

### ✅ Internationalization (i18n)

- [ ] All hardcoded strings replaced with `t()` calls
- [ ] i18n JSON files created/updated for EN/FR/AR (`i18n/{module}/en.json`, `fr.json`, `ar.json`)
- [ ] Session messages translated
- [ ] Form labels, placeholders, help texts translated
- [ ] Error messages translated
- [ ] Arabic text fields use `lang="ar"` with Tajawal font

### ✅ WOWDASH UI Compliance

- [ ] Page header with breadcrumb (left: title, right: breadcrumb)
- [ ] No h1-h6 tags (use `<strong><p>` instead)
- [ ] Card header pattern (left: filters/size selector, right: main action button)
- [ ] Table structure: `table bordered-table mb-0` with `table-responsive scroll-sm`
- [ ] Table headers: `scope="col" class="bg-transparent rounded-0"`
- [ ] Action buttons: circular `w-32-px h-32-px` with Iconify icons
- [ ] Badges: `bg-*-focus text-*-main px-24 py-4 rounded-pill`
- [ ] Pagination with size selector (10, 20, 50, 100)
- [ ] Pagination display: "Showing X to Y of Z entries"
- [ ] Form layout: `row g-3` with `col-12 col-md-*` breakpoints

### ✅ Functionality

- [ ] All CRUD operations working (Create, Read, Update, Delete)
- [ ] Search functionality (if applicable)
- [ ] Filtering (if applicable)
- [ ] Pagination working correctly
- [ ] Image handling with fallbacks (if applicable)
- [ ] Data validation on forms
- [ ] Error handling and user feedback
- [ ] Role-based permissions maintained (if applicable)

### ✅ Code Quality

- [ ] No linter errors
- [ ] Proper error handling (try-catch, validation)
- [ ] SQL injection prevention (prepared statements)
- [ ] XSS prevention (htmlspecialchars)
- [ ] Consistent code style
- [ ] No deprecated functions

### ✅ Testing

- [ ] All CRUD endpoints tested
- [ ] Forms submit correctly
- [ ] Validation works
- [ ] Pagination works
- [ ] Search/filter works
- [ ] i18n switching works (EN/FR/AR)
- [ ] Responsive design works

### ✅ Documentation

- [ ] Module status updated in `devfiles/fix_plan.md`
- [ ] Module status updated in `devfiles/PET_PROFILE_ENHANCEMENTS_COMPLETE.md` (if applicable)
- [ ] Progress tracking updated

**A module is NOT 100% complete until ALL items above are checked.**

---

## 27. Switch Components (Toggle Switches)

**Purpose**: Toggle switches for boolean settings (Active/Inactive, Enabled/Disabled, etc.)

### Standard Switch Structure

```html
<div class="d-flex align-items-center flex-wrap gap-28">
    <div class="form-switch switch-primary d-flex align-items-center gap-3">
        <input class="form-check-input" type="checkbox" role="switch" id="switch1" checked>
        <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="switch1">Active</label>
    </div>
    
    <div class="form-switch switch-purple d-flex align-items-center gap-3">
        <input class="form-check-input" type="checkbox" role="switch" id="switch2">
        <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="switch2">Enabled</label>
    </div>
    
    <div class="form-switch switch-success d-flex align-items-center gap-3">
        <input class="form-check-input" type="checkbox" role="switch" id="switch3">
        <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="switch3">Published</label>
    </div>
    
    <div class="form-switch switch-warning d-flex align-items-center gap-3">
        <input class="form-check-input" type="checkbox" role="switch" id="switch4">
        <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="switch4">Notify</label>
    </div>
</div>
```

### Switch Color Variants

- `switch-primary` - Primary color (Blue)
- `switch-purple` - Purple/Lavender
- `switch-success` - Green (Success)
- `switch-warning` - Yellow/Orange (Warning)
- `switch-danger` - Red (Danger)
- `switch-info` - Cyan/Blue (Info)

### Usage in Forms

```html
<div class="row mb-3">
    <div class="col-12">
        <label class="form-label">Status</label>
        <div class="form-switch switch-primary d-flex align-items-center gap-3">
            <input class="form-check-input" type="checkbox" role="switch" id="active" name="active" value="1" <?= ($item['active'] ?? false) ? 'checked' : '' ?>>
            <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="active">Active</label>
        </div>
    </div>
</div>
```

### Horizontal Layout

```html
<div class="d-flex align-items-center flex-wrap gap-28">
    <div class="form-switch switch-primary d-flex align-items-center gap-3">
        <input class="form-check-input" type="checkbox" role="switch" id="horizontal1">
        <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="horizontal1">Horizontal 1</label>
    </div>
    
    <div class="form-switch switch-purple d-flex align-items-center gap-3">
        <input class="form-check-input" type="checkbox" role="switch" id="horizontal2">
        <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="horizontal2">Horizontal 2</label>
    </div>
    
    <div class="form-switch switch-success d-flex align-items-center gap-3">
        <input class="form-check-input" type="checkbox" role="switch" id="horizontal3">
        <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="horizontal3">Horizontal 3</label>
    </div>
    
    <div class="form-switch switch-warning d-flex align-items-center gap-3">
        <input class="form-check-input" type="checkbox" role="switch" id="horizontal4">
        <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="horizontal4">Horizontal 4</label>
    </div>
</div>
```

### Key Features

- **Container**: `d-flex align-items-center flex-wrap gap-28` for horizontal layout
- **Switch Wrapper**: `form-switch switch-{color} d-flex align-items-center gap-3`
- **Input**: `form-check-input` with `type="checkbox"` and `role="switch"`
- **Label**: `form-check-label line-height-1 fw-medium text-secondary-light`
- **Gap**: `gap-28` between switches, `gap-3` between input and label

---

## 28. Radio Button Components

**Purpose**: Radio buttons for single-choice selections (Status, Type, Priority, etc.)

### Standard Radio Button Structure

```html
<div class="d-flex align-items-center flex-wrap gap-28">
    <div class="form-check checked-primary d-flex align-items-center gap-2">
        <input class="form-check-input" type="radio" name="status" id="status1" value="active" checked>
        <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="status1">Active</label>
    </div>
    
    <div class="form-check checked-secondary d-flex align-items-center gap-2">
        <input class="form-check-input" type="radio" name="status" id="status2" value="inactive">
        <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="status2">Inactive</label>
    </div>
    
    <div class="form-check checked-success d-flex align-items-center gap-2">
        <input class="form-check-input" type="radio" name="status" id="status3" value="pending">
        <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="status3">Pending</label>
    </div>
    
    <div class="form-check checked-warning d-flex align-items-center gap-2">
        <input class="form-check-input" type="radio" name="status" id="status4" value="archived">
        <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="status4">Archived</label>
    </div>
</div>
```

### Radio Button Color Variants

- `checked-primary` - Primary color (Blue)
- `checked-secondary` - Secondary color (Gray/Purple)
- `checked-success` - Green (Success)
- `checked-warning` - Yellow/Orange (Warning)
- `checked-danger` - Red (Danger)
- `checked-info` - Cyan/Blue (Info)

### Active and Inactive States

```html
<div class="card-body p-24">
    <!-- Active State (Checked) -->
    <div class="d-flex align-items-center flex-wrap gap-28">
        <div class="form-check checked-primary d-flex align-items-center gap-2">
            <input class="form-check-input" type="radio" name="radio1" id="radio1" checked>
            <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="radio1">Radio Active</label>
        </div>
        
        <div class="form-check checked-secondary d-flex align-items-center gap-2">
            <input class="form-check-input" type="radio" name="radio2" id="radio2" checked>
            <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="radio2">Radio Active</label>
        </div>
        
        <div class="form-check checked-success d-flex align-items-center gap-2">
            <input class="form-check-input" type="radio" name="radio3" id="radio3" checked>
            <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="radio3">Radio Active</label>
        </div>
        
        <div class="form-check checked-warning d-flex align-items-center gap-2">
            <input class="form-check-input" type="radio" name="radio4" id="radio4" checked>
            <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="radio4">Radio Active</label>
        </div>
    </div>
    
    <!-- Inactive State (Unchecked) -->
    <div class="d-flex align-items-center flex-wrap gap-28 mt-24">
        <div class="form-check checked-primary d-flex align-items-center gap-2">
            <input class="form-check-input" type="radio" name="radio" id="radio11">
            <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="radio11">Radio Inactive</label>
        </div>
        
        <div class="form-check checked-secondary d-flex align-items-center gap-2">
            <input class="form-check-input" type="radio" name="radio" id="radio22">
            <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="radio22">Radio Inactive</label>
        </div>
        
        <div class="form-check checked-success d-flex align-items-center gap-2">
            <input class="form-check-input" type="radio" name="radio" id="radio33">
            <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="radio33">Radio Inactive</label>
        </div>
        
        <div class="form-check checked-warning d-flex align-items-center gap-2">
            <input class="form-check-input" type="radio" name="radio" id="radio44">
            <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="radio44">Radio Inactive</label>
        </div>
    </div>
</div>
```

### Usage in Forms

```html
<div class="row mb-3">
    <div class="col-12">
        <label class="form-label">Priority <span class="text-danger">*</span></label>
        <div class="d-flex align-items-center flex-wrap gap-28">
            <div class="form-check checked-primary d-flex align-items-center gap-2">
                <input class="form-check-input" type="radio" name="priority" id="priority_low" value="low" <?= ($item['priority'] ?? '') === 'low' ? 'checked' : '' ?> required>
                <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="priority_low">Low</label>
            </div>
            
            <div class="form-check checked-warning d-flex align-items-center gap-2">
                <input class="form-check-input" type="radio" name="priority" id="priority_medium" value="medium" <?= ($item['priority'] ?? '') === 'medium' ? 'checked' : '' ?> required>
                <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="priority_medium">Medium</label>
            </div>
            
            <div class="form-check checked-danger d-flex align-items-center gap-2">
                <input class="form-check-input" type="radio" name="priority" id="priority_high" value="high" <?= ($item['priority'] ?? '') === 'high' ? 'checked' : '' ?> required>
                <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="priority_high">High</label>
            </div>
        </div>
    </div>
</div>
```

### Horizontal Layout (Multiple Groups)

```html
<div class="d-flex align-items-center flex-wrap gap-28">
    <div class="form-check checked-primary d-flex align-items-center gap-2">
        <input class="form-check-input" type="radio" name="horizontal" id="horizontal1">
        <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="horizontal1">Horizontal 1</label>
    </div>
    
    <div class="form-check checked-secondary d-flex align-items-center gap-2">
        <input class="form-check-input" type="radio" name="horizontal" id="horizontal2">
        <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="horizontal2">Horizontal 2</label>
    </div>
    
    <div class="form-check checked-success d-flex align-items-center gap-2">
        <input class="form-check-input" type="radio" name="horizontal" id="horizontal3">
        <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="horizontal3">Horizontal 3</label>
    </div>
    
    <div class="form-check checked-warning d-flex align-items-center gap-2">
        <input class="form-check-input" type="radio" name="horizontal" id="horizontal4">
        <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="horizontal4">Horizontal 4</label>
    </div>
</div>
```

### Vertical Layout (Stacked)

```html
<div class="d-flex flex-column gap-3">
    <div class="form-check checked-primary d-flex align-items-center gap-2">
        <input class="form-check-input" type="radio" name="type" id="type1" value="standard">
        <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="type1">Standard</label>
    </div>
    
    <div class="form-check checked-secondary d-flex align-items-center gap-2">
        <input class="form-check-input" type="radio" name="type" id="type2" value="premium">
        <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="type2">Premium</label>
    </div>
    
    <div class="form-check checked-success d-flex align-items-center gap-2">
        <input class="form-check-input" type="radio" name="type" id="type3" value="enterprise">
        <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="type3">Enterprise</label>
    </div>
</div>
```

### Key Features

- **Container**: `d-flex align-items-center flex-wrap gap-28` for horizontal layout
- **Radio Wrapper**: `form-check checked-{color} d-flex align-items-center gap-2`
- **Input**: `form-check-input` with `type="radio"` and shared `name` attribute
- **Label**: `form-check-label line-height-1 fw-medium text-secondary-light`
- **Gap**: `gap-28` between radio groups, `gap-2` between input and label
- **Required**: All radio buttons in a group must share the same `name` attribute
- **Checked State**: Use `checked` attribute or PHP conditional `<?= ($value === 'option') ? 'checked' : '' ?>`
- **Card Body**: Wrap in `<div class="card-body p-24">` when inside cards
- **Spacing**: Use `mt-24` for spacing between groups of radio buttons

### Differences from Switches

- **Type**: `type="radio"` (not `type="checkbox"`)
- **Role**: No `role="switch"` attribute (standard radio behavior)
- **Name**: All radios in a group must share the same `name` attribute
- **Selection**: Only one radio can be selected at a time (mutually exclusive)
- **Class**: `checked-{color}` (not `switch-{color}`)
- **Gap**: Uses `gap-2` (not `gap-3`) between input and label

---

## 29. Image Upload with Preview Component

**Purpose**: File upload component with image preview functionality for single or multiple image uploads

### Standard Upload Structure

```html
<div class="upload-image-wrapper d-flex align-items-center gap-3 flex-wrap">
    <!-- Preview Container (shows uploaded images) -->
    <div class="uploaded-imgs-container d-flex gap-3 flex-wrap"></div>
    
    <!-- Upload Button/Label -->
    <label class="upload-file-multiple h-120-px w-120-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50 bg-hover-neutral-200 d-flex align-items-center flex-column justify-content-center gap-1" for="upload-file-multiple">
        <iconify-icon icon="solar:camera-outline" class="text-xl text-secondary-light"></iconify-icon>
        <span class="fw-semibold text-secondary-light">Upload</span>
        <input id="upload-file-multiple" type="file" hidden multiple accept="image/*">
    </label>
</div>
```

### Single Image Upload

```html
<div class="upload-image-wrapper d-flex align-items-center gap-3 flex-wrap">
    <div class="uploaded-imgs-container d-flex gap-3 flex-wrap"></div>
    
    <label class="upload-file-multiple h-120-px w-120-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50 bg-hover-neutral-200 d-flex align-items-center flex-column justify-content-center gap-1" for="upload-file-single">
        <iconify-icon icon="solar:camera-outline" class="text-xl text-secondary-light"></iconify-icon>
        <span class="fw-semibold text-secondary-light">Upload</span>
        <input id="upload-file-single" type="file" hidden accept="image/*">
    </label>
</div>
```

### Key Classes

- **Wrapper**: `upload-image-wrapper d-flex align-items-center gap-3 flex-wrap`
- **Preview Container**: `uploaded-imgs-container d-flex gap-3 flex-wrap`
- **Upload Label**: `upload-file-multiple h-120-px w-120-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50 bg-hover-neutral-200 d-flex align-items-center flex-column justify-content-center gap-1`
- **Input**: `type="file" hidden` with optional `multiple` and `accept="image/*"`

### Size Variations

**Small (80px)**:

```html
<label class="upload-file-multiple h-80-px w-80-px ...">
```

**Medium (120px)** - Default:

```html
<label class="upload-file-multiple h-120-px w-120-px ...">
```

**Large (160px)**:

```html
<label class="upload-file-multiple h-160-px w-160-px ...">
```

### Icon Variations

- **Camera**: `solar:camera-outline` (default)
- **Image**: `solar:image-outline`
- **Gallery**: `solar:gallery-outline`
- **Upload**: `solar:upload-outline`
- **Add Circle**: `solar:add-circle-outline`

### JavaScript Preview Handler

```javascript
// Multiple image upload with preview
document.getElementById('upload-file-multiple').addEventListener('change', function(e) {
    const files = e.target.files;
    const previewContainer = document.querySelector('.uploaded-imgs-container');
    
    if (!previewContainer) return;
    
    // Clear existing previews (optional)
    // previewContainer.innerHTML = '';
    
    Array.from(files).forEach(file => {
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imgWrapper = document.createElement('div');
                imgWrapper.className = 'position-relative';
                imgWrapper.style.width = '120px';
                imgWrapper.style.height = '120px';
                
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'w-100 h-100 object-fit-cover radius-8';
                img.style.border = '1px solid var(--bs-border-color)';
                
                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.className = 'position-absolute top-0 end-0 bg-danger-600 text-white rounded-circle w-24-px h-24-px d-flex align-items-center justify-content-center border-0';
                removeBtn.style.transform = 'translate(50%, -50%)';
                removeBtn.innerHTML = '<iconify-icon icon="solar:close-circle-bold" class="text-sm"></iconify-icon>';
                removeBtn.onclick = function() {
                    imgWrapper.remove();
                    // Optionally remove from file input
                };
                
                imgWrapper.appendChild(img);
                imgWrapper.appendChild(removeBtn);
                previewContainer.appendChild(imgWrapper);
            };
            reader.readAsDataURL(file);
        }
    });
});

// Single image upload with preview
document.getElementById('upload-file-single').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const previewContainer = document.querySelector('.uploaded-imgs-container');
    
    if (!file || !file.type.startsWith('image/') || !previewContainer) return;
    
    // Clear existing preview
    previewContainer.innerHTML = '';
    
    const reader = new FileReader();
    reader.onload = function(e) {
        const imgWrapper = document.createElement('div');
        imgWrapper.className = 'position-relative';
        imgWrapper.style.width = '120px';
        imgWrapper.style.height = '120px';
        
        const img = document.createElement('img');
        img.src = e.target.result;
        img.className = 'w-100 h-100 object-fit-cover radius-8';
        img.style.border = '1px solid var(--bs-border-color)';
        
        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.className = 'position-absolute top-0 end-0 bg-danger-600 text-white rounded-circle w-24-px h-24-px d-flex align-items-center justify-content-center border-0';
        removeBtn.style.transform = 'translate(50%, -50%)';
        removeBtn.innerHTML = '<iconify-icon icon="solar:close-circle-bold" class="text-sm"></iconify-icon>';
        removeBtn.onclick = function() {
            imgWrapper.remove();
            document.getElementById('upload-file-single').value = '';
        };
        
        imgWrapper.appendChild(img);
        imgWrapper.appendChild(removeBtn);
        previewContainer.appendChild(imgWrapper);
    };
    reader.readAsDataURL(file);
});
```

### Usage in Forms

```html
<div class="row mb-3">
    <div class="col-12">
        <label class="form-label">Service Image</label>
        <div class="upload-image-wrapper d-flex align-items-center gap-3 flex-wrap">
            <div class="uploaded-imgs-container d-flex gap-3 flex-wrap">
                <?php if (!empty($service['image_url'])): ?>
                    <div class="position-relative" style="width: 120px; height: 120px;">
                        <img src="<?= htmlspecialchars(BASE_URL . $service['image_url']) ?>" 
                             class="w-100 h-100 object-fit-cover radius-8" 
                             style="border: 1px solid var(--bs-border-color);"
                             alt="Service Image">
                        <button type="button" 
                                class="position-absolute top-0 end-0 bg-danger-600 text-white rounded-circle w-24-px h-24-px d-flex align-items-center justify-content-center border-0"
                                style="transform: translate(50%, -50%);"
                                onclick="removeImagePreview(this)">
                            <iconify-icon icon="solar:close-circle-bold" class="text-sm"></iconify-icon>
                        </button>
                    </div>
                <?php endif; ?>
            </div>
            
            <label class="upload-file-multiple h-120-px w-120-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50 bg-hover-neutral-200 d-flex align-items-center flex-column justify-content-center gap-1" for="service-image">
                <iconify-icon icon="solar:camera-outline" class="text-xl text-secondary-light"></iconify-icon>
                <span class="fw-semibold text-secondary-light">Upload</span>
                <input id="service-image" name="image" type="file" hidden accept="image/*">
            </label>
        </div>
        <small class="text-secondary-light">Recommended: 500x500px, Max 2MB</small>
    </div>
</div>
```

### Preview Image Styling

**Standard Preview**:

```html
<div class="position-relative" style="width: 120px; height: 120px;">
    <img src="..." class="w-100 h-100 object-fit-cover radius-8" 
         style="border: 1px solid var(--bs-border-color);" alt="Preview">
    <button type="button" class="position-absolute top-0 end-0 bg-danger-600 text-white rounded-circle w-24-px h-24-px d-flex align-items-center justify-content-center border-0"
            style="transform: translate(50%, -50%);"
            onclick="removeImagePreview(this)">
        <iconify-icon icon="solar:close-circle-bold" class="text-sm"></iconify-icon>
    </button>
</div>
```

### Key Features

- **Hidden Input**: File input is hidden, triggered by label click
- **Preview Container**: Dynamically populated with uploaded images
- **Remove Button**: Circular button with close icon positioned at top-right
- **Responsive**: Uses `flex-wrap` for responsive layout
- **Hover Effect**: `bg-hover-neutral-200` on upload label
- **Border Style**: Dashed border (`border-dashed`) for upload area
- **Iconify Icons**: Uses Iconify for camera/upload icons

### File Size Validation (JavaScript)

```javascript
function validateImageFile(file, maxSizeMB = 2) {
    const maxSize = maxSizeMB * 1024 * 1024; // Convert to bytes
    const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
    
    if (!allowedTypes.includes(file.type)) {
        alert('Please select a valid image file (JPEG, PNG, GIF, or WebP)');
        return false;
    }
    
    if (file.size > maxSize) {
        alert(`Image size must be less than ${maxSizeMB}MB`);
        return false;
    }
    
    return true;
}

// Usage in change handler
document.getElementById('upload-file-multiple').addEventListener('change', function(e) {
    Array.from(e.target.files).forEach(file => {
        if (!validateImageFile(file, 2)) {
            return; // Skip invalid files
        }
        // Process valid file...
    });
});
```

### Integration with Form Submission

```html
<form method="POST" enctype="multipart/form-data">
    <div class="upload-image-wrapper d-flex align-items-center gap-3 flex-wrap">
        <div class="uploaded-imgs-container d-flex gap-3 flex-wrap"></div>
        <label class="upload-file-multiple h-120-px w-120-px ..." for="image-upload">
            <iconify-icon icon="solar:camera-outline" class="text-xl text-secondary-light"></iconify-icon>
            <span class="fw-semibold text-secondary-light">Upload</span>
            <input id="image-upload" name="image" type="file" hidden accept="image/*">
        </label>
    </div>
    <button type="submit" class="btn btn-primary-600">Save</button>
</form>
```

---

## 30. Form Input with Icons

**Purpose**: Form input fields with icon indicators (search, user, email, phone, etc.)

### Standard Input with Icon Structure

**Left Icon (Prefix)**:

```html
<div class="icon-field">
    <input type="text" name="search" class="form-control" placeholder="Search..." value="">
    <span class="icon">
        <iconify-icon icon="ion:search-outline"></iconify-icon>
    </span>
</div>
```

**Right Icon (Suffix)**:

```html
<div class="icon-field icon-field-right">
    <input type="text" name="phone" class="form-control" placeholder="+1 (555) 000-0000" value="">
    <span class="icon">
        <iconify-icon icon="solar:phone-bold-duotone"></iconify-icon>
    </span>
</div>
```

**Both Sides (Prefix + Suffix)**:

```html
<div class="icon-field icon-field-both">
    <span class="icon icon-left">
        <iconify-icon icon="solar:user-bold-duotone"></iconify-icon>
    </span>
    <input type="text" name="username" class="form-control" placeholder="Username" value="">
    <span class="icon icon-right">
        <iconify-icon icon="solar:check-circle-bold-duotone"></iconify-icon>
    </span>
</div>
```

### Icon Field Classes

- **Base**: `icon-field` - Container for input with icon
- **Right Icon**: `icon-field-right` - Icon on the right side
- **Both Icons**: `icon-field-both` - Icons on both sides
- **Icon Element**: `icon` - Icon wrapper span
- **Left Icon**: `icon-left` - Left side icon (when using both)
- **Right Icon**: `icon-right` - Right side icon (when using both)

### Common Icon Patterns

**Search Input**:

```html
<div class="icon-field">
    <input type="text" name="search" class="form-control form-control-sm" placeholder="Search..." value="">
    <span class="icon">
        <iconify-icon icon="ion:search-outline"></iconify-icon>
    </span>
</div>
```

**Email Input**:

```html
<div class="icon-field">
    <input type="email" name="email" class="form-control" placeholder="email@example.com" value="">
    <span class="icon">
        <iconify-icon icon="solar:letter-bold-duotone"></iconify-icon>
    </span>
</div>
```

**Phone Input**:

```html
<div class="icon-field icon-field-right">
    <input type="tel" name="phone" class="form-control" placeholder="+1 (555) 000-0000" value="">
    <span class="icon">
        <iconify-icon icon="solar:phone-bold-duotone"></iconify-icon>
    </span>
</div>
```

**User/Name Input**:

```html
<div class="icon-field">
    <input type="text" name="name" class="form-control" placeholder="Full Name" value="">
    <span class="icon">
        <iconify-icon icon="solar:user-bold-duotone"></iconify-icon>
    </span>
</div>
```

**Password Input**:

```html
<div class="icon-field icon-field-both">
    <span class="icon icon-left">
        <iconify-icon icon="solar:lock-password-bold-duotone"></iconify-icon>
    </span>
    <input type="password" name="password" class="form-control" placeholder="Password" value="">
    <span class="icon icon-right" onclick="togglePassword(this)">
        <iconify-icon icon="solar:eye-bold-duotone" class="password-toggle"></iconify-icon>
    </span>
</div>
```

**Calendar/Date Input**:

```html
<div class="icon-field icon-field-right">
    <input type="date" name="date" class="form-control" value="">
    <span class="icon">
        <iconify-icon icon="solar:calendar-bold-duotone"></iconify-icon>
    </span>
</div>
```

**Location/Address Input**:

```html
<div class="icon-field">
    <input type="text" name="address" class="form-control" placeholder="Street Address" value="">
    <span class="icon">
        <iconify-icon icon="solar:map-point-bold-duotone"></iconify-icon>
    </span>
</div>
```

**Money/Currency Input**:

```html
<div class="icon-field">
    <input type="number" name="amount" class="form-control" placeholder="0.00" step="0.01" value="">
    <span class="icon">
        <iconify-icon icon="solar:dollar-bold-duotone"></iconify-icon>
    </span>
</div>
```

### Iconify Icon Options

**Common Icons**:

- Search: `ion:search-outline`, `solar:magnifer-outline`
- User: `solar:user-bold-duotone`, `tabler:user`
- Email: `solar:letter-bold-duotone`, `solar:mail-outline`
- Phone: `solar:phone-bold-duotone`, `solar:phone-calling-outline`
- Lock/Password: `solar:lock-password-bold-duotone`, `solar:lock-outline`
- Eye (Show/Hide): `solar:eye-bold-duotone`, `solar:eye-closed-bold-duotone`
- Calendar: `solar:calendar-bold-duotone`, `solar:calendar-outline`
- Location: `solar:map-point-bold-duotone`, `solar:location-outline`
- Money: `solar:dollar-bold-duotone`, `solar:dollar-minimalistic-outline`
- Check: `solar:check-circle-bold-duotone`, `solar:check-circle-outline`
- Warning: `solar:danger-circle-bold-duotone`, `solar:info-circle-outline`

### Size Variations

**Small**:

```html
<div class="icon-field">
    <input type="text" name="search" class="form-control form-control-sm" placeholder="Search...">
    <span class="icon">
        <iconify-icon icon="ion:search-outline"></iconify-icon>
    </span>
</div>
```

**Default**:

```html
<div class="icon-field">
    <input type="text" name="search" class="form-control" placeholder="Search...">
    <span class="icon">
        <iconify-icon icon="ion:search-outline"></iconify-icon>
    </span>
</div>
```

**Large**:

```html
<div class="icon-field">
    <input type="text" name="search" class="form-control form-control-lg" placeholder="Search...">
    <span class="icon">
        <iconify-icon icon="ion:search-outline"></iconify-icon>
    </span>
</div>
```

### Usage in Forms

```html
<div class="row mb-3">
    <div class="col-12 col-md-6">
        <label class="form-label">Email <span class="text-danger">*</span></label>
        <div class="icon-field">
            <input type="email" name="email" class="form-control" placeholder="email@example.com" value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>
            <span class="icon">
                <iconify-icon icon="solar:letter-bold-duotone"></iconify-icon>
            </span>
        </div>
    </div>
    
    <div class="col-12 col-md-6">
        <label class="form-label">Phone</label>
        <div class="icon-field icon-field-right">
            <input type="tel" name="phone" class="form-control" placeholder="+1 (555) 000-0000" value="<?= htmlspecialchars($user['phone'] ?? '') ?>">
            <span class="icon">
                <iconify-icon icon="solar:phone-bold-duotone"></iconify-icon>
            </span>
        </div>
    </div>
</div>
```

### Password Toggle Functionality

```javascript
function togglePassword(iconElement) {
    const input = iconElement.closest('.icon-field').querySelector('input[type="password"], input[type="text"]');
    const icon = iconElement.querySelector('iconify-icon');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.setAttribute('icon', 'solar:eye-closed-bold-duotone');
    } else {
        input.type = 'password';
        icon.setAttribute('icon', 'solar:eye-bold-duotone');
    }
}
```

### Search Input with Clear Button

```html
<div class="icon-field icon-field-both">
    <span class="icon icon-left">
        <iconify-icon icon="ion:search-outline"></iconify-icon>
    </span>
    <input type="text" name="search" class="form-control" placeholder="Search..." value="" id="search-input">
    <span class="icon icon-right" onclick="clearSearch()" style="cursor: pointer;">
        <iconify-icon icon="solar:close-circle-bold-duotone"></iconify-icon>
    </span>
</div>

<script>
function clearSearch() {
    document.getElementById('search-input').value = '';
    document.getElementById('search-input').focus();
}
</script>
```

### Validation States with Icons

**Success State**:

```html
<div class="icon-field icon-field-both">
    <span class="icon icon-left">
        <iconify-icon icon="solar:user-bold-duotone"></iconify-icon>
    </span>
    <input type="text" name="username" class="form-control is-valid" placeholder="Username" value="">
    <span class="icon icon-right">
        <iconify-icon icon="solar:check-circle-bold-duotone" class="text-success-main"></iconify-icon>
    </span>
</div>
```

**Error State**:

```html
<div class="icon-field icon-field-both">
    <span class="icon icon-left">
        <iconify-icon icon="solar:letter-bold-duotone"></iconify-icon>
    </span>
    <input type="email" name="email" class="form-control is-invalid" placeholder="email@example.com" value="">
    <span class="icon icon-right">
        <iconify-icon icon="solar:danger-circle-bold-duotone" class="text-danger-main"></iconify-icon>
    </span>
</div>
```

### Key Features

- **Icon Positioning**: Icons can be on left (default), right, or both sides
- **Clickable Icons**: Icons can be made clickable for actions (toggle password, clear search)
- **Validation States**: Icons can change color based on validation state
- **Responsive**: Works with all form control sizes (sm, default, lg)
- **Accessibility**: Icons are decorative; use `aria-label` on inputs for screen readers

### Best Practices

1. **Use appropriate icons** - Match icon to input purpose (email icon for email field)
2. **Consistent placement** - Keep icon placement consistent across forms
3. **Clickable icons** - Add `cursor: pointer` and `onclick` for interactive icons
4. **Color coding** - Use color classes (`text-success-main`, `text-danger-main`) for validation states
5. **Size matching** - Icon size should match input size (use `text-xl` for standard, `text-lg` for large)

---

**Reference**: Component utilities in `admin/include/service_utils.php`
