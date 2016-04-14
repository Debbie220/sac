@extends('user.admin.basepage')

@section('admin_content')
<div class="contents">
  <div class=row>
    <div class='col-md-8'>
      <h1> Requests </h1>
    </div>
  </div>
  @if(count($users))
    <div class="table-responsive">
      <table class="table">
        <tr class="row">
          <th class="col-lg-1 col-md-6 col-sm-2 text-center">Name</th>
          <th class="col-lg-1 col-md-6 col-sm-2 text-center">Email address</th>
          <th class="col-lg-1 col-md-6 col-sm-2 text-center"></th>
          <th class="col-lg-1 col-md-6 col-sm-2 text-center"></th>

        </tr>
          @foreach($users as $u)
          <tr class="row">
            <td class="text-center">
              {{$u->name}}
            </td>
            <td class="text-center">
              {{$u->email}}
            </td>
            <td class="text-center">
              <form action="{{ route('role.approve', $u->id) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}


                <button type="submit" class="btn btn-default"
                    aria-label="Approve Request" title="Approve Request">
                  <i class="fa fa-thumbs-up"></i>
                  Approve
                </button>
              </form>
            </td>
            <td class="text-center">
              <form action="{{ route('role.decline', $u->id) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                <button type="submit" class="btn btn-default"
                    aria-label="Decline Request" title="Decline Request">
                  <i class="fa fa-thumbs-down"></i>
                  Decline
                </button>
              </form>
          </tr>
          @endforeach
      </table>
    </div>
    @else
      <h4>No change role requests yet!</h4>
    @endif
</div>

@stop
