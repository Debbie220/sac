@if(!empty($presentations))
<div class="table-responsive">
	<table class="table">
		<tr class="row">
			<th class="col-lg-6 col-md-6 col-sm-6 text-center"></th>
			<th class="col-lg-1 col-md-1 col-sm-1 text-center"></th>
			<th class="col-lg-1 col-md-1 col-sm-1 text-center">OUR Nominee</th>
			<th class="col-lg-1 col-md-1 col-sm-1 text-center">Type</th>
			<th class="col-lg-1 col-md-1 col-sm-1 text-center">Status</th>
			<th class="col-lg-1 col-md-1 col-sm-1 text-center"></th>
		</tr>

		@foreach($presentations as $p)
		<tr class="row">
			<td>
				<h3>
					<a href="{{ route('presentation.edit', $p['id'])}}">
						{{$p['title']}}
					</a>
				</h3>

				<p>
					{{$p['abstract']}}
				</p>
				@if($p['status'] == 'D')
				<p>
					<div class="alert alert-info" role="alert">
						<h4>Comments: </h4>
						<p> {{$p['comments']}}</p>
				</div>
				</p>
				@endif
			</td>
			<td class="text-center">
				@if($p['status'] == "S" || $p['status'] == "D")
					@include('user._submit_presentation', ['id' => $p['id']])
				@endif
			</td>
			<td class="text-center">
				{{ $p['our_nominee'] ? 'Yes' : 'No' }}
			</td>
			<td class="text-center">
				{{ $p->type()->get()->first()->description}}
			</td>
			<td class="text-center">
				<div class="alert
					@if($p->status == 'S')
					alert-warning
					@elseif($p->status == 'D')
					alert-danger
					@elseif($p->status == 'A')
					alert-success
					@else
					alert-info
					@endif">
					{{$p->status()->get()->first()->description}}
				<div>
			</td>
			<td class="text-center">
				@include('user._delete_presentation', ['id' => $p['id']])
			</td>
		</tr>
		@endforeach
	</table>
</div>
@else
	<p>You don't have any presentations here!</p>
@endif
