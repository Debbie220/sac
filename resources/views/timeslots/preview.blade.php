@extends('basePages.sac')

@section('content')
<div class="container">
  <div class = "col-lg-10 col-md-10 col-sm-5">
    <h1> Preview </h1>
  </div>
  <div class = "col-lg-2 col-md-2 col-sm-2">
  @if(Auth::User()->is_admin())
    <a class="btn btn-primary" href="{{route('timeslot.publish')}}">
       Publish Schedule </a>
  @endif
  </div>
</div>
  @foreach($rooms as $room)
    <div class="row col-md-offset-1">
          <h2>
              <a href="#">
                  {{$room['code']}}
              </a>
          </h2>

          @for($day = 1; $day <= $days; $day++)
            <h3> Day {{$day}} </h3>

            <div class="row">
                <table class="table">
                    <tr class="row">
                        <th class="col-lg-1 col-md-1 col-sm-1 text-center">Time</th>
                        <th class="col-lg-1 col-md-1 col-sm-1 text-center">Name</th>
                        <th class="col-lg-3 col-md-3 col-sm-3 text-center">Presentation Title</th>
                        <th class="col-lg-2 col-md-2 col-sm-2 text-center">Course</th>
                        <th class="col-lg-2 col-md-2 col-sm-2 text-center">Professor Name</th>
                        <th class="col-lg-1 col-md-1 col-sm-1 text-center">Type</th>
                    </tr>
                    @include('timeslots._preview_table_body')
               </table>
          </div>
        @endfor
    </div>
  @endforeach
@stop
