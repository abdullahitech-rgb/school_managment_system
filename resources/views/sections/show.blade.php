@extends('layouts.app')
@section('title', 'Section Details')
@section('content')
<div class="container-scroller">
    @include('layouts.navbar')
    <div class="container-fluid page-body-wrapper">
        @include('layouts.sidebar')
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header d-flex justify-content-between">
                    <h3 class="page-title">Section Details: {{ $section->name }}</h3>
                    <div>
                        <a href="{{ route('sections.edit', $section->id) }}" class="btn btn-warning"><i class="mdi mdi-pencil"></i> Edit</a>
                        <a href="{{ route('sections.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header"><h5>Section Information</h5></div>
                            <div class="card-body">
                                <p><strong>Class:</strong> {{ $section->class->name }}</p>
                                <p><strong>Section Name:</strong> {{ $section->name }}</p>
                                <p><strong>Description:</strong> {{ $section->description ?? 'N/A' }}</p>
                                <p><strong>Total Students:</strong> <span class="badge bg-success">{{ $section->students->count() }}</span></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header"><h5>Class Teachers</h5></div>
                            <div class="card-body">
                                @forelse($section->classTeachers as $ct)
                                <p><strong>{{ $ct->teacher->user->name }}</strong></p>
                                @empty
                                <p class="text-muted">No teachers assigned</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header"><h5>Students in this Section</h5></div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Admission No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($section->students as $student)
                                <tr>
                                    <td>{{ $student->admission_no }}</td>
                                    <td>{{ $student->user->name }}</td>
                                    <td>{{ $student->user->email }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">No students in this section</td>
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
