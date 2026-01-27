@extends('layouts.app')

@section('title', 'Classes')

@section('content')
<div class="page-header">
    <h1 class="page-title">Classes</h1>
    <a href="{{ route('classes.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Add Class
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
        <h5 class="mb-0">All Classes</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Class Name</th>
                        <th>Sections</th>
                        <th>Students</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($classes as $class)
                    <tr>
                        <td>
                            <div style="font-weight: 500;">{{ $class->name }}</div>
                        </td>
                        <td><span class="badge" style="background-color: rgba(59, 130, 246, 0.1); color: #3b82f6;">{{ $class->sections_count }} Sections</span></td>
                        <td><span class="badge badge-success">{{ $class->students_count }} Students</span></td>
                        <td>
                            <span class="badge badge-primary">Active</span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('classes.show', $class->id) }}" class="btn btn-info" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('classes.edit', $class->id) }}" class="btn btn-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('classes.destroy', $class->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
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
                        <td colspan="5" class="text-center text-muted py-4">
                            <i class="bi bi-inbox" style="font-size: 2rem; display: block; margin-bottom: 0.5rem;"></i>
                            No classes found
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $classes->links() }}
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
