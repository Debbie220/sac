@extends('user.admin.basepage')

@section('header')
Courses
@stop

@section('add_object')
 <form action="{{route('course.add')}}" method="POST">
    {{ csrf_field() }}

    <button type="submit" class="btn btn-primary"
            aria-label="Delete Presentation" title="Delete Presentation">
            Check for new Courses
    </button>
</form>
@stop

@section('admin_content')
    <div class="row">
        <div class="col-lg-6">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button">Search</button>
                </span>
            </div><!-- /input-group -->
        </div><!-- /.col-lg-6 -->
    </div>
    <br>
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

