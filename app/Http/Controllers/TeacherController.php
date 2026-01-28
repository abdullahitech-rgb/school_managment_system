<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    /**
     * Display a listing of teachers
     */
    public function index()
    {
        $teachers = Teacher::with('user')->paginate(10);
        return view('teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new teacher
     */
    public function create()
    {
        return view('teachers.create');
    }

    /**
     * Store a newly created teacher in database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'phone' => 'nullable|string',
            'qualification' => 'nullable|string',
            'joining_date' => 'nullable|date',
            'address' => 'nullable|string',
        ]);

        // Create user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'teacher',
            'status' => 'active',
        ]);

        // Create teacher
        Teacher::create([
            'user_id' => $user->id,
            'phone' => $validated['phone'],
            'qualification' => $validated['qualification'],
            'joining_date' => $validated['joining_date'],
            'address' => $validated['address'],
        ]);

        return redirect()->route('teachers.index')->with('success', 'Teacher created successfully');
    }

    /**
     * Show teacher details
     */
    public function show(Teacher $teacher)
    {
        $teacher->load('user');
        return view('teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing teacher
     */
    public function edit(Teacher $teacher)
    {
        return view('teachers.edit', compact('teacher'));
    }

    /**
     * Update teacher in database
     */
    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string',
            'qualification' => 'nullable|string',
            'joining_date' => 'nullable|date',
            'address' => 'nullable|string',
        ]);

        // Update user
        $teacher->user->update(['name' => $validated['name']]);

        // Update teacher
        $teacher->update($validated);

        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully');
    }

    /**
     * Delete teacher
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->user()->delete();
        $teacher->delete();

        return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully');
    }
}
