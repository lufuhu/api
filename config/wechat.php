<?php
return [
    'app_id' => env("WECHAT_APP_ID"),
    'secret' => env("WECHAT_APP_SECRET"),

    'response_type' => 'array',

    'log' => [
        'level' => 'debug',
        'file' => __DIR__.'/wechat.log',
    ],
];
