@extends('basePages.sac')

@section('title')
    Add Presentation
@stop

@section('content')
<div classs="fluid-container">
    <div class="row text-center">
        <h2>
            Create Presentation
        </h2>
    </div>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <form class="form-horizontal" role="form" method="POST" 
            action="{{ route('presentation.store') }}">
                @include('presentations._form')
            </form>
        </div>
    </div>
</div>
@stop
