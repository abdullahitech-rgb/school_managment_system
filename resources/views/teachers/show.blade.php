@extends('layouts.app')
@section('title', 'Teacher Details')
@section('content')
<div class="container-scroller">
    @include('layouts.navbar')
    <div class="container-fluid page-body-wrapper">
        @include('layouts.sidebar')
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header d-flex justify-content-between">
                    <h3 class="page-title">Teacher Details</h3>
                    <div>
                        <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-warning"><i class="mdi mdi-pencil"></i> Edit</a>
                        <a href="{{ route('teachers.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header"><h5>Personal Information</h5></div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Name:</strong></td>
                                <td>{{ $teacher->user->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Email:</strong></td>
                                <td>{{ $teacher->user->email }}</td>
                            </tr>
                            <tr>
                                <td><strong>Phone:</strong></td>
                                <td>{{ $teacher->phone ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Qualification:</strong></td>
                                <td>{{ $teacher->qualification ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Joining Date:</strong></td>
                                <td>{{ $teacher->joining_date ? \Carbon\Carbon::parse($teacher->joining_date)->format('M d, Y') : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Address:</strong></td>
                                <td>{{ $teacher->address ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Status:</strong></td>
                                <td><span class="badge bg-success">{{ $teacher->user->status }}</span></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
