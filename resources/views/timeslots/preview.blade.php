@extends('user.admin.basepage')

@section('header')
    Preview
@stop

@section('admin_content')
@foreach($timeslots as $timeslot)
{{$timeslot}}
@endforeach
@stop