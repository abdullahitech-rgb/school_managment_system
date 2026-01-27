@extends('layouts.app')

@section('title', 'Create Student')

@section('content')
<div class="page-header">
    <h1 class="page-title">Add New Student</h1>
</div>

@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="bi bi-exclamation-triangle me-2"></i>
    <strong>Validation Errors!</strong>
    <ul class="mb-0 mt-2">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Student Information</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('students.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name" class="form-label">Full Name *</label>
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter student name" value="{{ old('name') }}" required>
                        @error('name') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email" class="form-label">Email Address *</label>
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter email address" value="{{ old('email') }}" required>
                        @error('email') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password" class="form-label">Password *</label>
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter password" required>
                        @error('password') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Confirm Password *</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm password" required>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="admission_no" class="form-label">Admission Number *</label>
                        <input type="text" id="admission_no" name="admission_no" class="form-control @error('admission_no') is-invalid @enderror" placeholder="Enter admission number" value="{{ old('admission_no') }}" required>
                        @error('admission_no') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="date_of_birth" class="form-label">Date of Birth</label>
                        <input type="date" id="date_of_birth" name="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror" value="{{ old('date_of_birth') }}">
                        @error('date_of_birth') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="gender" class="form-label">Gender</label>
                        <select id="gender" name="gender" class="form-control @error('gender') is-invalid @enderror">
                            <option value="">Select Gender</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('gender') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="tel" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Enter phone number" value="{{ old('phone') }}">
                        @error('phone') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="class_id" class="form-label">Class *</label>
                        <select id="class_id" name="class_id" class="form-control @error('class_id') is-invalid @enderror" required>
                            <option value="">Select Class</option>
                            @foreach($classes as $class)
                            <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                            @foreach($sections as $section)
                            <option value="{{ $section->id }}" {{ old('section_id') == $section->id ? 'selected' : '' }}>{{ $section->name }}</option>
                            @endforeach
                        </select>
                        @error('section_id') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="parent_id" class="form-label">Parent/Guardian</label>
                        <select id="parent_id" name="parent_id" class="form-control @error('parent_id') is-invalid @enderror">
                            <option value="">Select Parent/Guardian</option>
                            @foreach($parents as $parent)
                            <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>{{ $parent->user->name }}</option>
                            @endforeach
                        </select>
                        @error('parent_id') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" id="address" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Enter address" value="{{ old('address') }}">
                        @error('address') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg"></i> Add Student
                </button>
                <a href="{{ route('students.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-lg"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<style>
    .form-group {
        margin-bottom: 1.5rem;
    }

    .invalid-feedback {
        font-size: 0.875rem;
        color: #ef4444;
    }
</style>
@endsection
