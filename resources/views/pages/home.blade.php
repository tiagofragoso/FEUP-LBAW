@extends('layouts.app')

@section('title', 'Home')
@section('container', 'home-page')

@section('scripts')
<script type="module" src="js/posts.js"></script>
<script type="module" src="js/join_event.js"></script>
<script type="module" src="js/comments.js"></script>
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
        @foreach ($activity as $a)
            @if ($a->type == 'Post' || $a->type == 'Poll' || $a->type == 'File')
                @include('partials.feed_post_card', ['post' => $a])
            @else
                @include('partials.participation_card', ['participation' => $a])
            @endif
        @endforeach
    </div>
</div>
@endsection