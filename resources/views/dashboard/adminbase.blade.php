@extends('basePages.sac')

@section('content')
@yield('head')

<div class="container">
	<h3>Admin<br />
    </h3>
    <br />

    <div class="row">
        <div class= "col-sm-2">
            <nav class="nav-sidebar">
                <ul class="nav">
                    <li class="active"><a href="{!! route('adminhome') !!}">Home</a></li>
                    <li><a href="{!! route('show_rooms') !!}">Rooms</a></li>
                    <li><a href="{!! route('presentations') !!}">Presentations</a></li>
                    <li><a href="#">Students</a></li>
                    <li><a href="{!! route('courses') !!}">Courses</a></li>
                    <li><a href="#">Schedule</a></li>
                    <li class="nav-divider"></li>
                </ul>
            </nav>
        </div>
				<div class="contents"> @yield('text') </div>                                                  
    </div>
</div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         



@stop
