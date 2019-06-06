<<<<<<< HEAD
<div class="activity-event-card d-flex align-items-center hover-shadow"
    tabindex="-1">
    <div class="w-25 h-100 overflow-hidden d-flex justify-content-center">
        <img class="h-100" src="../assets/event-placeholder.png" alt="">
    </div>
    <div class="d-flex align-items-center w-75">
        <div class="container-fluid">
            <div class="row align-items-center">
                <a href="{{ url('events/' . $event->id)}}" class="col-12 event-link">
                    <h5 class="event-title">
                        {{$event->title}}
                    </h5>
                </a>
=======
<div class="col-12 col-md-10 mx-auto mt-5">
        <div class="activity-event-card d-flex align-items-center hover-shadow"
            tabindex="-1">
            <div class="w-25 h-100 overflow-hidden d-flex justify-content-center">
            <img class="h-100" src="{{ $event->image() }}" alt="">
            </div>
            <div class="d-flex align-items-center w-75">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <a href="{{ url('events/' . $event->id)}}" class="col-12 event-link">
                            <h5 class="event-title">
                               {{$event->title}}
                            </h5>
                        </a>
>>>>>>> develop

                <div class="col-7 col-md-9 mt-4">
                    <div class="text-muted event-date">{{(new DateTime($event->start_date))->format('j M Y')}}</div>
                    <div class="text-muted event-location">{{$event->location}}</div>
                </div>

                <div class="col-5 col-md-3 mt-4">
                    @if (isset($event->joined) && $event->joined)
                        <button type="button"
                        class="btn btn-outline-primary join-btn joined w-100" data-id="{{$event->id}}">
                        Joined
                    </button>
                    @else
                    <button type="button"
                        class="btn btn-primary join-btn join w-100" data-id="{{$event->id}}">
                        Join
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>