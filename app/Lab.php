<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'course_id', 'course_name', 'password', 'professor_name',
    ];
}
