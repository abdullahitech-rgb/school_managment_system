<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'student_id',
        'exam_id',
        'subject_id',
        'marks',
        'total_marks',
        'percentage',
        'grade',
        'remarks',
    ];

    protected $casts = [
        'marks' => 'decimal:2',
        'total_marks' => 'decimal:2',
        'percentage' => 'decimal:2',
    ];

    /**
     * Relationships
     */
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

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * Calculate and set percentage and grade
     */
    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if ($model->marks && $model->total_marks) {
                $model->percentage = ($model->marks / $model->total_marks) * 100;
                $model->grade = $model->calculateGrade($model->percentage);
            }
        });
    }

    /**
     * Calculate grade based on percentage
     */
    private function calculateGrade($percentage)
    {
        if ($percentage >= 90) return 'A+';
        if ($percentage >= 85) return 'A';
        if ($percentage >= 80) return 'B+';
        if ($percentage >= 70) return 'B';
        if ($percentage >= 60) return 'C+';
        if ($percentage >= 50) return 'C';
        if ($percentage >= 40) return 'D';
        return 'F';
    }
}
