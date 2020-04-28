<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class spelling extends Model
{
    protected $fillable = ['word', 'answer', 'is_right', 'user'];
}
