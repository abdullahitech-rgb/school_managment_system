@extends('layouts.app')

@section('title', 'Create Class')

@section('content')
<div class="page-header">
    <h1 class="page-title">Add New Class</h1>
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
        <form action="{{ route('classes.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Class Name *</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Class</button>
            <a href="{{ route('classes.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
