@extends('layouts.app')

@section('scripts')
	<script defer type="text/javascript" src="/js/settings.js"> </script>
@endsection

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
                    <div class="form-group-general">
                        <div class="form-group-name mb-3">
                            <label for="nameInput">Name</label>
                            <input type="email" class="form-control" id="nameInput" placeholder="John Smith" value="{{ $user->name }}">
                            <span class="errors-container" id="name-errors"></span>
                        </div>

                        <div class="form-group-email mb-3">
                            <label for="emailInput">Email address</label>
                            <input type="email" class="form-control" id="emailInput" placeholder="name@example.com" value="{{ $user->email }}">
                            <span class="errors-container" id="email-errors"></span>
                        </div>

                        <div class="form-group-username mb-3">
                            <label for="emailInput">Username</label>
                            <input type="username" class="form-control" id="usernameInput" placeholder="username" value="{{ $user->username }}">
                            <span class="errors-container" id="username-errors"></span>
                        </div>

                        <div class="form-group-date">
                            <label for="dateofbirthInput">Date of birth</label>
                            <input type="date" class="form-control" id="dateofbirthInput" placeholder="dd/mm/yyyy" value="{{ $user->birthdate }}">
                            <span class="errors-container" id="birthdate-errors"></span>
                        </div>

                        <div class="d-flex align-items-center mt-3">
                            <button type="submit" class="btn btn-primary" id="profile-submit">Submit</button>
                            <div class="success d-none" id="general-message">Information saved with success.</div>
                        </div>
                    </div>
                    

                    <div class="form-group-pass">
                        <h4 class="change-password-title mt-5">Change password</h4>

                        <div>
                            <label for="passwordInput">Old password</label>
                            <input type="password" class="form-control" id="passwordInput" placeholder="Old password">
                            <span class="errors-container" id="password-errors"></span>
                        </div>

                        <div class="mt-3">
                            <label for="newpasswordInput">New password</label>
                            <input type="password" class="form-control" id="newpasswordInput" placeholder="New password">
                            <span class="errors-container" id="new-password-errors"></span>
                        </div>

                        <div class="mt-3">
                            <label for="newpasswordInput">Repeat new password</label>
                            <input type="password" class="form-control" id="repeatpasswordInput" placeholder="Repeat password">
                        </div>

                        <div class="d-flex align-items-center mt-3">
                            <button type="submit" class="btn btn-primary" id="password-submit">Submit</button>
                            <div class="success d-none" id="password-message">Password updated with success.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
