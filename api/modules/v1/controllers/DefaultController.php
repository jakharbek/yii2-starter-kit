<?php
namespace api\modules\v1\controllers;

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
        return [
            'version' => 'v1'
        ];
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