@extends('layouts.superadmin')

@section('title', 'Super Admin Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="h3 d-inline-block">Dashboard</h1>
        </div>
    </div>

    <!-- Statistics -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="stat-card">
                <i class="fas fa-building" style="font-size: 2rem; color: var(--primary);"></i>
                <div class="stat-value">{{ $totalSchools }}</div>
                <div class="stat-label">Total Schools</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <i class="fas fa-users-cog" style="font-size: 2rem; color: var(--secondary);"></i>
                <div class="stat-value">{{ $totalAdmins }}</div>
                <div class="stat-label">Total Admins</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <i class="fas fa-check-circle" style="font-size: 2rem; color: var(--success);"></i>
                <div class="stat-value">{{ $activeSchools }}</div>
                <div class="stat-label">Active Schools</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <i class="fas fa-cogs" style="font-size: 2rem; color: var(--warning);"></i>
                <div class="stat-value">{{ Auth::user()->isSuperAdmin() ? '✓' : '✗' }}</div>
                <div class="stat-label">System Access</div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <a href="{{ route('superadmin.schools.create') }}" class="btn btn-primary me-2">
                        <i class="fas fa-plus"></i> Create School
                    </a>
                    <a href="{{ route('superadmin.admins.create') }}" class="btn btn-primary me-2">
                        <i class="fas fa-user-plus"></i> Add Admin
                    </a>
                    <a href="{{ route('superadmin.schools.index') }}" class="btn btn-outline-primary me-2">
                        <i class="fas fa-list"></i> View Schools
                    </a>
                    <a href="{{ route('superadmin.admins.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-list"></i> View Admins
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">System Overview</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted">
                        <i class="fas fa-info-circle"></i>
                        You have full platform control. Manage schools, create admins, and configure system settings.
                    </p>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Platform Features:</h6>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check text-success"></i> Multi-school Management</li>
                                <li><i class="fas fa-check text-success"></i> Admin User Creation</li>
                                <li><i class="fas fa-check text-success"></i> System Settings</li>
                                <li><i class="fas fa-check text-success"></i> Role-Based Access Control</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6>Next Steps:</h6>
                            <ol class="list-unstyled">
                                <li>1. Create a new school</li>
                                <li>2. Assign an admin to the school</li>
                                <li>3. Admin can manage teachers, students, and academics</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
