@extends('dashboard.adminbase')

@section('text')
<div>
<a href="{{ route('add_room') }}" class="btn btn-primary">
  <i class="fa fa-plus-square"></i>                                    Add new Room </a>                                                                                  
</div>

  <div class="table-responsive">
    <table class="table">
      <tr class="row">
        <th class="col-lg-1 col-md-6 col-sm-2 text-center">Room Id</th>
        <th class="col-lg-1 col-md-6 col-sm-2 text-center">Building</th>
      </tr>
        @foreach($rooms as $room)
        <tr class="row">
          <td class="text-center">
            {{$room->code}}
          </td>
          <td class="text-center">
            {{$room->description}}
          </td>
        </tr>
        @endforeach
    </table>
  </div>

@stop
