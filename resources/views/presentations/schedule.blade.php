@extends('user.admin.basepage')
@push('style')
  <link href="{{ asset('css/dragula.css') }}" rel="stylesheet">
@endpush
@section('header')
    Schedule
@stop

@section('admin_content')
  <div class="col-md-6 container" id="drag-elements">
    @foreach($presentations as $index=>$p)
      <div class = "row" id="p" + "{{ $p['id'] }}">
        {{$p['title']}}
      </div>
    @endforeach
  </div>
  <div class="col-md-2"></div>
  <div class="col-md-4">
    @foreach($timeslots as $timeslot)
      <h2>{{$timeslot->time}}, {{$timeslot->room_code}}</h2>
      <div id="{{$timeslot->id}}" class="drop-target well row" ></div>
    @endforeach

  </div>
@stop
@include('footer')
@push('scripts')
  <script src="{{ asset('js/dragula.js') }}"></script>
  <script>
  for (var i = 0; i<timeslots.length; i++){
    drake.containers.push(getEl(String(timeslots[i]['id'])));
  }

  
  </script>
@endpush
