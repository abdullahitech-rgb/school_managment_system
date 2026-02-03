<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'name',
        'grade_point',
        'description',
        'status',
    ];

    protected $casts = [
        'grade_point' => 'decimal:2',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function gradeScales()
    {
        return $this->hasMany(GradeScale::class);
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }

    public function resultCards()
    {
        return $this->hasMany(ResultCard::class);
    }
}
