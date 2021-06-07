<?php

return [
    'wechat' => [
        'app_id' =>'',
        'secret' => '',
        'driver' => Wtf10029\Oauth\WeChatApplets::class,
        'log' => [
            'file' => __DIR__ . '/runtime/logs/wechat.log',
        ],
    ],
];