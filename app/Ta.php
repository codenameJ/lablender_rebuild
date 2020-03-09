<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ta extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
    ];

    public function User(){
        return $this->belongsTo(User::class,'id');
    }

    public function Labs()
    {
        return $this->belongsToMany(Lab::class,'id');
    }
}
