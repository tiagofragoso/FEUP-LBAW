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

                <form class="row mb-5 justify-content-center" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                    <div class="col-12 col-md-10 form-group">
                        <input name="email" type="email" class="form-control w-100" value="{{ old('email') }}" placeholder="email" required autofocus>
                        @if ($errors->has('email'))
                          <span class="error">
                              {{ $errors->first('email') }}
                          </span>
                        @endif
                    </div>

                    <div class="col-12 col-md-10 form-group">
                        <input name="username" type="text" class="form-control w-100" value="{{ old('username') }}" placeholder="username" required>
                        @if ($errors->has('username'))
                          <span class="error">
                              {{ $errors->first('username') }}
                          </span>
                        @endif
                    </div>
                    
                    <div class="col-12 col-md-10 form-group">
                        <input name="password" type="password" class="form-control w-100" placeholder="password" required>
                        @if ($errors->has('password'))
                          <span class="error">
                              {{ $errors->first('password') }}
                          </span>
                        @endif
                    </div>

                    <div class="col-12 col-md-10 form-group">
                        <input name="password_confirmation" type="password" class="form-control w-100" placeholder="repeat password" required>
                    </div>
    
                    <div class="col-12 col-md-10 ">
                        <button type="submit" name="login" class="btn btn-primary w-100">
                            Register
                        </button>
                    </div>
                </form>
    
                <div class="row justify-content-center">
                    <div class="col-12 text-center">
                        Already have an account? <a class="register" href="{{ route('login') }}">Sign in</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
