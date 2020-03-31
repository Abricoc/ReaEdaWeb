<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed name_product
 * @property mixed price
 * @property mixed text
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
