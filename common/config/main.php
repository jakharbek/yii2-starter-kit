<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'bootstrap'  => [
        'queue'
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'tools'        => [
            'class' => 'common\components\ToolsComponent',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager'  => [
            'class'        => 'yii\rbac\DbManager', // or use 'yii\rbac\DbManager'
            'defaultRoles' => ['user'],
        ],
        'i18n'  => [
            'translations' => [
                '*' => [
                    'class'            => 'yii\i18n\DbMessageSource',
                    'forceTranslation' => true,
                    'enableCaching'    => true,
                    'cachingDuration'  => 3600,
                    'sourceLanguage'   => 'en-US'
                ],
            ],
        ],
    ],
    'modules' => [
        'gii' => [
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['127.0.0.1', '::1', '*'],
            'generators' => [
                'swagger-model' => [
                    'class' => '\common\generators\model\Generator',
                    'templates' => [
                        'swagger-model' => '@common/generators/model/default',
                    ]
                ],
                'swagger-api-crud' => [
                    'class' => '\common\generators\crud\Generator',
                    'templates' => [
                        'swagger' => '@common/generators/crud/default',
                    ]
                ],
                'fixture' => [
                    'class' => 'elisdn\gii\fixture\Generator',
                ],
            ],
        ],
    ],
];
