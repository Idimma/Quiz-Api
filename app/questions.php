<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class questions extends Model
{
    protected $hidden = ['created_at', 'updated_at', 'id'];
}
