@extends('layouts.superadmin')

@section('title', 'Schools')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="h3 d-inline-block">Schools</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('superadmin.schools.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Create School
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
                            <th>City</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($schools as $school)
                        <tr>
                            <td><strong>{{ $school->name }}</strong></td>
                            <td>{{ $school->email ?? 'N/A' }}</td>
                            <td>{{ $school->city ?? 'N/A' }}</td>
                            <td>{{ $school->phone ?? 'N/A' }}</td>
                            <td>
                                @if ($school->status === 'active')
                                    <span class="badge bg-success">Active</span>
                                @elseif ($school->status === 'inactive')
                                    <span class="badge bg-warning">Inactive</span>
                                @else
                                    <span class="badge bg-danger">Suspended</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('superadmin.schools.edit', $school) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form method="POST" action="{{ route('superadmin.schools.destroy', $school) }}" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="fas fa-inbox"></i> No schools found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if ($schools->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $schools->links() }}
    </div>
    @endif
</div>
@endsection
