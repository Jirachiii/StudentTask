<?php
//此php标签内的代码为update用
if($alreadyNum>0){
    $tasks=array();
    $members=array();
    foreach($detailTask as $onetask){
        array_push($tasks,$onetask['task_content']);
        $onemembers=explode(',',$onetask['members']);
        array_push($members,$onemembers);
    }
    $insert=<<<EOF
<div><br><br>
<label>任务详情<span class="glyphicon glyphicon-remove mycursor"></span></label>
<input  type="text"  name="task[]" class="form-control">
<br><label>选择成员</label>
<select name="member[1][]" type="text" class="form-control"  multiple="multiple">
{$memberOption}
</select><br><br></div>
EOF;
    for($i=0;$i<$alreadyNum-1;$i++){
        echo $insert;
    }
    foreach($tasks as $key=>$task){
        echo "<script>
                        $(\"label:contains('任务'):eq($key)\").next('input').val({$task})
</script>";
    }
    foreach($members as $key=>$member){
        foreach($member as $one){
            echo "<script>
                        $(\"label:contains('成员'):eq({$key})\").next('select').find(\"option[value={$one}]\").attr(\"selected\",true);
</script>";
        }

    }
}

?>