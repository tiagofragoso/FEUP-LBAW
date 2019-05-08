<div class="row justify-content-center">
    <div class="col-6 mb-3 mt-3 text-center position-relative">
        <img src="../assets/user.svg" alt="..." class="rounded-circle border border-green"
            width="120" height="120">
    </div>
</div>
<div class="row justify-content-center position-relative">
    <div class="col-10 text-center">
    <h3 class="card-title user-name" >{{$user->name}}</h3>
    </div>
</div>
<div class="row justify-content-center mb-2">
    <div class="col-10 text-center">
    <p class="card-subtitle text-muted username" data-id="{{$user->id}}">{{$user->username}}</p>
    </div>
</div>
<div class="row justify-content-center mb-4">
    <div class="col-5 col-sm-4 text-right border-right pr-2">
        <p class="card-text number-followers">{{$user->followers}}</p>
    </div>
    <div class="col-5 col-sm-4 text-left pl-0 ml-2">
        <p class="card-text number-following">{{$user->following}}</p>
    </div>
</div>