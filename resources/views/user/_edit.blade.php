@extends('basePages.sac')

@section('content')

<div class="col-md-8 col-md-offset-2">
<form action="{{ route('update')}}" method="POST" role='form'>
  <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">Username</label>

        <div>
            <input type="text" class="form-control" name="username"
            value="{{ old('username', $user['username']) }}">

            @if ($errors->has('username'))
                <span class="help-block">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
            @endif
        </div>
    </div>


  <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
  	<label class="col-md-1 control-label">Name</label>

  	<div>
  		<input type="text" class="form-control" name="name"
  			value="{{ old('name', $user['name']) }}"
  			{{ Auth::user()->name }} >

  		@if ($errors->has('name'))
  			<span class="help-block">
  				<strong>{{ $errors->first('name') }}</strong>
  			</span>
  		@endif
  	</div>
  </div>


  <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
  	<label class="col-md-3 control-label">Email</label>

  	<div>
  		<input type="text" class="form-control" name="email"
  			value="{{ old('email', $user['email']) }}">

  		@if ($errors->has('email'))
  			<span class="help-block">
  				<strong>{{ $errors->first('email') }}</strong>
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
