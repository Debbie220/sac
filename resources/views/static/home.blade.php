@extends('basePages.sac')

@section('content')
    <div class="jumbotron">
        <h1> Welcome to the SAC registration system!</h1>
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

    /**
     * The following code was created by the ride share app group
     * (github.com/AUCSC/ride) and it's used and modified with their permission
     */

    /**
     * Convenience function to validate email address domains. Allows
     * @ualberta.ca addresses
     */
    function validateEmail(email) {
        return /@ualberta.ca$/.test(email);
    }


    /**
     * Handler for when the user signs in.
     */
    function onSignIn(authResult) {
        var user = authResult.getBasicProfile();

        var idToken = authResult.getAuthResponse().id_token;
        var email   = user.getEmail();
        if (!validateEmail(email)) {
            console.log("User's email domain is not permitted.");
            return;
        }

        $.ajax({
            type: "POST",
            url: "{{ route('test') }}",
            data: {id_token : idToken},
            success: function (data) {
                console.log(data);
            },
            error: function (data) {
                console.log('Error:', data.responseText);
            }
        });

    }

    function signOut() {
        var auth2 = gapi.auth2.getAuthInstance();
        auth2.signOut().then(function () {
            console.log('User signed out.');
        });
    }


        // var response = request('login.php', 'POST', { id_token: idToken });
        // user = JSON.parse(response);

        // // Hide sign-in button and show sign-out and account buttons
        // $('#button-view-profile').removeClass('hidden');
        // $('#button-view-profile').prepend('<img src="' + userPicURL + '" alt="USER PIC">');
        // $('#button-sign-out').removeClass('hidden');
        // $('#googleSignIn').addClass('hidden');

        // console.log(user);


</script>
@endpush
