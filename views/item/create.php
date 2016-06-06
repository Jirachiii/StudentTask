<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Items */

$this->title = '发布新项目';
$this->params['breadcrumbs'][] = ['label' => '项目', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="items-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'user'=>$user,
        'allusers'=>$allusers,
    ]) ?>

</div>
