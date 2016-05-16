$("#create_detail").click(function(){
    //detail=$(".form-group:last").prev().prev().clone();
    //person=$(".form-group:last").prev().clone();
    $("button:contains('提交')").parent().before("<br><br>");
    $("button:contains('提交')").parent().before(detail.clone());
    $("button:contains('提交')").parent().before(person.clone());

    $("[multiple]").select2({
        placeholder:'请选择参与者'
    })
    alter_order();

});
$("button[type='submit']").click(function(){
    var count=1;
    var a=$('.select2-selection__rendered').length;
    for(var i=0;i<a;i++){
        if($(".select2-selection__rendered:eq("+i+")").children().length<=1){
            count=count+1;
        }
    }
    if(count>1){
        alert("请填写完整")
        return false;
    }
    //if($('.select2-selection__rendered').children().length<=10){
    //    alert("成员不能为空")
    //    return false
    //}
})
//$("button[type='submit']").click(function(){
//    var count=1;
//    $('.select2-selection__rendered').each(function(index,element){
//        if(element.children().length){
//            alert(element.children().length)
//        }
//    })
//    if(count>=1){
//        alert("成员不能为空")
//        return false
//    }
//})
/**
 * 对分任务表单的name命名name[i][]
 * */
function alter_order(){
    var del="<span class='glyphicon glyphicon-remove finger' onclick='removedetail(this)' ></span>"
    //var length=$("input[name^='ItemDetailPerson[st_id]']").length;
    var inp=$("input[name^='ItemDetailPerson[st_id]']").length;
    var sel=$("select[name^='ItemDetailPerson[st_id]']").length
    for(var i=0;i<inp;i++){
        $("input[name^='ItemDetailPerson[st_id]']:eq("+i+")").attr("name","ItemDetailPerson[st_id]["+i+"]")
        $("select[name^='ItemDetailPerson[st_id]']:eq("+i+")").attr({"name":"ItemDetailPerson[st_id]["+i+"][]","id":"itemdetailperson-st_id-"+i+""})
        if(($("label:contains('任务分配'):eq("+i+")").next().is("input"))){
            $("label:contains('任务分配'):eq("+i+")").after(del)
        }
    }
}

function removedetail(obj){
    var thisObjsParent=obj.parentNode
    var nodeperson=get_nextSibling(thisObjsParent)
    nodeperson.remove()
    thisObjsParent.previousSibling.remove()
    thisObjsParent.previousSibling.remove()
    // thisObjsParent.previousSibling.previousSibling.remove()

    thisObjsParent.remove()
    alter_order();

}
/**
 * 过滤空白节点
 * @param n
 * @returns {*|Node}
 */
function get_nextSibling(n){
    var x=n.nextSibling;
    while (x && x.nodeType!=1){
        x=x.nextSibling;
    }
    return x;


}




