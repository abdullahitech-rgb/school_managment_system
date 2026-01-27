<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'name',
        'description',
    ];

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'section_id');
    }

    public function classTeachers()
    {
        return $this->hasMany(ClassTeacher::class, 'section_id');
    }
}
