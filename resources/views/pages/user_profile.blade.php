@extends('layouts.app')

@section('container', 'profile-page')
@section('scripts')
<script defer type="text/javascript" src="/js/user_profile.js"> </script>
<script defer type="text/javascript" src="/js/join_event.js"> </script>
<script defer type="text/javascript" src="/js/admin.js"> </script>
<script defer type="text/javascript" src="/js/reports.js"> </script>
@endsection
@section('content')
<div id="content" class="container-fluid my-0 my-sm-5 profile-container" data-id="{{$user->id}}">
    @include('partials.banned_card',['object' => $user])
    @include('partials.report_modal')
    <div class="row">
        <div class="card-wrapper mx-auto w-100">
            <div class="card pb-4">
                <div class="card-header">
                    @include('partials.profile_header', ['user' => $user])
                    <div class="row justify-content-center mb-4">
                        <div class="col-6 col-sm-3 text-center">
                            @if ($follow)
                            <button class="btn btn-outline-secondary w-100 following" id="follow-button">Following</button>
                            @else
                            <button class="btn btn-secondary w-100 follow" id="follow-button">Follow</button>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('partials.profile_event_tabs', ['data' => [$joined, $hosting, $performing, $user]])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection