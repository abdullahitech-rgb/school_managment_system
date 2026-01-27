<aside class="sidebar" id="sidebar">
    <!-- User Profile Card -->
    <div class="sidebar-header">
        <div class="user-profile-card">
            <div class="profile-avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <h6 class="mb-0" style="font-weight: 600; color: #111827;">{{ Auth::user()->name }}</h6>
            <small style="color: #6b7280;">{{ ucfirst(Auth::user()->role) }}</small>
        </div>
    </div>

    <!-- Menu -->
    <ul class="sidebar-menu">
        <!-- Dashboard -->
        <li class="sidebar-item">
            <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
        </li>

        @if(Auth::user()->isAdmin() || Auth::user()->isSuperAdmin())
            <!-- Students -->
            <li class="sidebar-item">
                <a href="javascript:void(0)" class="sidebar-link submenu-toggle {{ request()->routeIs('students.*') ? 'active' : '' }}">
                    <i class="bi bi-people-fill"></i>
                    <span>Students</span>
                    <i class="bi bi-chevron-down ms-auto" style="font-size: 0.75rem;"></i>
                </a>
                <ul class="sidebar-submenu {{ request()->routeIs('students.*') ? 'show' : '' }}">
                    <li class="sidebar-item">
                        <a href="{{ route('students.index') }}" class="sidebar-link {{ request()->routeIs('students.index') ? 'active' : '' }}">
                            <i class="bi bi-list-ul"></i> View All
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('students.create') }}" class="sidebar-link {{ request()->routeIs('students.create') ? 'active' : '' }}">
                            <i class="bi bi-plus-lg"></i> Add New
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Teachers -->
            <li class="sidebar-item">
                <a href="javascript:void(0)" class="sidebar-link submenu-toggle {{ request()->routeIs('teachers.*') ? 'active' : '' }}">
                    <i class="bi bi-person-workspace"></i>
                    <span>Teachers</span>
                    <i class="bi bi-chevron-down ms-auto" style="font-size: 0.75rem;"></i>
                </a>
                <ul class="sidebar-submenu {{ request()->routeIs('teachers.*') ? 'show' : '' }}">
                    <li class="sidebar-item">
                        <a href="{{ route('teachers.index') }}" class="sidebar-link {{ request()->routeIs('teachers.index') ? 'active' : '' }}">
                            <i class="bi bi-list-ul"></i> View All
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('teachers.create') }}" class="sidebar-link {{ request()->routeIs('teachers.create') ? 'active' : '' }}">
                            <i class="bi bi-plus-lg"></i> Add New
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Classes -->
            <li class="sidebar-item">
                <a href="javascript:void(0)" class="sidebar-link submenu-toggle {{ request()->routeIs('classes.*') ? 'active' : '' }}">
                    <i class="bi bi-book-fill"></i>
                    <span>Classes</span>
                    <i class="bi bi-chevron-down ms-auto" style="font-size: 0.75rem;"></i>
                </a>
                <ul class="sidebar-submenu {{ request()->routeIs('classes.*') ? 'show' : '' }}">
                    <li class="sidebar-item">
                        <a href="{{ route('classes.index') }}" class="sidebar-link {{ request()->routeIs('classes.index') ? 'active' : '' }}">
                            <i class="bi bi-list-ul"></i> View All
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('classes.create') }}" class="sidebar-link {{ request()->routeIs('classes.create') ? 'active' : '' }}">
                            <i class="bi bi-plus-lg"></i> Add New
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Sections -->
            <li class="sidebar-item">
                <a href="javascript:void(0)" class="sidebar-link submenu-toggle {{ request()->routeIs('sections.*') ? 'active' : '' }}">
                    <i class="bi bi-folder2-open"></i>
                    <span>Sections</span>
                    <i class="bi bi-chevron-down ms-auto" style="font-size: 0.75rem;"></i>
                </a>
                <ul class="sidebar-submenu {{ request()->routeIs('sections.*') ? 'show' : '' }}">
                    <li class="sidebar-item">
                        <a href="{{ route('sections.index') }}" class="sidebar-link {{ request()->routeIs('sections.index') ? 'active' : '' }}">
                            <i class="bi bi-list-ul"></i> View All
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('sections.create') }}" class="sidebar-link {{ request()->routeIs('sections.create') ? 'active' : '' }}">
                            <i class="bi bi-plus-lg"></i> Add New
                        </a>
                    </li>
                </ul>
            </li>
        @endif

        @if(Auth::user()->isTeacher())
            <!-- Teacher Menu Items -->
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="bi bi-calendar2-check"></i>
                    <span>My Classes</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="bi bi-clipboard-check"></i>
                    <span>Mark Attendance</span>
                </a>
            </li>
        @endif

        @if(Auth::user()->isStudent())
            <!-- Student Menu Items -->
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="bi bi-graph-up"></i>
                    <span>My Results</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="bi bi-calendar-check"></i>
                    <span>My Attendance</span>
                </a>
            </li>
        @endif

        @if(Auth::user()->isParent())
            <!-- Parent Menu Items -->
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="bi bi-person-fill"></i>
                    <span>My Child</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="bi bi-graph-up"></i>
                    <span>Child Results</span>
                </a>
            </li>
        @endif
    </ul>
</aside>

<style>
    .submenu-toggle i:last-child {
        transition: transform 0.3s ease;
    }

    .submenu-toggle i:last-child.rotate-180 {
        transform: rotate(180deg);
    }
</style>

