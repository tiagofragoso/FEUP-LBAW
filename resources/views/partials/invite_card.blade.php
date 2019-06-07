<div class="card col-12 col-lg-9 report-card px-0 mt-5 {{$invite->status !== 'Pending'? 'card-fade': ''}}" data-id="{{$invite->id}}">
		<div class="card-header">
			<div class="row align-items-center">
				<div class="col-12">
					<p class="mb-0"><a href="{{url('/users/'. $invite->inviter()->first()->id)}}"><strong>{{$invite->inviter()->first()->displayName()}}</strong></a> invited you to 
						<strong>{{$invite->formattedType}}</strong> an event.</p>
				</div>
			</div>
		</div>
		<div class="card-body py-4">
			<div class="row col-12 align-items-center justify-content-center mx-0">
				<div class="activity-event-card d-flex align-items-center hover-shadow" tabindex="-1">
					<div class="w-25 h-100 overflow-hidden d-flex justify-content-center">
						<img class="h-100" src="{{ $event->image() }}" alt="event image">
					</div>
					<div class="d-flex align-items-center w-75">
						<div class="container-fluid">
							<div class="row align-items-center">
								<a href="{{ url('events/' . $invite->event()->first()->id)}}" class="col-12 event-link">
									<h5 class="event-title">{{$invite->event()->first()->title}}</h5>
								</a>
	
								<div class="col-7 col-md-9 mt-4">
									<div class="text-muted event-date">
											{{ \DateTime::createFromFormat('Y-m-d H:i:sO',$invite->event()->first()->start_date)->format('d M Y') }}
									</div>
									<div class="text-muted event-location">
											{{$invite->event()->first()->location}}
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@if($invite->status === 'Pending')
		<div class="card-footer">
			<div class="row justify-content-center">
				<div class="col-6 text-right">
					<button class="my-0 btn ban-btn text-uppercase">decline</button>
				</div>
				<div class="col-6 text-left">
					<button class="my-0 btn diss-btn text-uppercase">accept</button>
				</div>
			</div>
		</div>
		@else
		<div class="card-footer">
			<div class="row justify-content-center">
				<div class="col-6 text-center">
					<p class="my-0 {{ ($invite->status === 'Declined')? 'baned-btn' : 'dissed-btn' }}  text-uppercase">
						{{$invite->status}}
					</p>
				</div>
			</div>
		</div>
		@endif
	</div>