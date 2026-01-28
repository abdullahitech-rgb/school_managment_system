@extends('layouts.app')
@section('title', 'Edit Section')
@section('content')
<div class="page-header">
    <h1 class="page-title">Edit Section</h1>
</div>

@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong>
    <ul class="mb-0">
        @foreach($errors->all() as $e)
            <li>{{ $e }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card">
    <div class="card-body">
        <form action="{{ route('sections.update', $section->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Class *</label>
                <select name="class_id" class="form-control" required>
                    @foreach($classes as $class)
                    <option value="{{ $class->id }}" {{ old('class_id', $section->class_id) == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Section Name *</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $section->name) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description', $section->description) }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Section</button>
            <a href="{{ route('sections.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
