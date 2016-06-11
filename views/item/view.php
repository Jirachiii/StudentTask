<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Items */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="items-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    if(isset($creater)){
        echo '<label>'.$creater->st_name.'&nbsp;</label><span>发布于:'.$model->create_at.'&nbsp;&nbsp;&nbsp;</span>';

    }else{
        echo '<label>'.$model->create_by.'&nbsp;</label><span>发布于:'.$model->create_at.'&nbsp;&nbsp;&nbsp;</span>';
    }
    if(isset($updater)){
        echo '<span>最后由：</span><label>'.$updater->st_name.'</label>';
        echo '<span>在'.$model->update_at.'更新</span>';
    }else{
        if(!empty($model->update_by)){
            echo '<span>最后由：</span><label>'.$model->update_by.'</label><span>在'.$model->update_at.'更新</span>';
        }
    }
    ?>
    <hr style="border: 1.5px solid #9D9D9D">

    <?=  $model->content?>
    <hr style="border: 1.5px solid #9D9D9D">
    <label>任务成员:</label>
    <br>
    <?php
    foreach ($members as $key => $value) {
        echo $value.'&nbsp;';
    }
    echo '<br>';
    echo '状态：'.$model->status;
    ?>
    <br>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger pull-right',
            'data' => [
                'confirm' => '你确定要删除这个项目吗?',
                'method' => 'post',
            ],
        ]) ?>

    </p>
</div>
<?php $this->registerCssFile('css/item_view.css');?>
