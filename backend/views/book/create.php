<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Category;
/* @var $this yii\web\View */
/* @var $model common\models\Book */

$this->title = Yii::t('app', '新增书籍');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Books'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?=Html::cssFile('@web/css/plugins/iCheck/custom.css')?>
<?=Html::cssFile('@web/css/plugins/steps/jquery.steps.css')?>
<?=Html::cssFile('@web/css/animate.min.css')?>

<style>
    .wizard > .content {
        min-height: 390px;
    }

    .wizard > .content > .body {
        float: left;
        position: relative !important;
        width: 95%;
        height: 95%;
        padding: 2.5%;
    }
</style>

<div class="wrapper wrapper-content">

    <div class="ibox-content">
        <h2>
            新增书籍
        </h2>
        <p>
            <?php $form = ActiveForm::begin(['id'=>'form']); ?>
        <h1>选择类型</h1>
        <fieldset>
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <label class="col-sm-12 control-label">目标读者：</label>

                        <div class="col-sm-6">
                            <label class="radio-inline">
                                <input type="radio" checked="" value="2" id="optionsRadios1" name="type">女生</label>
                            <p>以女性视角或女性受众为主的作品，古言/现言/玄幻/青春/悬疑/科幻/仙侠/游戏/N次元等所有女生题材</p>
                        </div>
                        <div class="col-sm-6">
                            <label class="radio-inline">
                                <input type="radio" value="1" id="optionsRadios2" name="type">男生</label>
                            <p>以男性视角或男性受众为主的作品，玄幻/奇幻/历史/都市/灵异/仙侠/游戏/二次元/武侠/军事等所有男生题材</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="text-center">
                        <div style="margin-top: 20px">
                            <i class="fa fa-sign-in" style="font-size: 180px;color: #e5e5e5 "></i>
                        </div>
                    </div>
                </div>
            </div>

        </fieldset>
        <h1>完善作品信息</h1>
        <fieldset>
            <div class="row">
                    <div class="form-group">

                        <div class="col-sm-12">
                            <div class="col-md-1">
                            </div>
                            <div class="col-sm-1" style="padding: 9px 9px">
                                <p style="font-weight:bold;">书籍名称</p>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($model,'name')->label(false)->textInput(['class'=>'form-control required',])?>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="col-md-1">
                            </div>
                            <div class="col-sm-1" style="padding: 9px 9px">
                                <p style="font-weight:bold;">书籍作者</p>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($model,'author')->label(false)->textInput(['class'=>'form-control required',])?>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="col-md-1">
                            </div>
                            <div class="col-sm-1" style="padding: 9px 9px">
                                <p style="font-weight:bold;">书籍分类</p>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($model,'category')->label(false)->dropDownList(Category::items(1))?>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="col-md-1">
                            </div>
                            <div class="col-sm-1" style="padding: 9px 9px">
                                <p style="font-weight:bold;">书籍封面</p>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($model,'cover')->label(false)->textInput(['class'=>'form-control required',])?>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="col-md-1">
                            </div>
                            <div class="col-sm-1" style="padding: 9px 9px">
                                <p style="font-weight:bold;">书籍简介</p>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($model,'desc')->label(false)->textarea(['class'=>'form-control required',])?>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="col-md-1">
                            </div>
                            <div class="col-sm-1" style="padding: 9px 9px">
                                <p style="font-weight:bold;">销售模式</p>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($model,'sale_model')->label(false)->dropDownList(['1' => '按章收费', '2' => '整本收费'])?>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="col-md-1">
                            </div>
                            <div class="col-sm-1" style="padding: 9px 9px">
                                <p style="font-weight:bold;">书籍状态</p>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($model,'status')->label(false)->dropDownList(['1' => '完结', '2' => '连载'])?>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="col-md-1">
                            </div>
                            <div class="col-sm-1" style="padding: 9px 9px">
                                <p style="font-weight:bold;">章节总数</p>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($model,'chapter_num')->label(false)->textInput(['class'=>'form-control required',])?>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="col-md-1">
                            </div>
                            <div class="col-sm-1" style="padding: 9px 9px">
                                <p style="font-weight:bold;">最新章节总数</p>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($model,'chapter_name')->label(false)->textInput(['class'=>'form-control required',])?>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="col-md-1">
                            </div>
                            <div class="col-sm-1" style="padding: 9px 9px">
                                <p style="font-weight:bold;">目前文字总数</p>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($model,'words_num')->label(false)->textInput(['class'=>'form-control required',])?>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="col-md-1">
                            </div>
                            <div class="col-sm-1" style="padding: 9px 9px">
                                <p style="font-weight:bold;">书籍价格</p>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($model,'price')->label(false)->textInput(['class'=>'form-control required',])?>
                            </div>
                        </div>
                    </div>

            </div>

        </fieldset>

        <h1>创建成功</h1>
        <fieldset>
            <div class="row">
                <div class="col-sm-8">

                </div>
                <div class="col-sm-4">
                    <div class="text-center">
                        <div style="margin-top: 20px">
                            <i class="fa fa-sign-in" style="font-size: 180px;color: #e5e5e5 "></i>
                        </div>
                    </div>
                </div>
            </div>

        </fieldset>

        <?php ActiveForm::end(); ?>

    </div>

