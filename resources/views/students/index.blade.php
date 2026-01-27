@extends('layouts.app')

@section('title', 'Students')

@section('content')
<div class="page-header">
    <h1 class="page-title">Students</h1>
    <a href="{{ route('students.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Add Student
    </a>
</div>

@if($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle me-2"></i>
    {{ $message }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">All Students</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Admission No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Class</th>
                        <th>Section</th>
                        <th>Gender</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $student)
                    <tr>
                        <td><span class="badge badge-primary">{{ $student->admission_no }}</span></td>
                        <td>
                            <div style="font-weight: 500;">{{ $student->user->name }}</div>
                            <small style="color: #6b7280;">ID: {{ $student->id }}</small>
                        </td>
                        <td>{{ $student->user->email }}</td>
                        <td>{{ $student->class->name ?? 'N/A' }}</td>
                        <td>{{ $student->section->name ?? 'N/A' }}</td>
                        <td>
                            @if($student->gender == 'male')
                                <span class="badge" style="background-color: rgba(59, 130, 246, 0.1); color: #3b82f6;">Male</span>
                            @elseif($student->gender == 'female')
                                <span class="badge" style="background-color: rgba(236, 72, 153, 0.1); color: #ec4899;">Female</span>
                            @else
                                <span class="badge badge-warning">N/A</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('students.show', $student->id) }}" class="btn btn-info" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            <i class="bi bi-inbox" style="font-size: 2rem; display: block; margin-bottom: 0.5rem;"></i>
                            No students found
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $students->links() }}
        </div>
    </div>
</div>

<style>
    .btn-group-sm .btn {
        padding: 0.375rem 0.5rem;
        font-size: 0.875rem;
    }

    @media (max-width: 768px) {
        .table-responsive {
            font-size: 0.85rem;
        }

        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>
@endsection
