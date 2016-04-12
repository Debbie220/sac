@extends('user.admin.basepage')

@section('header')
Old Conferences
@stop

@section('admin_content')
	@forelse($conferences as $conference)
		<p>
			{{$conference->description}}
		</p>
	@empty
		No previous conferences
	@endforelse
@stop