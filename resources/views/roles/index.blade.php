@extends('layouts.app')

@section('title', 'Roles & Permissions')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Roles & Permissions</h1>
        <p class="page-subtitle">Overview of platform roles and their core responsibilities.</p>
    </div>
</div>

<div class="row g-4">
    @foreach($roles as $roleKey => $role)
        <div class="col-lg-4 col-md-6">
            <div class="card h-100">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="badge badge-primary text-uppercase">{{ $role['label'] }}</span>
                        <i class="bi bi-shield-check text-primary"></i>
                    </div>
                    <h5 class="mb-2">{{ $role['description'] }}</h5>
                    <p class="text-muted flex-grow-1">
                        {{ count($role['categories']) }} categories, {{ collect($role['categories'])->flatten()->count() }} permissions.
                    </p>
                    <a href="{{ route('roles.show', $roleKey) }}" class="btn btn-outline-primary mt-auto">
                        View details
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
