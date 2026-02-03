<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Parent_;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Subject;
use App\Models\ClassSubject;
use App\Models\ClassTeacher;
use App\Models\School;
use Database\Seeders\RolePermissionSeeder;
use Database\Seeders\AttendanceTypeSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(AttendanceTypeSeeder::class);

        // Create SuperAdmin (no school assigned)
        User::create([
            'name' => 'Super Administrator',
            'email' => 'superadmin@school.com',
            'password' => bcrypt('password123'),
            'role' => 'superAdmin',
            'status' => 'active',
            'school_id' => null,
        ]);

        // Create Schools
        $school1 = School::create([
            'name' => 'Primary School',
            'email' => 'primary@school.com',
            'phone' => '9841000001',
            'address' => '123 Main Street',
            'city' => 'Kathmandu',
            'state' => 'Bagmati',
            'zip_code' => '44600',
            'description' => 'A leading primary education institution',
            'status' => 'active',
        ]);

        $school2 = School::create([
            'name' => 'Secondary School',
            'email' => 'secondary@school.com',
            'phone' => '9841000002',
            'address' => '456 Oak Avenue',
            'city' => 'Pokhara',
            'state' => 'Gandaki',
            'zip_code' => '33700',
            'description' => 'A reputed secondary education institution',
            'status' => 'active',
        ]);

        // Create Admin users for each school
        User::create([
            'name' => 'Primary School Administrator',
            'email' => 'admin@primary.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
            'status' => 'active',
            'school_id' => $school1->id,
        ]);

        User::create([
            'name' => 'Secondary School Administrator',
            'email' => 'admin@secondary.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
            'status' => 'active',
            'school_id' => $school2->id,
        ]);

        // Create Classes for School 1
        $classes = [];
        for ($i = 1; $i <= 3; $i++) {
            $classes[] = Classes::create([
                'name' => "Class $i",
                'description' => "Grade $i",
                'school_id' => $school1->id,
            ]);
        }

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
            $english = Subject::create(['name' => 'English', 'code' => 'ENG' . $index]);
            ClassSubject::create(['class_id' => $class->id, 'subject_id' => $english->id]);

            $math = Subject::create(['name' => 'Mathematics', 'code' => 'MATH' . $index]);
            ClassSubject::create(['class_id' => $class->id, 'subject_id' => $math->id]);

            $science = Subject::create(['name' => 'Science', 'code' => 'SCI' . $index]);
            ClassSubject::create(['class_id' => $class->id, 'subject_id' => $science->id]);
        }

        // Create Teachers for School 1
        $teachers = [];
        for ($i = 1; $i <= 5; $i++) {
            $user = User::create([
                'name' => "Teacher $i",
                'email' => "teacher$i@primary.com",
                'password' => bcrypt('password123'),
                'role' => 'teacher',
                'status' => 'active',
                'school_id' => $school1->id,
            ]);

            $teachers[] = Teacher::create([
                'user_id' => $user->id,
                'phone' => '9841' . str_pad($i, 6, '0', STR_PAD_LEFT),
                'qualification' => 'B.Ed',
                'joining_date' => now()->subYear(),
                'address' => "Teacher Address $i",
            ]);
        }

        // Create Parents for School 1
        $parents = [];
        for ($i = 1; $i <= 10; $i++) {
            $user = User::create([
                'name' => "Parent $i",
                'email' => "parent$i@primary.com",
                'password' => bcrypt('password123'),
                'role' => 'parent',
                'status' => 'active',
                'school_id' => $school1->id,
            ]);

            $parents[] = Parent_::create([
                'user_id' => $user->id,
                'phone' => '9841' . str_pad(1000 + $i, 6, '0', STR_PAD_LEFT),
                'occupation' => 'Professional',
                'address' => "Parent Address $i",
            ]);
        }

        // Create Students for School 1
        $sectionIds = collect($sections)->flatMap(fn($arr) => $arr)->pluck('id')->toArray();
        $parentIndex = 0;

        for ($i = 1; $i <= 30; $i++) {
            $user = User::create([
                'name' => "Student $i",
                'email' => "student$i@primary.com",
                'password' => bcrypt('password123'),
                'role' => 'student',
                'status' => 'active',
                'school_id' => $school1->id,
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

        $this->call(RolePermissionSeeder::class);
    }
}
