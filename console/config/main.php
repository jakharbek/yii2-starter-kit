<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'console\controllers',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],

    'controllerMap' => [
        'fixture' => [
            'class' => 'yii\faker\FixtureController',
            'language' => 'ru_RU',
            'templatePath' => '@tests/fixtures/templates',
            'fixtureDataPath' => '@tests/fixtures/data',
            'namespace' => 'tests\fixtures'
        ],
        'migrate' => [
            'class'               => 'yii\console\controllers\MigrateController',
            'migrationNamespaces' => [
                'yii\queue\db\migrations'
            ],
        ],
    ],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    ],
    'params' => $params,
];
