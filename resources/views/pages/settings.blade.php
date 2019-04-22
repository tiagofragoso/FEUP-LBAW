@extends('layouts.app')

@section('title', 'Settings')

@section('content')

<div class="container-fluid my-0 my-sm-5">
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
                    <div class="row justify-content-center">
                        <div class="col-6 mb-3 mt-3 text-center position-relative">
                            <img src="../assets/user.svg" alt="..." class="rounded-circle border border-green"
                                width="120" height="120">                                
                        </div>
                    </div>
                    <div class="row justify-content-center position-relative">
                        <div class="col-10 text-center">
                        <h3 class="card-title user-name">{{ $user->name }}</h3>
                        </div>
                    </div>
                    <div class="row justify-content-center mb-2">
                        <div class="col-10 text-center">
                            <p class="card-subtitle text-muted">@<span>{{ $user->username }}</span></p>
                        </div>
                    </div>
                    <div class="row justify-content-center mb-4">
                        <div class="col-4 text-right border-right pr-2">
                            <p class="card-text">{{ $user->followers }} followers</p>
                        </div>
                        <div class="col-4 text-left pl-0 ml-2">
                            <p class="card-text">{{ $user->following }} following</p>
                        </div>
                    </div>
                    <div class="row justify-content-center mb-3">
                        <div class="col text-center">
                            <a href="profile.html" class="card-link border-bottom">View profile</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group-name">
                        <label for="nameInput">Name</label>
                        <input type="email" class="form-control mb-3" id="nameInput"
                            placeholder="John Smith" value="{{ $user->name }}">
                    </div>
                    <div class="form-group-email">
                        <label for="emailInput">Email address</label>
                        <input type="email" class="form-control mb-3" id="emailInput"
                            placeholder="name@example.com" value="{{ $user->email }}">
                    </div>
                    <div class="form-group-username">
                        <label for="emailInput">Username</label>
                        <input type="username" class="form-control mb-3" id="usernameInput" placeholder="username" value="{{ $user->username }}">
                    </div>
                    <div class="form-group-date">
                        <label for="dateofbirthInput">Date of birth</label>
                        <input type="date" class="form-control" id="dateofbirthInput" placeholder="dd/mm/yyyy" value="{{ $user->birthdate }}">
                        <button type="submit" class="btn btn-primary mt-3">Submit </button>
                    </div>

                    <div class="form-group-pass">
                        <h4 class="change-password-title mt-5">Change password</h4>
                        <label for="passwordInput">Old password</label>
                        <input type="password" class="form-control mb-3" id="passwordInput" placeholder="Old password">
                        <label for="newpasswordInput">New password</label>
                        <input type="password" class="form-control mb-3" id="newpasswordInput" placeholder="New password">
                        <label for="newpasswordInput">Repeat new password</label>
                        <input type="password" class="form-control" id="repeatpasswordInput" placeholder="Repeat password">
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
