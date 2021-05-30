<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'account',
        'phone',
        'mail',
        'openid',
        'unionid',
        'nickname',
        'avatarurl',
        'gender',
        'identity',
        'status',
        'session_key',
        'keyword',
        'last_login_time',
    ];

    public static $EnumStatus = [0 => '正常', 1 => '禁止登录', 2 => '待审核'];
    public static $EnumGender = [0 => '男', 1 => '女', 2 => '未知'];
    public static $EnumType = [0 => '用户', 1 => '助手'];

}
