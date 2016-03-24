@extends('user.admin.basepage')

@section('header')
Courses
@stop

@section('admin_content')
  <table class="table">
    <tr class="row">
      <th class="col-lg-1 col-md-6 col-sm-2 text-center">Course code</th>
      <th class="col-lg-1 col-md-6 col-sm-2 text-center">Name</th>
    </tr>
      @foreach($courses as $course)
      <tr class="row">
        <td class="text-center">
          {{$course->subject_code . $course->number}}
        </td>
        <td class="text-center">
          {{$course->title}}
        </a>
        </td>
      </tr>
      @endforeach
  </table>
@stop
