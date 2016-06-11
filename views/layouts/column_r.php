<?php
use yii\helpers\Html;
?>

    <!-- 先引用main.php布局文件， -->
<?php $this->beginContent('@app/views/layouts/main.php');?>
<?php $this->registerCssFile('css/item_index.css');?>
<?= $content ?>
    <div class="right_column ">
        <ul class="list-group">
            <?= Html::a('主页', ['site/index'], ['class' => 'list-group-item']) ?>
            <?= Html::a('项目管理', ['item/index'], ['class' => 'list-group-item']) ?>
            <?= Html::a('用户管理', ['users/index'], ['class' => 'list-group-item']) ?>
        </ul>
    </div>
<?php $this->endContent();?>