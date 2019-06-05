@extends('layouts.app')

@section('title', 'Home')
@section('container', 'home-page')

@section('scripts')

@endsection

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h2>
                Trending events
            </h2>
        </div>
    </div>

    <div class="row">
        @foreach ($events as $event)
            @include('partials.event_card', ['event' => $event])
        @endforeach
    </div>

    <div class="row mb-5">
        <div class="col-12">
            <h2 class="mt-5">
                Activity
            </h2>
        </div>
    </div>

    <div class="row">
        @include('partials.participation_card')

        @include('partials.feed_post_card')

        @include('partials.participation_card')

        @include('partials.feed_poll_card')
    </div>
</div>
@endsection