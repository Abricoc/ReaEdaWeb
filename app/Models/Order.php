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
 */
class Order extends Model
{
    use SoftDeletes;
    protected $table = 'orders';

    protected $casts = [
        'cart' => 'array'
    ];
}
