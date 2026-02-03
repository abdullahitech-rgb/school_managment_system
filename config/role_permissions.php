<?php

return [
    'super-admin' => [
        'label' => 'Super Admin',
        'description' => 'Highest authority - Full system control',
        'categories' => [
            'System Administration' => [
                'Create/manage multiple schools (if multi-tenant)',
                'Create/manage School Admins',
                'System-wide settings & configuration',
                'Database backup/restore',
                "View all schools' analytics",
                'Access to all modules and data',
                'Set up fee structures globally',
                'Configure academic year',
                'Manage system updates',
            ],
        ],
    ],
    'admin' => [
        'label' => 'Admin / School Admin',
        'description' => 'School-level administrator - Manages single school',
        'categories' => [
            'People Management' => [
                'Manage all teachers (add/edit/delete)',
                'Manage all students (admissions, profiles)',
            ],
            'Academics' => [
                'Create/manage classes & sections',
                'Assign class teachers',
                'Set up subjects',
                'Schedule exams',
                'Generate reports (attendance, results, fees)',
            ],
            'Finance' => [
                'Manage fee collection & generate vouchers',
                'Set up fee structures',
            ],
            'Operations' => [
                'Approve leave requests',
                'Send announcements to parents/teachers',
                'View school dashboard & analytics',
            ],
        ],
    ],
    'teacher' => [
        'label' => 'Teacher',
        'description' => 'Academic operations - Classroom management',
        'categories' => [
            'Classroom' => [
                'View assigned classes & students',
                'Take daily student attendance',
                'Enter exam marks',
                'Upload/update results',
                'Manage subjects (view materials)',
                'View student performance reports',
                'Send progress reports to parents',
            ],
            'Personal' => [
                'Update personal profile',
                'View timetable',
                'Request leave',
                'View class analytics',
            ],
        ],
    ],
    'student' => [
        'label' => 'Student',
        'description' => 'Primary user - Academic activities',
        'categories' => [
            'Academics' => [
                'View personal profile',
                'View class timetable',
                'Check attendance record',
                'View exam results',
                'Check fee payment status',
                'Download study materials',
                'View notices/announcements',
                'Update personal information',
                'View assigned teachers',
                'Track academic progress',
            ],
        ],
    ],
    'parent' => [
        'label' => 'Parent',
        'description' => "Guardian - Monitor child's progress",
        'categories' => [
            'Monitoring' => [
                "View child's profile",
                "Check child's attendance",
                "View child's exam results",
                'Monitor fee payment status',
                'Receive notifications',
                'Communicate with teachers',
                'View school announcements',
                'Track multiple children (if applicable)',
                'Download report cards',
                'Update contact information',
            ],
        ],
    ],
];
