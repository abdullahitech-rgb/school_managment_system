@extends('layouts.admin')

@section('title', 'Sections')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="h3 d-inline-block">Sections</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.sections.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Section
            </a>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">All Sections</h5>
                </div>
                <div class="card-body">
                    @if ($sections->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Class</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sections as $section)
                                        <tr>
                                            <td><strong>{{ $section->name }}</strong></td>
                                            <td>{{ $section->class?->name ?? '-' }}</td>
                                            <td>{{ Str::limit($section->description, 50) ?? '-' }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.sections.edit', $section->id) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                                        <i class="fas fa-pen"></i> Edit
                                                    </a>
                                                    <form action="{{ route('admin.sections.destroy', $section->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this section?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                                            <i class="fas fa-trash-alt"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            {{ $sections->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-inbox" style="font-size: 48px; color: #ccc;"></i>
                            <h5 class="mt-3">No Sections Found</h5>
                            <p class="text-muted">Get started by adding your first section.</p>
                            <a href="{{ route('admin.sections.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Add Section
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
