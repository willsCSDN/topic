<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\Lookup;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\BannerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'banner管理');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', '新增'), ['create'], ['class' => 'btn btn-info btn-sm']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
      //            'img_url:url',
            [
                'label' => '展示图片',
                'format' => [
                    'image',
                    [
                        'width' => '100',
                        'height' => '100'
                    ]
                ],
                'value' => function ($model) {
                    return $model->img_url;
                }
            ],
            'name',
//            'param',
            'remark',
//            'seat_id',
            [
                'label' => '展示位置',
                'value' => function ($model) {
                    return Lookup::item('banner-seat', $model->seat_id);
                },
                'filter' => Html::activeDropDownList($searchModel, 'seat_id', ['' => '全部']+Lookup::items('banner-seat'))
            ],
//            'show_type',
            [
                'label' => '展现方式',
                'value' => function ($model) {
                    return Lookup::item('banner-show-type', $model->show_type);
                },
                'filter' => Html::activeDropDownList($searchModel, 'show_type', ['' => '全部']+Lookup::items('banner-show-type'))
            ],
            'sort',
            'create_time',
            // 'status',
            // 'type',


            // 'update_time',

            // 'content:ntext',


            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'options' => ['width' => '100px;'],
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<i class="fa fa-edit">查看</i>', $url, [
                            'title' => Yii::t('app', 'view'),
                            'class' => 'del btn btn-primary btn-xs',
                        ]);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<i class="fa fa-unlock-alt">更新</i>', $url, [
                            'title' => Yii::t('app', 'update'),
                            'class' => 'del btn btn-success btn-xs',
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<i class="fa fa-close">删除</i>', $url, [
                            'title' => Yii::t('app', 'delete'),
                            'class' => 'del btn btn-default btn-xs',
                            'data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                'method' => 'post',
                            ],
                        ]);
                    }
                ],
                /*'urlCreator' => function ($action, $model, $key, $index) {
                if ($action === 'view') {
                return ['view', 'id' => $model->id];
                } else if ($action === 'update') {
                return ['update', 'id' => $model->id];
                } else if ($action === 'delete') {
                return ['delete', 'id' => $model->id];
                }
                }*/
            ],


        ],
    ]); ?>
<?php Pjax::end(); ?>                </div>
            </div>
        </div>
    </div>
</div>
