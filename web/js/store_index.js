var MouseEvent = function(e){
    this.x = e.pageX
    this.y = e.pageY
}
var Mouse = function(e){
    var kdheight =  $(document).scrollTop();
    mouse = new MouseEvent(e);
    leftpos = mouse.x+15;
    toppos = mouse.y-kdheight+10;
}
$(function(){
    getStores()
    //更改审核的按钮
    $(".glyphicon-wrench").bind("click",function(e){
        Mouse(e);
        $("#msg_show").html("")
        $("#req_id").empty()
        $("#status_op").css({top:toppos,left:leftpos}).fadeIn(100);
        $("#req_id").html($(this).parent().parent().children('td:eq(0)').html());
    })
    //添加物料的按钮
    $("#addNewStore").bind("click",function(e){
        $("#msg_store_add").html("")
        $("#store_add_name").val('');
        $("#store_add_num").val('');
        Mouse(e);
        $("#store_op_add").css({top:toppos,left:leftpos}).fadeIn(100);
    });
    //关闭
    $(".glyphicon-remove").bind("click",function(e){
        $(this).parent().hide();
    })
    autoRowSpan(document.getElementById('tab_l'),1,1)

})

//状态修改提交
function req_submit(){
    $.ajax({
        url: 'index.php?r=store/reqstatus',
        type: 'POST',
        dataType: 'json',
        data: {id: $("#req_id").html(),
               status: $("#status_change").val()
        },
    })
        .done(function(data) {
            if(data.success==true){
                var id=$("#req_id").html()
                $("#status_change").val()
                $("tr").each(function(){
                    if($(this).children('td:eq(0)').html()==id){
                        $(this).children('td:eq(-2)').html(data.status);
                    }
                })
                $("#msg_show").html(data.msg)
            }else{
                $("#msg_show").html(data.msg)
            }
        })
        .fail(function() {
            console.log("error");
        })

}
//显示所有库存按钮
function getAllStores(){
    $("#store_search").val('')
    getStores()
}

//显示所有库存&&搜索库存
function getStores(){
    var tab=' <table class="table table-hover table-striped"> <tr><th hidden="hidden">货物id</th><th>操作信息</th><th>操作时间</th><th>操作类型</th></tr>';
    $.ajax({
        url: 'index.php?r=store/getstores',
        type: 'GET',
        dataType: 'json',
        data: {
            searchName:　$("#store_search").val(),
        }
    })
        .done(function(data) {
            if(data.success==true){
                for(var i=0;i<data.stores.length;i++){
                    tab+='<tr><td hidden="hidden">'+data.stores[i]['id']+'</td><td>'+data.stores[i]['store_name']+'</td><td>'+data.stores[i]['store_num']+'</td>' +
                        '<td><span class="glyphicon glyphicon-plus"></span><span class="glyphicon glyphicon-minus"></span>' +
                        '<span class="glyphicon glyphicon-trash" onclick="store_delete('+data.stores[i]["id"]+')"></span></td></tr>';
                }
                tab+='</table>';
                $("#store_tab").html(tab)
                bindBtn()
            }else{
                $("#store_tab").html(data.msg)
            }
        })

}

//显示所有操作记录
function getRecords(){
    var tab=' <table class="table table-hover table-striped" id="tb_Record"> <tr><th>货物（id）</th><th>详情</th><th>时间</th><th>操作</th></tr>';
    $.ajax({
        url: 'index.php?r=store/getrecords',
        type: 'GET',
        dataType: 'json',
    })
        .done(function(data) {
            if(data.success==true){
                for(var i=0;i<data.records.length;i++){
                    tab+='<tr><td>'+data.records[i]['store_id']+'</td><td>'+data.records[i]['changeinfo']+'</td><td>'+data.records[i]['change_time']+'</td>' +
                        '<td>'+data.records[i]['change_type']+'</td></tr>';
                }
                tab+='</table>';
                $("#store_tab").html(tab)
                bindBtn()
    autoRowSpan(document.getElementById('tb_Record'),0,0)
                
            }else{
                $("#store_tab").html(data.msg)
            }
        })

}
//添加新物料
function store_add_submit(){
    $.ajax({
        url: 'index.php?r=store/addstore',
        type: 'POST',
        dataType: 'json',
        data: {store_name: $("#store_add_name").val(),
               store_num:  Number($("#store_add_num").val()),
        },
    })
        .done(function(data) {
            if(data.success==true){
                getStores();
                $("#store_add_name").val('');
                $("#store_add_num").val('');
                $("#msg_store_add").html(data.msg)
            }else{
                $("#msg_store_add").html(data.msg)
            }
        })
        .fail(function() {
            console.log("error");
        })

}
/**
 * 物料数量更改
 * @param id
 */
function store_PM_submit(){
    $.ajax({
        url: 'index.php?r=store/changenum',
        type: 'POST',
        dataType: 'json',
        data: {change_id: $("#change_id").html(),
            change_num:  Number($("#store_PM_num").val()),
            changetype: $("#change_type").html()
        },
    })
        .done(function(data) {
            if(data.success==true){
                getStores();
                $("#store_PM_num").val('');
                $("#msg_store_PM").html(data.msg)
            }else{
                $("#msg_store_PM").html(data.msg)
            }
        })
        .fail(function() {
            console.log("error");
        })
}

/**
 * 删除库存
 * @param id
 */
function store_delete(id){
    var isdel=confirm("您确定要删除该库存吗");
    if(isdel==true){
        $.ajax({
            url: 'index.php?r=store/delstore',
            type: 'POST',
            dataType: 'json',
            data: {store_id: id,
            },
        })
            .done(function(data) {
                if(data.success==true){
                    alert('删除成功！')
                    getStores();
                }else{
                }
            })
            .fail(function() {
                console.log("error");
            })

    }
}
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
                $("#item_detail_content").html(content)
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

function hideDetail(){
    $("#item_detail_content").html('')
    $("#back_click_hide").fadeOut()
    $("#item_detail_hidden").fadeOut(300)
}


function bindBtn(){
    //增加的按钮
        $(".glyphicon-plus").bind("click",function(e){
            $("#text_til").html("输入增加的数量")
            $("#msg_store_PM").html("")
            $("#store_PM_num").val('');
            $("#change_type").html('plus')
            $("#change_id").html($(this).parent().parent().children('td:eq(0)').html())
            Mouse(e);
            $("#store_op_PM").css({top:toppos,left:leftpos}).fadeIn(100);
         })
    //减少的按钮
        $(".glyphicon-minus").bind("click",function(e){
            $("#text_til").html("输入减少的数量")
            $("#msg_store_PM").html("")
            $("#store_PM_num").val('');
            $("#change_type").html('minus')
            $("#change_id").html($(this).parent().parent().children('td:eq(0)').html())
            Mouse(e);
            $("#store_op_PM").css({top:toppos,left:leftpos}).fadeIn(100);
        })
}
/**
 * 合并单元格方法
 * @param tb
 * @param row
 * @param col
 */
function autoRowSpan(tb,row,col)
{
    //alert()
    var lastValue="";
    var value="";
    var pos=1;
    for(var i=row;i<tb.rows.length;i++)
    {
        value = tb.rows[i].cells[col].innerText;
        if(lastValue == value)
        {
            tb.rows[i].deleteCell(col);
            tb.rows[i-pos].cells[col].rowSpan = tb.rows[i-pos].cells[col].rowSpan+1;
            pos++;
        }else{
            lastValue = value;
            pos=1;
        }
    }
}