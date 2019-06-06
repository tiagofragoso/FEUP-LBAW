<div class="card col-12 col-lg-9 report-card px-0 mt-5" data-id="{{$report['report_id']}}" data-type="user">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col-12">
                <p class="mb-0"><strong>{{$report['count']}} 
                    @if ($report['count'] > 1) users 
                    @else user
                    @endif
                    </strong> reported an user.
                </p>  
            </div>
        </div>
    </div>
    <div class="card-body py-4">
        <a href="{{ url('users/' . $report['user']->id)}}" class="row col-12 align-items-center justify-content-center">
            <div class="col-1 mr-4">
                <img src="../assets/user.svg" class="rounded-circle rounded-circle border border-light" width="40" />
            </div>
            <div class="col-9">
                <h4 class="card-title user-name mb-1">{{$report['user']->name}}</h4>
                <p class="card-subtitle user-username text-muted">{{$report['user']->username}}
                </p>
            </div>
        </a>
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
                <p class="my-0 {{ ($report['status'] == 'Declined')? 'baned-btn' : 'dissed-btn' }} text-uppercase">{{$report['status']}}</p>
            </div>
        </div>
    </div>
    @endif
</div>