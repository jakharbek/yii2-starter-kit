<?php
/**
 * This is the template for generating a CRUD controller class file.
 */

use yii\db\ActiveRecordInterface;
use yii\helpers\Inflector;
use yii\helpers\StringHelper;


/* @var $this yii\web\View */
/* @var $generator \zakovat\generators\crud\Generator */

$controllerClass = StringHelper::basename($generator->controllerClass);
$modelClass = StringHelper::basename($generator->modelClass);
$searchModelClass = StringHelper::basename($generator->searchModelClass);
if ($modelClass === $searchModelClass) {
    $searchModelAlias = $searchModelClass . 'Search';
}

/* @var $class ActiveRecordInterface */
$class = $generator->modelClass;
$pks = $class::primaryKey();
$urlParams = $generator->generateUrlParams();
$actionParams = $generator->generateActionParams();
$actionParamComments = $generator->generateActionParamComments();
if (strlen($generator->tag) == 0) {
    $generator->tag = Inflector::camel2id($modelClass);
}

echo "<?php\n";
?>

namespace <?= StringHelper::dirname(ltrim($generator->controllerClass, '\\')) ?>;

use Yii;
use <?= ltrim($generator->modelClass, '\\') ?>;
<?php if (!empty($generator->searchModelClass)): ?>
use <?= ltrim($generator->searchModelClass, '\\') . (isset($searchModelAlias) ? " as $searchModelAlias" : "") ?>;
<?php else: ?>
use yii\data\ActiveDataProvider;
<?php endif; ?>
use <?= ltrim($generator->baseControllerClass, '\\') ?>;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use <?= $generator->actionCreateClass ?>;
use <?= $generator->actionIndexClass ?>;
use <?= $generator->actionUpdateClass ?>;
use <?= $generator->actionViewClass ?>;
use <?= $generator->actionDeleteClass ?>;
use <?= $generator->actionRestoreClass ?>;

<?php if ($generator->withCreate): ?>
    /**
    * @OA\Post(
    *   path="<?= $generator->path ?>/<?= Inflector::camel2id($modelClass) ?>",
    *   tags={"<?= $generator->tag ?>"},
    *   summary="Create",
    *   description="Create",
    *   operationId="<?= $generator->tag ?>Create",
    *   security={{"bearerAuth":{}}},
    *
    *     @OA\RequestBody(
    *         description="Input data format",
    *         @OA\MediaType(
    *              mediaType="application/x-www-form-urlencoded",
    *             @OA\Schema(ref="#/components/schemas/<?= $modelClass ?>")
    *         )
    *     ),
    *   @OA\Response(
    *        response=200,
    *        description="Scucess: Created",
    *        @OA\MediaType(
    *            mediaType="application/json",
    *            @OA\Schema(ref="#/components/schemas/<?= $modelClass ?>")
    *       )
    *
    *     ),
    *
    *     @OA\Response(
    *         response=401,
    *         description="Error:Unauthorized",
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                           @OA\Property(
    *                              property="name",
    *                              type="string"
    *                           ),
    *                           @OA\Property(
    *                              property="message",
    *                              type="string"
    *                          ),
    *                           @OA\Property(
    *                              property="code",
    *                              type="integer"
    *                          ),
    *                           @OA\Property(
    *                              property="status",
    *                              type="integer"
    *                          ),
    *                          @OA\Property(
    *                              property="type",
    *                              type="string"
    *                          ),
    *                          example={"name": "Unauthorized","message": "Your request was made with invalid credentials.","code":"0","status":"401","type": "yii\\web\\UnauthorizedHttpException"}
    *                      )
    *         )
    *     ),
    *
    *
    *     @OA\Response(
    *         response=422,
    *         description="Error:Validation",
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                                  @OA\Property(
    *                                      property="field",
    *                                      type="string"
    *                                  ),
    *                                  @OA\Property(
    *                                      property="message",
    *                                     type="string"
    *                                  ),
    *                                  example={"field": "error_field","message": "Error message"}
    *                       )
    *                      )
    *     ),
    *  )
    *
    *
    *
    */

    /**
    * @OA\Get(
    *   path="<?= $generator->path ?>/<?= Inflector::camel2id($modelClass) ?>/{id}",
    *   tags={"<?= $generator->tag ?>"},
    *   summary="View",
    *   description="View",
    *   operationId="<?= $generator->tag ?>View",
    *   security={{"bearerAuth":{}}},
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         description="ID",
    *         required=true,
    *         @OA\Schema(
    *             type="integer",
    *             format="int64"
    *         )
    *     ),
    *   @OA\Response(
    *        response=200,
    *        description="Scucess:view",
    *        @OA\MediaType(
    *            mediaType="application/json",
    *            @OA\Schema(ref="#/components/schemas/<?= $modelClass ?>")
    *       )
    *
    *     ),
    *
    *     @OA\Response(
    *         response=401,
    *         description="Error:Unauthorized",
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                           @OA\Property(
    *                              property="name",
    *                              type="string"
    *                           ),
    *                           @OA\Property(
    *                              property="message",
    *                              type="string"
    *                          ),
    *                           @OA\Property(
    *                              property="code",
    *                              type="integer"
    *                          ),
    *                           @OA\Property(
    *                              property="status",
    *                              type="integer"
    *                          ),
    *                          @OA\Property(
    *                              property="type",
    *                              type="string"
    *                          ),
    *                          example={"name": "Unauthorized","message": "Your request was made with invalid credentials.","code":"0","status":"401","type": "yii\\web\\UnauthorizedHttpException"}
    *                      )
    *         )
    *     ),
    *
    *  )
    *
    *
    *
    */
