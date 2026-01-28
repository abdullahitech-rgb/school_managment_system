@extends('layouts.app')

@section('title', 'Section Details')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3">
    <h1 class="page-title">Section Details: {{ $section->name }}</h1>
    <div class="btn-group">
        <a href="{{ route('sections.edit', $section->id) }}" class="btn btn-warning">
            <i class="bi bi-pencil"></i> Edit
        </a>
        <a href="{{ route('sections.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Section Information</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless table-sm">
                    <tr>
                        <td class="fw-bold" style="width: 40%;">Class:</td>
                        <td><span class="badge badge-primary">{{ $section->class->name }}</span></td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Section Name:</td>
                        <td>{{ $section->name }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Description:</td>
                        <td>{{ $section->description ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Total Students:</td>
                        <td><span class="badge badge-success">{{ $section->students->count() }}</span></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-person-workspace me-2"></i>Class Teachers</h5>
            </div>
            <div class="card-body">
                <div class="d-flex flex-column gap-2">
                    @forelse($section->classTeachers as $ct)
                        <div class="d-flex align-items-center gap-2 p-2 border rounded bg-light">
                            <div class="user-avatar-circle" style="width: 32px; height: 32px; font-size: 0.8rem; margin: 0;">
                                {{ strtoupper(substr($ct->teacher->user->name, 0, 1)) }}
                            </div>
                            <span class="fw-bold">{{ $ct->teacher->user->name }}</span>
                        </div>
                    @empty
                        <span class="text-muted">No teachers assigned</span>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="bi bi-people-fill me-2"></i>Students in this Section</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Admission No</th>
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($section->students as $student)
                    <tr>
                        <td><span class="badge badge-secondary">{{ $student->admission_no }}</span></td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="user-avatar-circle" style="width: 32px; height: 32px; font-size: 0.8rem; margin: 0;">
                                    {{ strtoupper(substr($student->user->name, 0, 1)) }}
                                </div>
                                {{ $student->user->name }}
                            </div>
                        </td>
                        <td>{{ $student->user->email }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted py-4">
                            <i class="bi bi-inbox d-block display-6 mb-2"></i>
                            No students in this section
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
