<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'name',
        'start_time',
        'end_time',
        'sort_order',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function timetables()
    {
        return $this->hasMany(Timetable::class);
    }
}
