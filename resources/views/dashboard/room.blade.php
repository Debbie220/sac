@extends('dashboard.adminbase')



@section('text')



<div class='row'>
  <div class='col-md-8'>
    <h1> Rooms </h1>
  </div>
  <div class='col-md-2'>
    <a href="{{ route('add_room') }}" class="btn btn-primary">
    <i class="fa fa-plus-square"></i>                                    Add new Room </a>
  </div>

</div>

  <div class="table-responsive">
    <table class="table">
      <tr class="row">
        <th class="col-lg-1 col-md-6 col-sm-2 text-center">Room Code</th>
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
          <td class="text-center">
            @include('dashboard._change_avaliability', ['id' => $room['id']])
          </td>
          <td class="text-center">
            @if($room['available'])
              <i class="fa fa-check-circle-o"></i>
            @else
              <i class="fa fa-circle-o"></i>
            @endif
          </td>
          <td class="text-center">
					       @include('dashboard._delete_room', ['id' => $room['id']])
				  </td>                                                                                                     
        </tr>
        @endforeach
    </table>
  </div>

@stop
