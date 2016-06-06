 //$(function () {
 //       $(".glyphicon-remove").bind("click", function () {
 //           //$(this).next().slideToggle(300,function(){
 //           //
 //           //})
 //           alert()
 //       })
 //   });

function addTask(){
    var subbtn=$("#sub_btn");
    var memberOption=$("#hideOption").html();
    var insert='<div><br><br><label>任务详情<span class="glyphicon glyphicon-remove mycursor"></span></label><input  type="text"  name="task[]" class="form-control"><br><label>选择成员</label><select name="member[1][]" type="text" class="form-control"  multiple="multiple">'+memberOption+'</select><br><br></div>';
    subbtn.before(insert);
    console.log('success');

    changeNameNum()

}
function changeNameNum(){
    for(var i=0;i<$("[multiple]").length;i++){
        $("[multiple]:eq("+i+")").attr("name","member["+i+"][]")
        console.log($("select:eq("+i+")").attr("name"))
    }
    $(".glyphicon-remove").bind("click", function () {
        $(this).parent().parent().remove()
        changeNameNum()

    })
    $("[multiple]").select2({
        placeholder:'请选择参与者'
    })
}