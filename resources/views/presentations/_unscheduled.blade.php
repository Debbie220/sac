@foreach($presentations as $index=>$p)
  @if( $p['timeslot'] == NULL )
    <div class = "row" id="presentation_{{ $p['id'] }}">
      {{$p['title']}}
    </div>
  @endif
@endforeach
