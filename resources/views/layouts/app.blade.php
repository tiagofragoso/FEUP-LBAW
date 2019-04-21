<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Styles -->
  <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('libs/bootstrap/bootstrap.min.css') }}">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700|Rubik:400,700" rel="stylesheet">
  <script defer src="{{ asset('libs/libs/jQuery/jquery-3.0.0.slim.min.js') }}"></script>
  <script defer src="{{ asset('libs/libs/popper/popper.min.js') }}"></script>
  <script defer src="{{ asset('libs/libs/bootstrap/bootstrap.min.js') }}"></script>
  <script type="text/javascript">
    // Fix for Firefox autofocus CSS bug
    // See: http://stackoverflow.com/questions/18943276/html-5-autofocus-messes-up-css-loading/18945951#18945951
  </script>
  <script type="text/javascript" src={{ asset('js/app.js') }} defer>
  </script>
</head>

<body>
  @unless(Route::currentRouteName() == 'login' || Route::currentRouteName() == 'register')
  <header>
    <h1><a href="{{ url('/cards') }}">Thingy!</a></h1>
    @if (Auth::check())
    <a class="button" href="{{ url('/logout') }}"> Logout </a> <span>{{ Auth::user()->name }}</span>
    @endif
  </header>
  @endunless
  <section id="main">
    @yield('content')
  </section>
</body>

</html>