@extends('layouts.app')

@section('title', 'Settings')

@section('content')

<div class="container-fluid my-0 my-sm-5 profile-container">
    <div class="row">
        <div class="card-wrapper mx-auto w-100">
            <div class="card pb-4">
                <div class="card-header position-relative">
                    <div class="dropdown position-absolute more-button">
                        <button class="btn btn-light border-light" type="button" id="deleteAccount"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="deleteAccount">
                            <a class="dropdown-item" href="#">Delete account</a>
                        </div>
                    </div>
                    @include('partials.profile_header', ['user' => $user])
                    <div class="row justify-content-center mb-3">
                        <div class="col text-center">
                            <a href="/profile" class="card-link border-bottom">View profile</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group-name mb-3">
                        <label for="nameInput">Name</label>
                        <input type="email" class="form-control" id="nameInput" placeholder="John Smith" value="{{ $user->name }}">
                        <span id="name-errors"></span>
                    </div>
                    <div class="form-group-email mb-3">
                        <label for="emailInput">Email address</label>
                        <input type="email" class="form-control" id="emailInput" placeholder="name@example.com" value="{{ $user->email }}">
                        <span id="email-errors"></span>
                    </div>
                    <div class="form-group-username mb-3">
                        <label for="emailInput">Username</label>
                        <input type="username" class="form-control" id="usernameInput" placeholder="username" value="{{ $user->username }}">
                        <span id="username-errors"></span>
                    </div>
                    <div class="form-group-date">
                        <label for="dateofbirthInput">Date of birth</label>
                        <input type="date" class="form-control" id="dateofbirthInput" placeholder="dd/mm/yyyy" value="{{ $user->birthdate }}">
                        <span id="birthdate-errors"></span>
                        <button type="submit" class="btn btn-primary mt-3" id="profile-submit">Submit</button>
                    </div>

                    <div class="form-group-pass">
                        <h4 class="change-password-title mt-5">Change password</h4>
                        <label for="passwordInput">Old password</label>
                        <input type="password" class="form-control" id="passwordInput" placeholder="Old password">
                        <span id="password-errors"></span>
                        <label class="mt-3" for="newpasswordInput">New password</label>
                        <input type="password" class="form-control" id="newpasswordInput" placeholder="New password">
                        <span id="new-password-errors"></span>
                        <label class="mt-3" for="newpasswordInput">Repeat new password</label>
                        <input type="password" class="form-control" id="repeatpasswordInput" placeholder="Repeat password">
                        <button type="submit" class="btn btn-primary mt-3" id="password-submit">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/settings.js"></script>

@endsection
