@extends('basePages.sac')

@section('content')
<div class="col-md-10 col-md-offset-1">
    @forelse($presentations as $index=>$p)
        <div class="col-md-10 col-md-offset-1">

            <div class="row ">
                <div class="col-lg-4 col-md-4 col-sm-4 info">
                    @include('presentations._presentation_info', ['p' => $p])
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 ">
                    {{$p->course->subject_code . " " . $p->course->number}}
                </div>

                <div class="col-lg-1 col-md-1 col-sm-1 text-center">
                    @if($p['our_nominee'])
                        <span title="OUR Nominee"><i class="fa fa-star fa-lg"></i></span>
                    @endif
                </div>

                @if($p['status'] == "S")
                    <div class="col-lg-2 col-md-2 col-sm-2">
                            @include('user._submit_presentation', ['id' => $p['id']])
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-1 text-center">
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
                @else
                    <div class="col-lg-3 col-md-3 col-sm-3 text-center">
                        <p class = "
                            @if($p->status == 'D')
                                label label-danger
                            @elseif($p->status == 'A')
                                label label-success
                            @else
                                label label-info
                            @endif">
                            {{ $p->status()->get()->first()->description }}
                        </p>
                    </div>
                @endif



                <div class="col-lg-1 col-md-1 col-sm-1 text-center">
                    <a href="{{ route('presentation.edit', $p['id'])}}"
                        class="btn btn-default">
                        Edit
                    </a>
                </div>

                <div class="col-lg-1 col-md-1 col-sm-1 text-center">
                    @include('basePages._delete_item', 
                    ['route_name' => 'presentation.destroy',
                        'id' => $p['id'], 'title' => 'Delete Presentation'])
                </div>

            </div>
        </div>
    @empty
        Start by adding courses to your account.
    @endforelse
</div>
@stop


