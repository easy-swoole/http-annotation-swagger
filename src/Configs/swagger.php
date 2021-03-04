<?php
return [
    'info' => [
        'title' => '测试用例',
        'version' => '1.0.0',
        'contact' => ['name' => 'aaa'],
    ],
    'servers' => [
        [
            'url' => 'http://127.0.0.1:9501',
            'description' => '本地环境'
        ]
    ],
    'templates' => [
        'success' => [
            'code|状态码' => "0",
            'result|api请求结果' => "{template}",
            'msg|api提示信息' => 'success'
        ],
        'page' => [
            'code|状态码' => "0",
            'result|api请求结果' => [
                'totalPage|总页数' => 10,
                'page|页数' => 1,
                'list|列表' => ["{template}"],
            ],
            'msg|api提示信息' => 'success'
        ],
    ],
];
