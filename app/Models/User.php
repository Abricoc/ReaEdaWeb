<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int|mixed role
 * @property mixed firstname
 * @property mixed|string password
 * @property mixed email
 * @property mixed device_id
 * @method static where(string $string, $input)
 */
class User extends Authenticatable
{
    use Notifiable;
    use HasApiTokens;

    protected $fillable = [
        'firstname', 'email', 'password', 'role'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'cart' => 'array'
    ];

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function devices()
    {
        return $this->hasMany('App\Models\Device');
    }
}
