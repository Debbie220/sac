@extends('user.admin.basepage')
@push('style')
  <link href="{{ asset('css/dragula.css') }}" rel="stylesheet">
@endpush
@section('header')
    Schedule
@stop

@section('admin_content')
  <div class="col-md-6 container" id="drag-elements">
    <div id="1">Presentation 1</div>
    <div id="2">Presentation 2</div>
    <div id="3">Presentation 3</div>
  </div>
  <div class="col-md-2"></div>
  <div class="col-md-4 drop-target" id="drop-target">

  </div>
@stop
@push('scripts')
  <script src="{{ asset('js/dragula.js') }}"></script>
@endpush
