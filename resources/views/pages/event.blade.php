@extends('layouts.app')

@section('scripts')
<script defer type="module" src="/js/join_event.js"> </script>
<script defer type="module" src="/js/posts.js"> </script>
<script defer type="module" src="/js/admin.js"> </script>
<script defer type="module" src="/js/reports.js"> </script>
<script defer type="module" src="/js/comments.js"> </script>
<script defer type="module" src="/js/questions.js"> </script>
<script defer type="module" src="/js/answers.js"> </script>
<script defer type="module" src="/js/tickets.js"> </script>
@endsection

@section('title', $event->title)
@section('container', 'event-page')
@section('content')

<div id="content" class="container my-0 my-sm-5" data-id="{{$event->id}}">
	@include('partials.banned_card',['object' => $event])
	@include('partials.report_modal')
	@include('partials.acquire_ticket_modal',['event'=> $event])
	<div class="row">
		<div class="card-wrapper col-12 mx-auto">
			<div class="card mb-5">
				<div class="img-container w-100 d-flex align-items-center overflow-hidden position-relative">
					<div class="dropdown position-absolute more-button">
						<button class="btn btn-light border-light" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-ellipsis-h"></i>
						</button>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
							<a class="dropdown-item" href="#">Share event</a>
							@if(!$event->banned)
							@if(Auth::check() && Auth::user()->is_admin)
							<a class="dropdown-item text-danger" id="ban-event-btn" href="#">Ban event</a>
							@else
							<a class="dropdown-item text-danger" id="report-event-btn" data-toggle="modal" data-target="#exampleModal">
								Report event</a>
							@endif
							@endif
						</div>
					</div>
				@if ($joined == 'Host')
				<a href="#" class="position-absolute invite-button">
					<button class="btn btn-light border-light">
						<i class="fas fa-envelope mr-1"></i>
						Invite
					</button>
				</a>
				@endif
				<button class="btn btn-light border-light position-absolute tag-button" type="button">
					<i class="fas fa-tag mr-1"></i>
					{{ $event->category()->first()->name }}
				</button>
				<img class="d-block w-100" src="{{asset('assets/event-placeholder.png')}}" alt="First slide">
			</div>
			<div class="container-fluid mt-3">
				<div class="row justify-content-between">
					<div class="col-12 col-sm-9 mb-2 mb-sm-0 d-flex flex-column">
						<h5 class="card-title">
							<strong>{{ $event->title }}</strong>
						</h5>
						<p class="text-muted mb-0">Hosted by <strong><a href="{{ url('/users/' . $owner->id) }}" class="host-name text-muted">{{$owner->displayName()}}</a></strong>
							@if ($hosts->count() > 0)
							and {{$hosts->count()}} others
							@endif
						</p>
					</div>
					<div class="col-12 col-sm-3">
						@if($joined === null)
						<button type="submit" class="btn btn-primary w-100 join-btn join" data-id="{{$event->id}}">
							Join </button>
						@elseif($joined === 'Host')
						<a href="{{ url('/events/' . $event->id . '/edit') }}" class="btn btn-info w-100"> Edit </a>
						@else
						<button type="submit" class="btn btn-outline-primary w-100 join-btn joined" data-id="{{$event->id}}"> Joined </button>
						@endif
					</div>
				</div>
				<hr>
				<div class="row mb-3 justify-content-between">
					<div class="col-8">
						<p class="card-subtitle text-muted">
							@if (!empty($event->start_date))
							<span>
								{{ \DateTime::createFromFormat('Y-m-d H:i:s', $event->start_date)->format('D, d M Y') }}
							</span>
							@endif
							@if (!empty($event->end_date))
							-
							<span>
								{{ \DateTime::createFromFormat('Y-m-d H:i:s', $event->end_date)->format('D, d M Y') }}
							</span>
							@endif
						</p>
					</div>
					<div class="col-3">
						<p class="card-subtitle text-muted text-right" id="participants">{{$event->participants}} <i class="mr-1 fas fa-users"></i></p>
					</div>
				</div>
				<div class="row mb-3 justify-content-between">
					<div class="col-8">
						<div class="d-flex flex-column card-subtitle text-muted">
							<p class="mb-0">
								{{ $event->location}}
							</p>
							<a href="{{ 'https://www.google.com/maps/search/'.urlencode($event->address)}}" target="_blank" class="mb-0 event-addr">
								{{ $event->address}}
							</a>
						</div>
					</div>
					<div class="col-4">
						<p class="card-subtitle text-muted text-right">{{$event->type}}</p>
					</div>
				</div>
				<div class="row mb-3 justify-content-between">
					<div class="col-8">
						<p class="card-text">
							{{$event->brief}}
						</p>
					</div>
					<div class="col-4">
						<p class="card-subtitle text-muted text-right">
							@if($event->private)
							Private
							@else Public
							@endif
						</p>
					</div>

				</div>
				<div class="row justify-content-between">
					<div class="col-12 col-lg-9 mb-2 mb-lg-0 ">

						<div class="d-flex flex-row justify-content-between position-relative">
							<div class="progress 
									@if ($event->status == 'Planning') 
										progress-1
									@elseif ($event->status == 'Tickets')
										progress-2
									@elseif ($event->status == 'Live')
										progress-3
									@else
										progress-4
									@endif
									position-absolute"></div>
							<div class="ml-3 step-wrapper d-flex flex-column align-items-center">
								<div class="step rounded-circle d-flex align-items-center justify-content-center {{ ($event->status == 'Planning' || $event->status == 'Tickets'|| $event->status == 'Live')? 'complete' : '' }}">
									1
								</div>
								<span>Planning</span>
							</div>
							<div class="step-wrapper d-flex flex-column align-items-center">
								<div class="step rounded-circle d-flex align-items-center justify-content-center {{ ($event->status == 'Tickets' || $event->status == 'Live' )? 'complete' : '' }}">
									2
								</div>
								<span>Buy a ticket</span>
							</div>
							<div class="mr-3 step-wrapper d-flex flex-column align-items-center">
								<div class="step rounded-circle d-flex align-items-center justify-content-center {{ ($event->status == 'Live')? 'complete' : '' }}">
									3
								</div>
								<span>Live</span>
							</div>
						</div>
					</div>
					@if ($event->status == 'Planning' || $event->status == 'Tickets')
					<div class="col-12 col-lg-3">
						@if ($event->status == 'Tickets')
						
						<button type="submit" class="btn btn-secondary w-100" data-toggle="modal" data-target="#acquireTicketModal">
							@elseif ($event->status == 'Planning')
							<button type="submit" class="btn btn-info w-100">
								@endif
								<i class="fas fa-ticket-alt mr-1"></i>
								@if (!(empty($event->price)) && $event->price > 0)
								{{$event->price}} {{$event->currency()->first()->getSymbol()}}
								@else FREE
								@endif
							</button>
					</div>
					@endif
				</div>
				<div class="row">
					<div class="col-12">
						<hr>
					</div>
				</div>
				<div class="row mb-3 justify-content-between align-items-center">
					<div class="col-4">
						<h5>Artists</h5>
					</div>
					<div class="col-4 text-right">
						@unless(count($artists) === 0)
						<a href="#" class="view-all">
							View all
						</a>
						@endunless
					</div>
				</div>
				<div class="row artists-wrapper">
					@if (count($artists) > 0)
					@foreach($artists as $artist)
					<a href="{{ url('/users/'.$artist->id) }}" class="col-lg-2 col-4 d-inline-flex flex-column align align-items-center">
						<img src="{{asset('assets/user.svg')}}" class="rounded-circle rounded-circle border border-light" width="40" />
						<span class="text-center">{{$artist->displayName()}}</span>
					</a>
					@endforeach
					@elseif ($joined !== 'Host') <span class="col-10 mx-auto text-center">No artists confirmed
						yet.</span>
					@endif

				</div>
				<div class="row">
					<div class="col-12">
						<hr>
					</div>
				</div>
				<div class="event-content">
					<ul class="nav justify-content-center mt-2" id="event-tabs" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="about-tab" data-toggle="tab" href="#about" role="tab" aria-controls="about" aria-selected="true">About</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="false">Posts</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="qa-tab" data-toggle="tab" href="#qa" role="tab" aria-controls="qa" aria-selected="false">Q&A</a>
						</li>
						@if ($joined == 'Host' || $joined == 'Artist')
						<li class="nav-item">
							<a class="nav-link" id="forum-tab" data-toggle="tab" href="#forum" role="tab" aria-controls="forum" aria-selected="false">Forum</a>
						</li>
						@endif
					</ul>
					<div class="tab-content my-3 mx-3" id="myTabContent">
						<div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="about-tab">
							<div class="row justify-content-center">
								<div class="about-text col-12 col-md-9">
									<p class="card-text">
										{{$event->description}}
									</p>
									<p class="card-text">
									</p>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="posts" role="tabpanel" aria-labelledby="posts-tab">
							<div class="posts">
								@if ($joined === 'Host')
								<div class="row justify-content-center">
									<div class="card col-12 col-lg-9 mb-4 py-2 hover-shadow">
										<div class=" container">
											<div class="row">
												<div class="col-12">
													<p class="card-title"><strong>Create a post</strong></p>
												</div>
											</div>
											<div class="row">
												<div class="col-12">
													<textarea class="form-control" id="postFormTextarea" rows="3"></textarea>
												</div>
											</div>
											<hr class="mb-1">
											<div class="row">
												<div class="col-6 post-type">
													<input class="form-check-input d-none form-post-type" type="radio" id="text" value="option1" name="post-type" checked>
													<label class="form-check-label mr-2" for="text"><i class="fas fa-font"></i></label>

													<input class="form-check-input d-none form-post-type" type="radio" id="poll" value="option2" name="post-type">
													<label class="form-check-label mr-2" for="poll"><i class="fas fa-poll-h"></i></label>

													<input class="form-check-input d-none form-post-type" type="radio" id="file" value="option3" name="post-type">
													<label class="form-check-label" for="file"><i class="fas fa-paperclip"></i></label>
												</div>
												<div class="col-6 text-right">
													<button class="submit-btn submit-post" data-id="{{$event->id}}" type="submit">
														<i class="fas fa-angle-double-right"></i>
													</button>
												</div>
											</div>
										</div>
									</div>
								</div>
								@endif
								<div class="posts-list">
									@each('partials.post', $posts, 'post')
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="qa" role="tabpanel" aria-labelledby="qa-tab">
							<div class="container">
								@if ($joined === 'Participant')
								<div class="row justify-content-center align-items-center mb-4">
									<div class="row col-12 mt-3 justify-content-center align-items-center">
										<div class="col-12 col-md-10 d-flex flex-row align-items-center">
											<img src="../assets/user.svg" class="rounded-circle rounded-circle border border-light mr-3" width="30" height="30" />
											<form class="position-relative w-100" action="#">
												<textarea class="form-control position-relative w-100 pr-5"
													id="questionFormTextarea" rows="1"
													placeholder="Ask a question" style="resize: none"></textarea>
												<div
													class="position-absolute submit-btn-wrapper d-flex justify-content-center align-items-center mr-1">
													<button class="submit-btn submit-question" data-id="{{$event->id}}" type="submit">
														<i class="fas fa-angle-double-right"></i>
													</button>
												</div>
											</form>
										</div>
										<div class="success d-none" id="question-confirmation-message">Question submitted with success.</div>
									</div>
								</div>
								@endif
								@if ($joined === 'Host')
								<div class="row justify-content-center">
									<div class="col-12 col-md-9 ">
										<p><strong>Unanswered questions
												(<span class='nUnanswered'>{{count($questions['unanswered'])}}</span>) </strong></p>
									</div>
								</div>
								<div class="row justify-content-center mb-4">
									<ul class="col-12 col-md-9 list-group list-group-flush">
										@foreach ($questions['unanswered'] as $question)
										<li class="list-group-item unanswered-question">
											<a class="pl-0 text-decoration-none qa-question dropdown-toggle" data-toggle="collapse" href="#collapse{{$question->id}}" role="button" aria-expanded="false" aria-controls="collapseExample">
												{{$question->content}}
											</a>
											<div class="collapse" id="collapse{{$question->id}}">
												<div class="row align-items-center mb-4">
													<div class="row col-12 mt-3  align-items-center">
														<div class="col-12 d-flex flex-row align-items-center">
															<img src="../assets/user.svg" class="rounded-circle rounded-circle border border-light mr-3" width="30" height="30">
															<form class="position-relative form-answer-question w-100">
																<textarea class="form-control position-relative w-100 pr-5" rows="1" placeholder="Answer" style="resize: none"></textarea>
																<div class="position-absolute submit-btn-wrapper d-flex justify-content-center align-items-center mr-1">
																	<button class="submit-btn answer-button" data-id = {{$question->id}} type="submit">
																		<i class="fas fa-angle-double-right"></i>
																	</button>
																</div>
															</form>
														</div>
													</div>
												</div>
											</div>
										</li>
										@endforeach
									</ul>
								</div>
								<div class="row justify-content-center">
									<div class="col-12 col-md-9">
										<p><strong>Answered questions
												(<span class='nAnswered'>{{count($questions['answered'])}}</span>) </strong></p>
									</div>
								</div>
								@endif
								<div class="row justify-content-center">
									<ul class="col-12 col-md-9 list-group list-group-flush answered-questions-list">
										@foreach($questions['answered'] as $question)
										<li class="list-group-item">
											<a class="pl-0 text-decoration-none qa-question dropdown-toggle" data-toggle="collapse" href="#" role="button" data-target="#question{{$question->id}}" aria-expanded="false" aria-controls="collapseExample">
												{{$question->content}}
											</a>
											<div class="collapse" id="question{{ $question->id }}">
												<p class="text-muted">
													{{$question->answer->content}}
												</p>
											</div>
										</li>
										@endforeach
									</ul>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="forum" role="tabpanel" aria-labelledby="forum-tab">
							<div class="row justify-content-center">
								<div class="col-12 col-lg-9">
									<p class="text-muted">
										This is only visible to hosts and artists.
									</p>
								</div>
								<div class="card col-12 col-lg-9 mb-4 py-2 hover-shadow">
									<div class="container">
										<div class="row">
											<div class="col-12">
												<p class="card-title"><strong>Start a thread</strong></p>
											</div>
										</div>
										<div class="row">
											<div class="col-12">
												<textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
											</div>
										</div>
										<hr class="mb-1">
										<div class="row">
											<div class="col-6 post-type">
												<input class="form-check-input d-none" type="radio" id="thread" value="option4" name="thread" checked>
												<label class="form-check-label mr-2" for="thread"><i class="fas fa-font"></i></label>
											</div>
											<div class="col-6 text-right">
												<button class="submit-btn" type="submit">
													<i class="fas fa-angle-double-right"></i>
												</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							@if ($joined === 'Host' || $joined === 'Artist')
							@each('partials.thread', $threads, 'thread')
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
	@endsection