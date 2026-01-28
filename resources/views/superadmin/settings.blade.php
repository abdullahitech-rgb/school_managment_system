@extends('layouts.superadmin')

@section('title', 'System Settings')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="h3 d-inline-block">System Settings</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Configuration</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('superadmin.settings.update') }}" method="POST">
                        @csrf

                        <div class="alert alert-info" role="alert">
                            <i class="fas fa-info-circle"></i>
                            System settings configuration panel. More options coming soon.
                        </div>

                        <div class="mb-3">
                            <h6>System Information</h6>
                            <p class="text-muted">
                                <strong>Current Date:</strong> {{ now()->format('M d, Y H:i') }}<br>
                                <strong>Application Version:</strong> 1.0.0<br>
                                <strong>Total Schools:</strong> {{ App\Models\School::count() }}<br>
                                <strong>Total Admins:</strong> {{ App\Models\User::where('role', 'admin')->count() }}
                            </p>
                        </div>

                        <hr>

                        <div class="mb-3">
                            <h6>Email Configuration</h6>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="emailNotifications" name="email_notifications" checked>
                                <label class="form-check-label" for="emailNotifications">
                                    Enable Email Notifications
                                </label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <h6>Maintenance Mode</h6>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="maintenance" name="maintenance_mode">
                                <label class="form-check-label" for="maintenance">
                                    Enable Maintenance Mode
                                </label>
                            </div>
                        </div>

                        <hr>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Save Settings
                            </button>
                            <a href="{{ route('superadmin.dashboard') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left"></i> Back
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
