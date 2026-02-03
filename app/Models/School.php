<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'zip_code',
        'description',
        'status',
    ];

    /**
     * Relationships
     */
    public function admins()
    {
        return $this->hasMany(User::class)->where('role', 'admin');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function classes()
    {
        return $this->hasMany(Classes::class);
    }

    public function fees()
    {
        return $this->hasMany(Fee::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function examTypes()
    {
        return $this->hasMany(ExamType::class);
    }

    public function examRooms()
    {
        return $this->hasMany(ExamRoom::class);
    }

    public function examSchedules()
    {
        return $this->hasMany(ExamSchedule::class);
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function gradeScales()
    {
        return $this->hasMany(GradeScale::class);
    }

    public function resultCards()
    {
        return $this->hasMany(ResultCard::class);
    }

    public function examInvigilators()
    {
        return $this->hasMany(ExamInvigilator::class);
    }
}
