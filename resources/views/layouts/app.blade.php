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
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('libs/bootstrap/bootstrap.min.css') }}">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700|Rubik:400,700" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('libs/cropper/cropper.min.css') }}">
  <script defer src="{{ asset('libs/jQuery/jquery-3.0.0.slim.min.js') }}"></script>
  <script defer src="{{ asset('libs/popper/popper.min.js') }}"></script>
  <script defer src="{{ asset('libs/bootstrap/bootstrap.min.js') }}"></script>
  <script defer src="{{ asset('libs/cropper/cropper.min.js') }}"></script>
  <script type="text/javascript">
    // Fix for Firefox autofocus CSS bug
    // See: http://stackoverflow.com/questions/18943276/html-5-autofocus-messes-up-css-loading/18945951#18945951
  </script>
  <script type="text/javascript" src="{{ asset('js/app.js') }}" defer>
  </script>
</head>

<body>
  @unless(Route::currentRouteName() == 'login' || Route::currentRouteName() == 'register')
  @include('partials.navbar')
  @endunless
 
  @yield('content')

  @unless(Route::currentRouteName() == 'login' || Route::currentRouteName() == 'register')
  @include('partials.footer')
  @endunless
</body>

</html>
