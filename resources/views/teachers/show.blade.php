@extends('layouts.app')

@section('title', 'Teacher Details')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Teacher Profile</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('teachers.index') }}">Teachers</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $teacher->user->name }}</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-warning">
            <i class="bi bi-pencil-square me-2"></i>Edit Profile
        </a>
        <a href="{{ route('teachers.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back to List
        </a>
    </div>
</div>

<div class="row">
    <!-- Left Column: Profile Card -->
    <div class="col-lg-4 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body text-center p-5">
                <div class="user-avatar-circle mx-auto mb-4" style="width: 120px; height: 120px; font-size: 3rem; background: linear-gradient(135deg, var(--primary), #818cf8); box-shadow: 0 10px 25px -5px rgba(99, 102, 241, 0.4);">
                    {{ strtoupper(substr($teacher->user->name, 0, 1)) }}
                </div>
                <h2 class="h3 fw-bold mb-1">{{ $teacher->user->name }}</h2>
                <p class="text-muted mb-4">{{ $teacher->user->email }}</p>

                <div class="d-flex justify-content-center gap-2 mb-4">
                    @if($teacher->user->status == 'active')
                        <span class="badge badge-success px-3 py-2"><i class="bi bi-check-circle-fill me-1"></i> Active</span>
                    @else
                        <span class="badge badge-warning px-3 py-2"><i class="bi bi-exclamation-circle-fill me-1"></i> {{ ucfirst($teacher->user->status) }}</span>
                    @endif
                </div>

                <div class="border-top pt-4 text-start">
                    <h6 class="text-uppercase text-muted small fw-bold mb-3">Quick Contact</h6>
                    <div class="d-flex align-items-center mb-3">
                        <div class="d-flex align-items-center justify-content-center bg-light rounded-circle me-3" style="width: 40px; height: 40px; color: var(--primary);">
                            <i class="bi bi-telephone"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Phone</small>
                            <span class="fw-medium">{{ $teacher->phone ?? 'Not Available' }}</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="d-flex align-items-center justify-content-center bg-light rounded-circle me-3" style="width: 40px; height: 40px; color: var(--secondary);">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Address</small>
                            <span class="fw-medium">{{ $teacher->address ?? 'Not Available' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Details & Assignments -->
    <div class="col-lg-8">
        <!-- Professional Info -->
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-header bg-white border-bottom pt-4 pb-3 ps-4">
                <h5 class="card-title d-flex align-items-center mb-0">
                    <i class="bi bi-briefcase text-primary me-2"></i> Professional Information
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="text-muted small text-uppercase fw-bold mb-1">Qualification</label>
                        <p class="fw-bold mb-0 fs-5 text-dark">
                            {{ $teacher->qualification ?? 'Not Specified' }}
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small text-uppercase fw-bold mb-1">Joining Date</label>
                        <p class="fw-medium mb-0 fs-5">
                            {{ $teacher->joining_date ? \Carbon\Carbon::parse($teacher->joining_date)->format('F d, Y') : 'N/A' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Academic Assignments -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom pt-4 pb-3 ps-4">
                <h5 class="card-title d-flex align-items-center mb-0">
                    <i class="bi bi-journal-check text-success me-2"></i> Class Assignments
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">Class</th>
                                <th>Section</th>
                                <th class="text-end pe-4">Students</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($teacher->classTeachers as $assignment)
                                <tr>
                                    <td class="ps-4">
                                        <span class="fw-bold text-dark">{{ $assignment->class->name }}</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-primary px-3">{{ $assignment->section->name }}</span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <span class="text-muted fw-medium">{{ $assignment->section->students->count() ?? 0 }} Students</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-5">
                                        <div class="mb-2">
                                            <i class="bi bi-journal-x fs-1 text-muted opacity-50"></i>
                                        </div>
                                        <p class="text-muted mb-0">No classes assigned to this teacher yet.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
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
        transform: scale(1.05) rotate(-5deg);
    }
    .table thead th {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 700;
        color: var(--text-muted);
        border-top: none;
    }
</style>
@endsection
