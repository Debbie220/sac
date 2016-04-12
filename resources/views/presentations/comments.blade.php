@extends('user.admin.basepage')

@section('header')
Presentations
@stop

@section('admin_content')
<form action="{{ route('presentation.comment', $id) }}" method="POST" role='form'>
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="form-group{{ $errors->has('special_notes') ? ' has-error' : '' }}">
  	<label class="control-label">
    Comments on declining Presentation </label>

  	<div>
  		<textarea special_notes="text" row="3" class="form-control"
  			name="comments" ></textarea>

    </div>
  </div>

  <div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-floppy-o"></i> Save
        </button>
    </div>
  </div>
</form>
@stop
