<div class="modal fade" id="acquireTicketModal" tabindex="-1" role="dialog" aria-labelledby="acquireTicketModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" data-id="{{$event->price}}">
            <div class="modal-header">
                <h5 class="modal-title" id="acquireTicketModal">{{$event->title}} tickets</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if (!(empty($event->price)) && $event->price > 0)
                Price: {{$event->price}} {{$event->currency()->first()->getSymbol()}}
                @else FREE
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="acquire-ticket-btn btn btn-secondary" data-id ="{{$event->id}}">Acquire Ticket</button>
                <button type="button" class="cancel-btn btn btn-danger" data-dismiss="modal">Cancel</button>

            </div>
        </div>
    </div>
</div>