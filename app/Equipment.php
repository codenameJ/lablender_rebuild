<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'equip_id', 'equip_name', 'equip_qty', 'lab_id','description','picture_path'
    ];
    public function Labs()
    {
        return $this->belongsTo('App\Lab', 'lab_id');
    }
}
