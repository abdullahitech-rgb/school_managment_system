<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
    ];

    public function classes()
    {
        return $this->belongsToMany(Classes::class, 'class_subjects', 'subject_id', 'class_id');
    }

    public function sections()
    {
        return $this->belongsToMany(Section::class, 'subject_section');
    }

    public function subjectTeachers()
    {
        return $this->hasMany(SubjectTeacher::class);
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }

    public function examSchedules()
    {
        return $this->hasMany(ExamSchedule::class);
    }
}
