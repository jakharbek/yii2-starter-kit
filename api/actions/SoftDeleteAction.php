<?php

namespace api\actions;

use Yii;
use yii\web\ServerErrorHttpException;

class SoftDeleteAction extends \yii\rest\DeleteAction
{
    /**
     * Deletes a model.
     * @param mixed $id id of the model to be deleted.
     * @throws ServerErrorHttpException on failure.
     */
    public function run($id)
    {
        $model = $this->findModel($id);

        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id, $model);
        }

        $result = $model->softDelete();
        Yii::$app->getResponse()->setStatusCode(204);
        return $model;

    }
}