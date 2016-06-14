$(function(){
    $(".glyphicon-remove").bind("click",function(){
        hideDetail()
    })
})

function hideDetail(){
    $("#back_click_hide").fadeOut()
    $("#item_detail_hidden").fadeOut()
    $("#item_content").html('')
    $("#task_content").html('')
}

function showItem(id){
    $.ajax({
        url: 'index.php?r=item/myitemdetail',
        type: 'GET',
        dataType: 'json',
        data: {
            itemid: id,
        },
    })
        .done(function(data) {
            if(data.success==true){
                $("#item_content").html(data.item['content'])
                var tasks='<tr><th>任务详情</th><th>任务发布者</th></th><th>发布时间</th><th>成员</th></th></tr>'
                for(var i=0;i<data.details.length;i++){
                    tasks+='<tr><td>'+data.details[i]['task_content']+'</td><td>'+data.details[i]['create_by']+'</td>' +
                        '<td>'+data.details[i]['create_at']+'</td><td>'+data.details[i]['members']+'</td></tr>'
                }
                $("#task_content").html(tasks)
            }else{
                alert(data.msg)
            }
        })
        .fail(function() {
            console.log("error");
        })
    $("#back_click_hide").fadeIn()
    $("#item_detail_hidden").fadeIn()
}
