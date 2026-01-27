@extends('layouts.app')

@section('title', 'Student Details')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3">
    <h1 class="page-title">Student Details</h1>
    <div class="btn-group">
        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning">
            <i class="bi bi-pencil"></i> Edit
        </a>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>
</div>

<div class="row">
    <!-- Personal Information Card -->
    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-person-fill me-2"></i>Personal Information</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless table-sm">
                    <tr>
                        <td class="fw-bold" style="width: 40%;">Name:</td>
                        <td>{{ $student->user->name }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Email:</td>
                        <td><a href="mailto:{{ $student->user->email }}">{{ $student->user->email }}</a></td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Admission No:</td>
                        <td><span class="badge badge-primary">{{ $student->admission_no }}</span></td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Date of Birth:</td>
                        <td>{{ $student->date_of_birth ? \Carbon\Carbon::parse($student->date_of_birth)->format('M d, Y') : 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Gender:</td>
                        <td>
                            @if($student->gender == 'male')
                                <span class="badge" style="background-color: rgba(59, 130, 246, 0.1); color: #3b82f6;">Male</span>
                            @elseif($student->gender == 'female')
                                <span class="badge" style="background-color: rgba(236, 72, 153, 0.1); color: #ec4899;">Female</span>
                            @else
                                <span class="badge badge-warning">{{ $student->gender ?? 'N/A' }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Phone:</td>
                        <td>{{ $student->phone ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Address:</td>
                        <td>{{ $student->address ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- Academic Information Card -->
    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-book-fill me-2"></i>Academic Information</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless table-sm">
                    <tr>
                        <td class="fw-bold" style="width: 40%;">Class:</td>
                        <td>
                            @if($student->class)
                                <span class="badge badge-primary">{{ $student->class->name }}</span>
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Section:</td>
                        <td>
                            @if($student->section)
                                <span class="badge badge-success">{{ $student->section->name }}</span>
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Parent/Guardian:</td>
                        <td>
                            @if($student->parent)
                                {{ $student->parent->user->name }}
                                <br>
                                <small class="text-muted">{{ $student->parent->user->email }}</small>
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Status:</td>
                        <td>
                            @if($student->user->status == 'active')
                                <span class="badge badge-success">Active</span>
                            @elseif($student->user->status == 'inactive')
                                <span class="badge badge-warning">Inactive</span>
                            @else
                                <span class="badge badge-danger">Suspended</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Joined:</td>
                        <td>{{ \Carbon\Carbon::parse($student->user->created_at)->format('M d, Y') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-group {
        display: flex;
        gap: 0.5rem;
    }

    .table-sm td {
        padding: 0.75rem;
        border-bottom: 1px solid #e5e7eb;
    }

    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .btn-group {
            width: 100%;
            flex-direction: column;
        }

        .btn-group .btn {
            width: 100%;
            text-align: left;
        }
    }
</style>

