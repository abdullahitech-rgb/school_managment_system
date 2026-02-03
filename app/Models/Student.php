<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'admission_no',
        'date_of_birth',
        'gender',
        'class_id',
        'section_id',
        'parent_id',
        'address',
        'phone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function parent()
    {
        return $this->belongsTo(Parent_::class, 'parent_id');
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
