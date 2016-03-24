@extends('user.admin.basepage')

@section('header')
Presentations
@stop

@section('admin_content')
    @include('presentations._index_table')
    {{ $presentations->links() }}
@stop
