<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '学生工作站管理系统',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    if(!Yii::$app->user->isGuest){
        if (Yii::$app->user->identity->status == '管理员') {
            $view="管理员后台";
            $url=array('/item/index');
        }elseif(Yii::$app->user->identity->status == '干部'){
            $view="项目负责人后台";
            $url=array('/item/itemdetail');
            $view1="我参与的项目";
            $url1=array('/item/myitem');
        }elseif(Yii::$app->user->identity->status == '物料管理员'){
            $view="物料管理员后台";
            $url=array('/store/index');
        } else{
            $view="我参与的项目";
            $url=array('/item/myitem');

        }
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => '首页', 'url' => ['/site/index']],
//            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (
                ['label' => '登陆', 'url' => ['/site/login']]
            ) : (
            [
                'label' => '用户 (' . Yii::$app->user->identity->st_name . ')',
                'items'=>[
                    ['label' => '注销', 'url' => ['/site/logout'],'linkOptions' => ['data-method' => 'post']],
                    ['label'=>$view, 'url'=>$url],
                    isset($view1)?['label'=>$view1, 'url'=>$url1]:'',
                ]
            ]
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; 学生工作站管理系统 <?= date('Y') ?></p>

<!--        <p class="pull-right">--><?//= Yii::powered() ?><!--</p>-->
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
