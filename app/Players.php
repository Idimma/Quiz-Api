<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Players extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'questions',
        'answers',
        'given_answers',
        'score',
        'percent',
        'no_questions',
        'seconds_used',
        'seconds_allocated',
        'seconds_expected',
        'seconds_spread',
        'type',
        'level',
        'question_type',
        'meta',
    ];
    protected $casts = [
        'questions' => 'array',
        'answers' => 'array',
        'meta' => 'array',
        'given_answers' => 'array',
        'seconds_spread' => 'array',
    ];
}
