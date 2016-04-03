<div style="padding: 1em;">
  @foreach($days as $day)
    <h2>Day {{$day->day}}</h2>
    @foreach($timeslots as $timeslot)
      @if($timeslot->day == $day->day)
      <div class="row">
        <div class="col-md-2">
          <h3>
            {{$timeslot->time}}
          </h3>
        </div>
        <div class="col-md-8">
          <div id="{{$timeslot->id}}" class="drop-target row" >
            @foreach($presentations as $index=>$p)
              @if( $p['timeslot'] == $timeslot->id )
                <div class = "row" id="presentation_{{ $p['id'] }}">
                  {{$p['title']}}
                </div>
              @endif
            @endforeach
          </div>
        </div>
        <div class="col-md-1">
          <a href="{{route('delete_time', ['display_room' => $display_room,'id' => $timeslot->id, ])}}">
                <i class="fa fa-trash-o"></i></a>
        </div>
      </div>
      <input type='text' name='timeslots[]' value="{{ $timeslot->id }}"
          class='hidden'>
      @endif
    @endforeach
  @endforeach
</div>
