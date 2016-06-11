<?php
use app\models\ItemUsers;
?>
<?php $this->registerCssFile('css/item_detail.css');?>
<h1 class="I_D_title">我负责的项目</h1>
<section>
    <table class="tab_item_detail tab_center" border="1">
        <tr>
            <th>项目名称</th>
            <th>发布日期</th>
            <th>项目发布者</th>
            <th>项目负责人</th>
            <th>项目状态</th>
            <th>项目管理</th>
        </tr>
        <?php
            foreach($items as $item){
                $info=$item->iteminfo[0];
                $itemusers=new ItemUsers();
                $create_by_CN=$itemusers->getChineseName($info['create_by']);
                $st_admins=$itemusers->getStudentAdmins($info['id']);
               echo <<<EOF
               <tr>
                    <td>{$info['title']}</td>
                    <td>{$info['create_at']}</td>
                    <td>{$create_by_CN['st_name']}</td>
                    <td>{$st_admins}</td>
                    <td>{$info['status']}</td>
                    <td>
                        <a href='index.php?r=item/detailtask&item_id={$info['id']}' class='glyphicon glyphicon-pencil myedit'></a>
                        <span class='glyphicon glyphicon-eye-open myedit' onclick='showItemDetail({$info['id']})'></span>
                        <span class='glyphicon glyphicon glyphicon-ok-sign myedit' onclick='statusChange({$info['id']})'></span>
                        <span class='glyphicon glyphicon glyphicon-remove-sign myedit' onclick='statusChangeback({$info['id']})'></span>
                    </td>
                </tr>
EOF;
                $itemusers=null;
            }
        ?>
    </table>
</section>
<section id="back_click_hide" onclick="hideDetail()">

</section>
<section id="item_detail_hidden">
    <span class="pull-right glyphicon glyphicon-remove"></span>
    <p>项目内容</p>
    <div id="item_content">

    </div>
    <p>项目任务表</p>
    <div>
        <table  id="item_detail_content" border="1">

        </table>
    </div>
    <p>物料申请记录</p>
    <div>
        <table  id="item_store_req" border="1">

        </table>
    </div>
    <p id="msg_show"></p>
</section>
<?php $this->registerJsFile('js/item_detail.js');?>
