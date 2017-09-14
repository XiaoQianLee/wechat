<?php
return [
    'options' => [
        'debug'  => true,
        'app_id' => 'wx720a0a4ae1856235',
        'secret' => '677ba74521dc19ac126a14026a4e0e03',
        'token'  => 'lixiaoqian',
        // 'aes_key' => null, // 可选
        'log' => [
            'level' => 'debug',
            'file'  => '/tmp/easywechat.log', // XXX: 绝对路径！！！！//
        ],
        'oauth' => [
            'scopes'   => ['snsapi_userinfo'],
            'callback' => url('index/wechat/callback'),
        ]
        //...
    ]
];