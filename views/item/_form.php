<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model app\models\Items */
/* @var $form yii\widgets\ActiveForm */
$status_change=array('未完成'=>'未完成','已完成'=>'已完成');
?>

<div class="items-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->widget(\yii\redactor\widgets\Redactor::className(), [
        'clientOptions' => [
            'imageManagerJson' => ['/redactor/upload/image-json'],
            'imageUpload' => ['/redactor/upload/image'],
            'fileUpload' => ['/redactor/upload/file'],
            'lang' => 'zh_cn',
            'plugins' => ['clips', 'fontcolor','imagemanager']
        ]
    ])?>
    <?php $member=ArrayHelper::map($allusers, 'st_id', 'st_name') ?>

    <?= $form->field($user, 'st_id')->dropDownList($member,['multiple'=>'multiple'])->label('此任务负责人') ?>
    <?= $model->isNewRecord ? null:$form->field($model, 'status')->dropDownList($status_change); ?>




    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '确定创建' : '确定更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>

    $(function(){
        detail=$(".form-group:last").prev().prev().clone();
        person=$(".form-group:last").prev().clone();
        $("[multiple]").select2({
            placeholder:'请选择参与者'
        })
    })

</script>
