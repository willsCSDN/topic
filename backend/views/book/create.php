<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

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
                        <label class="col-sm-3 control-label">目标读者：</label>
                        <div class="col-sm-9">
                            <label class="radio-inline">
                                <input type="radio" checked="" value="2" id="optionsRadios1" name="type">女生</label>
                            <p>以女性视角或女性受众为主的作品，古言/现言/玄幻/青春/悬疑/科幻/仙侠/游戏/N次元等所有女生题材</p>
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
                <div class="col-sm-8">
                    <div class="form-group">
                        <?= $form->field($model,'chapter_num')->textInput(['class'=>'form-control required',])?>
                    </div>
                    <div class="form-group">
                        <?= $form->field($model,'chapter_name')->textInput(['class'=>'form-control required',])?>
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
