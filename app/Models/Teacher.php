<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone',
        'qualification',
        'joining_date',
        'address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classTeachers()
    {
        return $this->hasMany(ClassTeacher::class, 'teacher_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'subject_teachers', 'teacher_id', 'subject_id');
    }

    public function subjectTeachers()
    {
        return $this->hasMany(SubjectTeacher::class, 'teacher_id');
    }

    public function examInvigilators()
    {
        return $this->hasMany(ExamInvigilator::class, 'teacher_id');
    }
}
