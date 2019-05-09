<?php
return [
    'class' => \yii\web\UrlManager::class,
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules'           => [
        "<module>/<controller>/<action>"                          => "<module>/<controller>/<action>",
        "<module>/<controller>/<action>/<id:\w+>/<parent_id:\w+>" => "<module>/<controller>/<action>",
        "<module>/<controller>/<action>/<id:\w+>"                 => "<module>/<controller>/<action>",
        '<controller:\w+>/<id:\d+>'                               => '<controller>/view',
        "<controller>/<action>/<id:\w+>"                          => '<controller>/<action>',
        '<controller:\w+>/<action:\w+>'                           => '<controller>/<action>',
    ],
];