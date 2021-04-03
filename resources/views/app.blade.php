<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Laravel Vue Boilerplate" />
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>HuntBazaar</title>
  </head>
  <body>
    <div id="app">
      @yield('content')
    </div>

    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
  </body>
</html>
