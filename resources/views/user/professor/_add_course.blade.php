<form action="{{ route('add_course') }}" method="POST">
	{{ csrf_field() }}
	<div class="col-lg-11 col-md-11 col-sm-11 col-xs-9 text-center">
		<select type="text" class="form-control" name="course_id" id="course">
			<option value=""> Select a course </option>
			<option value="" disabled >---------</option>

			@foreach($courses as $course)
				<option value="{{ $course->id }}">
				{{ $course->subject_code." ". $course->number." - ".$course->title }}</option>
			@endforeach
		</select>
	</div>

	<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">
		<button type="submit" class="btn btn-default" id="add_course">
			<i class="fa fa-plus"></i> Add Course
		</button>
	</div>
</form>
