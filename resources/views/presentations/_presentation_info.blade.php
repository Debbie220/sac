<h4>
    <a data-toggle="collapse"
        href="#{{$index . $p->id}}" aria-expanded="false"
        aria-controls="details">
        {{$p['title']}}
    </a>
</h4>
<div id="{{$index . $p->id}}" class="collapse">
    <p>
        <b>Professor:</b> {{ $p['professor_name'] }}
    </p>
    <p>
        <b>Course:</b> {{$p->course->toString()}}
    </p>
    <p>
        <b>Students:</b>
        <ul class="list-unstyled">
        @foreach($p->students() as $student)
            <li>{{ $student->student_name }}</li>
        @endforeach
        </ul>
    </p>
    <p>
        <b>Abstract:</b> {{$p['abstract']}}
    </p>
    <p>
        <b>Special Notes:</b> {{$p['special_notes']}}
    </p>
</div>