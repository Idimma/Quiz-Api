<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Players extends Model
{
    protected $fillable = ['questions', 'name', 'score', 'class', 'zone', 'answers', 'user_id', 'time'];
    protected $casts = [
        'questions' => 'array',
        'answers' => 'array',
        'time' => 'array',
    ];
}
