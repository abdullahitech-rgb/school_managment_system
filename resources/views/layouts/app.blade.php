<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'School Management System')</title>

    <!-- Google Fonts: Outfit & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS (Kept for Grid System) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVJkEZSMUkrQ6usznLUbFoTomy2Badge9qQMatqEcVQUoNkqbeM2OxskUpCsqrNBbeFtyx86F5EA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Modern Admin CSS -->
    <link href="{{ asset('css/modern-admin.css') }}" rel="stylesheet">

    <!-- Fallback/Legacy CSS if needed -->
    <style>
        /* Critical overrides just in case */
        .wrapper { display: flex; overflow-x: hidden; }
        .main-content-wrapper { flex: 1; }
    </style>

    @yield('extra-css')
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Mobile Overlay -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <!-- Main Content -->
        <div class="main-content-wrapper">
            <!-- Navbar -->
            @include('layouts.navbar')

            <!-- Content Body -->
            <div class="content-body">
                @yield('content')
            </div>

            <!-- Footer -->
            @include('layouts.footer')
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Interaction Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sidebar Toggle (Mobile)
            const sidebarToggle = document.querySelector('.toggle-sidebar-btn');
            const sidebar = document.querySelector('.sidebar');
            const sidebarOverlay = document.getElementById('sidebarOverlay');

            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', () => {
                    sidebar.classList.toggle('show');
                    sidebarOverlay.classList.toggle('show');
                });
            }

            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', () => {
                    sidebar.classList.remove('show');
                    sidebarOverlay.classList.remove('show');
                });
            }

            // Submenu Toggles
            const submenuToggles = document.querySelectorAll('.submenu-toggle');
            submenuToggles.forEach(toggle => {
                toggle.addEventListener('click', (e) => {
                    e.preventDefault();

                    // Find the next sibling which is the ul.submenu
                    const submenu = toggle.nextElementSibling;
                    const icon = toggle.querySelector('.bi-chevron-down');

                    if (submenu) {
                        submenu.classList.toggle('show');
                        // Optional: Rotate icon if it exists
                        if (icon) {
                            if (submenu.classList.contains('show')) {
                                icon.style.transform = 'rotate(180deg)';
                            } else {
                                icon.style.transform = 'rotate(0deg)';
                            }
                        }
                    }
                });
            });

            // Active State Handling
            const currentUrl = window.location.href;
            const sidebarLinks = document.querySelectorAll('.sidebar-link');

            sidebarLinks.forEach(link => {
                if (link.href === currentUrl) {
                    link.classList.add('active');

                    // Open parent submenu if exists
                    const parentItem = link.closest('.submenu');
                    if (parentItem) {
                        parentItem.classList.add('show');
                        // Highlight parent toggle?
                        const parentToggle = parentItem.previousElementSibling;
                        if (parentToggle) {
                            parentToggle.classList.add('active'); // Optional: highlight parent
                            parentToggle.classList.remove('collapsed');
                            const icon = parentToggle.querySelector('.bi-chevron-down');
                            if(icon) icon.style.transform = 'rotate(180deg)';
                        }
                    }
                }
            });
        });
    </script>

    @yield('extra-js')
</body>
</html>
