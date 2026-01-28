@extends('layouts.admin')

@section('title', 'Results')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="h3 d-inline-block">Results</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.results.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Result
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
                    <h5 class="mb-0">All Results</h5>
                </div>
                <div class="card-body">
                    @if ($results->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Student</th>
                                        <th>Exam</th>
                                        <th>Subject</th>
                                        <th>Marks</th>
                                        <th>Percentage</th>
                                        <th>Grade</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($results as $result)
                                        <tr>
                                            <td><strong>{{ $result->student?->name ?? '-' }}</strong></td>
                                            <td>{{ $result->exam?->class?->name ?? '-' }}</td>
                                            <td>{{ $result->subject?->name ?? '-' }}</td>
                                            <td>{{ $result->marks ?? '-' }}</td>
                                            <td>{{ $result->percentage ? $result->percentage . '%' : '-' }}</td>
                                            <td>
                                                @if ($result->grade)
                                                    <span class="badge bg-{{ $result->grade == 'A' ? 'success' : ($result->grade == 'B' ? 'info' : ($result->grade == 'C' ? 'warning' : 'danger')) }}">
                                                        {{ $result->grade }}
                                                    </span>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.results.edit', $result->id) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                                        <i class="fas fa-pen"></i> Edit
                                                    </a>
                                                    <form action="{{ route('admin.results.destroy', $result->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this result?');">
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
                            {{ $results->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-inbox" style="font-size: 48px; color: #ccc;"></i>
                            <h5 class="mt-3">No Results Found</h5>
                            <p class="text-muted">Get started by adding your first result.</p>
                            <a href="{{ route('admin.results.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Add Result
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
