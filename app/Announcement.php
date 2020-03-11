<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'announcement_name', 'describe','lab_id','user_id',
    ];
}
