<div class="row" style="text-align:center;">
  <a class="btn btn-default" onclick="addTime();" style="margin-bottom: 1em;">
     <i class="fa fa-plus"></i> Add Timeslot</a>
</div>
<div class="row hidden" id = "newTimeForms" style="text-align:center;">
  <div class="row">
    <label class="col-md-2 control-label">Day:</label>
    <div class="col-md-9">
      <select type="text" class="form-control" name="day" style="margin-bottom: 1em;">
        @foreach($days as $day)
          <option value="{{ $day->day }}"
             {{old('day') == $day ? 'selected' : ''}}>
          {{ $day->day }}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="row">
    <label class="col-md-2 control-label">Hour:</label>
    <div class="col-md-9">
      <select type="text" class="form-control" name="hour" style="margin-bottom: 1em;">
        <option value="" disabled >---------</option>
        @foreach($hours as $hour)
          <option value="{{ $hour }}"
             {{old('hour') == $hour ? 'selected' : ''}}>
          {{ $hour}}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="row">
    <label class="col-md-2 control-label">Minute:</label>
    <div class="col-md-9">
      <select type="text" class="form-control" name="minute" style="margin-bottom: 1em;">
        <option value="" disabled >---------</option>
        @foreach($minutes as $minute)
          <option value="{{ $minute }}"
             {{old('minute') == $minute ? 'selected' : ''}}>
          {{ $minute}}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="row" style="text-align:center;">
    <button type="submit" class="btn btn-primary">Create Time Slot</button>
  </div>
</div>
