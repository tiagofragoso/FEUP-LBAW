<ul class="nav justify-content-center mt-2" id="myTabProfile" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="joined-tab" data-toggle="tab" href="#joined" role="tab" aria-controls="joined" aria-selected="true">Pending</a>
    </li>
    @unless (count($acceptedReports) == 0)
    <li class="nav-item">
        <a class="nav-link" id="hosting-tab" data-toggle="tab" href="#hosting" role="tab" aria-controls="hosting" aria-selected="false">All reports</a>
    </li>
    @endunless
</ul>
<div class="tab-content my-3 mx-3" id="myTabProfile">
    <div class="tab-pane fade show active" id="joined" role="tabpanel" aria-labelledby="joined-tab">
        <div class="row">
            @if (count($pendingReports) == 0)
            <div class="text-muted col-12 col-md-10 mx-auto mt-5 d-flex justify-content-center">
                @if (Auth::check() && Auth::user()->id == $user->id)
                <span class="text-center">
                    There isn't pending reports.
                    <a href="{{ url('/search')}}" class="card-link border-bottom ml-2"> Go discover.</a>
                </span>
                @endif
            </div>
            @else
            <div class="card-body">
                <div class="tab-content my-3 mx-3" id="adminTab">
                    <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                        <div class="container">
                            <div class="row justify-content-center">
                                @each('partials.reported_user_card', $pendingReports['user'], 'user') 
                                @each('partials.reported_event_card',  $pendingReports['event'], 'event')
                                
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>