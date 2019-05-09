<?php

namespace api\modules\v1;

use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\Cors;

class Module extends \yii\base\Module
{
    const VERSION = "v1";

    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'api\modules\v1\controllers';

    /**
     * @return array
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = $this->getAuthenticator();
        $behaviors['corsFilter'] = $this->getCorsFilter();
        return $behaviors;
    }

    /**
     * @return array
     */
    private function getCorsFilter()
    {
        return [
            'class' => Cors::className(),
            'cors' => [
                'Origin' => static::allowedDomains(),
                'Access-Control-Request-Method' => ['GET,HEAD,POST,PUT,PATCH,OPTIONS,DELETE'],
                'Access-Control-Max-Age' => 3600,
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Expose-Headers' => ['*'],
                'Access-Control-Allow-Methods' => ['GET,HEAD,POST,PUT,PATCH,OPTIONS,DELETE'],
            ],
        ];
    }

    /**
     * @return array
     */
    private function getAuthenticator()
    {
        return [
            'class' => CompositeAuth::className(),
            'except' => [
                'default/index'
            ],
            'authMethods' => [
                HttpBearerAuth::className(),
            ],
        ];
    }


    /**
     * @return array
     */
    public static function allowedDomains()
    {
        return [
            '*',
        ];
    }

    /**
     * @var array
     */
    public static $urlManagerRules = [
        [
            'class' => 'yii\rest\UrlRule',
            'controller' => 'v1/default',
            'extraPatterns' => [
                'GET /info' => 'info',
                'OPTIONS info' => 'options',
            ]
        ],
    ];

}
