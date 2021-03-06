<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed place_name
 * @property false|mixed|string place_photo
 * @property mixed place_open
 * @property mixed place_close
 * @property mixed|string operating_mode
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

    public function getPlaceOpenAttribute($value)
    {
        return substr($value, 0, 5) ;
    }

    public function getPlaceCloseAttribute($value)
    {
        return substr($value, 0, 5) ;
    }

    protected $casts = [
        'operating_mode' => 'boolean'
    ];
}
