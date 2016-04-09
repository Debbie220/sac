@extends('basePages.sac')

@section('content')
    <div class="jumbotron">
        <h1> Welcome to the SAC registration system!</h1>
        <h2>
            <a  href="{{ url('/register') }}" class="btn btn-primary btn-lg"> Signup Now!</a> or
            <a  href="{{ url('/login') }}" class="btn btn-default btn-lg"> Login</a>
        </h2>

        <div class="g-signin2" data-onsuccess="onSignIn"></div>
        <a href="#" onclick="signOut();">Sign out</a>

    </div>
@endsection

@push('scripts')
<script type="text/javascript">
$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});

function onSignIn(googleUser) {
    var id_token = googleUser.getAuthResponse().id_token;

    var xhr = new XMLHttpRequest();
    xhr.open('GET', "https://www.googleapis.com/oauth2/v3/tokeninfo?id_token="+id_token);
    xhr.onload = function() {
          if(xhr.status == 200){

         } else {
            console.log("BOOH");
         }
    };
    xhr.send();
}
  function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      console.log('User signed out.');
    });
  }



    /**
     * Convenience function to validate email address domains. Allows
     * @ualberta.ca and @gmail.com addresses.
     */
    function validateEmail(email) {
        return /@ualberta.ca$/.test(email) || /@gmail.com$/.test(email);
    }

    /**
     * Returns the public ID of the current user, or false
     * if there is no current user.
     */
    function getCurrentUserId() {
        var user = getCurrentUser();
        return user ? user.id : false;
    }

    /**
     * Retrieves the current user object, or false if there
     * is no current user.
     * Use this instead of accessing the variable directly.
     */
    function getCurrentUser() {
        return _currentuser || false;
    }

    /**
     * Sets the current user object.
     * Use this instead of accessing the variable directly.
     */
    function setCurrentUser(user) {
        _currentuser = user;
    }

    /**
     * Handler for when the user signs in.
     */
    function onSignIn(authResult) {
        var user    = authResult.currentUser.get();
        var idToken = user.getAuthResponse().id_token;
        var email   = user.getBasicProfile().getEmail();
        var userPicURL = user.getBasicProfile().getImageUrl();
        if (!validateEmail(email)) {
            console.log("User's email domain is not permitted.");
            return;
        }

        var response = request('login.php', 'POST', { id_token: idToken });
        user = JSON.parse(response);

        // Hide sign-in button and show sign-out and account buttons
        $('#button-view-profile').removeClass('hidden');
        $('#button-view-profile').prepend('<img src="' + userPicURL + '" alt="USER PIC">');
        $('#button-sign-out').removeClass('hidden');
        $('#googleSignIn').addClass('hidden');

        console.log(user);

</script>
@endpush
