<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'session',
        'semester',
        'matric_no',
        'course_id',
        'ca_1',
        'ca_2',
        'exam',
        'total',
        'grade',
    ];
}
