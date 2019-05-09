<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'defaultRoute'        => 'site/index',
    'bootstrap' => ['log'],
    'modules' => [
        'v1' => \api\modules\v1\Module::class
    ],
    'components' => [
        'request' => [
            'enableCsrfCookie'   => false,
            'parsers'   => [
                'application/json'  => 'yii\web\JsonParser'
            ],
        ],
        'response'   => [
            'class'     => \yii\web\Response::class,
            'format'    => \yii\web\Response::FORMAT_JSON,
        ],
        'urlManager' => require("urlManager.php"),
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'enableSession' => false,
            'identityCookie' => ['name' => '_identity-api', 'httpOnly' => true],
        ],
        'session' => [
            'name' => 'advanced-api',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ]
    ],
    'params' => $params,
];
