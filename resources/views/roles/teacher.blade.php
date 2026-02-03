@extends('layouts.app')

@section('title', $role['label'] . ' Permissions')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">{{ $role['label'] }}</h1>
        <p class="page-subtitle">{{ $role['description'] }}</p>
    </div>
    <div>
        <a href="{{ route('roles.index') }}" class="btn btn-light">
            <i class="bi bi-arrow-left me-2"></i>Back to all roles
        </a>
    </div>
</div>

<div class="alert alert-success">
    <i class="bi bi-journal-check me-2"></i>
    Teachers focus on classroom delivery, assessments, and student performance tracking.
</div>

@include('roles.partials.permissions-list', ['role' => $role])
@endsection
