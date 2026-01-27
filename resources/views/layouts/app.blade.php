<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'School Management System')</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        :root {
            --primary-color: #6366f1;
            --primary-dark: #4f46e5;
            --primary-light: #818cf8;
            --secondary-color: #ec4899;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --info-color: #3b82f6;
            --light-bg: #f9fafb;
            --border-color: #e5e7eb;
            --text-muted: #6b7280;
            --sidebar-width: 260px;
            --navbar-height: 70px;
        }

        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--light-bg);
            color: #1f2937;
            margin: 0;
            padding: 0;
        }

        /* Navbar Styles */
        .navbar {
            background: #ffffff;
            border-bottom: 1px solid var(--border-color);
            height: var(--navbar-height);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 100;
            padding: 0 1.5rem;
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--primary-color) !important;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .navbar-brand i {
            font-size: 1.8rem;
        }

        .navbar-toggler {
            border: none;
            padding: 0.25rem 0.5rem;
        }

        .navbar-toggler:focus {
            box-shadow: none;
            outline: none;
        }

        .navbar-nav .nav-link {
            color: var(--text-muted) !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            border-radius: 0.375rem;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: var(--primary-color) !important;
            background-color: rgba(99, 102, 241, 0.1);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding-left: 1rem;
            border-left: 1px solid var(--border-color);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            cursor: pointer;
        }

        .user-info-text {
            display: none;
        }

        @media (min-width: 992px) {
            .user-info-text {
                display: block;
            }
        }

        .user-info-text small {
            display: block;
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            background: #ffffff;
            border-right: 1px solid var(--border-color);
            height: calc(100vh - var(--navbar-height));
            overflow-y: auto;
            position: fixed;
            left: 0;
            top: var(--navbar-height);
            z-index: 90;
            transition: left 0.3s ease;
        }

        .sidebar.collapse-sidebar {
            left: -100%;
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border-color);
            text-align: center;
        }

        .user-profile-card {
            text-align: center;
            padding: 1rem 0;
        }

        .profile-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.8rem;
            margin: 0 auto 0.5rem;
        }

        .sidebar-menu {
            list-style: none;
            padding: 1rem 0;
            margin: 0;
        }

        .sidebar-item {
            margin: 0.25rem 0.75rem;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: var(--text-muted);
            text-decoration: none;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 0.95rem;
        }

        .sidebar-link:hover {
            color: var(--primary-color);
            background-color: rgba(99, 102, 241, 0.1);
            padding-left: 1.25rem;
        }

        .sidebar-link.active {
            color: var(--primary-color);
            background-color: rgba(99, 102, 241, 0.1);
            border-left: 3px solid var(--primary-color);
            padding-left: calc(1rem - 3px);
        }

        .sidebar-link i {
            width: 20px;
            text-align: center;
        }

        .sidebar-submenu {
            list-style: none;
            padding: 0;
            margin: 0.25rem 0;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .sidebar-submenu.show {
            max-height: 500px;
        }

        .sidebar-submenu .sidebar-item {
            margin: 0;
        }

        .sidebar-submenu .sidebar-link {
            padding: 0.5rem 1rem 0.5rem 3rem;
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        .sidebar-submenu .sidebar-link:hover {
            padding-left: 3.25rem;
        }

        .sidebar-toggle {
            display: none;
            position: absolute;
            top: 15px;
            right: 15px;
            background: var(--primary-color);
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 0.5rem;
            cursor: pointer;
            z-index: 101;
            font-size: 1.2rem;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                width: 100%;
                left: -100%;
            }

            .sidebar.show {
                left: 0;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            }

            .sidebar-toggle {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .sidebar-overlay {
                display: none;
                position: fixed;
                top: var(--navbar-height);
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 89;
            }

            .sidebar-overlay.show {
                display: block;
            }
        }

        /* Main Content */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            min-height: calc(100vh - var(--navbar-height));
            transition: margin-left 0.3s ease;
        }

        @media (max-width: 991.98px) {
            .main-wrapper {
                margin-left: 0;
            }
        }

        .main-content {
            padding: 2rem;
        }

        /* Page Header */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .page-title {
            font-size: 1.875rem;
            font-weight: 700;
            color: #111827;
            margin: 0;
        }

        /* Card Styles */
        .card {
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background: #ffffff;
            border-bottom: 1px solid var(--border-color);
            padding: 1.5rem;
            font-weight: 600;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Table Styles */
        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background-color: var(--light-bg);
            border-bottom: 1px solid var(--border-color);
            color: #374151;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.875rem;
            letter-spacing: 0.05em;
            padding: 1rem;
        }

        .table tbody td {
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background-color: var(--light-bg);
        }

        /* Button Styles */
        .btn {
            border-radius: 0.375rem;
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(99, 102, 241, 0.3);
        }

        .btn-secondary {
            background-color: #6b7280;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #4b5563;
            color: white;
        }

        .btn-success {
            background-color: var(--success-color);
            color: white;
        }

        .btn-success:hover {
            background-color: #059669;
            color: white;
        }

        .btn-danger {
            background-color: var(--danger-color);
            color: white;
        }

        .btn-danger:hover {
            background-color: #dc2626;
            color: white;
        }

        .btn-warning {
            background-color: var(--warning-color);
            color: white;
        }

        .btn-warning:hover {
            background-color: #d97706;
            color: white;
        }

        .btn-info {
            background-color: var(--info-color);
            color: white;
        }

        .btn-info:hover {
            background-color: #2563eb;
            color: white;
        }

        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
        }

        /* Form Styles */
        .form-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        .form-control,
        .form-select {
            border: 1px solid var(--border-color);
            border-radius: 0.375rem;
            padding: 0.625rem 0.875rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            outline: none;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        /* Alert Styles */
        .alert {
            border-radius: 0.375rem;
            border: 1px solid transparent;
            padding: 1rem;
        }

        .alert-success {
            background-color: #d1fae5;
            border-color: #6ee7b7;
            color: #065f46;
        }

        .alert-danger {
            background-color: #fee2e2;
            border-color: #fca5a5;
            color: #7f1d1d;
        }

        .alert-warning {
            background-color: #fef3c7;
            border-color: #fde68a;
            color: #78350f;
        }

        .alert-info {
            background-color: #dbeafe;
            border-color: #93c5fd;
            color: #0c2340;
        }

        /* Badge Styles */
        .badge {
            padding: 0.375rem 0.75rem;
            border-radius: 0.25rem;
            font-weight: 500;
            font-size: 0.85rem;
        }

        .badge-primary {
            background-color: rgba(99, 102, 241, 0.1);
            color: var(--primary-color);
        }

        .badge-success {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
        }

        .badge-danger {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--danger-color);
        }

        .badge-warning {
            background-color: rgba(245, 158, 11, 0.1);
            color: var(--warning-color);
        }

        /* Stat Card Styles */
        .stat-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            padding: 1.5rem;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
            transform: translateY(-5px);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .stat-value {
            font-size: 1.875rem;
            font-weight: 700;
            color: #111827;
            margin: 0;
        }

        .stat-label {
            color: var(--text-muted);
            font-size: 0.95rem;
            margin: 0.5rem 0 0;
        }

        /* Pagination */
        .pagination {
            margin-top: 1.5rem;
        }

        .pagination .page-link {
            color: var(--primary-color);
            border-color: var(--border-color);
        }

        .pagination .page-link:hover {
            background-color: rgba(99, 102, 241, 0.1);
            color: var(--primary-color);
        }

        .pagination .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        /* Footer */
        .footer {
            background: #ffffff;
            border-top: 1px solid var(--border-color);
            padding: 1.5rem;
            text-align: center;
            color: var(--text-muted);
            font-size: 0.9rem;
            margin-top: 2rem;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--light-bg);
        }

        ::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
        }

        /* Responsive */
        @media (max-width: 575.98px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .page-title {
                font-size: 1.5rem;
            }

            .main-content {
                padding: 1rem;
            }

            .table-responsive {
                font-size: 0.875rem;
            }

            .btn-sm {
                padding: 0.25rem 0.5rem;
                font-size: 0.75rem;
            }
        }
    </style>

    @yield('extra-css')
