@extends('user.admin.basepage')

@section('header')
Presentations
@stop

@section('admin_content')
    @forelse($presentations as $index=>$p)
        <div class="row ">
            <div class="col-lg-9 col-md-9 col-sm-9 ">
                <h4>
                    <a data-toggle="collapse"
                        href="#{{$index}}" aria-expanded="false"
                        aria-controls="details">
                        {{$p['title']}}
                    </a>
                </h4>
                <div id="{{$index}}" class="collapse">
                    <p>
                        <b>Course:</b> {{ $p->course()->get()->first()->toString() }}
                    </p>
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
                    <p>
                        <a href="{{ route('presentation.edit', $p['id'])}}"
                            class="btn btn-default">
                            Edit this presentation
                        </a>
                    </p>
                </div>
            </div>

            <div class="col-lg-1 col-md-1 col-sm-1 text-center">
                @if($p['our_nominee'])
                    <span title="OUR Nominee"><i class="fa fa-star fa-lg"></i></span>
                @endif
            </div>

            <div class="col-lg-1 col-md-1 col-sm-1 text-center">
                {{ $p->type()->get()->first()->description}}
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
    {{ $presentations->links() }}

    <i class="fa fa-star fa-lg"></i> = OUR Nominee
    <br>
@stop
