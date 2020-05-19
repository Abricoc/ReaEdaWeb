<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed comment
 * @property mixed user_id
 * @property mixed|string status
 * @property mixed products
 * @property mixed id
 * @property int|mixed final_amount
 */
class Order extends Model
{
    use SoftDeletes;
    protected $table = 'orders';

    protected $fillable = ['id', 'status', 'comment', 'products', 'created_at'];

    protected $casts = [
        'products' => 'array'
    ];
}
