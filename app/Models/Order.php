<?php

namespace App\Models;

use App\Http\Controllers\OrdersController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed comment
 * @property mixed user_id
 * @property mixed|string status
 * @property mixed products
 * @property mixed id
 * @property int|mixed final_amount
 * @property int|mixed place_name
 * @property mixed select_date
 */
class Order extends Model
{
    use SoftDeletes;
    protected $table = 'orders';

    protected $fillable = ['id', 'status', 'comment', 'products', 'created_at'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    protected $casts = [
        'products' => 'array',
        'created_at' => 'datetime:d.m.Y H:i',
        'select_date' => 'datetime:d.m.Y H:i'
    ];
}
