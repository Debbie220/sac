<div class="row" style="margin: 3em;">
  <ul class="nav nav-tabs nav-justified">
    @foreach($rooms as $room)
      <li class="{{ $room->room_code == $display_room ? 'active' : ''}}">
        <a href="{{ route('timeslot.show', ['display_room' =>
         $room->room_code]) }}">{{$room->room_code}}</a></li>
    @endforeach
  </ul>
</div>
