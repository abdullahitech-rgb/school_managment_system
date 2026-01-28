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
                            <div class="d-flex gap-2">
                                <a href="{{ route('classes.show', $class->id) }}" class="btn-action btn-action-view" title="View Details">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('classes.edit', $class->id) }}" class="btn-action btn-action-edit" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('classes.destroy', $class->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-action-delete" title="Delete">
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

    /* Modern Action Buttons */
    .btn-action {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        border: none;
        transition: all 0.2s ease;
        background: transparent;
        text-decoration: none;
    }
    .btn-action i {
        font-size: 1rem;
        line-height: 1;
    }
    
    .btn-action-view {
        color: #3b82f6;
        background-color: rgba(59, 130, 246, 0.1);
    }
    .btn-action-view:hover {
        background-color: #3b82f6;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.3);
    }

    .btn-action-edit {
        color: #f59e0b;
        background-color: rgba(245, 158, 11, 0.1);
    }
    .btn-action-edit:hover {
        background-color: #f59e0b;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 6px -1px rgba(245, 158, 11, 0.3);
    }

    .btn-action-delete {
        color: #ef4444;
        background-color: rgba(239, 68, 68, 0.1);
    }
    .btn-action-delete:hover {
        background-color: #ef4444;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 6px -1px rgba(239, 68, 68, 0.3);
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
