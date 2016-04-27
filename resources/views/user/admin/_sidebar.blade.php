@if(current_conference())
<ul class="nav nav-pills nav-stacked"> Current Conference
    <li><a href="{{ route('timeslot.show')}}">Schedule</a></li>
    <li><a href="{{ route('presentation.index') }}">Presentations</a></li>
    <li><a href="{{ route('timeslot.preview') }}">Preview Schedule</a></li>
</ul>

<ul class="nav nav-pills nav-stacked"> Previous conferences
    <li><a href="{{ route('conference.old') }}">See previous Conferences</a></li>
</ul>
@endif
<ul class="nav nav-pills nav-stacked"> General
    <li><a href="{{ route('room.index') }}">Rooms</a></li>
    <li><a href="{{ route('role.index') }}">Change role requests</a></li>
    <li><a href="{{ route('course.index') }}">Courses</a></li>
</ul>

<ul class="nav nav-pills nav-stacked"> New Conference
    <li><a href="{{ route('conference.create') }}">Create new Conference</a></li>
</ul>
