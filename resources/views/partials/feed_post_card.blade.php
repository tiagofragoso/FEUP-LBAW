<div class="col-12 mb-5">
    <div class="activity-message mb-2">
        <a href="{{ url('users/'.$post->author->id) }}" class="user-tag">@<span>{{ $post->author->username }}</span></a> has posted on an event you joined.
    </div>

    <div class="card container-fluid hover-shadow" tabindex="-1">
        <div class="row post-card-header align-items-center">
            <div class="col-12">
                <a href="{{ url('events/'.$post->event_id) }}">
                    <h5 class="mb-0 event-title px-0 px-md-3">{{ $post->event_title }}</h5>
                </a>
            </div>
        </div>

        <div class="nested-post">
            @include('partials.post', ['post' => $post])
        </div>
    </div>
</div>