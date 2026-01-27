@extends('layouts.app')
@section('title', 'Class Details')
@section('content')
<div class="container-scroller">
    @include('layouts.navbar')
    <div class="container-fluid page-body-wrapper">
        @include('layouts.sidebar')
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header d-flex justify-content-between">
                    <h3 class="page-title">Class Details: {{ $class->name }}</h3>
                    <div>
                        <a href="{{ route('classes.edit', $class->id) }}" class="btn btn-warning"><i class="mdi mdi-pencil"></i> Edit</a>
                        <a href="{{ route('classes.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header"><h5>Class Information</h5></div>
                            <div class="card-body">
                                <p><strong>Name:</strong> {{ $class->name }}</p>
                                <p><strong>Description:</strong> {{ $class->description ?? 'N/A' }}</p>
                                <p><strong>Total Sections:</strong> <span class="badge bg-info">{{ $class->sections->count() }}</span></p>
                                <p><strong>Total Students:</strong> <span class="badge bg-success">{{ $class->students->count() }}</span></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header"><h5>Sections</h5></div>
                            <div class="card-body">
                                @forelse($class->sections as $section)
                                <span class="badge bg-primary">{{ $section->name }}</span>
                                @empty
                                <p class="text-muted">No sections assigned</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header"><h5>Subjects</h5></div>
                    <div class="card-body">
                        @forelse($class->subjects as $subject)
                        <div class="badge bg-secondary me-2 mb-2">{{ $subject->name }} ({{ $subject->code }})</div>
                        @empty
                        <p class="text-muted">No subjects assigned</p>
                        @endforelse
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header"><h5>Class Teachers</h5></div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Teacher Name</th>
                                    <th>Section</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($class->classTeachers as $ct)
                                <tr>
                                    <td>{{ $ct->teacher->user->name }}</td>
                                    <td>{{ $ct->section->name }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2" class="text-center text-muted">No teachers assigned</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
