<?php

return [
        'mongodb_c' => [
            'class' => '\yii\mongodb\Connection',
            'dsn' => 'mongodb://username:password@ip:port/database',
        ],
        'mongodb_p' => [
            'class' => '\yii\mongodb\Connection',
            'dsn' => 'mongodb://username:password@ip:port/database',
        ],
        'mongodb_a' => [
            'class' => '\yii\mongodb\Connection',
            'dsn' => 'mongodb://username:password@ip:port/database',
        ],
        'mysql' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=yii2advanced',
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
        ],
];
