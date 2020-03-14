<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request_detail extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'len_qty', 'request_list_id','equipment_id',
    ];
}
