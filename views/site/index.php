<?php
use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
$itemstatus=['未完成'=>'未完成','已完成'=>'已完成','负责人申请完成'=>'负责人申请完成'];

?>
<?php $this->registerCssFile('css/site_index.css');?>

<div class="site-index">

    <div class="jumbotron">
        <h1>学生工作站管理系统</h1>
        <h3>项目浏览</h3>
    </div>

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

            ['class' => 'yii\grid\ActionColumn','template' => '{view}'],
        ],
    ]); ?>
</div>
