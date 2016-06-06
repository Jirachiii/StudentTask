<?php
/* @var $this yii\web\View */
?>
<?php $this->registerCssFile('css/store_index.css');?>

<section id="store_admin">
    <select name="status_sel" id="">
        <option value="1">未审核</option>
        <option value="2">审核通过</option>
        <option value="3">审核不通过</option>
    </select>
    <table border="1">
        <tr>
            项目编号
            <th>申请时间</th>
<!--            <th>申请人</th>-->
            <th>项目内容</th>
            <th>申请内容</th>
            <th>审批状态</th>
            <th>操作</th>
        </tr>
            <?php
            foreach($stores as $one){
                $content=<<<EOF
<tr>
    <td>{$one->item_id}</td>
    <td>{$one->apply_time}</td>
    <td><a class='glyphicon glyphicon-eye-open mycursor' onclick='javascript:alert("以后写：ajax从中间弹出");'><a/></script></td>
    <td>{$one->apply_text}</td>
    <td>{$one->apply_status}</td>
    <td><span class="glyphicon glyphicon-wrench mycursor"><span></td>
</tr>
EOF;
            echo $content;

            }
            ?>
    </table>
</section>