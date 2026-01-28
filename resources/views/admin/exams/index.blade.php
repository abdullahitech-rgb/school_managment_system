@extends('layouts.admin')

@section('title', 'Exams')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="h3 d-inline-block">Exams</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.exams.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Exam
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
                    <h5 class="mb-0">All Exams</h5>
                </div>
                <div class="card-body">
                    @if ($exams->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Exam Name</th>
                                        <th>Class</th>
                                        <th>Exam Date</th>
                                        <th>Status</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($exams as $exam)
                                        <tr>
                                            <td><strong>{{ $exam->name }}</strong></td>
                                            <td><strong>{{ $exam->class?->name ?? '-' }}</strong></td>
                                            <td>{{ $exam->exam_date ? \Carbon\Carbon::parse($exam->exam_date)->format('d M Y') : '-' }}</td>
                                            <td>
                                                @if ($exam->status == 'scheduled')
                                                    <span class="badge bg-warning">Scheduled</span>
                                                @elseif ($exam->status == 'ongoing')
                                                    <span class="badge bg-info">Ongoing</span>
                                                @else
                                                    <span class="badge bg-success">Completed</span>
                                                @endif
                                            </td>
                                            <td>{{ Str::limit($exam->description, 50) ?? '-' }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.exams.edit', $exam->id) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                                        <i class="fas fa-pen"></i> Edit
                                                    </a>
                                                    <form action="{{ route('admin.exams.destroy', $exam->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this exam?');">
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
                            {{ $exams->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-inbox" style="font-size: 48px; color: #ccc;"></i>
                            <h5 class="mt-3">No Exams Found</h5>
                            <p class="text-muted">Get started by adding your first exam.</p>
                            <a href="{{ route('admin.exams.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Add Exam
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
