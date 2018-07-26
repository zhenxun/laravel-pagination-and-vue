<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!-- Styles -->
        <link href="{{ asset('css/app.css?2018072301') }}" rel="stylesheet">


    </head>
    <body>
      <div id="app">
          @include('layouts.partials.menu')
        
          @yield('content')

      </div>
      
      <script src="{{ asset('js/app.js') }}" defer="defer"></script>
    </body>
</html>
