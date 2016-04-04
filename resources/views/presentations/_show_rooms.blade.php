<div class="row" style="margin: 3em;">
  <ul class="nav nav-tabs nav-justified">
    @foreach($rooms as $room)
      @if ($room->room_code == $display_room)
        <li class="active"><a href="{{ route('presentation.schedule', ['display_room' =>
           $room->room_code]) }}">{{$room->room_code}}</a></li>
      @else
        <li><a href="{{ route('presentation.schedule', ['display_room' =>
           $room->room_code]) }}">{{$room->room_code}}</a></li>
      @endif
    @endforeach
  </ul>
</div>
