@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Dashboard</h1>
        <p class="page-subtitle">Welcome back, {{ Auth::user()->name }}!</p>
    </div>
    <div>
        <button class="btn btn-primary">
            <i class="bi bi-download me-2"></i> Download Report
        </button>
    </div>
</div>

<!-- User Profile Section -->
<div class="row mb-4">
    <div class="col-lg-8">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center gap-4 flex-wrap">
                    <div class="user-avatar-circle" style="width: 80px; height: 80px; font-size: 2rem;">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <h3 class="mb-1">{{ Auth::user()->name }}</h3>
                        <p class="text-muted mb-3">{{ Auth::user()->email }}</p>
                        <div class="d-flex gap-2 flex-wrap">
                            <span class="badge badge-primary">{{ ucfirst(Auth::user()->role) }}</span>
                            <span class="badge badge-success">{{ ucfirst(Auth::user()->status ?? 'Active') }}</span>
                            <span class="badge badge-info">Joined {{ \Carbon\Carbon::parse(Auth::user()->created_at)->format('M Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Quick Actions or Time -->
    <div class="col-lg-4">
        <div class="card h-100" style="background: linear-gradient(135deg, var(--primary), var(--primary-hover)); color: white; border: none;">
            <div class="card-body d-flex flex-column justify-content-center align-items-center text-center">
                <h2 class="mb-0">{{ now()->format('h:i A') }}</h2>
                <p class="mb-0" style="opacity: 0.8;">{{ now()->format('l, F j, Y') }}</p>
            </div>
        </div>
    </div>
</div>

@if(Auth::user()->isAdmin() || Auth::user()->isSuperAdmin())
<!-- Statistics Cards -->
<div class="row">
    <div class="col-sm-6 col-lg-3 mb-4">
        <div class="stat-card primary">
            <div class="stat-icon-wrapper">
                <i class="bi bi-people-fill"></i>
            </div>
            <p class="stat-value">{{ \App\Models\Student::count() }}</p>
            <p class="stat-label">Total Students</p>
            <a href="{{ route('students.index') }}" class="stat-link">
                View All <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3 mb-4">
        <div class="stat-card success">
            <div class="stat-icon-wrapper">
                <i class="bi bi-person-workspace"></i>
            </div>
            <p class="stat-value">{{ \App\Models\Teacher::count() }}</p>
            <p class="stat-label">Total Teachers</p>
            <a href="{{ route('teachers.index') }}" class="stat-link" style="color: var(--success);">
                View All <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3 mb-4">
        <div class="stat-card warning">
            <div class="stat-icon-wrapper">
                <i class="bi bi-book-fill"></i>
            </div>
            <p class="stat-value">{{ \App\Models\Classes::count() }}</p>
            <p class="stat-label">Total Classes</p>
            <a href="{{ route('classes.index') }}" class="stat-link" style="color: var(--warning);">
                View All <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3 mb-4">
        <div class="stat-card info">
            <div class="stat-icon-wrapper">
                <i class="bi bi-folder2-open"></i>
            </div>
            <p class="stat-value">{{ \App\Models\Section::count() }}</p>
            <p class="stat-label">Total Sections</p>
            <a href="{{ route('sections.index') }}" class="stat-link" style="color: var(--info);">
                View All <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
</div>
@endif

@endsection
