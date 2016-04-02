var numdays = 1;

function enable() {
    document.getElementById("endTime").disabled=false;
    document.getElementById("startTime").disabled=false;
}

function addDay(){
  numdays = numdays + 1;
  var day = $(".new-day").last().clone();
  var header = $(".header").last().clone();
  header.removeClass("hidden");
  header.find("b").text("Day "  + numdays);
  day.removeClass("hidden");
  enable();
  header.appendTo("#all-days");
  day.appendTo("#all-days");

}
