@extends('basePages.sac')
@push('style')
  <link href="{{ asset('css/dragula.css') }}" rel="stylesheet">
@endpush
@section('content')



<div class="container" id="left">
    <div>One</div>
    <div>Two</div>
    <div>Three</div>
    <div>Four</div>
    <div>Five</div>
    <div>Six</div>
    <div>Seven</div>
</div>
<div class="container" id="right"></div>
@stop
@push('scripts')
  <script src="{{ asset('js/dragula.js') }}"></script>
@endpush
