<?php

return [
    'wechat' => [
        'app_id' =>env('WECHAT_APPLETS_APPID'),
        'secret' => env('WECHAT_APPLETS_APPSECRE'),
        'driver' => Wtf10029\Oauth\WeChatApplets::class,
        'log' => [
            'file' => __DIR__ . '/runtime/logs/wechat.log',
        ],
    ],
    'app' => [
        'app_id' =>env('WECHAT_OPEN_PLATFORM_APPID'),
        'secret' => env('WECHAT_OPEN_PLATFORM_SECRET'),
        'driver' => Wtf10029\Oauth\WeChatOpenPlatform::class,
        'log' => [
            'file' => __DIR__ . '/runtime/logs/wechat.log',
        ],
    ],
];