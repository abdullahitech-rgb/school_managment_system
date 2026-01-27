<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Parent_;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Subject;
use App\Models\ClassTeacher;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create SuperAdmin
        User::create([
            'name' => 'Super Administrator',
            'email' => 'superadmin@school.com',
            'password' => bcrypt('password123'),
            'role' => 'superAdmin',
            'status' => 'active',
        ]);

        // Create Admin
        User::create([
            'name' => 'School Administrator',
            'email' => 'admin@school.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        // Create Classes
        $classes = [
            Classes::create(['name' => 'Class 1', 'description' => 'First Grade']),
            Classes::create(['name' => 'Class 2', 'description' => 'Second Grade']),
            Classes::create(['name' => 'Class 3', 'description' => 'Third Grade']),
        ];

        // Create Sections
        $sections = [];
        foreach ($classes as $class) {
            $sections[$class->id] = [
                Section::create(['class_id' => $class->id, 'name' => 'Section A']),
                Section::create(['class_id' => $class->id, 'name' => 'Section B']),
            ];
        }

        // Create Subjects
        foreach ($classes as $index => $class) {
            Subject::create(['class_id' => $class->id, 'name' => 'English', 'code' => 'ENG' . $index]);
            Subject::create(['class_id' => $class->id, 'name' => 'Mathematics', 'code' => 'MATH' . $index]);
            Subject::create(['class_id' => $class->id, 'name' => 'Science', 'code' => 'SCI' . $index]);
        }

        // Create Teachers
        $teachers = [];
        for ($i = 1; $i <= 5; $i++) {
            $user = User::create([
                'name' => "Teacher $i",
                'email' => "teacher$i@school.com",
                'password' => bcrypt('password123'),
                'role' => 'teacher',
                'status' => 'active',
            ]);

            $teachers[] = Teacher::create([
                'user_id' => $user->id,
                'phone' => '9841' . str_pad($i, 6, '0', STR_PAD_LEFT),
                'qualification' => 'B.Ed',
                'joining_date' => now()->subYear(),
                'address' => "Teacher Address $i",
            ]);
        }

        // Create Parents
        $parents = [];
        for ($i = 1; $i <= 10; $i++) {
            $user = User::create([
                'name' => "Parent $i",
                'email' => "parent$i@email.com",
                'password' => bcrypt('password123'),
                'role' => 'parent',
                'status' => 'active',
            ]);

            $parents[] = Parent_::create([
                'user_id' => $user->id,
                'phone' => '9841' . str_pad(1000 + $i, 6, '0', STR_PAD_LEFT),
                'occupation' => 'Professional',
                'address' => "Parent Address $i",
            ]);
        }

        // Create Students
        $sectionIds = collect($sections)->flatMap(fn($arr) => $arr)->pluck('id')->toArray();
        $parentIndex = 0;

        for ($i = 1; $i <= 30; $i++) {
            $user = User::create([
                'name' => "Student $i",
                'email' => "student$i@school.com",
                'password' => bcrypt('password123'),
                'role' => 'student',
                'status' => 'active',
            ]);

            $sectionId = $sectionIds[$i % count($sectionIds)];
            $section = Section::find($sectionId);

            Student::create([
                'user_id' => $user->id,
                'admission_no' => 'ADM' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'date_of_birth' => now()->subYears(rand(5, 15)),
                'gender' => ['Male', 'Female'][rand(0, 1)],
                'class_id' => $section->class_id,
                'section_id' => $sectionId,
                'parent_id' => $parents[$parentIndex % count($parents)]->id,
                'phone' => '9841' . str_pad(5000 + $i, 6, '0', STR_PAD_LEFT),
                'address' => "Student Address $i",
            ]);

            $parentIndex++;
        }

        // Assign Teachers to Classes
        foreach ($classes as $index => $class) {
            foreach ($sections[$class->id] as $section) {
                ClassTeacher::create([
                    'class_id' => $class->id,
                    'section_id' => $section->id,
                    'teacher_id' => $teachers[$index % count($teachers)]->id,
                ]);
            }
        }
    }
}

