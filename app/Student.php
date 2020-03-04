<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'student_id', 'user_id',
    ];

    public function User(){
        return $this->belongsTo(User::class,'id');
    }
}
