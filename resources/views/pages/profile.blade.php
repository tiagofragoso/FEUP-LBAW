@extends('layouts.app')

@section('content')
<div class="container-fluid my-0 my-sm-5 profile-container">
		<div class="row">
			<div class="card-wrapper mx-auto w-100">
				<div class="card pb-4">
					<div class="card-header">
						<div class="row justify-content-center">
							<div class="col-6 mb-3 mt-3 text-center position-relative">
								<img src="../assets/user.svg" alt="..." class="rounded-circle border border-green"
									width="120" height="120">
							</div>
						</div>
						<div class="row justify-content-center position-relative">
							<div class="col-10 text-center">
                            <h3 class="card-title user-name">{{Auth::user()->name}}</h3>
							</div>
						</div>
						<div class="row justify-content-center mb-2">
							<div class="col-10 text-center">
								<p class="card-subtitle text-muted">{{Auth::user()->username}}</p>
							</div>
						</div>
						<div class="row justify-content-center mb-4">
							<div class="col-5 col-sm-4 text-right border-right pr-2">
								<p class="card-text">{{Auth::user()->followers}} followers</p>
							</div>
							<div class="col-5 col-sm-4 text-left pl-0 ml-2">
								<p class="card-text">{{Auth::user()->following}} following</p>
							</div>
						</div>
						<div class="row justify-content-center mb-3">
							<div class="col text-right">
								<a class="card-link border-bottom" data-toggle="collapse" href="#mytickets"
									role="button" aria-expanded="false" aria-controls="mytickets">My tickets</a>
							</div>
							<div class="col text-left">
                            <a href="{{ url('/settings')}}" class="card-link border-bottom">Settings</a>
							</div>
						</div>
					</div>
					<div class="card-body">
						<ul class="nav justify-content-center mt-2" id="myTabProfile" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="joined-tab" data-toggle="tab" href="#joined" role="tab"
									aria-controls="joined" aria-selected="true">Joined</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="hosting-tab" data-toggle="tab" href="#hosting" role="tab"
									aria-controls="hosting" aria-selected="false">Hosting</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="performing-tab" data-toggle="tab" href="#performing" role="tab"
									aria-controls="performing" aria-selected="false">Performing</a>
							</li>
						</ul>
						<div class="tab-content my-3 mx-3" id="myTabProfile">
							<div class="tab-pane fade show active" id="joined" role="tabpanel"
								aria-labelledby="joined-tab">
								<div class="row">
									@each('partials.activity_event_card', $joined, 'joinedEvent')
								</div>
							</div>
							<div class="tab-pane fade" id="hosting" role="tabpanel" aria-labelledby="performing-tab">
								<div class="row">
                                        @each('partials.activity_event_card', $hosting, 'hostingEvent')
								</div>
							</div>
							<div class="tab-pane fade" id="performing" role="tabpanel" aria-labelledby="performing-tab">
								<div class="row">
                                        @each('partials.activity_event_card', $performing, 'performingEvent')
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

