@extends('user.admin.basepage')
@push('style')
  <link href="{{ asset('css/dragula.css') }}" rel="stylesheet">
@endpush
@section('header')
    Schedule
@stop

@section('admin_content')
@include('timeslots._show_rooms')
<form method="POST" action="{{ route('timeslot.assign',
                          ['display_room' => $display_room]) }}">
{{ csrf_field() }}
  <div class="col-md-4 container"
    id="drag-elements">
    @include('timeslots._unscheduled')
  </div>
  <div class="col-md-1">
  </div>
  <div class="col-md-5">
    @if($display_room != null)
      <div class="btn-group text-center" role="group" aria-label="...">
        <button type="submit" 
         class="btn btn-primary">
            <i class="fa fa-floppy-o"></i> Save
        </button>
        <a class="btn btn-default"> 
          <i class="fa fa-calendar-o" aria-hidden="true"></i>
          Preview </a>
        <a class="btn btn-default"> 
          <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
          Publish </a>
      </div>

      @include('timeslots._show_timeslots')
    @endif
    </div>
</form>
@if ($display_room != null)
  <form method="POST" action="{{ route('timeslot.create',
                            ['display_room' => $display_room]) }}">
  {{ csrf_field() }}
    <div class="row">
      <div class="col-md-6"></div>
      <div class="col-md-6">
        @include('timeslots._add_timeslot')
      </div>
    </div>
  </form>
@endif

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

  function addTime(){
    $("#newTimeForms").removeClass("hidden");
  }

  </script>
@endpush
