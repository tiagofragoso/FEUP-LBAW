<div class="col-12 mb-5">
    <div class="activity-message mb-2">
        @if (Auth::user()->id == $participation->user_id)
        You have 
        @else
        <a href="{{ url('users/'.$participation->user_id) }}" class="user-tag">@<span>{{ $participation->username }}</span></a> has 
        @endif
        @if ($participation->type == 'Owner')
        created an event.
        @elseif ($participation->type == 'Participant')
        joined an event.
        @elseif ($participation->type == 'Host')
        started hosting an event
        @endif
    </div>

    @include('partials.activity_event_card', ['event' => $participation])
</div>