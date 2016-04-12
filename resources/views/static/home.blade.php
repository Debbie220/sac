@extends('basePages.sac')

@section('content')
    <div class="jumbotron">
        <h1> Welcome to the SAC registration system!</h1>
    </div>

    <h2>
        Sign in with your ualberta account and start to manage your presentations for SAC!
    </h2>
    <br>
    <center>
        <div class="g-signin2" data-onsuccess="onSignIn"></div>
    </center>
@endsection

@push('scripts')
<script src="https://apis.google.com/js/platform.js" async defer></script>

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
            url: "{{ route('login') }}",
            data: {id_token : idToken},
            success: function (data) {
                location.reload();
            },
            error: function (data) {
                console.log('Error:', data.responseText);
            }
        });

    }
</script>
@endpush