<?php endif; ?>
<?php if ($generator->withIndex): ?>
    /**
    * @OA\Get(
    *   path="<?= $generator->path ?>/<?= Inflector::camel2id($modelClass) ?>",
    *   tags={"<?= $generator->tag ?>"},
    *   summary="Index (List)",
    *   description="Index (List)",
    *   operationId="<?= $generator->tag ?>IndexList",
    *   security={{"bearerAuth":{}}},
    *     @OA\Response(
    *         response=200,
    *         description="successful operation",
    *         @OA\JsonContent(
    *             type="array",
    *             @OA\Items(ref="#/components/schemas/<?= $modelClass ?>")
    *         )
    *     ),
    *     @OA\Response(
    *         response=401,
    *         description="Error:Unauthorized",
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                           @OA\Property(
    *                              property="name",
    *                              type="string"
    *                           ),
    *                           @OA\Property(
    *                              property="message",
    *                              type="string"
    *                          ),
    *                           @OA\Property(
    *                              property="code",
    *                              type="integer"
    *                          ),
    *                           @OA\Property(
    *                              property="status",
    *                              type="integer"
    *                          ),
    *                          @OA\Property(
    *                              property="type",
    *                              type="string"
    *                          ),
    *                          example={"name": "Unauthorized","message": "Your request was made with invalid credentials.","code":"0","status":"401","type": "yii\\web\\UnauthorizedHttpException"}
    *                      )
    *         )
    *     ),
    *
    *  )
    *
    *
    *
    */
<?php endif; ?>
<?php if ($generator->withUpdate): ?>

    /**
    * @OA\Put(
    *   path="<?= $generator->path ?>/<?= Inflector::camel2id($modelClass) ?>/{id}",
    *   tags={"<?= $generator->tag ?>"},
    *   summary="Update",
    *   description="Update",
    *   operationId="<?= $generator->tag ?>Update",
    *   security={{"bearerAuth":{}}},
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         description="ID",
    *         required=true,
    *         @OA\Schema(
    *             type="integer",
    *             format="int64"
    *         )
    *     ),
    *     @OA\RequestBody(
    *         description="Input data format",
    *         @OA\MediaType(
    *             mediaType="application/x-www-form-urlencoded",
    *             @OA\Schema(ref="#/components/schemas/<?= $modelClass ?>")
    *         )
    *     ),
    *   @OA\Response(
    *        response=200,
    *        description="Scucess: update",
    *        @OA\MediaType(
    *            mediaType="application/json",
    *            @OA\Schema(ref="#/components/schemas/<?= $modelClass ?>")
    *       )
    *
    *     ),
    *
    *     @OA\Response(
    *         response=401,
    *         description="Error:Unauthorized",
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                           @OA\Property(
    *                              property="name",
    *                              type="string"
    *                           ),
    *                           @OA\Property(
    *                              property="message",
    *                              type="string"
    *                          ),
    *                           @OA\Property(
    *                              property="code",
    *                              type="integer"
    *                          ),
    *                           @OA\Property(
    *                              property="status",
    *                              type="integer"
    *                          ),
    *                          @OA\Property(
    *                              property="type",
    *                              type="string"
    *                          ),
    *                          example={"name": "Unauthorized","message": "Your request was made with invalid credentials.","code":"0","status":"401","type": "yii\\web\\UnauthorizedHttpException"}
    *                      )
    *         )
    *     ),
    *
    *  )
    *
    *
    *
    */

