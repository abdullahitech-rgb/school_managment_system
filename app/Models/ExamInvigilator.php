<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamInvigilator extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'exam_schedule_id',
        'teacher_id',
        'role',
        'remarks',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function examSchedule()
    {
        return $this->belongsTo(ExamSchedule::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
