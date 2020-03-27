<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categorys';

    public function products(){
        return $this->hasMany('App\Models\Product');
    }
}