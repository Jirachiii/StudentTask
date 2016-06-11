<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '项目管理';
$this->params['breadcrumbs'][] = $this->title;
$itemstatus=['未完成'=>'未完成','已完成'=>'已完成','负责人申请完成'=>'负责人申请完成'];
?>
<div class="items-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建项目', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'title',
//            'content:ntext',
//            'file_path',
            'create_at',
            // 'update_at',
            // 'create_by',
            // 'update_by',
            [
                'attribute' => 'status',
                'filter' => Html::activeDropDownList($searchModel,'status',$itemstatus,['class'=>'form-control','prompt' =>'显示全部']),
            ],

//            'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
