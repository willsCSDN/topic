<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use common\models\BookAgent;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '分销书库');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">

    <h1><?= Html::encode($this->title) ?></h1>
                    <div class="col-md-12">
                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!--                        <div class="col-md-1" style="padding-top: 18px">-->
<!--                            <?//= Html::a(Yii::t('app', '新增书籍'), ['create'], ['class' => 'btn btn-success btn-sm']) ?>-->
<!--                        </div>-->
                    </div>

                    <div>
                        <p>
                            <?= Html::a('上架', 'javascript:void(0);', ['class' => 'btn btn-info btn-sm btn-grid-up']) ?>
                            <?= Html::a('下架', 'javascript:void(0);', ['class' => 'btn btn-default btn-sm btn-grid-down']) ?>
                            <?= Html::a('删除', 'javascript:void(0);', ['class' => 'btn btn-default btn-sm btn-grid-delete']) ?>
                        </p>
                    </div>

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'id' => 'grid',
        'dataProvider' => $dataProvider,
        'tableOptions'=> [
            'class' => 'table text-center',
        ],
        //'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
                'headerOptions' => [
                    'class' => 'text-center'
                ],
            ],
//            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => '书籍封面',
                'contentOptions' => [
                    'style' => 'word-break: break-all; white-space: normal;',
                    'width' => '10%'
                ],
                'headerOptions' => [
                    'class' => 'text-center'
                ],
                'format' => [
                    'image',
                    [
                        'width' => '100',
                        'height' => '100'
                    ]
                ],
                'value' => function ($model) {
                    return $model->cover;
                }
            ],

            [
                'label' => '书籍ID',
                'attribute' => 'id',
                'contentOptions' => [
                    'style' => 'word-break: break-all; white-space: normal;',
                    'width' => '10%'
                ],
                'headerOptions' => [
                    'class' => 'text-center'
                ]
            ],

            [
                'label' => '书籍名称',
                'attribute' => 'name',
                'contentOptions' => [
                    'style' => 'word-break: break-all; white-space: normal:',
                    'width' => '10%'
                ],
                'headerOptions' => [
                    'class' => 'text-center'
                ]
            ],

            [
                'label' => '作者',
                'attribute' => 'author',
                'contentOptions' => [
                    'style' => 'word-break: break-all: white-space: normal:',
                    'width' => '10%'
                ],
                'headerOptions' => [
                    'class' => 'text-center'
                ]
            ],

            [
                'label' => '完结状态',
                'attribute' => 'status',
                'contentOptions' => [
                    'style' => 'word-break:break-all; white-space: normal:',
                    'width' => '10%'
                ],
                'headerOptions' => [
                    'class' => 'text-center'
                ],
                'value' => function ($model) {
                    if ($model->status == 1)
                        return '完结';
                    if ($model->status == 2)
                        return '连载';
                    return false;
                }
            ],

            [
                'label' => '书籍字数',
                'attribute' => 'words_num',
                'contentOptions' => [
                    'style' => 'words-break:break-all; white-space: normal;',
                    'width' => '10%'
                ],
                'headerOptions' => [
                    'class' => 'text-center'
                ]
            ],

            [
                'label' => '销售模式',
                'attribute' => 'sale_model',
                'contentOptions' => [
                    'style' => 'words-break:break-all; white-space: normal;',
                    'width' => '10%'
                ],
                'headerOptions' => [
                    'class' => 'text-center'
                ],
                'value' => function ($model) {
                    if($model->sale_model == 1)
                        return '按章购买';
                    if($model->sale_model == 2)
                        return '整本购买';
                    return false;
                }
            ],

            [
                'label' => '入库时间',
                'attribute' => 'created',
                'contentOptions' => [
                    'style' => 'words-break;break-all; white-space: normal;',
                    'width' => '10%'
                ],
                'headerOptions' => [
                    'class' => 'text-center'
                ],
                'value' => function ($model) {
                    return BookAgent::getCreated($model->id);
                }
            ],

//            [
//                'label' => '是否加入分销库',
//                'attribute' => 'is_agent',
//                'contentOptions' => [
//                    'style' => 'words-break:break-all; white-space: normal;',
//                    'width' => '10%'
//                ],
//                'headerOptions' => [
//                    'class' => 'text-center'
//                ],
//                'value' => function ($model) {
//                    if ($model->is_agent == 0)
//                        return '否';
//                    if ($model->is_agent == 1)
//                        return '是';
//                    return false;
//                }
//            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'headerOptions' => [
                    'class' => 'text-center'
                ],
                'options' => ['width' => '100px;'],
                'template' => '{update} {update-chapter}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<i class="fa fa-edit">查看</i>', $url, [
                            'title' => Yii::t('app', 'view'),
                            'class' => 'del btn btn-primary btn-xs',
                        ]);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<i class="fa fa-pencil-square-o">书籍编辑</i>', $url, [
                            'title' => Yii::t('app', 'update'),
                            'class' => 'del btn btn-success btn-xs',
                        ]);
                    },

                    'update-chapter' => function ($url, $model) {
                        return Html::a('<i class="fa fa-pencil-square-o">章节编辑</i>', $url, [
                            'title' => Yii::t('app', 'update-chapter'),
                            'class' => 'del btn btn-info btn-xs',
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
<?php
$requestUrl = Url::toRoute('shelve-up');
$requestUrl2 = Url::toRoute('shelve-down');
$requestUrl3 = Url::toRoute('shelve-delete');
$js = <<<JS
    $(document).on('click','.btn-grid-up', function () {
        //注意这里的$("#grid")，要跟我们第一步设定的options id一致
        var keys = $("#grid").yiiGridView("getSelectedRows");
        console.log(keys);
        $.post('{$requestUrl}', {ids:keys},
            function (data) {
                alert(data);
                location.reload();
            }
        );
    });
   $(document).on('click','.btn-grid-dowm', function (){
        //注意这里的$("#grid")，要跟我们第一步设定的options id一致
        var keys = $("#grid").yiiGridView("getSelectedRows");
        console.log(keys);
        $.post('{$requestUrl2}', {ids:keys},
            function (data) {
                alert(data);
                location.reload();
            }
    );
    $(document).on('click','.btn-grid-delete', function (){
        //注意这里的$("#grid")，要跟我们第一步设定的options id一致
        var keys = $("#grid").yiiGridView("getSelectedRows");
        console.log(keys);
        $.post('{$requestUrl3}', {ids:keys},
            function (data) {
                alert(data);
                location.reload();
            }
    );
});
JS;

$this->registerJs($js);
?>
