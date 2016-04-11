@extends('user.admin.basepage')

@section('header')
Presentations
@stop

@section('admin_content')
<ul class="nav nav-tabs">
  <li role="presentation"><a href="{{ route('presentation.status', 'approved') }}">Approved</a></li>
  <li role="presentation"><a href="{{ route('presentation.status', 'pending') }}">Pending Approval</a></li>
  <li role="presentation"><a href="{{ route('presentation.status', 'saved') }}">Saved</a></li>
  <li role="presentation"><a href="{{ route('presentation.status', 'declined') }}">Declined</a></li>
</ul>
    @forelse($courses as $course)
        <h3>
            {{ $course->toString() }}
        </h3>

        @forelse($course->presentations as $index=>$p)
            <div class="row ">
                <div class="col-lg-8 col-md-8 col-sm-8 ">
                    <h4>
                        <a data-toggle="collapse"
                            href="#{{$index . $p->id}}" aria-expanded="false"
                            aria-controls="details">
                            {{$p['title']}}
                        </a>
                    </h4>
                    <div id="{{$index . $p->id}}" class="collapse">
                        <p>
                            <b>Professor:</b> {{ $p['professor_name'] }}
                        </p>
                        <p>
                            <b>Students:</b>
                            <ul class="list-unstyled">
                            @foreach($p->students() as $student)
                                <li>{{ $student->student_name }}</li>
                            @endforeach
                            </ul>
                        </p>
                        <p>
                            <b>Abstract:</b> {{$p['abstract']}}
                        </p>
                    </div>
                </div>

                <div class="col-lg-1 col-md-1 col-sm-1 text-center">
                    <a href="{{ route('presentation.edit', $p['id'])}}"
                        class="btn btn-default">
                        Edit
                    </a>
                </div>

                <div class="col-lg-1 col-md-1 col-sm-1 text-center">
                    @if($p['our_nominee'])
                        <span title="OUR Nominee"><i class="fa fa-star fa-lg"></i></span>
                    @endif
                </div>

            <div class="col-lg-1 col-md-1 col-sm-1 ">
                <span class = "
                    @if($p->status == 'S')
                        label label-warning
                    @elseif($p->status == 'D')
                        label label-danger
                    @elseif($p->status == 'A')
                        label label-success
                    @else
                        label label-info
                    @endif">
                    {{ $p->status()->get()->first()->description }}
                </span>
              </div>
            </div>
            <br>
        @empty
            <h4>No presentations yet!</h4>
        @endforelse
    @empty
        No courses or presentations.
    @endforelse

    {{ $courses->links() }}

    <br>
    <small><i class="fa fa-star fa-lg"></i> = OUR Nominee</small>
    <br>
@stop
