<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => getenv("DB_TEST_DSN"),
            'username' => getenv("DB_TEST_USERNAME"),
            'password' => getenv("DB_TEST_PASSWORD"),
            'charset' => getenv("DB_TEST_CHARSET"),
        ],
    ],
];
