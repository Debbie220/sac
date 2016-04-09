@extends('basePages.sac')

@section('content')
    <div class="jumbotron">
        <h1> Welcome to the SAC registration system!</h1>
        <h2>
            <a  href="{{ url('/register') }}" class="btn btn-primary btn-lg"> Signup Now!</a> or
            <a  href="{{ url('/login') }}" class="btn btn-default btn-lg"> Login</a>
        </h2>

    </div>
@endsection
