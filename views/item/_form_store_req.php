<div id="store">
    <table border="1">
        <tr>
            <th>申请时间</th>
            <th>申请内容</th>
            <th>状态</th>
        </tr>
        <?php
        if(!empty($allstore_req)){
            foreach($allstore_req as $store_req){
                echo <<<EOF
<tr>
    <td>{$store_req->apply_time}</td>
    <td>{$store_req->apply_text}</td>
    <td>{$store_req->apply_status}</td>
</tr>
EOF;
            }


        }
        ?>
    </table>
</div>
