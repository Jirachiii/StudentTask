<?php $this->registerCssFile('css/myitem.css');?>
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
                        <td><span class="glyphicon glyphicon-eye-open"></span></td>
                    </tr>
EOF;
                echo $content;

            }
        ?>
    </table>
</div>