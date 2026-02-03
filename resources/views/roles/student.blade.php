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

<div class="alert alert-warning">
    <i class="bi bi-person-check me-2"></i>
    Students stay informed about classes, attendance, and progress from one unified dashboard.
</div>

@include('roles.partials.permissions-list', ['role' => $role])
@endsection
