<div class="col-12 mb-5">
    <div class="activity-message mb-2">
        <a href="{{ url('users/'.$participation->user_id) }}" class="user-tag">@<span>{{ $participation->username }}</span></a> 
        @if ($participation->type == 'Owner')
        has created an event.
        @elseif ($participation->type == 'Participant')
        has joined an event.
        @elseif ($participation->type == 'Host')
        start hosting an event
        @endif
    </div>

    @include('partials.activity_event_card', ['event' => $participation])
</div>