@extends('basePages.sac')

@section('content')

<div class="col-md-8 col-md-offset-2">
<form action="{{ route('update')}}" method="POST" role='form'>
  {{ csrf_field() }}
  <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
  	<label class="col-md-1 control-label">Name</label>

  	<div>
  		<input required type="text" class="form-control" name="name"
  			value="{{ old('name', $user['name']) }}">

  		@if ($errors->has('name'))
  			<span class="help-block">
  				<strong>{{ $errors->first('name') }}</strong>
  			</span>
  		@endif
  	</div>
  </div>

  <div class="form-group">
  	<div class="col-md-6 col-md-offset-6">

  		<button type="submit" class="btn btn-primary">
  			<i class="fa fa-floppy-o"></i> Save
  		</button>
  	</div>
  </div>
</form>
</div>
@stop
