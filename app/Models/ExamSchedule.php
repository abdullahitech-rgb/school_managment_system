<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'exam_id',
        'subject_id',
        'class_id',
        'section_id',
        'exam_room_id',
        'exam_date',
        'start_time',
        'end_time',
        'status',
    ];

    protected $casts = [
        'exam_date' => 'date',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function examRoom()
    {
        return $this->belongsTo(ExamRoom::class);
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }

    public function invigilators()
    {
        return $this->hasMany(ExamInvigilator::class);
    }
}
