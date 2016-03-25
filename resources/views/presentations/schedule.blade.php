@extends('user.admin.basepage')
@push('style')
  <link href="{{ asset('css/dragula.css') }}" rel="stylesheet">
@endpush
@section('header')
    Schedule
@stop

@section('admin_content')
  <div class="col-md-6 container" id="drag-elements">
    @foreach($presentations as $index=>$p)
      <div class = "row" id="{{ $p['id'] }}">
        <h4>
            <a data-toggle="collapse"
                href="#{{$index}}" aria-expanded="false"
                aria-controls="details">
                {{$p['title']}}
            </a>
        </h4>
        <div id="{{$index}}" class="collapse">
            <p>
                <b>Professor:</b> {{ $p['professor_name'] }}
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
        </div>
      </div>
    @endforeach
  </div>
  <div class="col-md-2"></div>
  <div class="col-md-4 drop-target" id="drop-target">

  </div>
@stop
@push('scripts')
  <script src="{{ asset('js/dragula.js') }}"></script>
@endpush
