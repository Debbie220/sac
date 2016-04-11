<div class="col-md-10 col-md-offset-1">
    <div class="row">
        <div class= "col-md-2">
            @include('user.admin._sidebar')
        </div>
        <div class="col-md-10">
            @if(current_conference())
                You have {{count_presentations()}} presentations under this conference
            @else
                You haven't created a conference yet!
            @endif
        </div>
    </div>
</div>