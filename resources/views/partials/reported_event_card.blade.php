<div class="card col-12 col-lg-9 report-card px-0 mt-5" data-id="{{$report['report_id']}}" data-type="event">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col-12">
                    <p class="mb-0"><strong>{{$report['count']}}
                        @if ($report['count'] > 1)users 
                        @else user
                        @endif
                        </strong> reported an event.
                    </p>   
            </div>
        </div>
    </div>
    <div class="card-body py-4">
        <div class="row col-12 align-items-center justify-content-center mx-0">
            <div class="activity-event-card d-flex align-items-center hover-shadow" tabindex="-1">
                <div class="w-25 h-100 overflow-hidden d-flex justify-content-center">
                    <img class="h-100" src="../assets/event-placeholder.png" alt="">
                </div>
                <div class="d-flex align-items-center w-75">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <a href="{{ url('events/' . $report['event']->id)}}" class="col-12 event-link">
                                <h5 class="event-title">{{$report['event']->title}}</h5>
                            </a>

                            <div class="col-7 col-md-9 mt-4">
                                <div class="text-muted event-date">
                                    {{ \DateTime::createFromFormat('Y-m-d H:i:s',$report['event']->start_date)->format('d M Y') }}
                                </div>
                                <div class="text-muted event-location">{{$report['event']->location}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($report['status'] === 'Pending')
    <div class="card-footer">
        <div class="row justify-content-center">
            <div class="col-6 text-right">
                <button class="my-0 btn diss-btn text-uppercase">dismiss</button>
            </div>
            <div class="col-6 text-left">
                <button class="my-0 btn ban-btn text-uppercase">delete</button>
            </div>
        </div>
    </div>
    @else
    <div class="card-footer">
        <div class="row justify-content-center">
            <div class="col-6 text-center">
                <p class="my-0 {{ ($report['status'] == 'Declined')? 'baned-btn' : 'dissed-btn' }} text-uppercase">
                    {{$report['status']}}</p>
            </div>
        </div>
    </div>
    @endif
</div>