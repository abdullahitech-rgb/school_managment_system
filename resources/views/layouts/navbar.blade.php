<nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container-fluid px-0">
        <!-- Logo -->
        <a class="navbar-brand ms-3" href="{{ route('dashboard') }}">
            <i class="bi bi-mortarboard-fill"></i>
            <span>EDU</span>
        </a>

        <!-- Navbar Toggler -->
        <button class="navbar-toggler me-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Content -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- Search (Optional) -->
                <li class="nav-item d-none d-lg-block">
                    <form class="d-flex" style="width: 250px;">
                        <input class="form-control form-control-sm me-2" type="search" placeholder="Search..." style="border-radius: 0.375rem; border: 1px solid #e5e7eb;">
                        <button class="btn btn-sm" type="submit" style="background-color: #f9fafb; border: 1px solid #e5e7eb;">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                </li>
            </ul>

            <!-- User Profile -->
            <div class="user-profile ms-3 me-3">
                <div class="user-avatar" data-bs-toggle="dropdown">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="user-info-text">
                    <strong style="font-size: 0.95rem;">{{ Auth::user()->name }}</strong>
                    <small>{{ ucfirst(Auth::user()->role) }}</small>
                </div>

                <!-- Dropdown Menu -->
                <ul class="dropdown-menu dropdown-menu-end" style="min-width: 200px;">
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="bi bi-person-circle me-2"></i> My Profile
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="bi bi-gear me-2"></i> Settings
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="dropdown-item" style="border: none; background: none; width: 100%; text-align: left; cursor: pointer;">
                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<!-- Sidebar Toggle Button (Mobile) -->
<button class="sidebar-toggle" id="sidebarToggle" style="display: none;">
    <i class="bi bi-list"></i>
</button>

<style>
    .dropdown-menu {
        border: 1px solid #e5e7eb;
        border-radius: 0.375rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .dropdown-item {
        color: #6b7280;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .dropdown-item:hover {
        background-color: #f9fafb;
        color: #6366f1;
    }

    .dropdown-item i {
        color: #6366f1;
    }
</style>
