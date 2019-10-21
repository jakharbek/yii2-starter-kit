<?php
namespace api\modules\v1\controllers;

use Yii;
use yii\helpers\Json;

/**
 * Class DefaultController
 * @package api\modules\v1\controllers
 */
class DefaultController extends \api\modules\v1\DefaultController
{
    /**
     * @return array
     */
    public function actionIndex()
    {
        $openapi = \OpenApi\scan([
            Yii::getAlias('@api')
            ,Yii::getAlias('@common')
        ]);
        $data = \yii\helpers\Json::decode($openapi->toJson());
        return $data;
    }

    /**
     * @return array
     */
    public function actionInfo()
    {
        return [
            'info' => 'info'
        ];
    }

}