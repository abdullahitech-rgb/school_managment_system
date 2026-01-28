@extends('layouts.admin')

@section('title', 'Admin Dashboard')

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
                <i class="fas fa-chalkboard-user" style="font-size: 2rem; color: var(--primary);"></i>
                <div class="stat-value">{{ $totalTeachers }}</div>
                <div class="stat-label">Teachers</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <i class="fas fa-users" style="font-size: 2rem; color: var(--secondary);"></i>
                <div class="stat-value">{{ $totalStudents }}</div>
                <div class="stat-label">Students</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <i class="fas fa-door-open" style="font-size: 2rem; color: var(--success);"></i>
                <div class="stat-value">{{ $totalClasses }}</div>
                <div class="stat-label">Classes</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <i class="fas fa-book" style="font-size: 2rem; color: var(--warning);"></i>
                <div class="stat-value">{{ $totalSubjects }}</div>
                <div class="stat-label">Subjects</div>
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
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="mb-3">Management</h6>
                            <a href="{{ route('admin.teachers.create') }}" class="btn btn-sm btn-primary me-2 mb-2">
                                <i class="fas fa-user-plus"></i> Add Teacher
                            </a>
                            <a href="{{ route('admin.students.create') }}" class="btn btn-sm btn-primary me-2 mb-2">
                                <i class="fas fa-user-plus"></i> Add Student
                            </a>
                            <a href="{{ route('admin.classes.create') }}" class="btn btn-sm btn-primary me-2 mb-2">
                                <i class="fas fa-plus"></i> Create Class
                            </a>
                        </div>
                        <div class="col-md-6">
                            <h6 class="mb-3">Academics</h6>
                            <a href="{{ route('admin.exams.create') }}" class="btn btn-sm btn-secondary me-2 mb-2">
                                <i class="fas fa-plus"></i> Create Exam
                            </a>
                            <a href="{{ route('admin.results.create') }}" class="btn btn-sm btn-secondary me-2 mb-2">
                                <i class="fas fa-plus"></i> Add Result
                            </a>
                            <a href="{{ route('admin.attendance.create') }}" class="btn btn-sm btn-secondary me-2 mb-2">
                                <i class="fas fa-plus"></i> Mark Attendance
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Management Cards -->
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Teachers</h6>
                </div>
                <div class="card-body text-center">
                    <h3 class="text-primary mb-3">{{ $totalTeachers }}</h3>
                    <a href="{{ route('admin.teachers.index') }}" class="btn btn-outline-primary btn-sm">View All</a>
                    <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary btn-sm">Add New</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Students</h6>
                </div>
                <div class="card-body text-center">
                    <h3 class="text-secondary mb-3">{{ $totalStudents }}</h3>
                    <a href="{{ route('admin.students.index') }}" class="btn btn-outline-secondary btn-sm">View All</a>
                    <a href="{{ route('admin.students.create') }}" class="btn btn-secondary btn-sm">Add New</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Classes & Subjects</h6>
                </div>
                <div class="card-body text-center">
                    <h3 class="text-success mb-3">{{ $totalClasses }}</h3>
                    <a href="{{ route('admin.classes.index') }}" class="btn btn-outline-success btn-sm">Classes</a>
                    <a href="{{ route('admin.subjects.index') }}" class="btn btn-outline-info btn-sm">Subjects</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Info -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Available Features</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h6><i class="fas fa-check text-success"></i> Teachers Management</h6>
                            <p class="text-muted">Create, edit, and manage teacher information</p>
                        </div>
                        <div class="col-md-4">
                            <h6><i class="fas fa-check text-success"></i> Students Management</h6>
                            <p class="text-muted">Manage student enrollment and class assignments</p>
                        </div>
                        <div class="col-md-4">
                            <h6><i class="fas fa-check text-success"></i> Exams & Results</h6>
                            <p class="text-muted">Schedule exams and record student results with grades</p>
                        </div>
                        <div class="col-md-4">
                            <h6><i class="fas fa-check text-success"></i> Attendance Tracking</h6>
                            <p class="text-muted">Mark and monitor student attendance</p>
                        </div>
                        <div class="col-md-4">
                            <h6><i class="fas fa-check text-success"></i> Fee Management</h6>
                            <p class="text-muted">Set up and manage fee structures</p>
                        </div>
                        <div class="col-md-4">
                            <h6><i class="fas fa-check text-success"></i> Class & Subject Setup</h6>
                            <p class="text-muted">Create classes and assign subjects</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
