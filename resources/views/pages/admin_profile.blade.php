@extends('layouts.app')

@section('title', 'Admin')
@section('container', 'profile-page')
@section('scripts')
    <script defer type="module"  src="/js/admin.js"> </script>
@endsection

@section('content')
<div class="container-fluid my-0 my-sm-5 profile-container">
    <div class="row">
        <div class="card-wrapper mx-auto w-100">
            <div class="card pb-4">
                <div class="card-header">
                    @include('partials.admin_header', ['user' => Auth::user()])
                    <div class="row justify-content-center mb-3">
                        <div class="col text-center">
                            <a href="{{ url('/settings')}}" class="card-link border-bottom">Settings</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('partials.reports')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

