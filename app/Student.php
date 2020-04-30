<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name','user_id', 'class', 'types', 'zone'];

    protected $casts = [
      'types' => 'array'
    ];
}
