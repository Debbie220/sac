@extends('basePages.sac')

@section('content')
<div class="col-md-10 col-md-offset-1">
    <h3>
        Courses
    </h3>

    <div class="row">
        @include('user.professor._add_course')
    </div>

    <br>

    <div class="row">
        <table class="table">
            <tr class="row">
                <th class="col-lg-1 col-md-1 col-sm-1 text-center">Subject</th>
                <th class="col-lg-1 col-md-1 col-sm-1 text-center">Number</th>
                <th class="col-lg-9 col-md-9 col-sm-9 text-center">Title</th>
                <th class="col-lg-1 col-md-1 col-sm-1 text-center"></th>
            </tr>
            
            
            @foreach($my_courses as $course)
            <tr class="row">
                <td class="text-center">
                    <p>
                        {{ $course->subject_code }}
                    </p>
                </td>
                <td class="text-center">
                    <p>
                        {{ $course->number }}
                    </p>
                </td>
                <td >
                    <p>
                        {{$course->title}}
                    </p>
                </td>
                <td class="text-center">
                    @include('user.professor._remove_course')
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@stop