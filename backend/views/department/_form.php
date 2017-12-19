<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Department;
/* @var $this yii\web\View */
/* @var $model common\models\Department */
/* @var $form yii\widgets\ActiveForm */
if($model->isNewRecord) {
    $get = Yii::$app->request->get();
    $model->fid = isset($get['fid']) ? $get['fid'] : '';
}
?>

<div class="department-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fid')->dropDownList(Department::getTop()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', '新增') : Yii::t('app', '修改'), ['class' => 'btn btn-info btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
