@extends('user.admin.basepage')

@section('header')
    Preview
@stop

@section('admin_content')
@foreach($rooms as $room)
  <div class="row ">
    <div class="col-lg-6 col-md-6 col-sm-6 ">
        <h2>
            <a href="#">
                {{$room['code']}}
            </a>
        </h2>

        <div class="row">
            <table class="table">
                <tr class="row">
                    <th class="col-lg-1 col-md-1 col-sm-1 text-center">Time</th>
                    <th class="col-lg-1 col-md-1 col-sm-1 text-center">Name</th>
                    <th class="col-lg-7 col-md-7 col-sm-7 text-center">Presentation Title</th>
                    <th class="col-lg-1 col-md-1 col-sm-1 text-center">Course</th>
                    <th class="col-lg-1 col-md-1 col-sm-1 text-center">Professor Name</th>
                    <th class="col-lg-1 col-md-1 col-sm-1 text-center">Type</th>
                </tr>

                @foreach($presentations as $p)
                @if($p['timeslot'] != null)
                @if($p->timeslot()->get()->first()->room_code == {{room['code']}} )

                <tr class="row">
                    <td class="text-center">
                        <p>
                            {{ $p->timeslot()->get()->first()->time}}
                        </p>
                    </td>
                    <td class="text-center">
                        <p>
                            {{ $p->owner()->get()->first()->name}}
                        </p>
                    </td>
                    <td class="text-center">
                        <p>
                            {{ $p['title']}}
                        </p>
                    </td>
                    <td class="text-center">
                        <p>
                            {{ $p->course()->get()->first()->subject_code}}
                        </p>
                    </td>
                    <td class="text-center">
                        <p>
                            {{ $p['professor_name']}}
                        </p>
                    </td>
                    <td class="text-center">
                        <p>
                            {{ $p->type()->get()->first()->description}}
                        </p>
                    </td>
                </tr>
                @endif
                @endif
                @endforeach
            </table>
        </div>


    </div>
  </div>

@endforeach
@foreach($timeslots as $timeslot)
{{$timeslot}}
@endforeach
@stop
