<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    public function index()
    {
        $roles = config('role_permissions');

        return view('roles.index', compact('roles'));
    }

    public function show(string $role)
    {
        $roles = config('role_permissions');

        if (!array_key_exists($role, $roles)) {
            abort(404);
        }

        $view = view()->exists("roles.$role") ? "roles.$role" : 'roles.show';

        return view($view, [
            'roleKey' => $role,
            'role' => $roles[$role],
        ]);
    }
}
