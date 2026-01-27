<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Classes;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of sections
     */
    public function index()
    {
        $sections = Section::with('class')->paginate(10);
        return view('sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new section
     */
    public function create()
    {
        $classes = Classes::all();
        return view('sections.create', compact('classes'));
    }

    /**
     * Store a newly created section in database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'class_id' => 'required|exists:classes,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Section::create($validated);

        return redirect()->route('sections.index')->with('success', 'Section created successfully');
    }

    /**
     * Show section details
     */
    public function show(Section $section)
    {
        $section->load('class', 'students', 'classTeachers.teacher');
        return view('sections.show', compact('section'));
    }

    /**
     * Show the form for editing section
     */
    public function edit(Section $section)
    {
        $classes = Classes::all();
        return view('sections.edit', compact('section', 'classes'));
    }

    /**
     * Update section in database
     */
    public function update(Request $request, Section $section)
    {
        $validated = $request->validate([
            'class_id' => 'required|exists:classes,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $section->update($validated);

        return redirect()->route('sections.index')->with('success', 'Section updated successfully');
    }

    /**
     * Delete section
     */
    public function destroy(Section $section)
    {
        $section->delete();

        return redirect()->route('sections.index')->with('success', 'Section deleted successfully');
    }
}
