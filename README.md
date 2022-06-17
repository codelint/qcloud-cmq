# qcloud-cmq
Tencent cloud cmq queue driver for laravel


### conf/queue.php :
```php
return [
    'connections' => [
        'sync' => [
            'driver' => 'sync',
        ],
        'cmq' => [
            'driver' => 'cmq',
            'key' => env('CMQ_KEY', ''),
            'secret' => env('CMQ_SECRET', ''),
            'endpoint' => env('CMQ_PREFIX', 'https://cmq-gz.public.tencenttdmq.com'),
            'queue' => 'stocker',
            'fail_queue' => '',
            'policy' => 0,
            'max' => 1000,
        ],
    ]
];
```