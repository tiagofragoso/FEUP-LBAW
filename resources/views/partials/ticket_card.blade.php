<div class="col-12 col-md-6 col-lg-4">
    <div class="card col ticket mr-1 ml-1 pt-2 pb-2 mb-2 mt-2" data-toggle="modal"
    data-target="#ticket{{$ticket->id}}">
    <div class="row">
        <div class="col-12">
            <h4 class="ticket-title">{{$ticket->event->title}}</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <p class="ticket-date card-text">{{(new DateTime($ticket->event->start_date))->format('M d Y | H:i')}}
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <p class="ticket-location card-text">{{$ticket->event->location}}</p>
        </div>
    </div>
    <div class="row justify-content-end">
        <div class="col-10 text-right">
            <p class="ticket-logo mb-0">sound.hub</p>
        </div>
    </div>
    </div>

    <div class="modal fade full-ticket" id="ticket{{$ticket->id}}" tabindex="-1" role="dialog" aria-hidden="true" data-code="{{$ticket->qrcode}}">
        <div class="modal-dialog modal-dialog-centered justify-content-center" role="document">
            <div class="modal-content col-xs-12 col-sm-8 px-0 border-0">
                <div class="col-12 card ticket p-3">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="ticket-title">{{$ticket->event->title}}</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <p class="ticket-date card-text">{{(new DateTime($ticket->event->start_date))->format('M d Y | H:i')}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <p class="ticket-location card-text">{{$ticket->event->location}} </p>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-5 mb-5">
                        <div class="qrcode justify-content-center">            
                        </div>
                    </div>
                    <div class="row justify-content-between">
                        <div class="col-12 text-right">
                            <p class="ticket-logo mb-0">sound.hub</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>