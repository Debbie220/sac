@extends('user.admin.basepage')

@section('header')
Pending Presentations
@stop

@section('admin_content')
<div class="table-responsive">
  <table class="table">
    <tr class="row">
      <th class="col-lg-1 col-md-6 col-sm-2 text-center">Title</th>
      <th class="col-lg-1 col-md-6 col-sm-2 text-center">Student(s)</th>
      <th class="col-lg-1 col-md-6 col-sm-2 text-center"></th>
      <th class="col-lg-1 col-md-6 col-sm-2 text-center"></th>

    </tr>
      @foreach($presentations as $p)
      <tr class="row">
        <td class="text-center">
          <a href="{!! route('presentation.edit', $p->id) !!}">
          {{$p->title}} </a>
        </td>
        <td class="text-center">
          <ul class="list-unstyled">
                    @foreach($p->students() as $student)
                        <li>{{ $student->student_name }}</li>
                    @endforeach
                    </ul>
        </td>
        <td class="text-center">

          <form action="{{ route('presentation.approve', $p->id)}}" role='form' method="POST">
            {{ csrf_field() }}
          	{{ method_field('PATCH') }}
            <div class="form-group">
                  <button type="submit" class="btn btn-default">
                     <i class="fa fa-thumbs-up"></i>Approve
                  </button>
            </div>
          </form>
        </td>
        <td class="text-center">
          <form action="{{ route('presentation.decline', $p->id)}}" role='form' method="POST">
            {{ csrf_field() }}
          	{{ method_field('PATCH') }}
            <div class="form-group">
                  <button type="submit" class="btn btn-default">
                       <i class="fa fa-thumbs-down"></i>Decline
                  </button>
            </div>
          </form>
        </td>
      </tr>
      @endforeach
  </table>
</div>


@stop
