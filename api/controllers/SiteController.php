<?php

namespace api\controllers;

use Yii;
use yii\filters\Cors;
use yii\helpers\Json;
use yii\rest\Controller;

/**
 * Class SiteController
 * @package api\controllers
 */
class SiteController extends Controller
{
    /**
     * @return array
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [
            'class' => Cors::className(),
            'cors'  => [
                'Origin'                         => ['*'],
                'Access-Control-Request-Method'  => ['*'],
                'Access-Control-Max-Age'         => 3600,
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Expose-Headers'  => ['*']
            ],
        ];
        return $behaviors;
    }
    /**
     * @param $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        parent::beforeAction($action);
        return $action;
    }

    /**
     * @inheritdoc
     */
    public function actions(): array
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * @return array
     */
    public function actionIndex()
    {
        return [
            "site_name"          => getenv("SITE_NAME"),
            "development"        => getenv("DEVELOPMENT"),
            'TEST' => getenv("FRONTEND_URL")
        ];
    }
}