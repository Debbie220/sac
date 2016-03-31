@extends('user.admin.basepage')

@section('header')
Presentations
@stop

@section('add_object')
    <a href="{{ route('presentation.pending')}}" class="btn btn-primary">
    Approve Presenations</a>
@stop

@section('admin_content')
    @include('presentations._index_table')
@stop
