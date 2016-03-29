@extends('basePages.sac')

@section('content')
<div class="col-md-10 col-md-offset-1">
	@forelse(Auth::user()->courses as $index=>$course)
		<h3>
			<a  role="button" data-toggle="collapse"
				href="#{{$index}}" aria-expanded="false">
				{{ $course ->title }}
			</a>
		</h3>

		<div class="collapse" id="{{$index}}">
			@include('user._presentations_table',
				['presentations' => $course->presentations])
		</div>
	@empty
		Start by adding courses to your account.
	@endforelse
</div>
@stop
