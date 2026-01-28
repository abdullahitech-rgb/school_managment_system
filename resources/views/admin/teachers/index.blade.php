@extends('layouts.admin')

@section('title', 'Teachers')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="h3 d-inline-block">Teachers</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Teacher
            </a>
        </div>
    </div>

    <div class="card">
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
                        @forelse ($teachers as $teacher)
                        <tr>
                            <td><strong>{{ $teacher->user->name }}</strong></td>
                            <td>{{ $teacher->user->email }}</td>
                            <td>{{ $teacher->phone ?? 'N/A' }}</td>
                            <td>{{ $teacher->qualification ?? 'N/A' }}</td>
                            <td>{{ $teacher->joining_date ? \Carbon\Carbon::parse($teacher->joining_date)->format('M d, Y') : 'N/A' }}</td>
                            <td>
                                <span class="badge {{ $teacher->user->status === 'active' ? 'bg-success' : 'bg-warning' }}">
                                    {{ ucfirst($teacher->user->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.teachers.edit', $teacher) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                        <i class="fas fa-pen"></i> Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.teachers.destroy', $teacher) }}" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this teacher?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                <i class="fas fa-inbox"></i> No teachers found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if ($teachers->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $teachers->links() }}
    </div>
    @endif
</div>
@endsection
