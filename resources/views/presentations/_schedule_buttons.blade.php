<div class="row">
  <button type="submit" style="display: block; width: 100%; margin: 15px;" 
                                              class="btn btn-primary">
      <i class="fa fa-floppy-o"></i> Save
  </button>
</div>
<div class="row" style="margin: 5px;">
  @foreach($rooms as $room)
    @if ($room->room_code == $display_room)
      <a href="{{ route('presentation.schedule', ['display_room' => $room->room_code]) }}" class="btn btn-success">{{$room->room_code}}</a>
    @else
      <a href="{{ route('presentation.schedule', ['display_room' => $room->room_code]) }}" class="btn btn-primary">{{$room->room_code}}</a>
    @endif
  @endforeach
</div>
