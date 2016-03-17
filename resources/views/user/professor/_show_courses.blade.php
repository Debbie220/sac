<div>
	<table class="table">
			<tr class="row">
				<th class="col-lg-9 col-md-9 col-sm-9">Course</th>
				<th class="col-lg-2 col-md-2 col-sm-2"></th>                                                                                                                       
			</tr>
			@forelse(Auth::user()->courses as $course)
			<tr class="row">
				<td>
					<h4>
						<a  role="button" data-toggle="collapse"
							href="#{{$course->id}}" aria-expanded="false"
							aria-controls="collapseExample">
							{{ $course ->title }}
						</a>
					</h4>

					<div class="collapse" id="{{$course->id}}">
						@include('user._presentations_table',
							['presentations' => $course->presentations])
					</div>


				</td>
				<td class="text-center">
					@include('user.professor._remove_course')
				</td>
			</tr>
			@empty
				Start by adding courses to your profile.
			@endforelse
	</table>
</div>
