@extends('layouts.app')

@section('content')
<div class="w-100 min-vh-100 d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="mx-auto my-3 formContent p-5">
                <div class="row mb-5 justify-content-center">
                    <a href="/" class="col-7">
                        <img src="../assets/logo-vertical.svg" alt="sound.hub logo">
                    </a>
                </div>

                <form class="row mb-5 justify-content-center" action="{{ route('login') }}">
                    <div class="col-12 col-md-10 form-group">
                        <input type="email" class="form-control w-100" placeholder="email" required autofocus>
                    </div>
                    
                    <div class="col-12 col-md-10 form-group">
                        <input type="password" class="form-control w-100" placeholder="password" required>
                    </div>
    
                    <div class="col-12 col-md-10 ">
                        <button type="submit" name="login" class="btn btn-primary w-100">
                            Login
                        </button>
                    </div>
                </form>
    
                <div class="row justify-content-center">
                    <div class="col-12 text-center">
                        Don't have an account? <a class="register" href="{{ route('register') }}">Sign up </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- <form method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}

    <label for="email">E-mail</label>
    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
    @if ($errors->has('email'))
        <span class="error">
          {{ $errors->first('email') }}
        </span>
    @endif

    <label for="password" >Password</label>
    <input id="password" type="password" name="password" required>
    @if ($errors->has('password'))
        <span class="error">
            {{ $errors->first('password') }}
        </span>
    @endif

    <label>
        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
    </label>

    <button type="submit">
        Login
    </button>
    <a class="button button-outline" href="{{ route('register') }}">Register</a>
</form> -->

