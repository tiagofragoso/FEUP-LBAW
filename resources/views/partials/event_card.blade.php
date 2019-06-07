<div class="col-12 col-md-6 col-lg-4">
    <a href="{{ url('events/'.$event->id) }}" class="event-card mb-5 hover-shadow link" tabindex="-1">
        <header class="w-100 position-relative event-header d-flex align-items-center">
            <img src="{{ $event->image() }}" class="h-100 w-100" alt="event image">
            <div class="position-absolute w-100 h-100 gradient-overlay"></div>
            <h6 class="position-absolute event-title px-3">
                {{ $event->title }}
            </h6>
        </header>
        <article class="event-info py-2">
            <div class="container-fluid">
                <div class="row d-flex align-items-center mt-1">
                    <i class="col-1 far fa-calendar-alt"></i>
                    <div class="col-10">
                        @if (!empty($event->start_date))
                        {{ \DateTime::createFromFormat('Y-m-d H:i:sO', $event->start_date)->format('D, d M Y') }}
                        @else
                        Unscheduled
                        @endif
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row d-flex align-items-center mt-1">
                    <i class="col-1 fas fa-map-marker-alt"></i>
                    <div class="col-10">
                        {{ $event->location }}
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row d-flex align-items-center mt-1">
                    <i class="col-1 fas fa-ticket-alt"></i>
                    <div class="col-10">
                        @if (!(empty($event->price)) && $event->price > 0)
                        {{ $event->price }} {{ $event->currency()->first()->getSymbol() }}
                        @else
                        FREE
                        @endif
                    </div>
                </div>
            </div>
        </article>
    </a>
</div>