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
          {{ $p->type()->get()->first()->description}} {{$p['title']}}
      </div>
    @endforeach
  </div>
  <div class="col-md-2"></div>
  <div class="col-md-4 drop-target" id="drop-target">

  </div>
@stop
@include('footer')
@push('scripts')
  <script src="{{ asset('js/dragula.js') }}"></script>
  <script>
  console.log(timeslots);
  </script>
@endpush
