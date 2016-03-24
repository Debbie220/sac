@extends('user.admin.basepage')

@section('admin_content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form class="form-horizontal" role="form" method="POST"
            action="{{ route('create_conference') }}">
                {{ csrf_field() }}

              <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label class="col-md-3 control-label">Conference name</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('days') ? ' has-error' : '' }}">
                	<label class="col-md-3 control-label">Number of days</label>

                	<div class="col-md-6">
                		<select type="text" class="form-control" name="days">
                			<option value=""> Specify the number of days for this conference </option>
                			<option value="" disabled >---------</option>
                			@foreach($days as $day)
                				<option value="{{ $day }}"
                           {{old('day') == $day ? 'selected' : ''}}>
                				{{ $day }}</option>
                			@endforeach
                		</select>

                	</div>
                </div>

                <div class="form-group{{ $errors->has('start_time') ? ' has-error' : '' }}">
                	<label class="col-md-3 control-label">Start time</label>

                	<div class="col-md-6">
                		<select type="text" class="form-control" name="start_time">
                			<option value=""> earliest time for the conference </option>
                			<option value="" disabled >---------</option>
                			@foreach($times as $time)
                				<option value="{{ $time }}"
                           {{old('time') == $time ? 'selected' : ''}}>
                				{{ $time }}</option>
                			@endforeach
                		</select>

                	</div>
                </div>

                <div class="form-group{{ $errors->has('end_time') ? ' has-error' : '' }}">
                	<label class="col-md-3 control-label"> Start time of latest presentation</label>

                	<div class="col-md-6">
                		<select type="text" class="form-control" name="end_time">
                			<option value=""> Latest time for the conference </option>
                			<option value="" disabled >---------</option>
                			@foreach($times as $time)
                				<option value="{{ $time }}"
                           {{old('time') == $time ? 'selected' : ''}}>
                				{{ $time }}</option>
                			@endforeach
                		</select>

                	</div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                           Create
                        </button>
                    </div>
                </div>
            </form>
          </div>
      </div>
  </div>

@stop
