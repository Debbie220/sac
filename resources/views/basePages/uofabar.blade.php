<nav class="navbar navbar-default uofa">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="{{ route('home') }}">
        <img alt="Augustana" class="uofatext" >
      </a>
    </div>
      @if(Auth::check())
        @include('user._user_navbar')
      @else
      
        <!-- Workaround to make the button appear with padding right -->
        <p class="navbar-text navbar-right"></p>
        <p class="navbar-text navbar-right">
          <span class="uofatext">
            You are not signed in.
          </span>
        </p>
      @endif
  </div>
</nav>
