<div class="form-group{{ $errors->has('days') ? ' has-error' : '' }}">
  <label class="col-md-3 control-label" id="days">Number of days</label>

  <div class="col-md-1 button">
    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">
        <a class="btn btn-default" onclick="addDay(); enable();">
            Add a Day
        </a>
    </div>
  </div>
</div>


<div id=all-days>
  @for($i= 1; $i <= $_SESSION['numDays']; $i++)
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


<div class="hidden form-group new-day">

  <h3 id='num'><b> Day {{$_SESSION['numDays']=$_SESSION['numDays'] + 1}} </b></h3>
  <div class="form-group{{ $errors->has('start_time') ? ' has-error' : '' }}">
    <label class="col-md-3 control-label">Start time</label>

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
    <label class="col-md-3 control-label"> Start time of latest presentation</label>

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
<script>
function enable() {
    document.getElementById("endTime").disabled=false;
    document.getElementById("startTime").disabled=false;
}
function addDay(){
  var day = $(".new-day").last().clone();
  day.removeClass("hidden");
  //document.getElementById("num").innerHTML=day1;
  day.find("input").prop('disabled', false);
  //{{$_SESSION['numDays'] = $_SESSION['numDays'] + 1}};
  day.appendTo("#all-days");
}
</script>
@stop
