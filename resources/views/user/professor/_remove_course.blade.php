<form action="{{ route('remove_course', $course->id) }}" method="POST">
	{{ csrf_field() }}

	<button type="submit" class="btn btn-link"
			aria-label="Delete Presentation" title="Delete Presentation">
		<i class="fa fa-trash"></i> Remove Course
	</button>
</form>
