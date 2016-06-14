<?php
/* @var $this yii\web\View */
?>
<?php $this->registerCssFile('css/store_index.css');?>
<?php $this->registerJsFile('js/store_index.js');?>
<h1 id="h1title">物料管理员后台</h1>
<br>


<div class="row">
    <section id="store_admin" class="col-md-6">



<!--            <select name="status_sel" id="">-->
<!--                <option value="1">未审核</option>-->
<!--                <option value="2">审核通过</option>-->
<!--                <option value="3">审核不通过</option>-->
<!--            </select>-->

        <table class="table table-hover table-bordered " id="tab_l">
            <tr>
                <th hidden="hidden">id</th>
                <th>项目编号</th>
                <th>申请时间</th>
    <!--            <th>申请人</th>-->
                <th>项目内容</th>
                <th>申请内容</th>
                <th>申请人</th>
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
        <td><span class='glyphicon glyphicon-eye-open' onclick='showItemDetail({$one->item_id});'><span/></script></td>
        <td>{$one->apply_text}</td>
        <td>{$one->apply_user}</td>
        <td>{$one->apply_status}</td>
        <td><span class="glyphicon glyphicon-wrench"><span></td>
    </tr>
EOF;
                echo $content;

                }
                ?>
        </table>
    </section>
    <form class="form-inline" id="form_tab">
        <input type="text" class="form-control" id="store_search">
        <input type="button" value="搜索" class="btn btn-primary btn-sm" onclick="getStores()">
        <input type="button" value="添加新物料" class="btn btn-info btn-sm" id="addNewStore">
        <input type="button" value="显示所有库存" id="" class="btn btn-success btn-sm"onclick="getAllStores()">
        <input type="button" value="显示操作记录" id="showRecord" class="btn btn-sm" onclick="getRecords()">
    </form>

    <section id="left_div" class="col-md-6">
        <div id="store_tab">

        </div>
    </section>

</div>
<!--更改审核状态隐藏菜单块-->
<div id="status_op" class="status_op" hidden="hidden">
    <span hidden="hidden" id="req_id"></span>
    <p class="op_name">更改审核状态</p><span class="glyphicon glyphicon-remove pull-right"></span>

    <select name="" id="status_change" class="form-control">
        <option value="审核通过">审核通过</option>
        <option value="审核不通过">审核不通过</option>
    </select>
    <br>
    <p id="msg_show"></p>
    <br>
    <input type="button" onclick="req_submit()" class="btn btn-success btn-sm" value="确定" >
</div>
<!--添加新物料隐藏设置块-->
<div id="store_op_add" class="status_op" hidden="hidden">
    <p class="op_name">添加新物料</p>
    <span class="glyphicon glyphicon-remove pull-right"></span>
    <span>名称：</span>
    <input type="text" id="store_add_name" class="form-control">
    <br>
    <span>数量：</span>
    <input type="number" id="store_add_num" class="form-control">

    <p id="msg_store_add"></p>

    <input type="button" onclick="store_add_submit()" class="btn btn-success btn-sm" value="确定" >
</div>
<!--物料数量更改隐藏快-->
<div id="store_op_PM" class="status_op" hidden="hidden">
    <span hidden="hidden" id="change_type"></span>
    <span hidden="hidden" id="change_id"></span>
    <p class="op_name">物料数量更改</p><span class="glyphicon glyphicon-remove pull-right"></span>

    <span id="text_til"></span>
    <input type="number" id="store_PM_num" class="form-control">
    <br>
    <p id="msg_store_PM"></p>

    <input type="button" onclick="store_PM_submit()" class="btn btn-success btn-sm" value="确定" >
</div>
<!--项目详情隐藏块-->
<section id="back_click_hide" onclick="hideDetail()">

</section>
<section id="item_detail_hidden">
    <span class="pull-right glyphicon glyphicon-remove" onclick="hideDetail()"></span>
    <p>项目内容</p>
    <div id="item_content">

    </div>
    <h4>项目任务表</h4>
    <div>
        <table  id="item_detail_content" class="table table-hover table-striped">

        </table>
    </div>
    <h4>物料申请记录</h4>
    <div>
        <table  id="item_store_req" class="table table-hover table-striped">

        </table>
    </div>
    <p id="msg_show"></p>
</section>
