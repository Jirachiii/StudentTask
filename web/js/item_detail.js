$(function () {
    $(".glyphicon-remove").bind('click',function(){
        $("#back_click_hide").fadeOut()
        $("#item_detail_hidden").fadeOut(300)
    })
})

function hideDetail(){
    $("#item_detail_content").html('')
    $("#back_click_hide").fadeOut()
    $("#item_detail_hidden").fadeOut(300)
}

/**
 * 点击显示项目详情
 * @param itemid
 */
function showItemDetail(itemid){
    $.ajax({
        url: 'index.php?r=item/itemdetailview',
        type: 'GET',
        dataType: 'json',
        data: {id: itemid,
        },
    })
        .done(function(data) {
            if(data.success==true){
                var content='<tr><th>任务内容</th><th>任务成员</th></tr>';
                for(var i=0;i<data.details.length;i++){
                    content+="<tr><td>"+data.details[i]['task_content']+"</td><td>"+data.details[i]['members']+"</td></tr>"
                }
                var content2='<tr><th>申请时间</th><th>申请内容</th><th>申请人容</th><th>申请状态</th></tr>';
                for(var i=0;i<data.store.length;i++){
                    content2+="<tr><td>"+data.store[i]['apply_time']+"</td><td>"+data.store[i]['apply_text']+"</td>" +
                        "<td>"+data.store[i]['apply_user']+"</td><td>"+data.store[i]['apply_status']+"</td></tr>"
                }
                $("#item_content").html(data.item['content'])
                $("#item_store_req").html(content2)
                item_store_req
                //$("#msg_show").html('success')
            }else{
                $("#msg_show").html(data.msg)
            }
        })
        .fail(function() {
            console.log("error");
        })
    $("#back_click_hide").fadeIn()
    $("#item_detail_hidden").fadeIn()
}
/**
 * 申请项目完成
 * @param id
 */
function statusChange(itemid){
    var confirmAlert=confirm('是否申请完成了项目');
    if(confirmAlert==true){
        $.ajax({
            url: 'index.php?r=item/changestatus',
            type: 'POST',
            dataType: 'json',
            data: {id: itemid,
            },
        })
            .done(function(data) {
                if(data.success==true){
                    alert(data.msg);
                    window.location.reload();
                }else{
                    alert(data.msg)
                }
            })
            .fail(function() {
                console.log("error");
            })
    }
}
/**
 * 重置为未完成
 * @param itemid
 */
function statusChangeback(itemid){
    var confirmAlert=confirm('将状态重置为未完成');
    if(confirmAlert==true){
        $.ajax({
            url: 'index.php?r=item/changestatusback',
            type: 'POST',
            dataType: 'json',
            data: {id: itemid,
            },
        })
            .done(function(data) {
                if(data.success==true){
                    alert(data.msg);
                    window.location.reload();
                }else{
                    alert(data.msg)
                }
            })
            .fail(function() {
                console.log("error");
            })
    }
}