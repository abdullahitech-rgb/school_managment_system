<aside class="sidebar" id="sidebar">
    <!-- Sidebar Header / Brand -->
    <div class="sidebar-header">
        <div class="sidebar-brand">
            <i class="bi bi-mortarboard-fill"></i>
            <span>ACADEMIA</span>
        </div>
        
        <!-- User Widget (Optional, fits well in sidebar for admins) -->
        <div class="user-profile-widget">
            <div class="user-avatar-circle">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="mt-2 text-white">
                <div style="font-weight: 600; font-size: 0.95rem;">{{ Auth::user()->name }}</div>
                <div style="font-size: 0.75rem; opacity: 0.7;">{{ ucfirst(Auth::user()->role) }}</div>
            </div>
        </div>
    </div>

    <!-- Menu -->
    <ul class="sidebar-menu">
        <div class="sidebar-title">Main Menu</div>
        
        <!-- Dashboard -->
        <li class="sidebar-item">
            <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>

        @if(Auth::user()->isAdmin() || Auth::user()->isSuperAdmin())
            <div class="sidebar-title">Management</div>
            
            <!-- Students -->
            <li class="sidebar-item">
                <a href="javascript:void(0)" class="sidebar-link submenu-toggle {{ request()->routeIs('students.*') ? 'active' : '' }}">
                    <i class="bi bi-people-fill"></i>
                    <span>Students</span>
                    <i class="bi bi-chevron-down ms-auto" style="font-size: 0.8rem; transition: transform 0.3s;"></i>
                </a>
                <ul class="submenu {{ request()->routeIs('students.*') ? 'show' : '' }}">
                    <li class="sidebar-item">
                        <a href="{{ route('students.index') }}" class="sidebar-link {{ request()->routeIs('students.index') ? 'active' : '' }}">
                            <span>All Students</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('students.create') }}" class="sidebar-link {{ request()->routeIs('students.create') ? 'active' : '' }}">
                            <span>Add New</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Teachers -->
            <li class="sidebar-item">
                <a href="javascript:void(0)" class="sidebar-link submenu-toggle {{ request()->routeIs('teachers.*') ? 'active' : '' }}">
                    <i class="bi bi-person-workspace"></i>
                    <span>Teachers</span>
                    <i class="bi bi-chevron-down ms-auto" style="font-size: 0.8rem; transition: transform 0.3s;"></i>
                </a>
                <ul class="submenu {{ request()->routeIs('teachers.*') ? 'show' : '' }}">
                    <li class="sidebar-item">
                        <a href="{{ route('teachers.index') }}" class="sidebar-link {{ request()->routeIs('teachers.index') ? 'active' : '' }}">
                            <span>All Teachers</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('teachers.create') }}" class="sidebar-link {{ request()->routeIs('teachers.create') ? 'active' : '' }}">
                            <span>Add New</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Classes -->
            <li class="sidebar-item">
                <a href="javascript:void(0)" class="sidebar-link submenu-toggle {{ request()->routeIs('classes.*') ? 'active' : '' }}">
                    <i class="bi bi-book-fill"></i>
                    <span>Classes</span>
                    <i class="bi bi-chevron-down ms-auto" style="font-size: 0.8rem; transition: transform 0.3s;"></i>
                </a>
                <ul class="submenu {{ request()->routeIs('classes.*') ? 'show' : '' }}">
                    <li class="sidebar-item">
                        <a href="{{ route('classes.index') }}" class="sidebar-link {{ request()->routeIs('classes.index') ? 'active' : '' }}">
                            <span>All Classes</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('classes.create') }}" class="sidebar-link {{ request()->routeIs('classes.create') ? 'active' : '' }}">
                            <span>Add New</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Sections -->
            <li class="sidebar-item">
                <a href="javascript:void(0)" class="sidebar-link submenu-toggle {{ request()->routeIs('sections.*') ? 'active' : '' }}">
                    <i class="bi bi-collection-fill"></i>
                    <span>Sections</span>
                    <i class="bi bi-chevron-down ms-auto" style="font-size: 0.8rem; transition: transform 0.3s;"></i>
                </a>
                <ul class="submenu {{ request()->routeIs('sections.*') ? 'show' : '' }}">
                    <li class="sidebar-item">
                        <a href="{{ route('sections.index') }}" class="sidebar-link {{ request()->routeIs('sections.index') ? 'active' : '' }}">
                            <span>All Sections</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('sections.create') }}" class="sidebar-link {{ request()->routeIs('sections.create') ? 'active' : '' }}">
                            <span>Add New</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endif

        @if(Auth::user()->isTeacher())
            <div class="sidebar-title">Academic</div>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="bi bi-calendar2-check-fill"></i>
                    <span>My Classes</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="bi bi-clipboard-check-fill"></i>
                    <span>Attendance</span>
                </a>
            </li>
        @endif

        @if(Auth::user()->isStudent())
            <div class="sidebar-title">My Learning</div>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="bi bi-bar-chart-fill"></i>
                    <span>Results</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="bi bi-calendar-check-fill"></i>
                    <span>Attendance</span>
                </a>
            </li>
        @endif

        @if(Auth::user()->isParent())
            <div class="sidebar-title">My Child</div>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="bi bi-person-fill"></i>
                    <span>Profile</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="bi bi-briefcase-fill"></i>
                    <span>Results</span>
                </a>
            </li>
        @endif
    </ul>
</aside>

