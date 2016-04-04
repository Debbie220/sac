 <form action="{{ route('presentation.submit', $id) }}" method="POST">
	{{ csrf_field() }}
	{{ method_field('PATCH') }}

	<button type="submit" class="btn" 
			aria-label="Submit Presentation" title="Submit Presentation">
		<i class="fa fa-paper-plane"></i>
		Submit
	</button>
</form>