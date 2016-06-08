<?php
/* @var $this yii\web\View */
?>
<?php $this->registerCssFile('css/store_index.css');?>
<?php $this->registerJsFile('js/store_index.js');?>
<!--更改审核状态隐藏菜单块-->
<div id="status_op" class="status_op" hidden="hidden">
    <span hidden="hidden" id="req_id"></span>
    <span>更改审核状态</span><span class="glyphicon glyphicon-remove"></span>
    <br><br>
    <select name="" id="status_change">
        <option value="审核通过">审核通过</option>
        <option value="审核不通过">审核不通过</option>
    </select>
    <br>
    <p id="msg_show"></p>
    <br>
    <input type="button" onclick="req_submit()" value="确定" >
</div>

<div class="row">
    <section id="store_admin" class="col-md-6">



            <select name="status_sel" id="">
                <option value="1">未审核</option>
                <option value="2">审核通过</option>
                <option value="3">审核不通过</option>
            </select>

        <table border="1">
            <tr>
                <th hidden="hidden">id</th>
                <th>项目编号</th>
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
        <td hidden="hidden">{$one->id}</td>
        <td>{$one->item_id}</td>
        <td>{$one->apply_time}</td>
        <td><a class='glyphicon glyphicon-eye-open' onclick='javascript:alert("以后写：ajax从中间弹出");'><a/></script></td>
        <td>{$one->apply_text}</td>
        <td>{$one->apply_status}</td>
        <td><span class="glyphicon glyphicon-wrench"><span></td>
    </tr>
EOF;
                echo $content;

                }
                ?>
        </table>
    </section>
    <input type="text" id="store_search">
    <input type="button" value="搜索">
    <input type="button" value="添加新物料" id="addNewStore">
    <input type="button" value="显示操作记录" id="showRecord">
    <section id="left_div" class="col-md-6">
        <dvi id="store_tab">

        </dvi>
    </section>

</div>
<!--添加新物料隐藏设置块-->
<div id="store_op_add" class="status_op" hidden="hidden">
    <span>添加新物料</span><span class="glyphicon glyphicon-remove"></span>
    <br><br>
    <input type="text" id="store_add_name">
    <input type="number" id="store_add_num">
    <br>
    <p id="msg_store_add"></p>
    <br>
    <input type="button" onclick="store_add_submit()" value="确定" >
</div>
<!--物料数量更改隐藏快-->
<div id="store_op_PM" class="status_op" hidden="hidden">
    <span hidden="hidden" id="change_type"></span>
    <span>物料数量更改</span><span class="glyphicon glyphicon-remove"></span>
    <br><br>
    <span id="text_til"></span>
    <input type="number" id="store_PM_num">
    <br>
    <p id="msg_store_PM"></p>
    <br>
    <input type="button" onclick="store_PM_submit()" value="确定" >
</div>
