@extends('basePages.sac')

@section('content')
<div class="col-md-10 col-md-offset-1">
    <div class="row">
        <div class= "col-md-2">
                @include('user.admin._sidebar')
        </div>
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-10" style="padding: 0;">
                    <h1>
                        @yield('header')
                    </h1>
                </div>

                <div class="col-md-2">
                    @yield('add_object')
                    <!-- Use this section to add links to create some object -->
                </div>
            </div>
            <div class="row">
                @yield('admin_content')
            </div>
        </div>
    </div>
</div>
@stop
