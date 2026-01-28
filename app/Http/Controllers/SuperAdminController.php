<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class SuperAdminController extends Controller
{
    /**
     * Dashboard for SuperAdmin
     */
    public function dashboard()
    {
        $totalSchools = School::count();
        $totalAdmins = User::where('role', 'admin')->count();
        $activeSchools = School::where('status', 'active')->count();

        return view('superadmin.dashboard', compact('totalSchools', 'totalAdmins', 'activeSchools'));
    }

    /**
     * Schools Management - Index
     */
    public function indexSchools()
    {
        $schools = School::paginate(10);
        return view('superadmin.schools.index', compact('schools'));
    }

    /**
     * Schools Management - Create
     */
    public function createSchool()
    {
        return view('superadmin.schools.create');
    }

    /**
     * Schools Management - Store
     */
    public function storeSchool(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:schools',
            'email' => 'nullable|email|unique:schools',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'zip_code' => 'nullable|string',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive,suspended',
        ]);

        School::create($validated);

        return redirect()->route('superadmin.schools.index')->with('success', 'School created successfully');
    }

    /**
     * Schools Management - Edit
     */
    public function editSchool(School $school)
    {
        return view('superadmin.schools.edit', compact('school'));
    }

    /**
     * Schools Management - Update
     */
    public function updateSchool(Request $request, School $school)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('schools')->ignore($school->id)],
            'email' => ['nullable', 'email', Rule::unique('schools')->ignore($school->id)],
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'zip_code' => 'nullable|string',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive,suspended',
        ]);

        $school->update($validated);

        return redirect()->route('superadmin.schools.index')->with('success', 'School updated successfully');
    }

    /**
     * Schools Management - Delete
     */
    public function destroySchool(School $school)
    {
        $school->delete();
        return redirect()->route('superadmin.schools.index')->with('success', 'School deleted successfully');
    }

    /**
     * Admin Management - Index
     */
    public function indexAdmins()
    {
        $admins = User::where('role', 'admin')->with('school')->paginate(10);
        return view('superadmin.admins.index', compact('admins'));
    }

    /**
     * Admin Management - Create
     */
    public function createAdmin()
    {
        $schools = School::where('status', 'active')->get();
        return view('superadmin.admins.create', compact('schools'));
    }

    /**
     * Admin Management - Store
     */
    public function storeAdmin(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'school_id' => 'required|exists:schools,id',
            'phone' => 'nullable|string',
            'status' => 'required|in:active,inactive,suspended',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'admin',
            'school_id' => $validated['school_id'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('superadmin.admins.index')->with('success', 'Admin created successfully');
    }

    /**
     * Admin Management - Edit
     */
    public function editAdmin(User $admin)
    {
        if ($admin->role !== 'admin') {
            abort(404);
        }

        $schools = School::where('status', 'active')->get();
        return view('superadmin.admins.edit', compact('admin', 'schools'));
    }

    /**
     * Admin Management - Update
     */
    public function updateAdmin(Request $request, User $admin)
    {
        if ($admin->role !== 'admin') {
            abort(404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($admin->id)],
            'school_id' => 'required|exists:schools,id',
            'status' => 'required|in:active,inactive,suspended',
        ]);

        $admin->update($validated);

        return redirect()->route('superadmin.admins.index')->with('success', 'Admin updated successfully');
    }

    /**
     * Admin Management - Delete
     */
    public function destroyAdmin(User $admin)
    {
        if ($admin->role !== 'admin') {
            abort(404);
        }

        $admin->delete();
        return redirect()->route('superadmin.admins.index')->with('success', 'Admin deleted successfully');
    }

    /**
     * System Settings
     */
    public function settings()
    {
        return view('superadmin.settings');
    }

    /**
     * Update System Settings
     */
    public function updateSettings(Request $request)
    {
        // Placeholder for system settings update
        return redirect()->route('superadmin.settings')->with('success', 'Settings updated successfully');
    }
}
