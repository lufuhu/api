<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'openid',
        'username',
        'mail',
        'avatar',
        'nickname',
        'driver',
        'status',
        'session_key',
        'keyword',
        'last_login_time',
    ];
    public static $EnumStatus = [0 => '正常', 1 => '禁止登录'];

}
