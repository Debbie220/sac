@extends('basePages.sac')

@section('content')

@if(Auth::user()->is_student())
	@include('user.student._show')
@else
	@include('user.professor._show')
@endif

@stop
