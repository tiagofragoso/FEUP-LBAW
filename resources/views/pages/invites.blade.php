@extends('layouts.app')

@section('container', 'profile-page')
@section('scripts')
@endsection

@section('content')
<div class="container-fluid my-0 my-sm-5 profile-container">
    <div class="row">
        <div class="card-wrapper mx-auto w-100">
            <div class="card pb-4">
                <div class="card-header">
                    @include('partials.profile_header', ['user' => $user])
                    <div class="row mb-3 justify-content-center">
                        <div class="col-2 text-right ">
                            <a class="card-link border-bottom" data-toggle="collapse" href="#mytickets"
                                role="button" aria-expanded="false" aria-controls="mytickets">My tickets</a>
                        </div>
                        <div class="col-2 text-center">
                                <a href="{{ url('/invites')}}" class="card-link border-bottom">Invites</a>
                            </div>
                        <div class="col-2 text-left">
                            <a href="{{ url('/settings')}}" class="card-link border-bottom">Settings</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container">
                        <div class="row justify-content-center">
                            @each('partials.invite_card', $invites, 'invite')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

