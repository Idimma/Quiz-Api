<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spelling extends Model
{
    protected $fillable = ['word', 'answer', 'is_right', 'user'];

    protected $hidden = ['created_at', 'updated_at', 'id'];
}
