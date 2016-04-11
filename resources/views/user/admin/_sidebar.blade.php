@if(current_conference())
<ul class="nav nav-pills nav-stacked"> Current Conference
    <li><a href="{{ route('presentation.schedule')}}">Schedule</a></li>
    <li><a href="{{ route('presentation.index') }}">Presentations</a></li>
</ul>
@endif

<ul class="nav nav-pills nav-stacked"> New Conference
    <li><a href="{{ route('room.index') }}">Rooms</a></li>
    <li><a href="{{ route('new_conference') }}">Create new Conference</a></li>
</ul>

<ul class="nav nav-pills nav-stacked"> General
    <li><a href="{{ route('role.index') }}">Change role requests</a></li>
    <li><a href="{{ route('course.index') }}">Courses</a></li>
</ul>

<ul class="nav nav-pills nav-stacked"> Previous conferences
    <li><a href="#">See previous Conferences</a></li>
</ul>
