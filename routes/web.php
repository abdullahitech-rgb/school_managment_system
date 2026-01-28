<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Protected routes (authenticated users only)
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Role-based dashboard redirect
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->isSuperAdmin()) {
            return redirect()->route('superadmin.dashboard');
        } elseif ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } else {
            return view('dashboard', ['user' => $user]);
        }
    })->name('dashboard');

    // SuperAdmin routes
    Route::middleware('role:superAdmin')->prefix('superadmin')->name('superadmin.')->group(function () {
        Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])->name('dashboard');

        // Schools Management
        Route::get('/schools', [SuperAdminController::class, 'indexSchools'])->name('schools.index');
        Route::get('/schools/create', [SuperAdminController::class, 'createSchool'])->name('schools.create');
        Route::post('/schools', [SuperAdminController::class, 'storeSchool'])->name('schools.store');
        Route::get('/schools/{school}/edit', [SuperAdminController::class, 'editSchool'])->name('schools.edit');
        Route::put('/schools/{school}', [SuperAdminController::class, 'updateSchool'])->name('schools.update');
        Route::delete('/schools/{school}', [SuperAdminController::class, 'destroySchool'])->name('schools.destroy');

        // Admins Management
        Route::get('/admins', [SuperAdminController::class, 'indexAdmins'])->name('admins.index');
        Route::get('/admins/create', [SuperAdminController::class, 'createAdmin'])->name('admins.create');
        Route::post('/admins', [SuperAdminController::class, 'storeAdmin'])->name('admins.store');
        Route::get('/admins/{admin}/edit', [SuperAdminController::class, 'editAdmin'])->name('admins.edit');
        Route::put('/admins/{admin}', [SuperAdminController::class, 'updateAdmin'])->name('admins.update');
        Route::delete('/admins/{admin}', [SuperAdminController::class, 'destroyAdmin'])->name('admins.destroy');

        // Settings
        Route::get('/settings', [SuperAdminController::class, 'settings'])->name('settings');
        Route::post('/settings', [SuperAdminController::class, 'updateSettings'])->name('settings.update');
    });

    // Admin (School Admin) routes
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Teachers Management
        Route::get('/teachers', [AdminController::class, 'indexTeachers'])->name('teachers.index');
        Route::get('/teachers/create', [AdminController::class, 'createTeacher'])->name('teachers.create');
        Route::post('/teachers', [AdminController::class, 'storeTeacher'])->name('teachers.store');
        Route::get('/teachers/{teacher}/edit', [AdminController::class, 'editTeacher'])->name('teachers.edit');
        Route::put('/teachers/{teacher}', [AdminController::class, 'updateTeacher'])->name('teachers.update');
        Route::delete('/teachers/{teacher}', [AdminController::class, 'destroyTeacher'])->name('teachers.destroy');

        // Students Management
        Route::get('/students', [AdminController::class, 'indexStudents'])->name('students.index');
        Route::get('/students/create', [AdminController::class, 'createStudent'])->name('students.create');
        Route::post('/students', [AdminController::class, 'storeStudent'])->name('students.store');
        Route::get('/students/{student}/edit', [AdminController::class, 'editStudent'])->name('students.edit');
        Route::put('/students/{student}', [AdminController::class, 'updateStudent'])->name('students.update');
        Route::delete('/students/{student}', [AdminController::class, 'destroyStudent'])->name('students.destroy');

        // Classes Management
        Route::get('/classes', [AdminController::class, 'indexClasses'])->name('classes.index');
        Route::get('/classes/create', [AdminController::class, 'createClass'])->name('classes.create');
        Route::post('/classes', [AdminController::class, 'storeClass'])->name('classes.store');
        Route::get('/classes/{class}/edit', [AdminController::class, 'editClass'])->name('classes.edit');
        Route::put('/classes/{class}', [AdminController::class, 'updateClass'])->name('classes.update');
        Route::delete('/classes/{class}', [AdminController::class, 'destroyClass'])->name('classes.destroy');

        // Sections Management
        Route::get('/sections', [AdminController::class, 'indexSections'])->name('sections.index');
        Route::get('/sections/create', [AdminController::class, 'createSection'])->name('sections.create');
        Route::post('/sections', [AdminController::class, 'storeSection'])->name('sections.store');
        Route::get('/sections/{section}/edit', [AdminController::class, 'editSection'])->name('sections.edit');
        Route::put('/sections/{section}', [AdminController::class, 'updateSection'])->name('sections.update');
        Route::delete('/sections/{section}', [AdminController::class, 'destroySection'])->name('sections.destroy');

        // Subjects Management
        Route::get('/subjects', [AdminController::class, 'indexSubjects'])->name('subjects.index');
        Route::get('/subjects/create', [AdminController::class, 'createSubject'])->name('subjects.create');
        Route::post('/subjects', [AdminController::class, 'storeSubject'])->name('subjects.store');
        Route::get('/subjects/{subject}/edit', [AdminController::class, 'editSubject'])->name('subjects.edit');
        Route::put('/subjects/{subject}', [AdminController::class, 'updateSubject'])->name('subjects.update');
        Route::delete('/subjects/{subject}', [AdminController::class, 'destroySubject'])->name('subjects.destroy');

        // AJAX endpoint to get sections for a class
        Route::get('/class/{class}/sections', [AdminController::class, 'getClassSections'])->name('class.sections');

        // Fees Management
        Route::get('/fees', [AdminController::class, 'indexFees'])->name('fees.index');
        Route::get('/fees/create', [AdminController::class, 'createFee'])->name('fees.create');
        Route::post('/fees', [AdminController::class, 'storeFee'])->name('fees.store');
        Route::get('/fees/{fee}/edit', [AdminController::class, 'editFee'])->name('fees.edit');
        Route::put('/fees/{fee}', [AdminController::class, 'updateFee'])->name('fees.update');
        Route::delete('/fees/{fee}', [AdminController::class, 'destroyFee'])->name('fees.destroy');

        // Exams Management
        Route::get('/exams', [AdminController::class, 'indexExams'])->name('exams.index');
        Route::get('/exams/create', [AdminController::class, 'createExam'])->name('exams.create');
        Route::post('/exams', [AdminController::class, 'storeExam'])->name('exams.store');
        Route::get('/exams/{exam}/edit', [AdminController::class, 'editExam'])->name('exams.edit');
        Route::put('/exams/{exam}', [AdminController::class, 'updateExam'])->name('exams.update');
        Route::delete('/exams/{exam}', [AdminController::class, 'destroyExam'])->name('exams.destroy');

        // Results Management
        Route::get('/results', [AdminController::class, 'indexResults'])->name('results.index');
        Route::get('/results/create', [AdminController::class, 'createResult'])->name('results.create');
        Route::post('/results', [AdminController::class, 'storeResult'])->name('results.store');
        Route::get('/results/{result}/edit', [AdminController::class, 'editResult'])->name('results.edit');
        Route::put('/results/{result}', [AdminController::class, 'updateResult'])->name('results.update');
        Route::delete('/results/{result}', [AdminController::class, 'destroyResult'])->name('results.destroy');

        // Attendance Management
        Route::get('/attendance', [AdminController::class, 'indexAttendance'])->name('attendance.index');
        Route::get('/attendance/create', [AdminController::class, 'createAttendance'])->name('attendance.create');
        Route::post('/attendance', [AdminController::class, 'storeAttendance'])->name('attendance.store');
        Route::get('/attendance/{attendance}/edit', [AdminController::class, 'editAttendance'])->name('attendance.edit');
        Route::put('/attendance/{attendance}', [AdminController::class, 'updateAttendance'])->name('attendance.update');
        Route::delete('/attendance/{attendance}', [AdminController::class, 'destroyAttendance'])->name('attendance.destroy');
    });

    // Legacy routes for backward compatibility (SuperAdmin & Admin routes)
    Route::middleware('role:superAdmin,admin')->group(function () {
        // Students (legacy)
        Route::resource('students', StudentController::class)->except(['index', 'create', 'store', 'edit', 'update', 'destroy']);

        // Teachers (legacy)
        Route::resource('teachers', TeacherController::class)->except(['index', 'create', 'store', 'edit', 'update', 'destroy']);

        // Classes
        Route::resource('classes', ClassController::class);

        // Sections
        Route::resource('sections', SectionController::class);
    });
});

Route::get('/register', function () {
    return view('register');
})->name('register');

