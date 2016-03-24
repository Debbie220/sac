function addStudent(){
    var student = $(".new-student").last().clone();
    student.removeClass("hidden");
    student.find("input").prop('disabled', false);
    student.appendTo("#new-students");
}

$(document).ready(function(){
    $("#group-checkbox").click(function(){
        var checkbox = $("#group-checkbox");
        if($("#group-checkbox").is(":checked")){
            addStudent();
        }else{
            $("#new-students").empty();
        }
    });

});