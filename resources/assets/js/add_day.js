function addDay(){
  var day = $(".new-day").last().clone();
  day.removeClass("hidden");
  day.find("input").prop('disabled', false);
  var days = {{$numDays}};
  //{{$numDays}} = {{$numDays}} + 1;
  day.appendTo("#all-days");
}
