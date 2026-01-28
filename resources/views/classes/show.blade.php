@extends('layouts.app')

@section('title', 'Class Details')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Class Details</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('classes.index') }}">Classes</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $class->name }}</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('classes.edit', $class->id) }}" class="btn btn-warning">
            <i class="bi bi-pencil-square me-2"></i>Edit Class
        </a>
        <a href="{{ route('classes.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back to List
        </a>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-4 mb-3 mb-md-0">
        <div class="stat-card primary h-100">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="stat-value">{{ $class->students->count() }}</div>
                    <div class="stat-label">Total Students</div>
                </div>
                <div class="stat-icon-wrapper">
                    <i class="bi bi-people-fill"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3 mb-md-0">
        <div class="stat-card info h-100">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="stat-value">{{ $class->sections->count() }}</div>
                    <div class="stat-label">Active Sections</div>
                </div>
                <div class="stat-icon-wrapper">
                    <i class="bi bi-layers-fill"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card success h-100">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="stat-value">{{ $class->subjects->count() }}</div>
                    <div class="stat-label">Subjects Assigned</div>
                </div>
                <div class="stat-icon-wrapper">
                    <i class="bi bi-book-half"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Left Column: Class Info & Subjects -->
    <div class="col-lg-8 mb-4">
        <!-- General Information -->
        <div class="card mb-4 border-0">
            <div class="card-header bg-white border-bottom pt-4 pb-3">
                <h5 class="card-title text-primary">
                    <i class="bi bi-info-circle me-2"></i>General Information
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="text-muted small text-uppercase fw-bold mb-1">Class Name</label>
                        <p class="fs-4 fw-bold text-dark mb-0">{{ $class->name }}</p>
                    </div>
                    <div class="col-md-6">
                         <!-- Placeholder alignment -->
                         <label class="text-muted small text-uppercase fw-bold mb-1">Status</label>
                         <div><span class="badge badge-success">Active Class</span></div>
                    </div>
                </div>
                <div>
                    <label class="text-muted small text-uppercase fw-bold mb-2">Description</label>
                    <div class="bg-light p-3 rounded" style="border-left: 4px solid var(--primary);">
                        <p class="text-secondary mb-0">
                            {{ $class->description ?? 'No description has been provided for this class curriculum.' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Subjects Grid -->
        <div class="card border-0">
            <div class="card-header bg-white border-bottom pt-4 pb-3">
                <h5 class="card-title text-dark">
                    <i class="bi bi-journal-text me-2 text-primary"></i>Curriculum Subjects
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row g-3">
                    @forelse($class->subjects as $subject)
                        <div class="col-md-6 col-xl-4">
                            <div class="p-3 border rounded-3 d-flex align-items-center gap-3 bg-white h-100 section-card">
                                <div class="d-flex align-items-center justify-content-center rounded-circle" 
                                     style="width: 48px; height: 48px; min-width: 48px; background-color: rgba(99, 102, 241, 0.1); color: var(--primary);">
                                    <i class="bi bi-book fs-5"></i>
                                </div>
                                <div class="overflow-hidden">
                                    <h6 class="mb-1 text-truncate fw-bold" title="{{ $subject->name }}">{{ $subject->name }}</h6>
                                    <span class="badge bg-light text-muted border border-light">{{ $subject->code }}</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <div class="mb-3 text-muted opacity-50">
                                <i class="bi bi-journal-x" style="font-size: 3rem;"></i>
                            </div>
                            <h6 class="text-muted">No subjects assigned yet</h6>
                            <p class="small text-muted">Edit the class to add subjects.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Sections & Teachers -->
    <div class="col-lg-4">
        <!-- Sections Panel -->
        <div class="card mb-4 border-0">
            <div class="card-header bg-white border-bottom pt-3 pb-3">
                <h5 class="card-title text-dark fs-6 text-uppercase fw-bold ls-1 mb-0">
                    <i class="bi bi-layers me-2 text-success"></i>Sections
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush rounded-bottom">
                    @forelse($class->sections as $section)
                        <div class="list-group-item d-flex justify-content-between align-items-center p-3 border-light">
                            <div class="d-flex align-items-center gap-2">
                                <span class="d-flex align-items-center justify-content-center bg-success text-white rounded-circle" style="width: 24px; height: 24px; font-size: 10px;">
                                    <i class="bi bi-check-lg"></i>
                                </span>
                                <span class="fw-semibold text-dark">{{ $section->name }}</span>
                            </div>
                            <!-- You could add a pill for student count here if available in the model relationship directly, but keeping safe -->
                            <i class="bi bi-chevron-right text-muted small"></i>
                        </div>
                    @empty
                        <div class="p-4 text-center text-muted small">
                            No sections created.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Class Teachers Panel -->
        <div class="card border-0">
            <div class="card-header bg-white border-bottom pt-3 pb-3">
                <h5 class="card-title text-dark fs-6 text-uppercase fw-bold ls-1 mb-0">
                    <i class="bi bi-person-video3 me-2 text-warning"></i>Teachers
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush rounded-bottom">
                    @forelse($class->classTeachers as $ct)
                        <div class="list-group-item p-3 border-light">
                            <div class="d-flex align-items-center gap-3">
                                <div class="user-avatar-circle m-0 flex-shrink-0" style="width: 40px; height: 40px; font-size: 1rem; background: linear-gradient(135deg, var(--warning), #f97316);">
                                    {{ strtoupper(substr($ct->teacher->user->name, 0, 1)) }}
                                </div>
                                <div class="overflow-hidden">
                                    <h6 class="mb-0 fw-bold text-dark text-truncate">{{ $ct->teacher->user->name }}</h6>
                                    <small class="text-muted d-flex align-items-center gap-1">
                                        <i class="bi bi-layers-fill" style="font-size: 10px;"></i> 
                                        Section: <span class="fw-medium text-dark">{{ $ct->section->name }}</span>
                                    </small>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-4 text-center text-muted small">
                            No teachers assigned to any sections.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .ls-1 { letter-spacing: 1px; }
    .section-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .section-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
        border-color: var(--primary-soft) !important;
    }
</style>
@endsection
