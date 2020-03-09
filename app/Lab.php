<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'course_id', 'course_name', 'password', 'professor_name',
    ];

    public function Ta()
    {
        return $this->belongsToMany(TA::class, 'id')->using(Assign::class, 'ta_id');
        // return $this->belongsToMany(Lab::class,'assigns');
    }
}
