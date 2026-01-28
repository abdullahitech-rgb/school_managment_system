@extends('layouts.app')

@section('title', 'Student Details')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Student Profile</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('students.index') }}">Students</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $student->user->name }}</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning">
            <i class="bi bi-pencil-square me-2"></i>Edit Profile
        </a>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back to List
        </a>
    </div>
</div>

<div class="row">
    <!-- Left Column: Profile Card -->
    <div class="col-lg-4 mb-4">
        <div class="card border-0 h-100">
            <div class="card-body text-center p-5">
                <div class="user-avatar-circle mx-auto mb-4" style="width: 120px; height: 120px; font-size: 3rem; background: linear-gradient(135deg, var(--primary), var(--secondary)); box-shadow: 0 10px 25px -5px rgba(99, 102, 241, 0.4);">
                    {{ strtoupper(substr($student->user->name, 0, 1)) }}
                </div>
                <h2 class="h3 fw-bold mb-1">{{ $student->user->name }}</h2>
                <a href="mailto:{{ $student->user->email }}" class="text-muted mb-4 d-block">{{ $student->user->email }}</a>

                <div class="d-flex justify-content-center gap-2 mb-4">
                    @if($student->user->status == 'active')
                        <span class="badge badge-success px-3 py-2"><i class="bi bi-check-circle-fill me-1"></i> Active</span>
                    @elseif($student->user->status == 'inactive')
                        <span class="badge badge-warning px-3 py-2"><i class="bi bi-pause-circle-fill me-1"></i> Inactive</span>
                    @else
                        <span class="badge badge-danger px-3 py-2"><i class="bi bi-x-circle-fill me-1"></i> Suspended</span>
                    @endif
                    <span class="badge badge-primary px-3 py-2"><i class="bi bi-card-heading me-1"></i> {{ $student->admission_no }}</span>
                </div>

                <div class="border-top pt-4 text-start">
                    <h6 class="text-uppercase text-muted small fw-bold mb-3">Quick Contact</h6>
                    <div class="d-flex align-items-center mb-3">
                        <div class="d-flex align-items-center justify-content-center bg-light rounded-circle me-3" style="width: 40px; height: 40px; color: var(--primary);">
                            <i class="bi bi-telephone"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Phone</small>
                            <span class="fw-medium">{{ $student->phone ?? 'Not Available' }}</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="d-flex align-items-center justify-content-center bg-light rounded-circle me-3" style="width: 40px; height: 40px; color: var(--secondary);">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Address</small>
                            <span class="fw-medium">{{ $student->address ?? 'Not Available' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Details -->
    <div class="col-lg-8">
        <!-- Personal Info -->
        <div class="card mb-4 border-0">
            <div class="card-header bg-white border-bottom pt-4 pb-3 ps-4">
                <h5 class="card-title d-flex align-items-center mb-0">
                    <i class="bi bi-person-badge text-primary me-2"></i> Personal Information
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="text-muted small text-uppercase fw-bold mb-1">Date of Birth</label>
                        <p class="fw-medium mb-0 fs-5">
                            {{ $student->date_of_birth ? \Carbon\Carbon::parse($student->date_of_birth)->format('M d, Y') : 'N/A' }}
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small text-uppercase fw-bold mb-1">Gender</label>
                        <div>
                            @if($student->gender == 'male')
                                <span class="badge" style="background-color: rgba(59, 130, 246, 0.1); color: #3b82f6; font-size: 0.9rem;">
                                    <i class="bi bi-gender-male me-1"></i> Male
                                </span>
                            @elseif($student->gender == 'female')
                                <span class="badge" style="background-color: rgba(236, 72, 153, 0.1); color: #ec4899; font-size: 0.9rem;">
                                    <i class="bi bi-gender-female me-1"></i> Female
                                </span>
                            @else
                                <span class="badge badge-warning">{{ $student->gender ?? 'N/A' }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small text-uppercase fw-bold mb-1">Date Joined</label>
                        <p class="fw-medium mb-0">
                            {{ \Carbon\Carbon::parse($student->user->created_at)->format('F d, Y') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Academic & Guardian Info -->
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card h-100 border-0">
                    <div class="card-header bg-white border-bottom pt-4 pb-3 ps-4">
                        <h5 class="card-title d-flex align-items-center mb-0">
                            <i class="bi bi-mortarboard text-secondary me-2"></i> Academic Info
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <label class="text-muted small text-uppercase fw-bold mb-1">Class</label>
                            @if($student->class)
                                <div class="d-flex align-items-center">
                                    <span class="badge badge-primary fs-6 px-3 py-2">{{ $student->class->name }}</span>
                                </div>
                            @else
                                <span class="text-muted">Not Assigned</span>
                            @endif
                        </div>
                        <div>
                            <label class="text-muted small text-uppercase fw-bold mb-1">Section</label>
                            @if($student->section)
                                <div class="d-flex align-items-center">
                                    <span class="badge badge-success fs-6 px-3 py-2">{{ $student->section->name }}</span>
                                </div>
                            @else
                                <span class="text-muted">Not Assigned</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card h-100 border-0">
                    <div class="card-header bg-white border-bottom pt-4 pb-3 ps-4">
                        <h5 class="card-title d-flex align-items-center mb-0">
                            <i class="bi bi-people text-success me-2"></i> Guardian Info
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        @if($student->parent)
                            <div class="mb-3">
                                <label class="text-muted small text-uppercase fw-bold mb-1">Guardian Name</label>
                                <p class="fw-bold mb-0 text-dark">{{ $student->parent->user->name }}</p>
                            </div>
                            <div>
                                <label class="text-muted small text-uppercase fw-bold mb-1">Email</label>
                                <a href="mailto:{{ $student->parent->user->email }}" class="d-block text-primary">
                                    {{ $student->parent->user->email }}
                                </a>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="bi bi-person-x text-muted fs-1 mb-2 d-block"></i>
                                <span class="text-muted">No guardian info available</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .breadcrumb-item a {
        color: var(--primary);
        text-decoration: none;
    }
    .breadcrumb-item.active {
        color: var(--text-muted);
    }
    .user-avatar-circle {
        transition: transform 0.3s ease;
    }
    .user-avatar-circle:hover {
        transform: scale(1.05) rotate(5deg);
    }
</style>
@endsection
