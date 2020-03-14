<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enroll extends Model
{
    protected $primaryKey = 'student_id';

    protected $fillable = [
        'lab_id', 'student_id','status'
    ];
}
