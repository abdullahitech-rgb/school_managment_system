<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Student;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Fee;
use App\Models\Exam;
use App\Models\Result;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    /**
     * Dashboard for Admin
     */
    public function dashboard()
    {
        $schoolId = Auth::user()->school_id;

        $totalTeachers = Teacher::whereHas('user', function ($q) use ($schoolId) {
            $q->where('school_id', $schoolId);
        })->count();

        $totalStudents = Student::whereHas('class', function ($q) use ($schoolId) {
            $q->where('school_id', $schoolId);
        })->count();

        $totalClasses = Classes::where('school_id', $schoolId)->count();
        $totalSubjects = Subject::whereHas('class', function ($q) use ($schoolId) {
            $q->where('school_id', $schoolId);
        })->count();

        return view('admin.dashboard', compact('totalTeachers', 'totalStudents', 'totalClasses', 'totalSubjects'));
    }

    /**
     * Teachers Management - Index
     */
    public function indexTeachers()
    {
        $schoolId = Auth::user()->school_id;
        $teachers = Teacher::whereHas('user', function ($q) use ($schoolId) {
            $q->where('school_id', $schoolId);
        })->with('user')->paginate(10);

        return view('admin.teachers.index', compact('teachers'));
    }

    /**
     * Teachers Management - Create
     */
    public function createTeacher()
    {
        return view('admin.teachers.create');
    }

    /**
     * Teachers Management - Store
     */
    public function storeTeacher(Request $request)
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

        $schoolId = Auth::user()->school_id;

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'teacher',
            'school_id' => $schoolId,
            'status' => 'active',
        ]);

        Teacher::create([
            'user_id' => $user->id,
            'phone' => $validated['phone'],
            'qualification' => $validated['qualification'],
            'joining_date' => $validated['joining_date'],
            'address' => $validated['address'],
        ]);

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher created successfully');
    }

    /**
     * Teachers Management - Edit
     */
    public function editTeacher(Teacher $teacher)
    {
        $schoolId = Auth::user()->school_id;
        if ($teacher->user->school_id != $schoolId) {
            abort(403);
        }

        return view('admin.teachers.edit', compact('teacher'));
    }

    /**
     * Teachers Management - Update
     */
    public function updateTeacher(Request $request, Teacher $teacher)
    {
        $schoolId = Auth::user()->school_id;
        if ($teacher->user->school_id != $schoolId) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($teacher->user_id)],
            'phone' => 'nullable|string',
            'qualification' => 'nullable|string',
            'joining_date' => 'nullable|date',
            'address' => 'nullable|string',
        ]);

        $teacher->user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        $teacher->update($validated);

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher updated successfully');
    }

    /**
     * Teachers Management - Delete
     */
    public function destroyTeacher(Teacher $teacher)
    {
        $schoolId = Auth::user()->school_id;
        if ($teacher->user->school_id != $schoolId) {
            abort(403);
        }

        $teacher->user()->delete();
        $teacher->delete();

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher deleted successfully');
    }

    /**
     * Students Management - Index
     */
    public function indexStudents()
    {
        $schoolId = Auth::user()->school_id;
        $students = Student::whereHas('class', function ($q) use ($schoolId) {
            $q->where('school_id', $schoolId);
        })->with('user', 'class', 'section')->paginate(10);

        return view('admin.students.index', compact('students'));
    }

    /**
     * Students Management - Create
     */
    public function createStudent()
    {
        $schoolId = Auth::user()->school_id;
        $classes = Classes::where('school_id', $schoolId)->get();

        return view('admin.students.create', compact('classes'));
    }

    /**
     * Students Management - Store
     */
    public function storeStudent(Request $request)
    {
        $schoolId = Auth::user()->school_id;

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'admission_no' => 'required|unique:students',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'class_id' => [
                'required',
                Rule::exists('classes', 'id')->where(function ($q) use ($schoolId) {
                    return $q->where('school_id', $schoolId);
                }),
            ],
            'section_id' => 'nullable|exists:sections,id',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'student',
            'school_id' => $schoolId,
            'status' => 'active',
        ]);

        Student::create([
            'user_id' => $user->id,
            'admission_no' => $validated['admission_no'],
            'date_of_birth' => $validated['date_of_birth'],
            'gender' => $validated['gender'],
            'class_id' => $validated['class_id'],
            'section_id' => $validated['section_id'],
            'address' => $validated['address'],
            'phone' => $validated['phone'],
        ]);

        return redirect()->route('admin.students.index')->with('success', 'Student created successfully');
    }

    /**
     * Students Management - Edit
     */
    public function editStudent(Student $student)
    {
        $schoolId = Auth::user()->school_id;
        if ($student->user->school_id != $schoolId) {
            abort(403);
        }

        $classes = Classes::where('school_id', $schoolId)->get();
        return view('admin.students.edit', compact('student', 'classes'));
    }

    /**
     * Students Management - Update
     */
    public function updateStudent(Request $request, Student $student)
    {
        $schoolId = Auth::user()->school_id;
        if ($student->user->school_id != $schoolId) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($student->user_id)],
            'admission_no' => ['required', Rule::unique('students')->ignore($student->id)],
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'class_id' => [
                'required',
                Rule::exists('classes', 'id')->where(function ($q) use ($schoolId) {
                    return $q->where('school_id', $schoolId);
                }),
            ],
            'section_id' => 'nullable|exists:sections,id',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
        ]);

        $student->user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        $student->update($validated);

        return redirect()->route('admin.students.index')->with('success', 'Student updated successfully');
    }

    /**
     * Students Management - Delete
     */
    public function destroyStudent(Student $student)
    {
        $schoolId = Auth::user()->school_id;
        if ($student->user->school_id != $schoolId) {
            abort(403);
        }

        $student->user()->delete();
        $student->delete();

        return redirect()->route('admin.students.index')->with('success', 'Student deleted successfully');
    }

    /**
     * Classes Management - Index
     */
    public function indexClasses()
    {
        $schoolId = Auth::user()->school_id;
        $classes = Classes::where('school_id', $schoolId)->with('students', 'subjects')->paginate(10);

        return view('admin.classes.index', compact('classes'));
    }

    /**
     * Classes Management - Create
     */
    public function createClass()
    {
        return view('admin.classes.create');
    }

    /**
     * Classes Management - Store
     */
    public function storeClass(Request $request)
    {
        $schoolId = Auth::user()->school_id;

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('classes')->where(function ($q) use ($schoolId) {
                    return $q->where('school_id', $schoolId);
                }),
            ],
            'description' => 'nullable|string',
        ]);

        Classes::create([
            'school_id' => $schoolId,
            'name' => $validated['name'],
            'description' => $validated['description'],
        ]);

        return redirect()->route('admin.classes.index')->with('success', 'Class created successfully');
    }

    /**
     * Classes Management - Edit
     */
    public function editClass(Classes $class)
    {
        $schoolId = Auth::user()->school_id;
        if ($class->school_id != $schoolId) {
            abort(403);
        }

        return view('admin.classes.edit', compact('class'));
    }

    /**
     * Classes Management - Update
     */
    public function updateClass(Request $request, Classes $class)
    {
        $schoolId = Auth::user()->school_id;
        if ($class->school_id != $schoolId) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('classes')->where(function ($q) use ($schoolId) {
                    return $q->where('school_id', $schoolId);
                })->ignore($class->id),
            ],
            'description' => 'nullable|string',
        ]);

        $class->update($validated);

        return redirect()->route('admin.classes.index')->with('success', 'Class updated successfully');
    }

    /**
     * Classes Management - Delete
     */
    public function destroyClass(Classes $class)
    {
        $schoolId = Auth::user()->school_id;
        if ($class->school_id != $schoolId) {
            abort(403);
        }

        $class->delete();
        return redirect()->route('admin.classes.index')->with('success', 'Class deleted successfully');
    }

    /**
     * Sections Management - Index
     */
    public function indexSections()
    {
        $schoolId = Auth::user()->school_id;
        $sections = Section::whereHas('class', function ($q) use ($schoolId) {
            $q->where('school_id', $schoolId);
        })->with('class')->paginate(10);

        return view('admin.sections.index', compact('sections'));
    }

    /**
     * Sections Management - Create
     */
    public function createSection()
    {
        $schoolId = Auth::user()->school_id;
        $classes = Classes::where('school_id', $schoolId)->get();
        return view('admin.sections.create', compact('classes'));
    }

    /**
     * Sections Management - Store
     */
    public function storeSection(Request $request)
    {
        $schoolId = Auth::user()->school_id;

        $validated = $request->validate([
            'class_id' => 'required|exists:classes,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Verify class belongs to user's school
        $class = Classes::find($validated['class_id']);
        if ($class->school_id != $schoolId) {
            abort(403);
        }

        Section::create($validated);
        return redirect()->route('admin.sections.index')->with('success', 'Section created successfully');
    }

    /**
     * Sections Management - Edit
     */
    public function editSection(Section $section)
    {
        $schoolId = Auth::user()->school_id;
        if ($section->class->school_id != $schoolId) {
            abort(403);
        }

        $classes = Classes::where('school_id', $schoolId)->get();
        return view('admin.sections.edit', compact('section', 'classes'));
    }

    /**
     * Sections Management - Update
     */
    public function updateSection(Request $request, Section $section)
    {
        $schoolId = Auth::user()->school_id;
        if ($section->class->school_id != $schoolId) {
            abort(403);
        }

        $validated = $request->validate([
            'class_id' => 'required|exists:classes,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Verify class belongs to user's school
        $class = Classes::find($validated['class_id']);
        if ($class->school_id != $schoolId) {
            abort(403);
        }

        $section->update($validated);
        return redirect()->route('admin.sections.index')->with('success', 'Section updated successfully');
    }

    /**
     * Sections Management - Delete
     */
    public function destroySection(Section $section)
    {
        $schoolId = Auth::user()->school_id;
        if ($section->class->school_id != $schoolId) {
            abort(403);
        }

        $section->delete();
        return redirect()->route('admin.sections.index')->with('success', 'Section deleted successfully');
    }

    /**
     * Subjects Management - Index
     */
    public function indexSubjects()
    {
        $schoolId = Auth::user()->school_id;
        $subjects = Subject::whereHas('class', function ($q) use ($schoolId) {
            $q->where('school_id', $schoolId);
        })->with('class')->paginate(10);

        return view('admin.subjects.index', compact('subjects'));
    }

    /**
     * Subjects Management - Create
     */
    public function createSubject()
    {
        $schoolId = Auth::user()->school_id;
        $classes = Classes::where('school_id', $schoolId)->get();

        return view('admin.subjects.create', compact('classes'));
    }

    /**
     * Get sections for a selected class (AJAX endpoint)
     */
    public function getClassSections($classId)
    {
        $schoolId = Auth::user()->school_id;

        // Verify class belongs to user's school
        $class = Classes::where('school_id', $schoolId)->find($classId);
        if (!$class) {
            return response()->json([], 403);
        }

        $sections = Section::where('class_id', $classId)->get(['id', 'name']);
        return response()->json($sections);
    }

    /**
     * Subjects Management - Store
     */
    public function storeSubject(Request $request)
    {
        $schoolId = Auth::user()->school_id;

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50',
            'class_id' => [
                'required',
                Rule::exists('classes', 'id')->where(function ($q) use ($schoolId) {
                    return $q->where('school_id', $schoolId);
                }),
            ],
            'section_ids' => 'required|array|min:1',
            'section_ids.*' => [
                'required',
                'integer',
                Rule::exists('sections', 'id')->where(function ($q) use ($request, $schoolId) {
                    // Verify section belongs to the selected class
                    return $q->where('class_id', $request->input('class_id'));
                }),
            ],
            'description' => 'nullable|string',
        ]);

        $subject = Subject::create([
            'name' => $validated['name'],
            'code' => $validated['code'],
            'class_id' => $validated['class_id'],
            'description' => $validated['description'],
        ]);

        // Attach subject to selected sections
        $subject->sections()->sync($validated['section_ids']);

        return redirect()->route('admin.subjects.index')->with('success', 'Subject created successfully and assigned to selected sections');
    }

    /**
     * Subjects Management - Edit
     */
    public function editSubject(Subject $subject)
    {
        $schoolId = Auth::user()->school_id;
        if ($subject->class->school_id != $schoolId) {
            abort(403);
        }

        $classes = Classes::where('school_id', $schoolId)->get();
        $sections = Section::where('class_id', $subject->class_id)->get();
        $selectedSectionIds = $subject->sections()->pluck('section_id')->toArray();

        return view('admin.subjects.edit', compact('subject', 'classes', 'sections', 'selectedSectionIds'));
    }

    /**
     * Subjects Management - Update
     */
    public function updateSubject(Request $request, Subject $subject)
    {
        $schoolId = Auth::user()->school_id;
        if ($subject->class->school_id != $schoolId) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50',
            'class_id' => [
                'required',
                Rule::exists('classes', 'id')->where(function ($q) use ($schoolId) {
                    return $q->where('school_id', $schoolId);
                }),
            ],
            'section_ids' => 'required|array|min:1',
            'section_ids.*' => [
                'required',
                'integer',
                Rule::exists('sections', 'id')->where(function ($q) use ($request) {
                    // Verify section belongs to the selected class
                    return $q->where('class_id', $request->input('class_id'));
                }),
            ],
            'description' => 'nullable|string',
        ]);

        $subject->update([
            'name' => $validated['name'],
            'code' => $validated['code'],
            'class_id' => $validated['class_id'],
            'description' => $validated['description'],
        ]);

        // Sync sections
        $subject->sections()->sync($validated['section_ids']);

        return redirect()->route('admin.subjects.index')->with('success', 'Subject updated successfully');
    }

    /**
     * Subjects Management - Delete
     */
    public function destroySubject(Subject $subject)
    {
        $schoolId = Auth::user()->school_id;
        if ($subject->class->school_id != $schoolId) {
            abort(403);
        }

        $subject->delete();
        return redirect()->route('admin.subjects.index')->with('success', 'Subject deleted successfully');
    }

    /**
     * Fees Management - Index
     */
    public function indexFees()
    {
        $schoolId = Auth::user()->school_id;
        $fees = Fee::where('school_id', $schoolId)->with('class')->paginate(10);

        return view('admin.fees.index', compact('fees'));
    }

    /**
     * Fees Management - Create
     */
    public function createFee()
    {
        $schoolId = Auth::user()->school_id;
        $classes = Classes::where('school_id', $schoolId)->get();

        return view('admin.fees.create', compact('classes'));
    }

    /**
     * Fees Management - Store
     */
    public function storeFee(Request $request)
    {
        $schoolId = Auth::user()->school_id;

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'class_id' => [
                'required',
                Rule::exists('classes', 'id')->where(function ($q) use ($schoolId) {
                    return $q->where('school_id', $schoolId);
                }),
            ],
            'amount' => 'required|numeric|min:0',
            'frequency' => 'required|in:monthly,quarterly,annually',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        Fee::create(array_merge($validated, ['school_id' => $schoolId]));

        return redirect()->route('admin.fees.index')->with('success', 'Fee created successfully');
    }

    /**
     * Fees Management - Edit
     */
    public function editFee(Fee $fee)
    {
        $schoolId = Auth::user()->school_id;
        if ($fee->school_id != $schoolId) {
            abort(403);
        }

        $classes = Classes::where('school_id', $schoolId)->get();
        return view('admin.fees.edit', compact('fee', 'classes'));
    }

    /**
     * Fees Management - Update
     */
    public function updateFee(Request $request, Fee $fee)
    {
        $schoolId = Auth::user()->school_id;
        if ($fee->school_id != $schoolId) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'class_id' => [
                'required',
                Rule::exists('classes', 'id')->where(function ($q) use ($schoolId) {
                    return $q->where('school_id', $schoolId);
                }),
            ],
            'amount' => 'required|numeric|min:0',
            'frequency' => 'required|in:monthly,quarterly,annually',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $fee->update($validated);

        return redirect()->route('admin.fees.index')->with('success', 'Fee updated successfully');
    }

    /**
     * Fees Management - Delete
     */
    public function destroyFee(Fee $fee)
    {
        $schoolId = Auth::user()->school_id;
        if ($fee->school_id != $schoolId) {
            abort(403);
        }

        $fee->delete();
        return redirect()->route('admin.fees.index')->with('success', 'Fee deleted successfully');
    }

    /**
     * Exams Management - Index
     */
    public function indexExams()
    {
        $schoolId = Auth::user()->school_id;
        $exams = Exam::where('school_id', $schoolId)->with('class')->paginate(10);

        return view('admin.exams.index', compact('exams'));
    }

    /**
     * Exams Management - Create
     */
    public function createExam()
    {
        $schoolId = Auth::user()->school_id;
        $classes = Classes::where('school_id', $schoolId)->get();

        return view('admin.exams.create', compact('classes'));
    }

    /**
     * Exams Management - Store
     */
    public function storeExam(Request $request)
    {
        $schoolId = Auth::user()->school_id;

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'class_id' => [
                'required',
                Rule::exists('classes', 'id')->where(function ($q) use ($schoolId) {
                    return $q->where('school_id', $schoolId);
                }),
            ],
            'exam_date' => 'nullable|date',
            'description' => 'nullable|string',
            'status' => 'required|in:scheduled,ongoing,completed',
        ]);

        Exam::create(array_merge($validated, ['school_id' => $schoolId]));

        return redirect()->route('admin.exams.index')->with('success', 'Exam created successfully');
    }

    /**
     * Exams Management - Edit
     */
    public function editExam(Exam $exam)
    {
        $schoolId = Auth::user()->school_id;
        if ($exam->school_id != $schoolId) {
            abort(403);
        }

        $classes = Classes::where('school_id', $schoolId)->get();
        return view('admin.exams.edit', compact('exam', 'classes'));
    }

    /**
     * Exams Management - Update
     */
    public function updateExam(Request $request, Exam $exam)
    {
        $schoolId = Auth::user()->school_id;
        if ($exam->school_id != $schoolId) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'class_id' => [
                'required',
                Rule::exists('classes', 'id')->where(function ($q) use ($schoolId) {
                    return $q->where('school_id', $schoolId);
                }),
            ],
            'exam_date' => 'nullable|date',
            'description' => 'nullable|string',
            'status' => 'required|in:scheduled,ongoing,completed',
        ]);

        $exam->update($validated);

        return redirect()->route('admin.exams.index')->with('success', 'Exam updated successfully');
    }

    /**
     * Exams Management - Delete
     */
    public function destroyExam(Exam $exam)
    {
        $schoolId = Auth::user()->school_id;
        if ($exam->school_id != $schoolId) {
            abort(403);
        }

        $exam->delete();
        return redirect()->route('admin.exams.index')->with('success', 'Exam deleted successfully');
    }

    /**
     * Results Management - Index
     */
    public function indexResults()
    {
        $schoolId = Auth::user()->school_id;
        $results = Result::where('school_id', $schoolId)->with('student', 'exam', 'subject')->paginate(10);

        return view('admin.results.index', compact('results'));
    }

    /**
     * Results Management - Create
     */
    public function createResult()
    {
        $schoolId = Auth::user()->school_id;
        $students = Student::whereHas('class', function ($q) use ($schoolId) {
            $q->where('school_id', $schoolId);
        })->with('user')->get();
        $exams = Exam::where('school_id', $schoolId)->get();
        $subjects = Subject::whereHas('class', function ($q) use ($schoolId) {
            $q->where('school_id', $schoolId);
        })->get();

        return view('admin.results.create', compact('students', 'exams', 'subjects'));
    }

    /**
     * Results Management - Store
     */
    public function storeResult(Request $request)
    {
        $schoolId = Auth::user()->school_id;

        $validated = $request->validate([
            'student_id' => [
                'required',
                Rule::exists('students', 'id')->where(function ($q) use ($schoolId) {
                    return $q->whereHas('user', function ($u) use ($schoolId) {
                        return $u->where('school_id', $schoolId);
                    });
                }),
            ],
            'exam_id' => [
                'required',
                Rule::exists('exams', 'id')->where(function ($q) use ($schoolId) {
                    return $q->where('school_id', $schoolId);
                }),
            ],
            'subject_id' => [
                'required',
                Rule::exists('subjects', 'id')->where(function ($q) use ($schoolId) {
                    return $q->whereHas('class', function ($c) use ($schoolId) {
                        return $c->where('school_id', $schoolId);
                    });
                }),
            ],
            'marks' => 'required|numeric|min:0|max:100',
            'total_marks' => 'required|numeric|min:0',
            'remarks' => 'nullable|string',
        ]);

        Result::create(array_merge($validated, ['school_id' => $schoolId]));

        return redirect()->route('admin.results.index')->with('success', 'Result created successfully');
    }

    /**
     * Results Management - Edit
     */
    public function editResult(Result $result)
    {
        $schoolId = Auth::user()->school_id;
        if ($result->school_id != $schoolId) {
            abort(403);
        }

        $students = Student::whereHas('class', function ($q) use ($schoolId) {
            $q->where('school_id', $schoolId);
        })->with('user')->get();
        $exams = Exam::where('school_id', $schoolId)->get();
        $subjects = Subject::whereHas('class', function ($q) use ($schoolId) {
            $q->where('school_id', $schoolId);
        })->get();

        return view('admin.results.edit', compact('result', 'students', 'exams', 'subjects'));
    }

    /**
     * Results Management - Update
     */
    public function updateResult(Request $request, Result $result)
    {
        $schoolId = Auth::user()->school_id;
        if ($result->school_id != $schoolId) {
            abort(403);
        }

        $validated = $request->validate([
            'student_id' => [
                'required',
                Rule::exists('students', 'id')->where(function ($q) use ($schoolId) {
                    return $q->whereHas('user', function ($u) use ($schoolId) {
                        return $u->where('school_id', $schoolId);
                    });
                }),
            ],
            'exam_id' => [
                'required',
                Rule::exists('exams', 'id')->where(function ($q) use ($schoolId) {
                    return $q->where('school_id', $schoolId);
                }),
            ],
            'subject_id' => [
                'required',
                Rule::exists('subjects', 'id')->where(function ($q) use ($schoolId) {
                    return $q->whereHas('class', function ($c) use ($schoolId) {
                        return $c->where('school_id', $schoolId);
                    });
                }),
            ],
            'marks' => 'required|numeric|min:0|max:100',
            'total_marks' => 'required|numeric|min:0',
            'remarks' => 'nullable|string',
        ]);

        $result->update($validated);

        return redirect()->route('admin.results.index')->with('success', 'Result updated successfully');
    }

    /**
     * Results Management - Delete
     */
    public function destroyResult(Result $result)
    {
        $schoolId = Auth::user()->school_id;
        if ($result->school_id != $schoolId) {
            abort(403);
        }

        $result->delete();
        return redirect()->route('admin.results.index')->with('success', 'Result deleted successfully');
    }

    /**
     * Attendance Management - Index
     */
    public function indexAttendance()
    {
        $schoolId = Auth::user()->school_id;
        $attendance = Attendance::where('school_id', $schoolId)->with('student')->paginate(10);

        return view('admin.attendance.index', compact('attendance'));
    }

    /**
     * Attendance Management - Create
     */
    public function createAttendance()
    {
        $schoolId = Auth::user()->school_id;
        $students = Student::whereHas('class', function ($q) use ($schoolId) {
            $q->where('school_id', $schoolId);
        })->with('user')->get();

        return view('admin.attendance.create', compact('students'));
    }

    /**
     * Attendance Management - Store
     */
    public function storeAttendance(Request $request)
    {
        $schoolId = Auth::user()->school_id;

        $validated = $request->validate([
            'student_id' => [
                'required',
                Rule::exists('students', 'id')->where(function ($q) use ($schoolId) {
                    return $q->whereHas('user', function ($u) use ($schoolId) {
                        return $u->where('school_id', $schoolId);
                    });
                }),
            ],
            'attendance_date' => 'required|date',
            'status' => 'required|in:present,absent,leave',
            'remarks' => 'nullable|string',
        ]);

        Attendance::create(array_merge($validated, ['school_id' => $schoolId]));

        return redirect()->route('admin.attendance.index')->with('success', 'Attendance recorded successfully');
    }

    /**
     * Attendance Management - Edit
     */
    public function editAttendance(Attendance $attendance)
    {
        $schoolId = Auth::user()->school_id;
        if ($attendance->school_id != $schoolId) {
            abort(403);
        }

        $students = Student::whereHas('class', function ($q) use ($schoolId) {
            $q->where('school_id', $schoolId);
        })->with('user')->get();

        return view('admin.attendance.edit', compact('attendance', 'students'));
    }

    /**
     * Attendance Management - Update
     */
    public function updateAttendance(Request $request, Attendance $attendance)
    {
        $schoolId = Auth::user()->school_id;
        if ($attendance->school_id != $schoolId) {
            abort(403);
        }

        $validated = $request->validate([
            'student_id' => [
                'required',
                Rule::exists('students', 'id')->where(function ($q) use ($schoolId) {
                    return $q->whereHas('user', function ($u) use ($schoolId) {
                        return $u->where('school_id', $schoolId);
                    });
                }),
            ],
            'attendance_date' => 'required|date',
            'status' => 'required|in:present,absent,leave',
            'remarks' => 'nullable|string',
        ]);

        $attendance->update($validated);

        return redirect()->route('admin.attendance.index')->with('success', 'Attendance updated successfully');
    }

    /**
     * Attendance Management - Delete
     */
    public function destroyAttendance(Attendance $attendance)
    {
        $schoolId = Auth::user()->school_id;
        if ($attendance->school_id != $schoolId) {
            abort(403);
        }

        $attendance->delete();
        return redirect()->route('admin.attendance.index')->with('success', 'Attendance deleted successfully');
    }
}
