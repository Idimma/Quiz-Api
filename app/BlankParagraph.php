<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlankParagraph extends Model
{

    protected $fillable = ['question', 'answer', 'level', 'type', 'meta', 'student_instruction', 'ai_instruction'];
    protected $casts = ['meta' => 'array'];
    protected $hidden = ['created_at', 'updated_at', 'type', 'level', 'meta'];
}
