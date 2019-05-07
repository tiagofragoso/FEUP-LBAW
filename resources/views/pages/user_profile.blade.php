@extends('layouts.app')

@section('content')
<div class="container-fluid my-0 my-sm-5 profile-container">
    <div class="row">
        <div class="card-wrapper mx-auto w-100">
            <div class="card pb-4">
                    <div class="card-header">
                        @include('partials.profile_header', ['user' => $user])
                        <div class="row justify-content-center mb-4">
                            <div class="col-6 col-sm-3 text-center">                    
                                <button class="btn btn-secondary w-100" id ="follow-button">Follow</button>
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

<script src="/js/user_profile.js"></script>
@endsection