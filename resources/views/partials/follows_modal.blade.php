<div class="modal fade" id="followsModal" tabindex="-1" role="dialog" aria-labelledby="followsModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="followsModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row d-flex align-items-center">
                        <div class="col-2">
                            <img src="{{ asset('assets/user.svg')}}" class="rounded-circle border border-light" />
                        </div>
                        <a href="{{ url('users/15') }}" class="col-7">
                            nome
                        </a>
                        <div class="col-3">
                            <button class="btn btn-primary w-100">
                                Follow
                            </button>
                        </div>
                    </div>
                    <hr>
                    <div class="row d-flex align-items-center">
                        <div class="col-2">
                            <img src="{{ asset('assets/user.svg')}}" class="rounded-circle border border-light" />
                        </div>
                        <a href="{{ url('users/15') }}" class="col-7">
                            nome
                        </a>
                        <div class="col-3">
                            <button class="btn btn-primary w-100">
                                Follow
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>