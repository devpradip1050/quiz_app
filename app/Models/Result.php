<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'exam_type',
        'total_question',
        'correct_answer',
        'wrong_answer',
        'exam_time'
    ];
}
