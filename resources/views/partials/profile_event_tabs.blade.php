<ul class="nav justify-content-center mt-2" id="myTabProfile" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="joined-tab" data-toggle="tab" href="#joined" role="tab"
                aria-controls="joined" aria-selected="true">Joined</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="hosting-tab" data-toggle="tab" href="#hosting" role="tab"
                aria-controls="hosting" aria-selected="false">Hosting</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="performing-tab" data-toggle="tab" href="#performing" role="tab"
                aria-controls="performing" aria-selected="false">Performing</a>
        </li>
    </ul>
    <div class="tab-content my-3 mx-3" id="myTabProfile">
        <div class="tab-pane fade show active" id="joined" role="tabpanel"
            aria-labelledby="joined-tab">
            <div class="row">
                @each('partials.activity_event_card', $joined, 'event')
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