</head>
<body>
    <!-- Navbar -->
    @include('layouts.navbar')

    <!-- Sidebar & Main Content Wrapper -->
    <div class="d-flex">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Overlay for mobile sidebar -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <!-- Main Content -->
        <div class="main-wrapper w-100">
            <div class="main-content">
                @yield('content')
            </div>

            <!-- Footer -->
            @include('layouts.footer')
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Scripts -->
    <script>
        // Sidebar toggle
        const sidebarToggle = document.querySelector('.sidebar-toggle');
        const sidebar = document.querySelector('.sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('show');
                sidebarOverlay.classList.toggle('show');
            });
        }

        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', function() {
                sidebar.classList.remove('show');
                sidebarOverlay.classList.remove('show');
            });
        }

        // Sidebar submenu toggle
        const subMenuToggles = document.querySelectorAll('.submenu-toggle');
        subMenuToggles.forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                const submenu = this.nextElementSibling;
                submenu.classList.toggle('show');
                this.querySelector('i:last-child').classList.toggle('rotate-180');
            });
        });

        // Close sidebar on mobile when clicking a link
        const sidebarLinks = document.querySelectorAll('.sidebar-link');
        sidebarLinks.forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth < 992) {
                    sidebar.classList.remove('show');
                    sidebarOverlay.classList.remove('show');
                }
            });
        });

        // Active sidebar link
        document.addEventListener('DOMContentLoaded', function() {
            const currentUrl = window.location.pathname;
            const sidebarLinks = document.querySelectorAll('.sidebar-link');
            sidebarLinks.forEach(link => {
                if (link.href.includes(currentUrl)) {
                    link.classList.add('active');
                }
            });
        });
    </script>

    @yield('extra-js')
</body>
</html>
