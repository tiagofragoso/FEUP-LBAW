@extends('layouts.app')

@section('container', 'auth-page')

@section('content')
<div class="w-100 min-vh-100 d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="mx-auto my-3 formContent p-5">
                <div class="row mb-5 justify-content-center">
                    <a href="/" class="col-7">
                        <img src="../assets/logo-vertical.svg" alt="sound.hub logo">
                    </a>
                </div>

                <form class="row mb-5 justify-content-center" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <div class="col-12 col-md-10 form-group">
                        <input name="email" type="email" class="form-control w-100 {{$errors->has('email')? 'is-invalid' : '' }}" placeholder="email" value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </span>
                        @endif
                    </div>
                    
                    <div class="col-12 col-md-10 form-group">
                        <input name="password" type="password" class="form-control w-100 {{$errors->has('password')? 'is-invalid' : '' }}" placeholder="password" required>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </span>
                        @endif
                    </div>

                    <div class="col-12 col-md-10 text-center form-group">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                    </div>

                    <div class="col-12 col-md-10 ">
                        <button type="submit" name="login" class="btn btn-primary w-100">
                            Login
                        </button>
                    </div>
                </form>
    
                <div class="row justify-content-center">
                    <div class="col-12 text-center">
                        Don't have an account? <a class="register" href="{{ route('register') }}">Sign up</a>
                    </div>
                    <div class="col-12 text-center">
                        Forgot your password? <a class="register"  href="{{ route('password.request') }}">Reset</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection