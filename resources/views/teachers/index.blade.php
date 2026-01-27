@extends('layouts.app')

@section('title', 'Teachers')

@section('content')
<div class="page-header">
    <h1 class="page-title">Teachers</h1>
    <a href="{{ route('teachers.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Add Teacher
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
        <h5 class="mb-0">All Teachers</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Qualification</th>
                        <th>Joining Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($teachers as $teacher)
                    <tr>
                        <td>
                            <div style="font-weight: 500;">{{ $teacher->user->name }}</div>
                            <small style="color: #6b7280;">ID: {{ $teacher->id }}</small>
                        </td>
                        <td>{{ $teacher->user->email }}</td>
                        <td>{{ $teacher->phone ?? 'N/A' }}</td>
                        <td>{{ $teacher->qualification ?? 'N/A' }}</td>
                        <td>{{ $teacher->joining_date ? \Carbon\Carbon::parse($teacher->joining_date)->format('M d, Y') : 'N/A' }}</td>
                        <td>
                            @if($teacher->user->status == 'active')
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-warning">{{ ucfirst($teacher->user->status) }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('teachers.show', $teacher->id) }}" class="btn btn-info" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
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
                            No teachers found
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $teachers->links() }}
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
