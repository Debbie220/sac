<div class="col-md-offset-1">
    @forelse($presentations as $p)
    <div class="row ">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
            <h4>
                <a href="{{ route('presentation.edit', $p['id'])}}">
                    {{$p['title']}}
                </a>
            </h4>

            <p>
                {{$p['abstract']}}
            </p>
            @if($p['status'] == 'D')
                <p>
                    <div class="alert alert-info" role="alert">
                        <h4>Comments: </h4>
                        <p> {{$p['comments']}}</p>
                    </div>
                </p>
            @endif
        </div>

        <div class="col-lg-1 col-md-1 col-sm-1 text-center">
            @if($p['our_nominee'])
                <i class="fa fa-star fa-lg"></i>
            @endif
        </div>

        <div class="col-lg-1 col-md-1 col-sm-1 text-center">
            {{ $p->type()->get()->first()->description}}
        </div>

        <div class="col-lg-1 col-md-1 col-sm-1 ">
            <span class = "
                @if($p->status == 'S')
                    alert-warning
                @elseif($p->status == 'D')
                    alert-danger
                @elseif($p->status == 'A')
                    alert-success
                @else
                    alert-info
                @endif">
                {{ $p->status()->get()->first()->description }}
            </span>
        </div>

        <div class="col-lg-1 col-md-1 col-sm-1 text-center">
            @if($p['status'] == "S" || $p['status'] == "D")
                @include('user._submit_presentation', ['id' => $p['id']])
            @endif
        </div>

        <div class="col-lg-1 col-md-1 col-sm-1 text-center">
            @include('user._delete_presentation', ['id' => $p['id']])
        </div>

    </div>
    <br>
    @empty
        <h4>No presentations here!</h4>
    @endforelse
</div>