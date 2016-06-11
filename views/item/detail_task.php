<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

$member=ArrayHelper::map($allusers, 'st_id', 'st_name');
$memberOption='';
foreach ($member as $key=>$value ) {
    $memberOption.=<<<EOF
        <option value={$key}>{$value}<option>
EOF;
    isset($alreadyNum)?null:$alreadyNum=0;
    isset($detailTask)?null:$detailTask=array();
    isset($allstore_req)?null:$allstore_req='';

}

?>
<div id="hideOption" hidden="hidden"><?php echo $memberOption ?></div>
<section>
    <input type="button" class="btn btn-primary" value="添加新任务" onclick="addTask()">
    <?=
    $this->render('_form_store_req', [
        'allstore_req'=>$allstore_req
    ]);

    ?>
    <br>
    <br>
<!--    --><?php //$form = ActiveForm::begin(['id'=>'task_form','action'=>'index.php?r=item/taskinsert','method'=>'POST']); ?>
    <form action="index.php?r=item/taskinsert" id="task_form" method="post">
        <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
        <input type="text" name="item_id" hidden="hidden" value="<?php echo $item_id ?>">
        <label>物料申请</label>
        <input type="text" id="store_inp" name="store_req" class="form-control"><br><br><br>
        <div id="task_id">
            <label>任务详情</label>
            <input  type="text" name="task[]" class="form-control">
            <br>
            <label>选择成员</label>
            <select  type="text" name="member[0][]" class="form-control" multiple="multiple">
                <?php echo $memberOption ?>
            </select>
            <br>
        </div>
        <br>
<!--        update用-->

        <?=
            $this->render('_formDetailUpdate', [
                'alreadyNum' => $alreadyNum,
                'detailTask'=>$detailTask,
                'memberOption'=>$memberOption,
            ]);

        ?>

        <input type="submit" id="sub_btn" class="btn btn-success">
        <a href="index.php?r=item/itemdetail" class="btn btn-primary">返回</a>
    </form>
<!--    --><?php //ActiveForm::end(); ?>

</section>
<?php $this->registerJsFile('js/detail_task.js');?>
<?php $this->registerCssFile('css/detail_task.css');?>
<?php
?>
<script>
    $(function(){
        $("[multiple]").select2({
            placeholder:'请选择参与者'
        })
        changeNameNum()

        $("#sub_btn").bind("click",function(){
            var count=0
            $('select').each(function(){
                if($(this).val()==null)
                    count+=1;
//                    return false;
            })
            $("[name='task[]']").each(function(){
                if($(this).val()=='')
                count+=1;
//                return false;
            })
            console.log(count)
            if(count!=0){
                alert('请填写完整！');
                return false;
            }else{
                alert("安排成功！");
            }
        })
    })
</script>

