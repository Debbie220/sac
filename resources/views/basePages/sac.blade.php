<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head
    content must come *after* these tags -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,400italic|Abel" rel="stylesheet" type="text/css">
    @stack('style')
    <title> SAC - @yield('title')</title>
  </head>

  <body>
    <script type="text/javascript" src="{{ URL::asset('js/drag.js') }}"></script>
    @include('basePages.uofabar')

    @include('flash::message')

    <div class="container-fluid">
      @yield('content')
    </div>

    @include('basePages.uofafooter')

    <script src="{{ asset('js/all.js') }}"></script>

    @stack('scripts')

    <script>
        $('#flash-overlay-modal').modal();
    </script>
  </body>
</html>
