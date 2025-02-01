<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spelling extends Model
{
    protected $fillable = ['word', 'type', 'level'];

    protected $hidden = ['created_at', 'updated_at'];

}
