<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model app\models\Items */

$this->title = '发布项目';
$this->params['breadcrumbs'][] = ['label' => '项目', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= Html::cssFile('@web/css/mycss.css') ?>
<div class="items-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label('项目名称') ?>

    <?= $form->field($model, 'content')->widget(\yii\redactor\widgets\Redactor::className(), [
        'clientOptions' => [
            'imageManagerJson' => ['/redactor/upload/image-json'],
            'imageUpload' => ['/redactor/upload/image'],
            'fileUpload' => ['/redactor/upload/file'],
            'lang' => 'zh_cn',
            'plugins' => ['clips', 'fontcolor','imagemanager']
        ]
    ])?>
    <?= Html::button('增加新任务!', ['class' => 'btn-success btn','id'=>'create_detail']) ?>
    <br>
    <br>
    <?php $member=ArrayHelper::map($allusers, 'st_id', 'st_name') ?>
    <?= $form->field($detail, 'item_detail[]')->textInput(['maxlength' => true])->label('任务分配') ?>
    <?= $form->field($itemDetailPerson, 'st_id[0][]')->dropDownList($member,['multiple'=>'multiple'])->label('此任务成员') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '提交' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
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
<?= Html::jsFile('@web/js/myjs.js') ?>