function getEl(id) {
  return document.getElementById(id);
};

var drake = dragula([getEl('drag-elements')], {
  revertOnSpill:true
})
;

drake.containers.push(getEl('drop-target'));

// for (var i=0; i<time.length; i++){
//   drake.containers.push($(String(times[i]['id'])));
// };
