<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\Book;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ChapterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '章节管理');
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
       // 'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table text-center'
        ],
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => '书籍名称',
                'attribute' => 'book_id',
                'contentOptions' => [
                    'style' => 'word-break: break-all; white-space: normal;',
                    'width' => '10%'
                ],
                'headerOptions' => [
                    'class' => 'text-center'
                ],
                'value' => function ($model) {
                    return Book::item($model->book_id);
                }
            ],

            [
                'label' => '章节顺序',
                'attribute' => 'num',
                'contentOptions' => [
                    'style' => 'word-break: break-all; white-space: normal;',
                    'width' => '10%'
                ],
                'headerOptions' => [
                    'class' => 'text-center'
                ]
            ],

            [
                'label' => '章节ID',
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
                'label' => '章节名称',
                'attribute' => 'name',
                'contentOptions' => [
                    'style' => 'word-break: break-all; white-space: normal;',
                    'width' => '15%'
                ],
                'headerOptions' => [
                    'class' => 'text-center'
                ]
            ],

            [
                'label' => '章节字数',
                'attribute' => 'words_num',
                'contentOptions' => [
                    'style' => 'word-break: break-all; white-space: normal;',
                    'width' => '10%'
                ],
                'headerOptions' => [
                    'class' => 'text-center'
                ]
            ],

            [
                'label' => '是否付费',
                'attribute' => 'is_free',
                'contentOptions' => [
                    'style' => 'word-break: break-all; white-space: normal;',
                    'width' => '10%'
                ],
                'headerOptions' => [
                    'class' => 'text-center'
                ],
                'value' => function ($model) {
                    if ($model->is_free == 1)
                        return '收费';
                    if ($model->is_free == 2)
                        return '免费';
                    return false;
                }
            ],

            [
                'label' => '收费金额',
                'attribute' => 'price',
                'contentOptions' => [
                    'style' => 'word-break: break-all; white-space: normal;',
                    'width' => '10%'
                ],
                'headerOptions' => [
                    'class' => 'text-center'
                ]
            ],

            [
                'label' => '创建时间',
                'attribute' => 'created',
                'contentOptions' => [
                    'style' => 'word-break: break-all; white-space: normal;',
                    'width' => '15%'
                ],
                'headerOptions' => [
                    'class' => 'text-center'
                ]
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'headerOptions' => [
                    'class' => 'text-center'
                ],
                'options' => ['width' => '100px;'],
                'template' => '{update}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<i class="fa fa-edit">查看</i>', $url, [
                            'title' => Yii::t('app', 'view'),
                            'class' => 'del btn btn-primary btn-xs',
                        ]);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<i class="fa fa-unlock-alt">编辑</i>', $url, [
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
