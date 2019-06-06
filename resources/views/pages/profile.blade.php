@extends('layouts.app')

@section('container', 'profile-page')
@section('scripts')
	<script defer type="module" src="/js/join_event.js"> </script>
@endsection

@section('content')
<div id ="content" class="container-fluid my-0 my-sm-5 profile-container">
@include('partials.banned_card',['object' => $user])
@include('partials.report_modal')
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
                    @include('partials.profile_event_tabs', ['events' => [$joined, $hosting, $performing, $user]])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

