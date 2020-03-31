<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed place_name
 * @property false|mixed|string place_photo
 * @method static findorfail($id)
 * @method static paginate(int $int)
 */
class Place extends Model
{
    protected $table = "places";

    protected $hidden = ['created_at', 'updated_at'];

    public function products(){
        return $this->hasMany('App\Models\Product');
    }
}
