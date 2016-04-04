@foreach($presentations as $index=>$p)
  @if( $p['timeslot'] == NULL )
    <div class = "row" id="presentation_{{ $p['id'] }}">
      @foreach($p->students() as $student)
        <b>{{$student->student_name}}, </b>
      @endforeach
      <i>{{$p['title']}}</i>
    </div>
  @endif
@endforeach
