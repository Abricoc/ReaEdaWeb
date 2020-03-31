<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed name_product
 * @property mixed price
 * @property mixed text
 * @property mixed category_id
 * @property mixed place_id
 * @property mixed photo
 * @method static findorfail($id)
 */
class Product extends Model
{
    protected $table = 'products';

    protected $hidden = ['category_id', 'place_id', 'created_at', 'updated_at'];

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function place(){
        return $this->belongsTo('App\Models\Place');
    }
}
