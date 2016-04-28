<div class="col-md-10 col-md-offset-1">
    <h1>
        Presentations
    </h1>
    <div class="col-md-offset-1">
        @forelse($presentations as $p)
            @include('user._presentations_table')
        @empty
            <h4>No presentations here!</h4>
        @endforelse
    </div>
</div>
