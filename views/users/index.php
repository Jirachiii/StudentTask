<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '用户管理';
$this->params['breadcrumbs'][] = $this->title;
//$itemstatus=['未完成'=>'未完成','已完成'=>'已完成'];
$status=['管理员'=>'管理员','干部'=>'干部','物料管理员'=>'物料管理员','部员'=>'部员'];
?>
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建新用户', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'st_id',
            'st_name',
//            'password',
            // 'authKey',
            // 'accessToken',
            [
                'attribute' => 'status',
                'filter' => Html::activeDropDownList($searchModel, 'status',$status,['class'=>'form-control','prompt' => '显示全部']),
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
