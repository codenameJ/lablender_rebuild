<?php

namespace App;

use App\Notifications\LendingRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;

class Request_list extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'status', 'student_id','lab_id','status'
    ];

    public function Request_detail(){
        return $this->hasMany(Request_detail::class,'request_list_id');
    }

}
