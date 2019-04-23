@extends('layouts.app')

@section('title', $event->title)

@section('content')
    
    <div id="content" class="container my-0 my-sm-5">
		<div class="row">
			<div class="card-wrapper col-12 mx-auto">
				<div class="card mb-5">
					<div class="img-container w-100 d-flex align-items-center overflow-hidden position-relative">
						<div class="dropdown position-absolute more-button">
							<button class="btn btn-light border-light" type="button" id="dropdownMenuButton"
								data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fas fa-ellipsis-h"></i>
							</button>
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
								<a class="dropdown-item" href="#">Share event</a>
								<a class="dropdown-item text-danger" href="#">Report event</a>
							</div>
						</div>
						<button class="btn btn-light border-light position-absolute tag-button" type="button">
							<i class="fas fa-tag mr-1"></i> 
						</button>
						<img class="d-block w-100" src="../assets/event-placeholder.png" alt="First slide">
					</div>
					<div class="container-fluid mt-3">
						<div class="row justify-content-between">
							<div class="col-12 col-sm-9 mb-2 mb-sm-0 d-flex flex-column">
								<h5 class="card-title">
									<strong>{{ $event->title }}</strong>
								</h5>
							<p class="text-muted mb-0">Hosted by <strong><a href="{{ url('/users/' . $owner->id) }}"
								class="host-name text-muted">{{$owner->displayName()}}</a></strong> 
									@if ($hosts->count() > 0)
										and {{$hosts->count()}} others
									@endif
							</p>
							</div>
							<div class="col-12 col-sm-3">
								<button type="submit" class="btn btn-primary w-100">Join</button>
							</div>
						</div>
						<hr>
						<div class="row mb-3 justify-content-between">
							<div class="col-8">
								<p class="card-subtitle text-muted"><span>{{  \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->start_date)->format('D, d M Y')}}</span> - <span>{{  \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->end_date)->format('D, d M Y')}}</span></p>
							</div>
							<div class="col-3">
								<p class="card-subtitle text-muted text-right">{{$event->participants}} <i class="mr-1 fas fa-users"></i></p>
							</div>
						</div>
						<div class="row mb-3 justify-content-between">
							<div class="col-8">
								<div class="d-flex flex-column card-subtitle text-muted">
									<p class="mb-0">
                                    {{ $event->location}}
									</p>
									<a href="https://www.google.com/maps/search/R.+Nova+da+Alf%C3%A2ndega,+4050-430+Porto"
										target="_blank" class="mb-0 event-addr">
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
									<div class="progress progress-2 position-absolute"></div>
									<div class="ml-3 step-wrapper d-flex flex-column align-items-center">
										<div
											class="step rounded-circle d-flex align-items-center justify-content-center {{ ($event->status == 'Planning' || $event->status == 'Tickets'|| $event->status == 'Live')? 'complete' : '' }}">
											1
										</div>
										<span>Planning</span>
									</div>
									<div class="step-wrapper d-flex flex-column align-items-center">
										<div
											class="step rounded-circle d-flex align-items-center justify-content-center {{ ($event->status == 'Tickets' || $event->status == 'Live' )? 'complete' : '' }}">
											2
										</div>
										<span>Buy a ticket</span>
									</div>
									<div class="mr-3 step-wrapper d-flex flex-column align-items-center">
										<div
											class="step rounded-circle d-flex align-items-center justify-content-center {{ ($event->status == 'Live')? 'complete' : '' }}" id ="live">
											3
										</div>
										<span>Live</span>
									</div>
								</div>
							</div>
							<div class="col-12 col-lg-3">
								<button type="submit" class="btn btn-secondary w-100">
									<i class="fas fa-ticket-alt mr-1"></i>
									{{$event->price}} {{$event->currency}}
								</button>
							</div>
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
								<a href="#" class="view-all">
                                    View all
								</a>
							</div>
						</div>
						<div class="row artists-wrapper">
                            @foreach($artists as $artist)
						<a href="{{ url('/users/'.$artist->id) }}"
								class="col-lg-2 col-4 d-inline-flex flex-column align align-items-center">
								<img src="../assets/user.svg" class="rounded-circle rounded-circle border border-light"
									width="40" />
								<span class="text-center">{{$artist->displayName()}}</span>
							</a>
                            @endforeach
                          
						</div>
						<div class="row">
							<div class="col-12">
								<hr>
							</div>
						</div>
						<div class="event-content">
							<ul class="nav justify-content-center mt-2" id="event-tabs" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="about-tab" data-toggle="tab" href="#about" role="tab"
										aria-controls="about" aria-selected="true">About</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="posts-tab" data-toggle="tab" href="#posts" role="tab"
										aria-controls="posts" aria-selected="false">Posts</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="qa-tab" data-toggle="tab" href="#qa" role="tab"
										aria-controls="qa" aria-selected="false">Q&A</a>
								</li>
							</ul>
							<div class="tab-content my-3 mx-3" id="myTabContent">
								<div class="tab-pane fade show active" id="about" role="tabpanel"
									aria-labelledby="about-tab">
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
                                        @foreach($posts as $post)
										<div class="row justify-content-center">
											<div class="card col-12 col-lg-9 mb-4 hover-shadow">
												<div class="row">
													<div class="col-12 col-md-10">
														<div class="py-3 px-0 px-md-3 w-100">
															<div class="row">
																<div class="col-12 d-flex flex-row">
																	<img src="../assets/user.svg"
																		class="rounded-circle rounded-circle border border-light mr-2"
																		width="30" height="30" />
																	<div class="d-flex flex-column">
																		<p class="card-text mb-0">
																			<a href="user-profile.html" class="badge badge-secondary">
																				{{$post->author->username}}
																			</a>
																			created a
																			<strong>post</strong>.
																		</p>
																		<span class="post-date text-muted">
																			{{$post->date}}
																		</span>
																	</div>
																</div>
															</div>
															<p class="card-text mt-3">
																{{$post->content}}
															</p>
														</div>
													</div>
													<div
														class="col-12 col-md-2 h-auto h-md-100 d-flex flex-row flex-md-column justify-content-center align-items-center pr-0 pl-0 pl-md-auto">
														<button type="button"
															class="btn btn-light w-100 h-100 flex-grow-2">
															<div
																class="w-100 h-100 d-flex flex-column align-items-center justify-content-center">
																<i class="far fa-thumbs-up"></i>
																<span>{{$post->likes}}</span>
															</div>
														</button>
														<button type="button" data-toggle="collapse"
															data-target="#comments1" aria-expanded="false"
															aria-controls="collapseExample"
															class="side-button btn btn-light w-100 h-100 flex-grow-2">
															<div
																class="w-100 h-100 d-flex flex-column align-items-center justify-content-center">
																<i class="far fa-comment-alt"></i>
																<span>{{$post->comments}}</span>
															</div>
														</button>
													</div>
												</div>
												<div class="row comment-section collapse mb-3 border-top border-light"
													id="comments1">
													<div
														class="row col-12 mt-3 justify-content-center align-items-center">
														<div
															class="col-12 col-md-10 d-flex flex-row align-items-center">
															<img src="../assets/user.svg"
																class="rounded-circle rounded-circle border border-light mr-3"
																width="30" height="30" />
															<form class="position-relative w-100" action="#">
																<textarea
																	class="form-control position-relative w-100 pr-5"
																	id="exampleFormControlTextarea1" rows="1"
																	placeholder="Write a comment..."
																	style="resize: none"></textarea>
																<div
																	class="position-absolute submit-btn-wrapper d-flex justify-content-center align-items-center mr-1">
																	<button class="submit-btn" type="submit">
																		<i class="fas fa-angle-double-right"></i>
																	</button>
																</div>
															</form>
														</div>
													</div>
													<div class="dropdown-divider col-12 col-md-10 mx-auto my-3"></div>
													<div
														class="row col-12 comment align-items-start justify-content-center">
                                                        <div class="col-12 col-md-10 d-flex flex-row">
															<img src="../assets/user.svg"
																class="rounded-circle rounded-circle border border-light mr-3"
																width="30" height="30" />
															<div class="w-100 d-flex flex-column">
																<div class="comment-wrapper d-flex flex-column w-100">
																	<div class="comment-text px-3 py-2">
																		<span>
																			<span class=" author mr-2">John
																				Smith</span>Lorem
																			ipsum dolor sit amet, consectetur adipiscing
																			elit.
																			Aliquam feugiat orci sit amet ante ornare
																			lobortis
																			sed
																			non enim. Vestibulum.
																		</span>
																	</div>
																	<div class="comment-footer ml-3">
																		<a href="#">Like</a>
																		•
																		<a href="#">More</a>
																		•
																		<span>2 weeks ago</span>
																	</div>
																</div>
																<div
																	class="pl-1 mt-3 align-items-start d-flex flex-row">
																	<img src="../assets/user.svg"
																		class="rounded-circle rounded-circle border border-light mr-3"
																		width="30" height="30" />
																	<div
																		class="comment-wrapper d-flex flex-column w-100">
																		<div class="comment-text px-3 py-2">
																			<span>
																				<span class=" author mr-2">John
																					Smith</span>Lorem
																				ipsum dolor sit amet, consectetur
																				adipiscing elit.
																				Aliquam feugiat orci sit amet ante
																				ornare lobortis
																				sed
																				non enim. Vestibulum.
																			</span>
																		</div>
																		<div class="comment-footer ml-3">
																			<a href="#">Like</a>
																			•
																			<a href="#">More</a>
																			•
																			<span>2 weeks ago</span>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
                                        </div>
                                        @endforeach
										<div class="row justify-content-center">
											<div class="card col-12 col-lg-9 mb-4 hover-shadow">
												<div class="row">
													<div class="col-12 col-md-10">
														<div class="py-3 px-0 px-md-3 w-100">
															<div class="row">
																<div class="col-12 d-flex flex-row">
																	<img src="../assets/user.svg"
																		class="rounded-circle rounded-circle border border-light mr-2"
																		width="30" height="30" />
																	<div class="d-flex flex-column">
																		<p class="card-text mb-0">
																			<a href="user-profile.html" class="badge badge-primary">
																				NOS
																			</a>
																			created a
																			<strong>poll</strong>.
																		</p>
																		<span class="post-date text-muted">
																			MAR 4 | 15:58
																		</span>
																	</div>
																</div>
															</div>
															<p class="card-text mt-3">
																Which drink would you like to see featured in the
																concert?
															</p>
															<div class="container">
																<div class="row align-items-center mb-2">
																	<div class="input-group col-12 col-sm-8">
																		<div class="input-group-prepend">
																			<div class="input-group-text">
																				<input type="radio" name="poll"
																					aria-label="">
																			</div>
																		</div>
																		<span type="text" class="form-control">
																			Super Bock
																		</span>
																	</div>
																	<div
																		class="col-12 col-sm-4 ml-5 ml-sm-0 mt-1 mt-sm-0 text-muted">
																		412 votes
																	</div>
																</div>
																<div class="row align-items-center mb-2">
																	<div class="input-group col-12 col-sm-8">
																		<div class="input-group-prepend">
																			<div class="input-group-text">
																				<input type="radio" name="poll"
																					aria-label="">
																			</div>
																		</div>
																		<span type="text" class="form-control">
																			Nortada
																		</span>
																	</div>
																	<div
																		class="col-12 col-sm-4 ml-5 ml-sm-0 mt-1 mt-sm-0 text-muted">
																		13 votes
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div
														class="col-12 col-md-2 h-auto h-md-100 d-flex flex-row flex-md-column justify-content-center align-items-center pr-0 pl-0 pl-md-auto">
														<button type="button"
															class="btn btn-light w-100 h-100 flex-grow-2">
															<div
																class="w-100 h-100 d-flex flex-column align-items-center justify-content-center">
																<i class="far fa-thumbs-up"></i>
																<span>312</span>
															</div>
														</button>
														<button type="button" data-toggle="collapse"
															data-target="#comments2" aria-expanded="false"
															aria-controls="collapseExample"
															class="side-button btn btn-light w-100 h-100 flex-grow-2">
															<div
																class="w-100 h-100 d-flex flex-column align-items-center justify-content-center">
																<i class="far fa-comment-alt"></i>
																<span>2</span>
															</div>
														</button>
													</div>
												</div>
												<div class="row comment-section collapse mb-3 border-top border-light"
													id="comments2">
													<div
														class="row col-12 mt-3 justify-content-center align-items-center">
														<div
															class="col-12 col-md-10 d-flex flex-row align-items-center">
															<img src="../assets/user.svg"
																class="rounded-circle rounded-circle border border-light mr-3"
																width="30" height="30" />
															<form class="position-relative w-100" action="#">
																<textarea
																	class="form-control position-relative w-100 pr-5"
																	id="exampleFormControlTextarea1" rows="1"
																	placeholder="Write a comment..."
																	style="resize: none"></textarea>
																<div
																	class="position-absolute submit-btn-wrapper d-flex justify-content-center align-items-center mr-1">
																	<button class="submit-btn" type="submit">
																		<i class="fas fa-angle-double-right"></i>
																	</button>
																</div>
															</form>
														</div>
													</div>
													<div class="dropdown-divider col-12 col-md-10 mx-auto my-3"></div>
													<div
														class="row col-12 comment align-items-start justify-content-center">
														<div class="col-12 col-md-10 d-flex flex-row">
															<img src="../assets/user.svg"
																class="rounded-circle rounded-circle border border-light mr-3"
																width="30" height="30" />
															<div class="w-100 d-flex flex-column">
																<div class="comment-wrapper d-flex flex-column w-100">
																	<div class="comment-text px-3 py-2">
																		<span>
																			<span class=" author mr-2">John
																				Smith</span>Lorem
																			ipsum dolor sit amet, consectetur adipiscing
																			elit.
																			Aliquam feugiat orci sit amet ante ornare
																			lobortis
																			sed
																			non enim. Vestibulum.
																		</span>
																	</div>
																	<div class="comment-footer ml-3">
																		<a href="#">Like</a>
																		•
																		<a href="#">More</a>
																		•
																		<span>2 weeks ago</span>
																	</div>
																</div>
																<div
																	class="pl-1 mt-3 align-items-start d-flex flex-row">
																	<img src="../assets/user.svg"
																		class="rounded-circle rounded-circle border border-light mr-3"
																		width="30" height="30" />
																	<div
																		class="comment-wrapper d-flex flex-column w-100">
																		<div class="comment-text px-3 py-2">
																			<span>
																				<span class=" author mr-2">John
																					Smith</span>Lorem
																				ipsum dolor sit amet, consectetur
																				adipiscing elit.
																				Aliquam feugiat orci sit amet ante
																				ornare lobortis
																				sed
																				non enim. Vestibulum.
																			</span>
																		</div>
																		<div class="comment-footer ml-3">
																			<a href="#">Like</a>
																			•
																			<a href="#">More</a>
																			•
																			<span>2 weeks ago</span>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane fade" id="qa" role="tabpanel" aria-labelledby="qa-tab">
									<div class="container">
										<div class="row justify-content-center align-items-center mb-4">
											<div class="row col-12 mt-3 justify-content-center align-items-center">
												<div class="col-12 col-md-10 d-flex flex-row align-items-center">
													<img src="../assets/user.svg"
														class="rounded-circle rounded-circle border border-light mr-3"
														width="30" height="30" />
													<form class="position-relative w-100" action="#">
														<textarea class="form-control position-relative w-100 pr-5"
															id="exampleFormControlTextarea1" rows="1"
															placeholder="Ask a question"
															style="resize: none"></textarea>
														<div
															class="position-absolute submit-btn-wrapper d-flex justify-content-center align-items-center mr-1">
															<button class="submit-btn" type="submit">
																<i class="fas fa-angle-double-right"></i>
															</button>
														</div>
													</form>
												</div>
											</div>
										</div>
										<div class="row justify-content-center">
											<ul class="col-12 col-md-9 list-group list-group-flush">
												@foreach($questions as $question)
												<li class="list-group-item">
													<a class="pl-0 text-decoration-none qa-question dropdown-toggle"
														data-toggle="collapse" href="#collapse1" role="button"
														aria-expanded="false" aria-controls="collapseExample">
														{{$question->content}}
													</a>
													<div class="collapse" id="collapse1">
														<p class="text-muted">
															No.
														</p>
													</div>
												</li>
												@endforeach
											</ul>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
    
    @endsection