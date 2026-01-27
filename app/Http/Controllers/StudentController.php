<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Parent_;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of students
     */
    public function index()
    {
        $students = Student::with('user', 'class', 'section', 'parent')->paginate(10);
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new student
     */
    public function create()
    {
        $classes = Classes::all();
        $sections = Section::all();
        $parents = Parent_::with('user')->get();

        return view('students.create', compact('classes', 'sections', 'parents'));
    }

    /**
     * Store a newly created student in database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'admission_no' => 'required|unique:students',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:Male,Female,Other',
            'class_id' => 'required|exists:classes,id',
            'section_id' => 'required|exists:sections,id',
            'parent_id' => 'nullable|exists:parents,id',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
        ]);

        // Create user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'student',
            'status' => 'active',
        ]);

        // Create student
        Student::create([
            'user_id' => $user->id,
            'admission_no' => $validated['admission_no'],
            'date_of_birth' => $validated['date_of_birth'],
            'gender' => $validated['gender'],
            'class_id' => $validated['class_id'],
            'section_id' => $validated['section_id'],
            'parent_id' => $validated['parent_id'],
            'address' => $validated['address'],
            'phone' => $validated['phone'],
        ]);

        return redirect()->route('students.index')->with('success', 'Student created successfully');
    }

    /**
     * Show student details
     */
    public function show(Student $student)
    {
        $student->load('user', 'class', 'section', 'parent');
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing student
     */
    public function edit(Student $student)
    {
        $classes = Classes::all();
        $sections = Section::all();
        $parents = Parent_::with('user')->get();

        return view('students.edit', compact('student', 'classes', 'sections', 'parents'));
    }

    /**
     * Update student in database
     */
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:Male,Female,Other',
            'class_id' => 'required|exists:classes,id',
            'section_id' => 'required|exists:sections,id',
            'parent_id' => 'nullable|exists:parents,id',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
        ]);

        // Update user
        $student->user->update(['name' => $validated['name']]);

        // Update student
        $student->update($validated);

        return redirect()->route('students.index')->with('success', 'Student updated successfully');
    }

    /**
     * Delete student
     */
    public function destroy(Student $student)
    {
        $student->user()->delete();
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully');
    }
}
