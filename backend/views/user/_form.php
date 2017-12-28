<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Alert;
use common\models\Department;
/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>


    <div class="col-md-12">
        <div class="col-md-1" style="padding-top: 9px">
            <p>用户名：</p>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'username')->label(false)->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-5" style="padding-top: 9px">
            <p>4-20位英文字母与数字混合</p>
        </div>
    </div>

    <div class="col-md-12">
        <div class="col-md-1" style="padding-top: 9px">
            <p>部门：</p>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'department_id' )->label(false)->dropDownList(Department::getDepart())?>
        </div>
    </div>

    <?php
    if( Yii::$app->getSession()->hasFlash('error') ) {
        echo Alert::widget([
            'options' => [
                'class' => 'alert alert-danger',
            ],
            'body' => Yii::$app->getSession()->getFlash('error'),
        ]);
    }
    ?>
    <div class="col-md-12">
        <div class="col-md-1" style="padding-top: 9px">
            <p>密码：</p>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'auth_key')->label(false)->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="col-md-12">
        <div class="col-md-1" style="padding-top: 9px">
            <p>邮箱：</p>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'email')->label(false)->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="col-md-12">
        <div class="col-md-1" style="padding-top: 9px">
            <p>用户组：</p>
        </div>
        <div class="col-md-6">
            <?= $form->field($model1, 'name' )->label(false)->dropDownList($item)?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
