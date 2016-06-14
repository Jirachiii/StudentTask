<?php $this->registerCssFile('css/myitem.css');?>
<?php $this->registerJsFile('js/myitem.js');?>
<div>
    <table class="myitem" border="1">
        <tr>
            <th>项目名称</th>
            <th>项目发布时间</th>
            <th>项目最后更改时间</th>
            <th>状态</th>
            <th>查看</th>
        </tr>
        <?php
            foreach($myitems as $myitem){
                $content=<<<EOF
                    <tr>
                        <td>{$myitem->title}</td>
                        <td>{$myitem->create_at}</td>
                        <td>{$myitem->update_at}</td>
                        <td>{$myitem->status}</td>
                        <td><span class="glyphicon glyphicon-eye-open" onclick="showItem({$myitem->id})"></span></td>
                    </tr>
EOF;
                echo $content;

            }
        ?>
    </table>
</div>
<section id="back_click_hide" onclick="hideDetail()">

</section>
<section id="item_detail_hidden">
    <span class="pull-right glyphicon glyphicon-remove"></span>
    <div id="item_content">

    </div>
    <p>我的任务：</p>
    <div id="">
        <table id="task_content" border="1">

        </table>
    </div>
</section>