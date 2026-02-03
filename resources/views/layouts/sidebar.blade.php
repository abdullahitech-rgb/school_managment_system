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
            @if(Auth::user()->isSuperAdmin())
                <a href="{{ route('superadmin.dashboard') }}" class="sidebar-link {{ request()->routeIs('superadmin.dashboard') ? 'active' : '' }}">
            @else
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            @endif
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a href="{{ route('roles.index') }}" class="sidebar-link {{ request()->routeIs('roles.*') ? 'active' : '' }}">
                <i class="bi bi-shield-lock-fill"></i>
                <span>Roles & Permissions</span>
            </a>
        </li>

        @if(Auth::user()->isSuperAdmin())
            <!-- Super Admin Menu -->
            <div class="sidebar-title">Management</div>

            <!-- Schools -->
            <li class="sidebar-item">
                <a href="{{ route('superadmin.schools.index') }}" class="sidebar-link {{ request()->routeIs('superadmin.schools.*') ? 'active' : '' }}">
                    <i class="bi bi-building"></i>
                    <span>Schools</span>
                </a>
            </li>

            <!-- Admins -->
            <li class="sidebar-item">
                <a href="{{ route('superadmin.admins.index') }}" class="sidebar-link {{ request()->routeIs('superadmin.admins.*') ? 'active' : '' }}">
                    <i class="bi bi-people-fill"></i>
                    <span>Admins</span>
                </a>
            </li>

            <!-- Settings -->
            <li class="sidebar-item">
                <a href="{{ route('superadmin.settings') }}" class="sidebar-link {{ request()->routeIs('superadmin.settings') ? 'active' : '' }}">
                    <i class="bi bi-gear-fill"></i>
                    <span>Settings</span>
                </a>
            </li>
        @endif

        @if(Auth::user()->isAdmin())
            <!-- Admin Menu -->
            <div class="sidebar-title">Management</div>

            <!-- Teachers -->
            <li class="sidebar-item">
                <a href="javascript:void(0)" class="sidebar-link submenu-toggle {{ request()->routeIs('admin.teachers.*') ? 'active' : '' }}">
                    <i class="bi bi-person-workspace"></i>
                    <span>Teachers</span>
                    <i class="bi bi-chevron-down ms-auto" style="font-size: 0.8rem; transition: transform 0.3s;"></i>
                </a>
                <ul class="submenu {{ request()->routeIs('admin.teachers.*') ? 'show' : '' }}">
                    <li class="sidebar-item">
                        <a href="{{ route('admin.teachers.index') }}" class="sidebar-link {{ request()->routeIs('admin.teachers.index') ? 'active' : '' }}">
                            <span>All Teachers</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('admin.teachers.create') }}" class="sidebar-link {{ request()->routeIs('admin.teachers.create') ? 'active' : '' }}">
                            <span>Add New</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Students -->
            <li class="sidebar-item">
                <a href="javascript:void(0)" class="sidebar-link submenu-toggle {{ request()->routeIs('admin.students.*') ? 'active' : '' }}">
                    <i class="bi bi-people-fill"></i>
                    <span>Students</span>
                    <i class="bi bi-chevron-down ms-auto" style="font-size: 0.8rem; transition: transform 0.3s;"></i>
                </a>
                <ul class="submenu {{ request()->routeIs('admin.students.*') ? 'show' : '' }}">
                    <li class="sidebar-item">
                        <a href="{{ route('admin.students.index') }}" class="sidebar-link {{ request()->routeIs('admin.students.index') ? 'active' : '' }}">
                            <span>All Students</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('admin.students.create') }}" class="sidebar-link {{ request()->routeIs('admin.students.create') ? 'active' : '' }}">
                            <span>Add New</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Classes -->
            <li class="sidebar-item">
                <a href="javascript:void(0)" class="sidebar-link submenu-toggle {{ request()->routeIs('admin.classes.*') ? 'active' : '' }}">
                    <i class="bi bi-book-fill"></i>
                    <span>Classes</span>
                    <i class="bi bi-chevron-down ms-auto" style="font-size: 0.8rem; transition: transform 0.3s;"></i>
                </a>
                <ul class="submenu {{ request()->routeIs('admin.classes.*') ? 'show' : '' }}">
                    <li class="sidebar-item">
                        <a href="{{ route('admin.classes.index') }}" class="sidebar-link {{ request()->routeIs('admin.classes.index') ? 'active' : '' }}">
                            <span>All Classes</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('admin.classes.create') }}" class="sidebar-link {{ request()->routeIs('admin.classes.create') ? 'active' : '' }}">
                            <span>Add New</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Sections -->
            <li class="sidebar-item">
                <a href="javascript:void(0)" class="sidebar-link submenu-toggle {{ request()->routeIs('admin.sections.*') ? 'active' : '' }}">
                    <i class="bi bi-columns-gap"></i>
                    <span>Sections</span>
                    <i class="bi bi-chevron-down ms-auto" style="font-size: 0.8rem; transition: transform 0.3s;"></i>
                </a>
                <ul class="submenu {{ request()->routeIs('admin.sections.*') ? 'show' : '' }}">
                    <li class="sidebar-item">
                        <a href="{{ route('admin.sections.index') }}" class="sidebar-link {{ request()->routeIs('admin.sections.index') ? 'active' : '' }}">
                            <span>All Sections</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('admin.sections.create') }}" class="sidebar-link {{ request()->routeIs('admin.sections.create') ? 'active' : '' }}">
                            <span>Add New</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Subjects -->
            <li class="sidebar-item">
                <a href="javascript:void(0)" class="sidebar-link submenu-toggle {{ request()->routeIs('admin.subjects.*') ? 'active' : '' }}">
                    <i class="bi bi-collection-fill"></i>
                    <span>Subjects</span>
                    <i class="bi bi-chevron-down ms-auto" style="font-size: 0.8rem; transition: transform 0.3s;"></i>
                </a>
                <ul class="submenu {{ request()->routeIs('admin.subjects.*') ? 'show' : '' }}">
                    <li class="sidebar-item">
                        <a href="{{ route('admin.subjects.index') }}" class="sidebar-link {{ request()->routeIs('admin.subjects.index') ? 'active' : '' }}">
                            <span>All Subjects</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('admin.subjects.create') }}" class="sidebar-link {{ request()->routeIs('admin.subjects.create') ? 'active' : '' }}">
                            <span>Add New</span>
                        </a>
                    </li>
                </ul>
            </li>

            <div class="sidebar-title">Academics</div>

            <!-- Exams -->
            <li class="sidebar-item">
                <a href="javascript:void(0)" class="sidebar-link submenu-toggle {{ request()->routeIs('admin.exams.*') ? 'active' : '' }}">
                    <i class="bi bi-pencil-square"></i>
                    <span>Exams</span>
                    <i class="bi bi-chevron-down ms-auto" style="font-size: 0.8rem; transition: transform 0.3s;"></i>
                </a>
                <ul class="submenu {{ request()->routeIs('admin.exams.*') ? 'show' : '' }}">
                    <li class="sidebar-item">
                        <a href="{{ route('admin.exams.index') }}" class="sidebar-link {{ request()->routeIs('admin.exams.index') ? 'active' : '' }}">
                            <span>All Exams</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('admin.exams.create') }}" class="sidebar-link {{ request()->routeIs('admin.exams.create') ? 'active' : '' }}">
                            <span>Add New</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Results -->
            <li class="sidebar-item">
                <a href="javascript:void(0)" class="sidebar-link submenu-toggle {{ request()->routeIs('admin.results.*') ? 'active' : '' }}">
                    <i class="bi bi-bar-chart-fill"></i>
                    <span>Results</span>
                    <i class="bi bi-chevron-down ms-auto" style="font-size: 0.8rem; transition: transform 0.3s;"></i>
                </a>
                <ul class="submenu {{ request()->routeIs('admin.results.*') ? 'show' : '' }}">
                    <li class="sidebar-item">
                        <a href="{{ route('admin.results.index') }}" class="sidebar-link {{ request()->routeIs('admin.results.index') ? 'active' : '' }}">
                            <span>All Results</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('admin.results.create') }}" class="sidebar-link {{ request()->routeIs('admin.results.create') ? 'active' : '' }}">
                            <span>Add New</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Attendance -->
            <li class="sidebar-item">
                <a href="javascript:void(0)" class="sidebar-link submenu-toggle {{ request()->routeIs('admin.attendance.*') ? 'active' : '' }}">
                    <i class="bi bi-clipboard-check-fill"></i>
                    <span>Attendance</span>
                    <i class="bi bi-chevron-down ms-auto" style="font-size: 0.8rem; transition: transform 0.3s;"></i>
                </a>
                <ul class="submenu {{ request()->routeIs('admin.attendance.*') ? 'show' : '' }}">
                    <li class="sidebar-item">
                        <a href="{{ route('admin.attendance.index') }}" class="sidebar-link {{ request()->routeIs('admin.attendance.index') ? 'active' : '' }}">
                            <span>All Records</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('admin.attendance.create') }}" class="sidebar-link {{ request()->routeIs('admin.attendance.create') ? 'active' : '' }}">
                            <span>Mark Attendance</span>
                        </a>
                    </li>
                </ul>
            </li>

            <div class="sidebar-title">Finance</div>

            <!-- Fees -->
            <li class="sidebar-item">
                <a href="javascript:void(0)" class="sidebar-link submenu-toggle {{ request()->routeIs('admin.fees.*') ? 'active' : '' }}">
                    <i class="bi bi-cash-coin"></i>
                    <span>Fees</span>
                    <i class="bi bi-chevron-down ms-auto" style="font-size: 0.8rem; transition: transform 0.3s;"></i>
                </a>
                <ul class="submenu {{ request()->routeIs('admin.fees.*') ? 'show' : '' }}">
                    <li class="sidebar-item">
                        <a href="{{ route('admin.fees.index') }}" class="sidebar-link {{ request()->routeIs('admin.fees.index') ? 'active' : '' }}">
                            <span>All Fees</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('admin.fees.create') }}" class="sidebar-link {{ request()->routeIs('admin.fees.create') ? 'active' : '' }}">
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
