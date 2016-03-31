@extends('user.admin.basepage')
@push('style')
  <link href="{{ asset('css/dragula.css') }}" rel="stylesheet">
@endpush
@section('header')
    Schedule
@stop

@section('admin_content')
<form method="POST" action="{{ route('presentation.book',
                          ['display_room' => $display_room]) }}">
{{ csrf_field() }}
  <div class="col-md-4 container" id="drag-elements">
    @foreach($presentations as $index=>$p)
      @if( $p['timeslot'] == NULL )
        <div class = "row" id="presentation_{{ $p['id'] }}">
          {{$p['title']}}
        </div>
      @endif
    @endforeach
  </div>
  <div class="col-md-1">
  </div>
  <div class="col-md-5">
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
    @foreach($timeslots as $timeslot)
      <div class="row">
        <div class="col-md-3 well">
          {{$timeslot->time}}
        </div>
        <div class="col-md-9">
          <div id="{{$timeslot->id}}" class="drop-target row" >
            @foreach($presentations as $index=>$p)
              @if( $p['timeslot'] == $timeslot->id )
                <div class = "row" id="presentation_{{ $p['id'] }}">
                  {{$p['title']}}
                </div>
              @endif
            @endforeach
          </div>
        </div>
      </div>
      <input type='text' name='timeslots[]' value="{{ $timeslot->id }}"
          class='hidden'>
    @endforeach
  </div>
</form>

@stop
@include('footer')
@push('scripts')
  <script src="{{ asset('js/dragula.js') }}"></script>
  <script>
  for (var i = 0; i<timeslots.length; i++){
    drake.containers.push(getEl(String(timeslots[i]['id'])));
  }

  drake.on('drop', function(el,target, source){
    //if we are dragging from a differnt timeslot, we
    //need to delete what was inserted into that other timeslot
    $("input[value='" + el['id'] + "']").remove();
    var stringToInsert = "<input class='hidden' type = 'text' name=" + target['id'] +
      "[] value="+el['id']+">";
    $(target).append(stringToInsert);

  });


  </script>
@endpush
