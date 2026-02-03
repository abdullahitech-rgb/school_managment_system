<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'student_id',
        'exam_id',
        'grade_id',
        'issue_date',
        'total_marks',
        'obtained_marks',
        'percentage',
        'remarks',
        'status',
    ];

    protected $casts = [
        'issue_date' => 'date',
        'total_marks' => 'decimal:2',
        'obtained_marks' => 'decimal:2',
        'percentage' => 'decimal:2',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
}
