@extends('user.admin.basepage')
@push('style')
  <link href="{{ asset('css/dragula.css') }}" rel="stylesheet">
@endpush
@section('header')
    Schedule
@stop

@section('admin_content')

<form method="POST" action="{{ route('presentation.book') }}">
{{ csrf_field() }}
  <div class="col-md-6 container" id="drag-elements">
    @foreach($presentations as $index=>$p)
      <div class = "row" id="presentation_{{ $p['id'] }}">
        {{$p['title']}}
      </div>
    @endforeach
  </div>
  <div class="col-md-2">
    <button type="submit" class="btn btn-primary">
        <i class="fa fa-floppy-o"></i> Save
    </button>
  </div>
  <div class="col-md-4">
    @foreach($timeslots as $timeslot)
      <h2>{{$timeslot->time}}, {{$timeslot->room_code}}</h2>
      <div id="{{$timeslot->id}}" class="drop-target well row" ></div>
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
    if ($(source).attr('id') !== "drag-elements"){
      $("input[value='" + el['id'] + "']").remove();
    }
    var stringToInsert = "<input type = 'text' name=" + target['id'] +
      "[] value="+el['id']+">";
    $(target).append(stringToInsert);

  });


  </script>
@endpush
