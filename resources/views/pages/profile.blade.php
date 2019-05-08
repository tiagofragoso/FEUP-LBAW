@extends('layouts.app')

@section('container', 'profile-page')

@section('content')
<div class="container-fluid my-0 my-sm-5 profile-container">
    <div class="row">
        <div class="card-wrapper mx-auto w-100">
            <div class="card pb-4">
                <div class="card-header">
                    @include('partials.profile_header', ['user' => $user])
                    <div class="row justify-content-center mb-3">
                        <div class="col text-right">
                            <a class="card-link border-bottom" data-toggle="collapse" href="#mytickets"
                                role="button" aria-expanded="false" aria-controls="mytickets">My tickets</a>
                        </div>
                        <div class="col text-left">
                            <a href="{{ url('/settings')}}" class="card-link border-bottom">Settings</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('partials.profile_event_tabs', ['events' => [$joined, $hosting, $performing, $user]])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