</div>
<?=Html::jsFile('@web/js/content.min.js')?>
<?=Html::jsFile('@web/js/plugins/staps/jquery.steps.min.js')?>
<?=Html::jsFile('@web/js/plugins/validate/jquery.validate.min.js')?>
<?=Html::jsFile('@web/js/plugins/validate/messages_zh.min.js')?>
<script>

    $(function(){

        function is_mobile(value){
            return /^(((13[0-9]{1})|(15[0-9]{1})|(17[0]{1})|(18[0-9]{1}))+\d{8})$/.test( value );
        }


        $(document).on('blur','#master_phone',function(){       //机构负责人手机号
//            console.log($('#master_phone').val());
            if($('#master_phone').val() == ''){
                alert('手机号不能为空= =');
                return false;
            }else if(!is_mobile($('#master_phone').val())) {
                alert('手机号不合法= =');
                $('#master_phone').val("");
//                $('#master_phone').focus();
                return false;
            }
        });

//        var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-]+)+$/g;
//        $(document).on('blur','#open_email',function(){       //对外联系邮箱 *
//            if($('#open_email').val() == ""){
//                return false;
//            }
//            if(!reg.test($('#open_email').val()))
//            {
//                alert("邮箱不合法,请重新输入！");
//                $('#open_email').val('');
////                $('#assistant_id').focus();
//                return  false;
//            }
//        });

        var reg = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/;
        $(document).on('blur','#assistant_id',function(){       //机构负责人手机号
            if(reg.test($('#assistant_id').val()) == '')
            {
                alert("身份证输入不合法,请重新输入！");
                $('#assistant_id').val("");
//                $('#assistant_id').focus();
                return  false;
            }
        });


        $(document).on('blur','#assistant_phone',function(){        //运营人手机号
            if($('#assistant_phone').val() == ''){
                alert('手机号不能为空= =');
                return false;
            }else if(!is_mobile($('#assistant_phone').val())) {
                alert('手机号不合法= =');
                $('#assistant_phone').val("");
//                $('#master_phone').focus();
                return false;
            }
//            if(!is_mobile($('#assistant_phone').val())) {
//                alert('手机号不合法= =');
//                $('#assistant_phone').val("");
////                $('#assistant_phone').focus();
//                return false;
//            }
        });



    });

</script>
<script>
    $(document).ready(function() {
//        $("#master_phone").blur(function(){
//            var str = $("#master_phone").val();
//            console.log(str);
//            console.log(5);
//            var reg = /^1[34578]\d{9}$/g;
//            if(!str.match(reg)){
//                alert('请输入有效的手机号');
//            }
//        });


        /*$(document).on('click','.actions li:first-child',function () {
         window.history.back(-1);
         console.log(1);
         });*/
        $("#form").steps({
            bodyTag: "fieldset",
            onStepChanging: function(event, currentIndex, newIndex) {
//                return true
                if (currentIndex > newIndex) {
                    return true
                }
                if (newIndex === 3 && Number($("#age").val()) < 18) {
                    return false
                }
                var form = $(this);
                if (currentIndex < newIndex) {
                    $(".body:eq(" + newIndex + ") label.error", form).remove();
                    $(".body:eq(" + newIndex + ") .error", form).removeClass("error")
                }
                form.validate().settings.ignore = ":disabled,:hidden";
                return form.valid()
            },
            onStepChanged: function(event, currentIndex, priorIndex) {
//                return true
                if (currentIndex === 2 && Number($("#age").val()) >= 18) {
                    $(this).steps("next")
                }
                /*if (currentIndex === 2 && priorIndex === 2) {
                 $(this).steps("previous")
                 }*/
                if (currentIndex === 3 && priorIndex === 3) {
                    $(this).steps("previous")
                }
            },
            onFinishing: function(event, currentIndex) {
                var form = $(this);
                form.validate().settings.ignore = ":disabled";
                return form.valid()
            },
            onFinished: function(event, currentIndex) {
                var form = $(this);
                form.submit()
            }
        }).validate({
            errorPlacement: function(error, element) {
                element.before(error)
            },
        })

        $(document).ready(function(){
            $('a[href=#cancel]').attr("href","#cancel").click(function(){
                window.location.href="/shop/art-shop/index";
            });

        });
    });
</script>
