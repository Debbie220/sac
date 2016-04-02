<div class="form-group{{ $errors->has('days') ? ' has-error' : '' }}">
  <label class="col-md-3 control-label" id="days">Number of days</label>

  <div class="col-md-1 button">
    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">
        <a class="btn btn-default" id="button" onclick="enable();addDay();">
            Add a Day
        </a>
    </div>
  </div>
</div>


<div id=all-days>
  @for($i= 1; $i <= $numDays; $i++)
  <h3><b> Day {{$i}} </b></h3>
  <div class="form-group{{ $errors->has('start_time') ? ' has-error' : '' }}">
    <label class="col-md-3 control-label">Start time</label>

    <div class="col-md-6">
      <select type="text" class="form-control" name="start_time[]">
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
      <select type="text" class="form-control" name="end_time[]">
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
  @endfor
</div>

<div class="hidden header"><h3><b> j </b></h3></div>

<div class="hidden form-group new-day">
  <div class="form-group{{ $errors->has('start_time') ? ' has-error' : '' }}">
    <label class="col-md-3 control-label">First timeslot</label>

    <div class="col-md-6">
      <select type="text" class="form-control" name="start_time[]" id="startTime" disabled>
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
    <label class="col-md-3 control-label"> Last timeslot</label>

    <div class="col-md-6">
      <select type="text" onchange="enable()" class="form-control" name="end_time[]" id="endTime" disabled>
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
</div>

@section('scripts')
@section('scripts')
<script src="{{ asset('js/add_day.js') }}"></script>
@stop
@stop
