<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'answer',
        'a',
        'b',
        'c',
        'd',
        'question',
        'type',
        'class',
        'meta'
    ];
}
