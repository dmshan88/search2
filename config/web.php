<?php

$params = array_merge(
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);
$db = array_merge(
    require __DIR__ . '/db.php',
    require __DIR__ . '/db-local.php'
);

$config = [
    'id' => 'yiisearch2',
    'basePath' => dirname(__DIR__),
    'vendorPath'=>__DIR__.'/../vendor',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            // 'enableCookieValidation' => false,
            'enableCsrfValidation' => false,
            'cookieValidationKey' => 'yiisearch2',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'mysql' => $db['mysql'],
        'mongodb_c' => $db['mongodb_c'],
        'mongodb_p' => $db['mongodb_p'],
        'mongodb_a' => $db['mongodb_a'],
        'user' => [
            'identityClass' => 'app\models\User',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    'logFile' => "@runtime/logs/app.log" ,
                ],
            ],
        ]
     ], 
    // 'defaultRoute' => 'fapan', 
    // 'defaultController' => 'index' 
    'language' => 'zh-CN',
    'language' => 'en-US',
    'timeZone' => 'Asia/Shanghai',
    'sourceLanguage' => 'en-US',
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
        'generators' => [
                'mongoDbModel' => [
                    'class' => 'yii\mongodb\gii\model\Generator'
                ]
            ],
    ];
}

return $config;
