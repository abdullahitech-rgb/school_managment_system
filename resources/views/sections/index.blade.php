@extends('layouts.app')

@section('title', 'Sections')

@section('content')
<div class="page-header">
    <h1 class="page-title">Sections</h1>
    <a href="{{ route('sections.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Add Section
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
        <h5 class="mb-0">All Sections</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Class</th>
                        <th>Section Name</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sections as $section)
                    <tr>
                        <td>
                            <span class="badge badge-primary">{{ $section->class->name }}</span>
                        </td>
                        <td>
                            <div style="font-weight: 500;">{{ $section->name }}</div>
                        </td>
                        <td>
                            <span class="badge badge-success">Active</span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('sections.show', $section->id) }}" class="btn btn-info" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('sections.edit', $section->id) }}" class="btn btn-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('sections.destroy', $section->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
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
                        <td colspan="4" class="text-center text-muted py-4">
                            <i class="bi bi-inbox" style="font-size: 2rem; display: block; margin-bottom: 0.5rem;"></i>
                            No sections found
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $sections->links() }}
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
