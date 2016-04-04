function comments(){
  comment = $(".comments").last().clone();
  comment.removeClass("hidden");
  $("#title").append(comment);
}
