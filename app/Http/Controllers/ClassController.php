<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    /**
     * Display a listing of classes
     */
    public function index()
    {
        $classes = Classes::withCount('students', 'sections')->paginate(10);
        return view('classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new class
     */
    public function create()
    {
        return view('classes.create');
    }

    /**
     * Store a newly created class in database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:classes',
            'description' => 'nullable|string',
        ]);

        Classes::create($validated);

        return redirect()->route('classes.index')->with('success', 'Class created successfully');
    }

    /**
     * Show class details
     */
    public function show(Classes $class)
    {
        $class->load('sections', 'students', 'subjects', 'classTeachers.teacher');
        return view('classes.show', compact('class'));
    }

    /**
     * Show the form for editing class
     */
    public function edit(Classes $class)
    {
        return view('classes.edit', compact('class'));
    }

    /**
     * Update class in database
     */
    public function update(Request $request, Classes $class)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:classes,name,' . $class->id,
            'description' => 'nullable|string',
        ]);

        $class->update($validated);

        return redirect()->route('classes.index')->with('success', 'Class updated successfully');
    }

    /**
     * Delete class
     */
    public function destroy(Classes $class)
    {
        $class->delete();

        return redirect()->route('classes.index')->with('success', 'Class deleted successfully');
    }
}
