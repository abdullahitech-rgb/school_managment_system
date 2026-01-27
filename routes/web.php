<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Protected routes (authenticated users only)
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    // SuperAdmin & Admin routes
    Route::middleware('role:superAdmin,admin')->group(function () {
        // Students
        Route::resource('students', StudentController::class);

        // Teachers
        Route::resource('teachers', TeacherController::class);

        // Classes
        Route::resource('classes', ClassController::class);

        // Sections
        Route::resource('sections', SectionController::class);
    });
});

Route::get('/register', function () {
    return view('register');
})->name('register');

