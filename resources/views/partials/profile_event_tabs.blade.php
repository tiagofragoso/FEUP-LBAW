<ul class="nav justify-content-center mt-2" id="myTabProfile" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="joined-tab" data-toggle="tab" href="#joined" role="tab" aria-controls="joined"
            aria-selected="true">Joined</a>
    </li>
    @unless (count($hosting) == 0)
    <li class="nav-item">
        <a class="nav-link" id="hosting-tab" data-toggle="tab" href="#hosting" role="tab" aria-controls="hosting"
            aria-selected="false">Hosting</a>
    </li>
    @endunless
    @unless (count($performing) == 0)
    <li class="nav-item">
        <a class="nav-link" id="performing-tab" data-toggle="tab" href="#performing" role="tab"
            aria-controls="performing" aria-selected="false">Performing</a>
    </li>
    @endunless
</ul>
<div class="tab-content my-3 mx-3" id="myTabProfile">
    <div class="tab-pane fade show active" id="joined" role="tabpanel" aria-labelledby="joined-tab">
        <div class="row">
            @if (count($joined) == 0)
            <div class="text-muted col-12 col-md-10 mx-auto mt-5 d-flex justify-content-center">
                @if (Auth::check() && Auth::user()->id == $user->id)
                <span class="text-center">
                    You haven't joined any events yet.
                    <a href="{{ url('/search')}}" class="card-link border-bottom ml-2"> Go discover.</a>
                </span>
                @else
                <span class="text-center">
                    This user hasn't joined any events.
                </span>
                @endif
            </div>
            @else
            @each('partials.activity_event_card', $joined, 'event')
            @endif
        </div>
    </div>
    <div class="tab-pane fade" id="hosting" role="tabpanel" aria-labelledby="performing-tab">
        <div class="row">
            @each('partials.activity_event_card', $hosting, 'event')
        </div>
    </div>
    <div class="tab-pane fade" id="performing" role="tabpanel" aria-labelledby="performing-tab">
        <div class="row">
            @each('partials.activity_event_card', $performing, 'event')
        </div>
    </div>
</div>