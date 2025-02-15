<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlankParagraph extends Model
{

    protected $fillable = ['question', 'answer', 'level', 'type', 'meta'];
    protected $casts = ['meta' => 'array'];
}
