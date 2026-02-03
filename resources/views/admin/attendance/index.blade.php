@extends('layouts.admin')

@section('title', 'Attendance')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="h3 d-inline-block">Attendance</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.attendance.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Mark Attendance
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
                    <h5 class="mb-0">Attendance Records</h5>
                </div>
                <div class="card-body">
                    @if ($attendance->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Student</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Remarks</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($attendance as $record)
                                        <tr>
                                            <td><strong>{{ $record->student?->name ?? '-' }}</strong></td>
                                            <td>{{ $record->attendance_date ? \Carbon\Carbon::parse($record->attendance_date)->format('d M Y') : '-' }}</td>
                                            <td>
                                                <span class="badge bg-secondary">
                                                    {{ $record->attendanceType?->name ?? 'Unknown' }}
                                                </span>
                                            </td>
                                            <td>{{ $record->remarks ?? '-' }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.attendance.edit', $record->id) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                                        <i class="fas fa-pen"></i> Edit
                                                    </a>
                                                    <form action="{{ route('admin.attendance.destroy', $record->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this record?');">
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
                            {{ $attendance->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-inbox" style="font-size: 48px; color: #ccc;"></i>
                            <h5 class="mt-3">No Attendance Records Found</h5>
                            <p class="text-muted">Get started by marking attendance.</p>
                            <a href="{{ route('admin.attendance.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Mark Attendance
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
