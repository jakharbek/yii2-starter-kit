<?php
return [
    'class' => \yii\web\UrlManager::class,
    'showScriptName'  => false,
    'enablePrettyUrl' => true,
    'rules'           => \yii\helpers\ArrayHelper::merge([],
        \api\modules\v1\Module::$urlManagerRules
    ),
];