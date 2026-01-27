@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="page-header mb-4">
    <h1 class="page-title">Dashboard</h1>
    <p class="text-muted mb-0">Welcome back, {{ Auth::user()->name }}!</p>
</div>

<!-- User Profile Card -->
<div class="row mb-4">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <div class="profile-avatar" style="width: 80px; height: 80px; font-size: 2rem;">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    </div>
                    <div class="col">
                        <div>
                            <h4 class="mb-0">{{ Auth::user()->name }}</h4>
                            <p class="text-muted mb-3">{{ Auth::user()->email }}</p>
                            <div class="d-flex gap-2 flex-wrap">
                                <span class="badge badge-primary">{{ ucfirst(Auth::user()->role) }}</span>
                                <span class="badge badge-success">{{ ucfirst(Auth::user()->status) }}</span>
                                <span class="badge" style="background-color: rgba(99, 102, 241, 0.1); color: #6366f1;">Joined {{ \Carbon\Carbon::parse(Auth::user()->created_at)->format('M Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(Auth::user()->isAdmin() || Auth::user()->isSuperAdmin())
<!-- Statistics Cards -->
<div class="row">
    <div class="col-sm-6 col-lg-3 mb-4">
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.2), rgba(129, 140, 248, 0.2)); color: #6366f1;">
                <i class="bi bi-people-fill"></i>
            </div>
            <p class="stat-value">{{ \App\Models\Student::count() }}</p>
            <p class="stat-label">Total Students</p>
            <a href="{{ route('students.index') }}" class="btn btn-sm btn-primary mt-2" style="width: 100%;">
                <i class="bi bi-arrow-right me-1"></i> View All
            </a>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3 mb-4">
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.2), rgba(52, 211, 153, 0.2)); color: #10b981;">
                <i class="bi bi-person-workspace"></i>
            </div>
            <p class="stat-value">{{ \App\Models\Teacher::count() }}</p>
            <p class="stat-label">Total Teachers</p>
            <a href="{{ route('teachers.index') }}" class="btn btn-sm" style="background-color: #10b981; color: white; width: 100%;">
                <i class="bi bi-arrow-right me-1"></i> View All
            </a>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3 mb-4">
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, rgba(245, 158, 11, 0.2), rgba(251, 191, 36, 0.2)); color: #f59e0b;">
                <i class="bi bi-book-fill"></i>
            </div>
            <p class="stat-value">{{ \App\Models\Classes::count() }}</p>
            <p class="stat-label">Total Classes</p>
            <a href="{{ route('classes.index') }}" class="btn btn-sm btn-warning" style="width: 100%;">
                <i class="bi bi-arrow-right me-1"></i> View All
            </a>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3 mb-4">
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, rgba(59, 130, 246, 0.2), rgba(147, 197, 253, 0.2)); color: #3b82f6;">
                <i class="bi bi-folder2-open"></i>
            </div>
            <p class="stat-value">{{ \App\Models\Section::count() }}</p>
            <p class="stat-label">Total Sections</p>
            <a href="{{ route('sections.index') }}" class="btn btn-sm btn-info" style="width: 100%;">
                <i class="bi bi-arrow-right me-1"></i> View All
            </a>
        </div>
    </div>
</div>
@endif

<style>
    .profile-avatar {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
    }

    @media (max-width: 576px) {
        .stat-card {
            text-align: center;
        }

        .page-header {
            margin-bottom: 2rem;
        }
    }
</style>
@endsection
