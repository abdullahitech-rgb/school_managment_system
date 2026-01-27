# Quick Reference Guide - Dashboard Layout System

## 📂 File Locations

```
resources/views/
├── layouts/
│   ├── app.blade.php                    # Master layout
│   ├── navbar.blade.php                 # Top navigation
│   ├── sidebar.blade.php                # Left menu
│   └── footer.blade.php                 # Bottom footer
│
├── dashboard.blade.php                  # Dashboard page (UPDATED)
├── users.blade.php                      # Users page (EXAMPLE)
├── login.blade.php                      # Login page
├── register.blade.php                   # Register page
└── dashboard-page-template.blade.php    # Template for new pages
```

## 🔗 Component Includes

```
app.blade.php (Master Layout)
    ├─→ includes: navbar.blade.php
    ├─→ includes: sidebar.blade.php
    └─→ includes: footer.blade.php
```

## 📋 Creating New Dashboard Pages

### Quick Command
```blade
@extends('layouts.app')
@section('title', 'Page Name')
@section('content')
    <!-- Your HTML content here -->
@endsection
```

### Complete Template
```blade
@extends('layouts.app')

@section('title', 'Products')

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-package"></i>
            </span> Products
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">Products</li>
            </ul>
        </nav>
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">All Products</h4>
                    <!-- Your content here -->
                </div>
            </div>
        </div>
    </div>
@endsection
```

## 🎨 Common Icons (Material Design Icons)

```
Dashboard        → mdi-home
Users            → mdi-account-multiple
Products         → mdi-package
Orders           → mdi-shopping-cart
Settings         → mdi-cog
Reports          → mdi-chart-bar
Messages         → mdi-message-square
Notifications    → mdi-bell
Analytics        → mdi-chart-pie
Documents        → mdi-file-document
Calendar         → mdi-calendar
```

## 🎯 Common CSS Classes

```
.badge-gradient-primary     → Blue badge
.badge-gradient-success     → Green badge
.badge-gradient-info        → Light blue badge
.badge-gradient-warning     → Yellow badge
.badge-gradient-danger      → Red badge

.btn-primary                → Primary button
.btn-success                → Success button
.btn-danger                 → Danger button
.btn-warning                → Warning button
.btn-info                   → Info button

.card                       → Card container
.card-title                 → Card heading
.card-body                  → Card content

.page-title                 → Main page title
.breadcrumb                 → Breadcrumb navigation
.table-responsive           → Responsive table
```

## 📝 Routes Example

In `routes/web.php`:
```php
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/users', function () {
    return view('users');
});

Route::get('/products', function () {
    return view('products');
});
```

## 🔄 Update Shared Components

| Component | File | Change |
|-----------|------|--------|
| Top Navigation | `layouts/navbar.blade.php` | Logo, menu items, profile |
| Left Sidebar | `layouts/sidebar.blade.php` | Menu items, categories |
| Footer | `layouts/footer.blade.php` | Copyright, links |
| Base HTML | `layouts/app.blade.php` | Meta tags, scripts, styles |

## 📚 Sections Available in Child Views

```blade
@section('title')       → Page title in browser tab
@section('content')     → Main page content
@section('extra-css')   → Additional CSS files
@section('extra-js')    → Additional JavaScript files
```

## 💡 Tips

1. **Always use `@extends('layouts.app')`** at the top of dashboard pages
2. **Required section is `@section('content')`** - this is where your HTML goes
3. **Optional sections** are `title`, `extra-css`, and `extra-js`
4. **Copy and modify** the template or example pages for consistency
5. **Keep page files focused** - only unique content, layouts handle structure
6. **Update sidebar** in `sidebar.blade.php` to match your actual pages

## 🚀 Quick Start

1. Copy `dashboard-page-template.blade.php`
2. Rename to your page name (e.g., `products.blade.php`)
3. Edit the title and content sections
4. Add route in `routes/web.php`
5. Add menu item to `layouts/sidebar.blade.php`
6. Done! Page automatically includes navbar, sidebar, footer

---

**Need help?** See `LAYOUT_README.md` for detailed documentation
