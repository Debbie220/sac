@extends('user.admin.basepage')

@section('header')
Courses
@stop

@section('add_object')
<a href="{{route('course.add')}}" class="btn btn-primary">Check for new Courses</a>
@stop

@section('admin_content')
    @forelse($courses as $course)
        <div class="row ">
            <div class="col-lg-1 col-md-1 col-sm-1 text-center">
                <p>{{$course->subject_code}}</p>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-1 text-center">
                <p>{{$course->number}}</p>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 ">
                <p>{{$course->title}}</p>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-1 text-center">
                <p>{{ $course->offered_this_semester ? 'Offered' : 'Not'}}</p>
            </div>
        </div>
    @empty
        <h4>No courses yet!</h4>
    @endforelse

{{$courses->links()}}
@stop

