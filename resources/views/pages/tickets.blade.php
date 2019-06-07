@extends('layouts.app')

@section('container', 'profile-page')
@section('scripts')
    <script defer type="module" src="/js/profile_invites.js"></script>
    <script defer type="module" src="/js/tickets.js"></script>
@endsection

@section('content')
<div class="container-fluid my-0 my-sm-5 profile-container">
    <div class="row">
        <div class="card-wrapper mx-auto w-100">
            <div class="card pb-4">
                <div class="card-header">
                    @include('partials.profile_header', ['user' => $user])
                    <div class="row justify-content-center mb-3">
                        <div class="col text-center">
                            <a href="/profile" class="card-link border-bottom">View profile</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container">
                        @if (count($tickets) === 0)
                            <div class="row justify-content-center">
                                <span class="text-center">
                                You haven't purchased any tickets.
                                </span>
                                @else
                            <div class="row">
                                @each('partials.ticket_card', $tickets, 'ticket')
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

