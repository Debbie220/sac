@extends('user.admin.basepage')

@section('header')
Pending Presentations
@stop

@section('admin_content')
    @forelse($presentations as $index=>$p)
        <div class="row ">
            <div id="title" class="col-lg-6 col-md-6 col-sm-6 ">
                <h4>
                    <a data-toggle="collapse"
                        href="#{{$index}}" aria-expanded="false"
                        aria-controls="details">
                        {{$p['title']}}
                        @include('presentations.comments')
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

            <div class="col-lg-2 col-md-2 col-sm-2 text-center">
                <form action="{{ route('presentation.approve', $p->id)}}"
                    role='form' method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-thumbs-up"></i>Approve
                    </button>
                </form>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 text-center">
                  <button type="button" class="btn btn-default" onclick="comments();">
                    <i class="fa fa-thumbs-down"></i>Decline
                 </button>
            </div>
        </div>
        <br>
    @empty
        <h4>No presentations yet!</h4>
    @endforelse

    <br>
    <i class="fa fa-star fa-lg"></i> = OUR Nominee
    <br>
@stop

@push('scripts')
<script src="{{ asset('js/commenting.js') }}"></script>
@endpush
