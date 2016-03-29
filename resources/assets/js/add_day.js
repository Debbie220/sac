function addDay(){
    var days= getElementById("days").value
    var newnumDays = <?php echo $numDays; ?>;
    <?php echo $numDays; ?> = days;
    // var day = $(".new-day").last().clone();
    // day.removeClass("hidden");
    // //student.find("input").prop('disabled', false);
    // day.appendTo("#newDay");
}

$(document).ready(function(){
    $("#group-checkbox").click(function(){
        var checkbox = $("#group-checkbox");
        if($("#group-checkbox").is(":checked")){
            addDay();
        }else{
            $("#new-days").empty();
        }
    });

});
