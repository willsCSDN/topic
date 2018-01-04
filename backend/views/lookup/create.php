<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Lookup */

$this->title = Yii::t('app', 'Create Lookup');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lookups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wrapper wrapper-content">

    <div class="ibox-content">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    </div>

</div>
