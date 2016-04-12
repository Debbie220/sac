@extends('user.admin.basepage')

@section('header')
Presentations
@stop

@section('admin_content')
<ul class="nav nav-tabs">
    <li role="presentation" class="{{ $status == 'A' ? 'active' : ''}}">
        <a href="{{ route('presentation.status', 'approved') }}">Approved</a>
    </li>
    <li role="presentation" class="{{ $status == 'P' ? 'active' : ''}}">
        <a href="{{ route('presentation.status', 'pending') }}">Pending Approval</a>
    </li>
    <li role="presentation" class="{{ $status == 'S' ? 'active' : ''}}">
        <a href="{{ route('presentation.status', 'saved') }}">Saved</a>
    </li>
    <li role="presentation" class="{{ $status == 'D' ? 'active' : ''}}">
        <a href="{{ route('presentation.status', 'declined') }}">Declined</a>
    </li>
</ul>

    @forelse($presentations as $index=>$p)
        <div class="row ">
            <div class="col-lg-5 col-md-5 col-sm-5 info">
                @include('presentations._presentation_info', ['p' => $p])
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

            @if($p->status == "P")
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
                    <a class="btn btn-default"
                        href="{{ route('presentation.decline', $p->id) }}">
                        <i class="fa fa-thumbs-down"></i>Decline
                    </a>
                </div>
            @else
                <div class="col-lg-2 col-md-2 col-sm-2 ">
                    <p class = "
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
                    </p>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 ">
                    {{$p->course->subject_code . " " . $p->course->number}}
                </div>
            @endif
        </div>
        <br>
    @empty
        <h4>No presentations yet!</h4>
    @endforelse

    <br>
    <small><i class="fa fa-star fa-lg"></i> = OUR Nominee</small>
    <br>

    
@stop