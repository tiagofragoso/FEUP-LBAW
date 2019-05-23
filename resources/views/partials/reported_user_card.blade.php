<div class="card col-12 col-lg-9 report-card px-0 mt-5" data-id ="{{json_encode($user['reports'])}}">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col-12">
                <p class="mb-0"><strong>{{$user['user']->name}}</strong> and <strong>{{count($user['reports'])-1}}
                        others</strong> reported a user.</p>
            </div>
        </div>
    </div>
    <div class="card-body py-4">
        <a href="{{ url('users/' . $user['reportedUser']->id)}}" class="row col-12 align-items-center justify-content-center">
            <div class="col-1 mr-4">
                <img src="../assets/user.svg" class="rounded-circle rounded-circle border border-light" width="40" />
            </div>
            <div class="col-9">
                <h4 class="card-title user-name mb-1">{{$user['reportedUser']->name}}</h4>
                <p class="card-subtitle user-username text-muted">{{$user['reportedUser']->username}}
                </p>
            </div>
        </a>
    </div>
    @if($user['status'] == 'Pending')
    <div class="card-footer">
        <div class="row justify-content-center">
            <div class="col-6 text-right">
                <p class="my-0 ban-btn text-uppercase" id ="delete-report-btn">delete</p>
            </div>
            <div class="col-6 text-left">
                <p class="my-0 diss-btn text-uppercase" id ="dismiss-report-btn">dismiss</p>
            </div>
        </div>
    </div>
    @else
    <div class="card-footer">
        <div class="row justify-content-center">
            <div class="col-6 text-center">
                <p class="my-0 {{ ($user['status'] == 'Declined')? 'baned-btn' : 'dissed-btn' }} text-uppercase">{{$user['status']}}</p>
            </div>
        </div>
    </div>
    @endif
</div>