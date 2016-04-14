@forelse($unscheduled as $index=>$p)
  <div class = "row" id="presentation_{{ $p['id'] }}">
    @foreach($p->students() as $student)
      <b>{{$student->student_name}}, </b>
    @endforeach
    <i>{{$p['title']}}</i>
    @if ($p['our_nominee'])
      <b>*</b>
    @endif
  </div>
@empty
  <h4>All approved presentations have been scheduled.</h4>
@endforelse
