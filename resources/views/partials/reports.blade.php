<ul class="nav justify-content-center mt-2" id="myTabProfile" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="true">Pending</a>
    </li>
    @unless (count($allReports['user']) == 0 && count($allReports['event']) == 0)
    <li class="nav-item">
        <a class="nav-link" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="false">All reports</a>
    </li>
    @endunless
</ul>
<div class="tab-content my-3 mx-3" id="myTabProfile">
    <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
        <div class="row">
            @if (count($pendingReports['user']) == 0 && count($pendingReports['event']) == 0)
            <div class="text-muted col-12 col-md-10 mx-auto mt-5 d-flex justify-content-center">
                <span class="text-center">
                    There isn't pending reports.
                    <a href="{{ url('/search')}}" class="card-link border-bottom ml-2"> Go discover.</a>
                </span>
            </div>
            @else
            <div class="card-body">
                <div class="tab-content my-3 mx-3" id="adminTab">
                    <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                        <div class="container">
                            <div class="row justify-content-center">
                                @each('partials.reported_user_card', $pendingReports['user'], 'user')
                                @each('partials.reported_event_card', $pendingReports['event'], 'event')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
       
    </div>
    <div class="tab-pane fade" id="all" role="tabpanel" aria-labelledby="all-tab">
        <div class="container">
            <div class="row justify-content-center">

                @each('partials.reported_user_card', $allReports['user'], 'user')
                @each('partials.reported_event_card', $allReports['event'], 'event')
            </div>
        </div>
    </div>
</div>