@extends('layouts.app')

@section('title', 'Search')
@section('container', 'search-page')

@section('scripts')
	<script defer type="text/javascript" src="/js/search.js"> </script>
@endsection

@section('content')
<span class="position-absolute trigger"><!-- hidden trigger to apply 'stuck' styles --></span>
<div class="d-flex banner-container justify-content-center align-items-center">
    <div class="container mx-2 mx-sm-0 search-container">
        <div class="row">
            <h1 class="col-12 slogan mb-3">
                Sound.hub, where sound meets.
            </h1>
            <h5 class="col-12 slogan-sub mb-3">
                Search for worldwide music events to collaborate and attend at any time and place.
            </h5>
        </div>
        <form class="container search-card p-4" action="#results-container">
            <div class="row">
                <div class="col-12 input-group mb-3">
                    <input type="text" class="form-control py-3 py-md-4 h-100" placeholder="Search..." id="search-input" aria-describedby="button-go">
                    <div class="input-group-append h-100">
                        <button type="submit" class="btn btn-primary px-2 px-sm-4 px-md-5 w-100" type="button" id="button-go">Go!</button>
                    </div>
                </div>
            </div>
            <div class="row">
                @include('partials.search_filters')
            </div>
        </form>
    </div>
    <div class="banner-overlay w-100 h-100 position-absolute"></div>
</div>

<div class="container mt-5" id="results-container">
    <div class="row">
        <div class="col-12">
            <h2>
                Search for: <span id="search-query">Trending events</span>
            </h2>
        </div>
    </div>
    <div class="row mt-3 mb-5">
        @include('partials.search_filters')
    </div>

    <div class="row">
        @for ($i = 0; $i < 6; $i++)
            @include('partials.event_card')
        @endfor
    </div>
</div>
@endsection