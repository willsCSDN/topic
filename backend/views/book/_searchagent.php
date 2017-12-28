<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Category;
use common\models\BookAgent;
/* @var $this yii\web\View */
/* @var $model backend\models\BookSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index-agent'],
        'method' => 'get',
    ]); ?>

    <div class="col-md-2">
        <?= $form->field($model, 'sale_model')->label('')->dropDownList(['' => '销售模式', '1' => '章节', '2'=> '整本']) ?>
    </div>

    <div class="col-md-2">
        <?= $form->field($model, 'status')->label('')->dropDownList(['' => '书籍状态','1' => '上架','2' => '下架']) ?>
    </div>

    <div class="col-md-4">
        <?= $form->field($model, 'name')->label('')->textInput(['maxlenth' => true, 'placeholder' => '请输入书籍名称/ID/作者']) ?>
    </div>


    <div class="col-md-3" style="padding-top: 18px">
        <?= Html::submitButton(Yii::t('app', '搜索'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
