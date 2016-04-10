@if(Auth::user()->is_student())
  @if(Auth::User()->requested_new_role == false)
    @include('user.student._navbar')
  @endif
@elseif(Auth::user()->is_professor())
  @include('user.professor._navbar')
@endif
<p class="navbar-text">
  <a href="{{ route('presentation.create') }}">
    <span class="uofatext">
      <i class="fa fa-plus-square"></i>
      Presentation
    </span>
  </a>
</p>

<!-- Workaround to make the button appear with padding right -->
<p class="navbar-text navbar-right"></p>

<p class="navbar-text navbar-right">
  <a onclick="signOut();">
    <span class="uofatext">
      <i class="fa fa-sign-out"></i>
      Log out
    </span>
  </a>
</p>

@push('scripts')
<script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>

<script type="text/javascript">
    function signOut() {
        var auth2 = gapi.auth2.getAuthInstance();
        auth2.signOut().then(function () {
            console.log('User signed out.');
        });
        $.ajax({
            type: "GET",
            url: "{{ route('logout') }}",
            success: function (data) {
                location.reload();
            },
            error: function (data) {
                console.log('Error:', data.responseText);
            }
        });
    }

    function onLoad() {
      gapi.load('auth2', function() {
        gapi.auth2.init();
      });
    }
</script>
@endpush
