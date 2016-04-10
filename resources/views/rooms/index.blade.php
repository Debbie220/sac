@extends('user.admin.basepage')

@section('header')
    Rooms
@stop

@section('add_object')
    <a href="{{ route('room.create') }}" class="btn btn-primary">
    <i class="fa fa-plus-square"></i> Add new Room </a>
@stop

@section('admin_content')
<table class="table">
    <tr class="row">
        <th class="col-lg-3 col-md-3 col-sm-3 text-center">Code</th>
        <th class="col-lg-3 col-md-3 col-sm-3">Description</th>
        <th class="col-lg-3 col-md-3 col-sm-3">Building</th>
        <th class="col-lg-1 col-md-1 col-sm-1"></th>
        <th class="col-lg-1 col-md-1 col-sm-1"></th>
    </tr>
        @foreach($rooms as $room)
        <tr class="row">
            <td class="text-center">
                {{$room->code}}
            </td>
            <td>
                {{$room->description}}
            </td>
            <td>
                {{$room->building}}
            </td>
            <td class="text-center">
                @include('rooms._change_availability',
                    ['id' => $room['code']])
            </td>
            <td class="text-center">
                @include('rooms._delete', ['code' => $room['code']])
            </td>
        </tr>
        @endforeach
</table>
@stop
