@if(Auth::check() && Auth::user()->id != $user->id)
<div class="dropdown position-absolute more-button">
    <button class="btn btn-light border-light" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-ellipsis-h"></i>
    </button>
   
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
        @if(Auth::check() && !$user->banned && !$user->deleted)
        @if(Auth::check() && Auth::user()->is_admin)
        <a class="dropdown-item text-danger" id="ban-user-btn" href="#"> Ban user</a>
        @else
        <a class="dropdown-item text-danger" id="report-user-btn" href="#"  data-toggle="modal" data-target="#exampleModal">
            Report user</a>
        @endif
        @endif
    </div>
</div>
@endif
<div class="row justify-content-center">
    <div class="col-6 mb-3 mt-3 text-center position-relative">
        <img src="../assets/user.svg" alt="..." class="rounded-circle border border-green" width="120" height="120">
    </div>
</div>
<div class="row justify-content-center position-relative">
    <div class="col-10 text-center">
        <h3 class="card-title user-name">{{$user->name}}</h3>
    </div>
</div>
<div class="row justify-content-center mb-2">
    <div class="col-10 text-center">
        <p class="card-subtitle text-muted username" data-id="{{$user->id}}">{{$user->username}}</p>
    </div>
</div>
<div class="row justify-content-center mb-4">
    <div class="col-5 col-sm-4 text-right border-right pr-2">
        <p class="card-text number-followers" data-id="{{$user->id}}">{{$user->followers}}</p>
    </div>
    <div class="col-5 col-sm-4 text-left pl-0 ml-2">
        <p class="card-text number-following" data-id="{{$user->id}}">{{$user->following}}</p>
    </div>
</div>