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
    <div id="authorInfo">
    <?php
//    if(isset($creater)){
        echo '<div class="author_L">
        <span class="glyphicon glyphicon-user" style="color: cornflowerblue"></span>
        <label class="user-font" >'.$creater->st_name.'&nbsp;&nbsp;<span style="color: darkgrey">发布于</span>&nbsp;&nbsp;</label>
        <span class="glyphicon glyphicon-time" style="color: cornflowerblue"></span>
        <span class="time-font">'.$model->create_at.'&nbsp;&nbsp;&nbsp;</span></div>';

//    }else{
//        echo '<label class="">'.$model->create_by.'&nbsp;</label><span>发布于:'.$model->create_at.'&nbsp;&nbsp;&nbsp;</span>';
//    }
    if(isset($updater)){
        echo '<div class="author_R "><span class="glyphicon glyphicon-user" style="color: darkgrey"></span>
               <label class="user-font">'.$updater->st_name.'&nbsp;&nbsp;</label>';
        echo '<span style="color: darkgray">更新于&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</spanst><span class="glyphicon glyphicon-time">  </span>
<span class="time-font">'.$model->update_at.'</span></div>';
    }else{
        if(!empty($model->update_by)){
            echo '<div class="author_R"><span class="glyphicon glyphicon-user" style="color: darkgrey"><label class="user-font">'.$model->update_by.'</label><span>更新于&nbsp;&nbsp;</span>
            <span class="glyphicon glyphicon-time "></span><span class="time-font">'.$model->update_at.'</span></div>';
        }
    }
    echo '<br>';

    ?>

    <div class="content_div">
        <div class="post-inner">
            <div class="post-deco">
                <div class="hex hex-small">
                    <div class="hex-inner">
                        <i class="glyphicon glyphicon-folder-open"></i>
                    </div>
                    <div class="corner-1"></div>
                    <div class="corner-2"></div>
                </div>
            </div>
        </div>
        <div class="content_word">
            <?=  $model->content?>

        </div>
    </div>
    </div>
    <hr class="hr_bom">
    <hr class="hr_center">
    <br>
    <div class="item_mems">
       <p id="mem_til">项目负责人</p>

        <?php
        foreach ($members as $key => $value) {
            echo '<span class="glyphicon glyphicon-bookmark">&nbsp;</span><span class="name">'.$value.'</span><br>';
        }
        echo '<br>';
        ?>
    </div>
    <br>
    <div class="item_status">
        <p>
            状态:
        </p>
        <br>
        <p class="status_item">
            <?php echo $model->status ?>
        </p>


        <p>
            <?= (Yii::$app->user->identity->status=='管理员')? Html::a('删除', [(Yii::$app->controller->id=='item')?'delete':'item/delete', 'id' => $model->id], [
                'class' => 'btn btn-danger pull-right',
                'data' => [
                    'confirm' => '你确定要删除这个项目吗?',
                    'method' => 'post',
                ],
            ]):null ?>
            <?= (Yii::$app->user->identity->status=='管理员')? Html::a('更新', [(Yii::$app->controller->id=='item')?'update':'item/update', 'id' => $model->id], ['class' => 'btn btn-primary pull-right']):null ?>

        </p>
    </div>

</div>
<?php $this->registerCssFile('css/item_view.css');?>
