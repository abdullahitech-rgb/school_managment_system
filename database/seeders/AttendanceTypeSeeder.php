<?php

namespace Database\Seeders;

use App\Models\AttendanceType;
use Illuminate\Database\Seeder;

class AttendanceTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            [
                'name' => 'Present',
                'code' => 'present',
                'description' => 'Student was present.',
            ],
            [
                'name' => 'Absent',
                'code' => 'absent',
                'description' => 'Student was absent.',
            ],
            [
                'name' => 'Leave',
                'code' => 'leave',
                'description' => 'Student was on approved leave.',
            ],
        ];

        foreach ($types as $type) {
            AttendanceType::firstOrCreate(
                ['code' => $type['code']],
                $type
            );
        }
    }
}
