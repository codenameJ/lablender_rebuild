<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assign extends Model
{
    protected $primaryKey = 'ta_id';

    protected $fillable = [
        'lab_id', 'ta_id',
    ];
}
