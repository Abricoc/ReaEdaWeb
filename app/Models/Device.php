<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed user_id
 * @property mixed device_token
 */
class Device extends Model
{
    protected $table = 'devices';

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public $timestamps = false;
}
