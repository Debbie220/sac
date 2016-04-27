@extends('user.admin.basepage')

@section('header')
    Preview
@stop

@section('admin_content')
@foreach($rooms as $room)
  <div class="row ">
    <div class="col-lg-12 col-md-12 col-sm-12">
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
                      <th class="col-lg-2 col-md-2 col-sm-2 text-center">Name</th>
                      <th class="col-lg-4 col-md-4 col-sm-4 text-center">Presentation Title</th>
                      <th class="col-lg-2 col-md-2 col-sm-2 text-center">Course</th>
                      <th class="col-lg-2 col-md-2 col-sm-2 text-center">Professor Name</th>
                      <th class="col-lg-1 col-md-1 col-sm-1 text-center">Type</th>
                  </tr>
                  @include('timeslots._preview_table_body')
          </table>
        </div>
      @endfor
    </div>
  </div>

@endforeach
@stop
