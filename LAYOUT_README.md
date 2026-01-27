# Dashboard Layout Structure

This document explains the new modular layout system for the dashboard.

## File Structure

```
resources/views/
├── layouts/
│   ├── app.blade.php          # Main layout template
│   ├── navbar.blade.php       # Navigation bar component
│   ├── sidebar.blade.php      # Sidebar component
│   └── footer.blade.php       # Footer component
├── dashboard.blade.php         # Dashboard page (example)
└── dashboard-page-template.blade.php  # Template for creating new pages
```

## How It Works

### 1. Main Layout (`layouts/app.blade.php`)
The master layout file that contains:
- HTML structure
- Head section with CSS links
- Navigation bar (includes navbar.blade.php)
- Sidebar (includes sidebar.blade.php)
- Footer (includes footer.blade.php)
- Script includes

**Yield sections:**
- `@yield('title')` - Page title
- `@yield('content')` - Main page content
- `@yield('extra-css')` - Custom CSS for specific pages
- `@yield('extra-js')` - Custom JavaScript for specific pages

### 2. Components

#### **Navbar** (`layouts/navbar.blade.php`)
- Top navigation bar
- Logo and branding
- Search functionality
- User profile dropdown
- Messages and notifications
- Settings options

#### **Sidebar** (`layouts/sidebar.blade.php`)
- Left navigation menu
- User profile section
- Menu items with dropdowns
- Icons for each menu item

#### **Footer** (`layouts/footer.blade.php`)
- Copyright information
- Company credits
- Links

## Creating New Dashboard Pages

### Method 1: Using the Template
Copy `dashboard-page-template.blade.php` and customize it:

```blade
@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-account-multiple"></i>
            </span> Users
        </h3>
    </div>
    
    {{-- Your page content here --}}
@endsection
```

### Method 2: Manual Creation
1. Create a new file in `resources/views/` (e.g., `users.blade.php`)
2. Use `@extends('layouts.app')`
3. Add your content in `@section('content')`
4. Optionally add custom CSS/JS in `@section('extra-css')` and `@section('extra-js')`

## Benefits

✅ **DRY Principle** - Don't Repeat Yourself
- Navbar, sidebar, and footer are defined once and reused across all pages

✅ **Easy Maintenance**
- Change navbar/sidebar/footer once, updates appear on all pages

✅ **Consistent Design**
- All dashboard pages have the same header, sidebar, and footer

✅ **Scalable**
- Easy to add new pages without duplicating layout code

✅ **Clean Code**
- Page files only contain unique content

## Example Pages

### Dashboard (`dashboard.blade.php`)
- Sales statistics
- Charts and graphs
- Recent tickets

### Users Page (Create `users.blade.php`)
```blade
@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-account-multiple"></i>
            </span> Users
        </h3>
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">All Users</h4>
                    {{-- User list table --}}
                </div>
            </div>
        </div>
    </div>
@endsection
```

### Settings Page (Create `settings.blade.php`)
```blade
@extends('layouts.app')

@section('title', 'Settings')

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-cog"></i>
            </span> Settings
        </h3>
    </div>
    
    {{-- Settings form --}}
@endsection
```

## Routes

In `routes/web.php`, you can define routes like:

```php
Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/users', function () {
    return view('users');
});

Route::get('/settings', function () {
    return view('settings');
});
```

## Customizing Components

### Update Navbar
Edit `resources/views/layouts/navbar.blade.php` to:
- Change logo
- Modify navigation items
- Update user profile info
- Add/remove dropdowns

### Update Sidebar
Edit `resources/views/layouts/sidebar.blade.php` to:
- Add/remove menu items
- Modify icons
- Change menu structure
- Add new categories

### Update Footer
Edit `resources/views/layouts/footer.blade.php` to:
- Change copyright text
- Update company links
- Modify footer content

## Notes

- All CSS files are loaded from `assets/` directory
- All JavaScript files are loaded from `assets/` directory
- Images are served from `assets/images/` directory
- Font icons use Material Design Icons (MDI)
- Bootstrap 5 is used for styling
