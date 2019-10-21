<?php

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $generator common\generators\crud\Generator */

echo $form->field($generator, 'modelClass');
echo $form->field($generator, 'searchModelClass');
echo $form->field($generator, 'controllerClass');
echo $form->field($generator, 'path');
echo $form->field($generator, 'tag');
echo $form->field($generator, 'baseControllerClass');
echo $form->field($generator, 'enableI18N')->checkbox();
echo $form->field($generator, 'messageCategory');
echo $form->field($generator, 'actionCreateClass');
echo $form->field($generator, 'actionUpdateClass');
echo $form->field($generator, 'actionDeleteClass');
echo $form->field($generator, 'actionViewClass');
echo $form->field($generator, 'actionRestoreClass');
echo $form->field($generator, 'withRestore')->checkbox();
echo $form->field($generator, 'withDelete')->checkbox();
echo $form->field($generator, 'withUpdate')->checkbox();
echo $form->field($generator, 'withView')->checkbox();
echo $form->field($generator, 'withIndex')->checkbox();