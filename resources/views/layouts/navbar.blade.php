<nav class="top-navbar">
    <!-- Left: Mobile Toggle & Page Title (Optional) -->
    <div class="d-flex align-items-center gap-3">
        <button class="toggle-sidebar-btn">
            <i class="bi bi-list"></i>
        </button>
        
        <!-- Search Bar (Desktop) -->
        <div class="search-bar">
            <i class="bi bi-search search-icon"></i>
            <input type="text" class="search-input" placeholder="Search anything...">
        </div>
    </div>

    <!-- Right: Actions & Profile -->
    <div class="nav-right">
        <!-- Notifications (Example) -->
        <a href="#" style="font-size: 1.25rem; color: var(--text-muted); position: relative;">
            <i class="bi bi-bell"></i>
            <span style="position: absolute; top: -2px; right: -2px; width: 8px; height: 8px; background: var(--danger); border-radius: 50%;"></span>
        </a>

        <!-- User Dropdown -->
        <div class="dropdown">
            <div class="d-flex align-items-center gap-2 cursor-pointer" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
                <div class="user-avatar-circle" style="width: 36px; height: 36px; font-size: 0.9rem; margin: 0;">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="d-none d-md-block">
                    <div style="font-weight: 600; font-size: 0.85rem; line-height: 1.2;">{{ Auth::user()->name }}</div>
                    <div style="font-size: 0.7rem; color: var(--text-muted); line-height: 1;">{{ ucfirst(Auth::user()->role) }}</div>
                </div>
                <i class="bi bi-chevron-down ms-1" style="font-size: 0.75rem; color: var(--text-muted);"></i>
            </div>

            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-2" style="border-radius: var(--radius-md); min-width: 200px; margin-top: 1rem;">
                <li>
                    <a class="dropdown-item rounded-2 py-2" href="#">
                        <i class="bi bi-person me-2"></i> My Profile
                    </a>
                </li>
                <li>
                    <a class="dropdown-item rounded-2 py-2" href="#">
                        <i class="bi bi-gear me-2"></i> Settings
                    </a>
                </li>
                <li><hr class="dropdown-divider my-1"></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item rounded-2 py-2 text-danger">
                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