<?php endif; ?>
<?php if ($generator->withDelete): ?>
    /**
    * @OA\Delete(
    *   path="<?= $generator->path ?>/<?= Inflector::camel2id($modelClass) ?>/{id}",
    *   tags={"<?= $generator->tag ?>"},
    *   summary="Delete",
    *   description="Delete",
    *   operationId="<?= $generator->tag ?>Delete",
    *   security={{"bearerAuth":{}}},
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         description="ID of ",
    *         required=true,
    *         @OA\Schema(
    *             type="integer",
    *             format="int64"
    *         )
    *     ),
    *   @OA\Response(
    *        response=200,
    *        description="Scucess: deleted",
    *        @OA\MediaType(
    *            mediaType="application/json",
    *            @OA\Schema(ref="#/components/schemas/<?= $modelClass ?>")
    *       )
    *
    *     ),
    *
    *     @OA\Response(
    *         response=401,
    *         description="Error:Unauthorized",
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                           @OA\Property(
    *                              property="name",
    *                              type="string"
    *                           ),
    *                           @OA\Property(
    *                              property="message",
    *                              type="string"
    *                          ),
    *                           @OA\Property(
    *                              property="code",
    *                              type="integer"
    *                          ),
    *                           @OA\Property(
    *                              property="status",
    *                              type="integer"
    *                          ),
    *                          @OA\Property(
    *                              property="type",
    *                              type="string"
    *                          ),
    *                          example={"name": "Unauthorized","message": "Your request was made with invalid credentials.","code":"0","status":"401","type": "yii\\web\\UnauthorizedHttpException"}
    *                      )
    *         )
    *     ),
    *
    *  )
    *
    *
    *
    */
<? endif; ?>
<?php if ($generator->withRestore): ?>
    /**
    * @OA\Put(
    *   path="<?= $generator->path ?>/<?= Inflector::camel2id($modelClass) ?>/restore/{id}",
    *   tags={"<?= $generator->tag ?>"},
    *   summary="Restore",
    *   description="Restore",
    *   operationId="<?= $generator->tag ?>Restore",
    *   security={{"bearerAuth":{}}},
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         description="ID of ",
    *         required=true,
    *         @OA\Schema(
    *             type="integer",
    *             format="int64"
    *         )
    *     ),
    *   @OA\Response(
    *        response=200,
    *        description="Scucess: Restored",
    *        @OA\MediaType(
    *            mediaType="application/json",
    *            @OA\Schema(ref="#/components/schemas/<?= $modelClass ?>")
    *       )
    *
    *     ),
    *
    *     @OA\Response(
    *         response=401,
    *         description="Error:Unauthorized",
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                           @OA\Property(
    *                              property="name",
    *                              type="string"
    *                           ),
    *                           @OA\Property(
    *                              property="message",
    *                              type="string"
    *                          ),
    *                           @OA\Property(
    *                              property="code",
    *                              type="integer"
    *                          ),
    *                           @OA\Property(
    *                              property="status",
    *                              type="integer"
    *                          ),
    *                          @OA\Property(
    *                              property="type",
    *                              type="string"
    *                          ),
    *                          example={"name": "Unauthorized","message": "Your request was made with invalid credentials.","code":"0","status":"401","type": "yii\\web\\UnauthorizedHttpException"}
    *                      )
    *         )
    *     ),
    *
    *  )
    *
    *
    *
    */

<?php endif; ?>

/**
* <?= $controllerClass ?> implements the CRUD actions for <?= $modelClass ?> model.
*/
class <?= $controllerClass ?> extends <?= StringHelper::basename($generator->baseControllerClass) . "\n" ?>
{

    /**
    * @var string
    */
    public $modelClass = <?= $modelClass ?>::class;
    public $modelSearch = <?= $searchModelClass ?>::class;


    /**
    * @return array
    */
    public function actions()
    {
        return [
        <?php if ($generator->withView): ?>
            'view'    => [
                'class'      => <?= StringHelper::basename($generator->actionViewClass) ?>::class,
                'modelClass' => $this->modelClass,
            ],
        <?php endif; ?>
        <?php if ($generator->withCreate): ?>
            'create'  => [
                'class'      => <?= StringHelper::basename($generator->actionCreateClass) ?>::class,
                'modelClass' => $this->modelClass,
            ],
        <?php endif; ?>
        <?php if ($generator->withUpdate): ?>
            'update'  => [
                'class'      => <?= StringHelper::basename($generator->actionUpdateClass) ?>::class,
                'modelClass' => $this->modelClass,
            ],
        <?php endif; ?>
        <?php if ($generator->withDelete): ?>
            'delete'  => [
                'class'      => <?= StringHelper::basename($generator->actionDeleteClass) ?>::class,
                'modelClass' => $this->modelClass,
            ],
        <?php endif; ?>
        <?php if ($generator->withRestore): ?>
            'restore' => [
                'class'      => <?= StringHelper::basename($generator->actionRestoreClass) ?>::class,
                'modelClass' => $this->modelClass,
            ],
        <?php endif; ?>
        <?php if ($generator->withIndex): ?>
            'index'   => [
                'class'      => <?= StringHelper::basename($generator->actionIndexClass) ?>::class,
                'modelClass' => $this->modelClass,
                'dataFilter' => [
                    'class'       => \yii\data\ActiveDataFilter::class,
                    'searchModel' => $this->modelSearch
                ]
            ],
        <?php endif; ?>

        'options' => [
            'class'             => 'yii\rest\OptionsAction',
                'resourceOptions'   => ['GET', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS', 'POST'],
                'collectionOptions' => ['GET', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS', 'POST'],
            ],
        ];
    }
}
