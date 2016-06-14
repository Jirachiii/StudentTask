<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Items */

$this->title = '更新项目: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '项目', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="items-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'user'=>$user,
        'allusers'=>$allusers,
    ]) ?>

</div>
