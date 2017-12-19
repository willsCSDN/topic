<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Alert;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '部门设置';
$this->params['breadcrumbs'][] = $this->title;
//var_dump($tree);
?>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <h1><?= Html::encode($this->title) ?></h1>
                    <div class="row">
                        <div class="col-sm-1 pull-right">
                            <a class="btn btn-info btn-sm" href="<?= Url::toRoute('department/create')?>">新增部门</a>
                        </div>
                    </div>
                    <hr />
                    <div class="col-sm-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-content">
                                <?php
                                if( Yii::$app->getSession()->hasFlash('success') ) {
                                    echo Alert::widget([
                                        'options' => [
                                            'class' => 'alert alert-success',
                                        ],
                                        'body' => Yii::$app->getSession()->getFlash('success'),
                                    ]);
                                }
                                ?>
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
                                <?php if($tree):?>
                                    <div id="tree" class="treeview">
                                        <ul class="list-group">
                                            <?php foreach ($tree as $value):?>
                                                <li class="list-group-item">
                                                    <div class="col-sm-8 is_show  " style="line-height: 35px;">
                                                        <span class="icon glyphicon glyphicon-folder-close"></span>
                                                        <?=$value['name'] ?>
                                                    </div>
                                                    <div class="col-sm-4 right">
                                                        <a class="btn btn-primary btn-sm glyphicon glyphicon-plus" href="<?= Url::toRoute(['create','fid'=>$value['id']])?>">新增子部门</a>
                                                        <?= Html::a('修改', ['update', 'id' => $value['id']], ['class' => 'btn btn-info btn-sm glyphicon glyphicon-pencil']) ?>
                                                        <?= Html::a('删除', ['delete', 'id' => $value['id']], [
                                                            'class' => 'btn btn-danger btn-sm glyphicon glyphicon-trash',
                                                            'data' => [
                                                                'confirm' => '确定删除此条记录？',
                                                                'method' => 'post',
                                                            ],
                                                        ]) ?>
                                                    </div>
                                                    <div style="clear: both"></div>
                                                    <?php if(isset($value['son'])):?>
                                                        <ul class="list-group-item" style="display:none">
                                                            <?php foreach ($value['son'] as $v):?>
                                                                <li class="list-group-item" data-nodeid="0" style="">
                                                    <span class="icon glyphicon ">
                                                        <i class="glyphicon glyphicon-folder-close"></i>
                                                    </span>
                                                                    <?=$v['name']?>
                                                                    <div class="col-sm-3 pull-right">
                                                                        <?= Html::a('修改', ['update', 'id' => $v['id']], ['class' => 'btn btn-info btn-sm glyphicon glyphicon-pencil']) ?>
                                                                        <?= Html::a('删除', ['delete', 'id' => $v['id']], [
                                                                            'class' => 'btn btn-danger btn-sm glyphicon glyphicon-trash',
                                                                            'data' => [
                                                                                'confirm' => '确定删除此条记录？',
                                                                                'method' => 'post',
                                                                            ],
                                                                        ]) ?>
                                                                    </div>
                                                                    <div style="clear: both"></div>
                                                                </li>
                                                            <?php endforeach;?>
                                                        </ul>
                                                    <?php endif;?>
                                                </li>
                                            <?php endforeach;?>
                                        </ul>
                                    </div>
                                <?php else: ?>
                                    暂无部门！
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                    <div style="clear: both"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $("#tree ul li .is_show").click(function () {
            if(!$(this).siblings(".list-group-item").length >0){
                alert('该部门下无子部门!');
                return false ;
            };
            if($(this).children('.icon').hasClass('glyphicon-folder-close')) {
                $(this).children('.icon').removeClass('glyphicon-folder-close');
                $(this).children('.icon').addClass('glyphicon-folder-open');

            }else {
                $(this).children('.icon').removeClass('glyphicon-folder-open');
                $(this).children('.icon').addClass('glyphicon-folder-close');

            }
            $(this).siblings(".list-group-item").toggle();
            $(this).siblings(".right").toggle();
        });
    })
</script>
<?php $this->registerCssFile('@web/assets/890e9ef2/yii.js');?>




