<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed category_name
 * @method static findorfail($id)
 */
class Category extends Model
{
    protected $table = 'categorys';
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['category_name'];

    public function products(){
        return $this->hasMany('App\Models\Product');
    }
}
