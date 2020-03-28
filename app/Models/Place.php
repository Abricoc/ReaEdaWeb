<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $table = "places";

    protected $hidden = ['created_at', 'updated_at'];

    public function products(){
        return $this->hasMany('App\Models\Product');
    }
}
