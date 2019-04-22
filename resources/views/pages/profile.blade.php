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
								<h3 class="card-title user-name">John Smith</h3>
							</div>
						</div>
						<div class="row justify-content-center mb-2">
							<div class="col-10 text-center">
								<p class="card-subtitle text-muted">@john_smith</p>
							</div>
						</div>
						<div class="row justify-content-center mb-4">
							<div class="col-5 col-sm-4 text-right border-right pr-2">
								<p class="card-text">123 followers</p>
							</div>
							<div class="col-5 col-sm-4 text-left pl-0 ml-2">
								<p class="card-text">124 following</p>
							</div>
						</div>
						<div class="row justify-content-center mb-3">
							<div class="col text-right">
								<a class="card-link border-bottom" data-toggle="collapse" href="#mytickets"
									role="button" aria-expanded="false" aria-controls="mytickets">My tickets</a>
							</div>
							<div class="col text-left">
								<a href="settings.html" class="card-link border-bottom">Settings</a>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="mytickets collapse mb-2" id="mytickets">
							<div class="row pl-3">
								<div class="col-6 col-md-4 card ticket mr-1 ml-1 pt-2 pb-2" data-toggle="modal"
									data-target="#ticket1">
									<div class="row">
										<div class="col-12">
											<h4 class="ticket-title">NOS Primavera Sound 2019</h4>
										</div>
									</div>
									<div class="row">
										<div class="col-12">
											<p class="ticket-date card-text">6 JUN 2019 at 16:00</p>
										</div>
									</div>
									<div class="row">
										<div class="col-12">
											<p class="ticket-location card-text">Parque da Cidade</p>
										</div>
									</div>
									<div class="row justify-content-end">
										<div class="col-10 text-right">
											<p class="ticket-logo mb-0">sound.hub</p>
										</div>
									</div>
								</div>
								<div class="col-6 col-md-4 card ticket mr-1 ml-1 pt-2 pb-2">
									<div class="row">
										<div class="col-12">
											<h4 class="ticket-title">NOS Primavera Sound 2019</h4>
										</div>
									</div>
									<div class="row">
										<div class="col-12">
											<p class="ticket-date card-text">6 JUN 2019 at 16:00</p>
										</div>
									</div>
									<div class="row">
										<div class="col-12">
											<p class="ticket-location card-text">Parque da Cidade</p>
										</div>
									</div>
									<div class="row justify-content-end">
										<div class="col-10 text-right">
											<p class="ticket-logo mb-0">sound.hub</p>
										</div>
									</div>
								</div>
								<div class="col-6 col-md-4 card ticket mr-1 ml-1 pt-2 pb-2">
									<div class="row">
										<div class="col-12">
											<h4 class="ticket-title">NOS Primavera Sound 2019</h4>
										</div>
									</div>
									<div class="row">
										<div class="col-12">
											<p class="ticket-date card-text">6 JUN 2019 at 16:00</p>
										</div>
									</div>
									<div class="row">
										<div class="col-12">
											<p class="ticket-location card-text">Parque da Cidade</p>
										</div>
									</div>
									<div class="row justify-content-end">
										<div class="col-10 text-right">
											<p class="ticket-logo mb-0">sound.hub</p>
										</div>

									</div>
								</div>
								<div class="col-6 col-md-4 card ticket mr-1 ml-1 pt-2 pb-2">
									<div class="row">
										<div class="col-12">
											<h4 class="ticket-title">NOS Primavera Sound 2019</h4>
										</div>
									</div>
									<div class="row">
										<div class="col-12">
											<p class="ticket-date card-text">6 JUN 2019 at 16:00</p>
										</div>
									</div>
									<div class="row">
										<div class="col-12">
											<p class="ticket-location card-text">Parque da Cidade</p>
										</div>
									</div>
									<div class="row justify-content-end">
										<div class="col-10 text-right">
											<p class="ticket-logo mb-0">sound.hub</p>
										</div>

									</div>
								</div>
							</div>
							<div class="modal fade" id="ticket1" tabindex="-1" role="dialog"
								aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered justify-content-center" role="document">
									<div class="modal-content col-xs-12 col-sm-8 px-0 border-0">
										<div class="col-12 card ticket pt-2 pb-2">
											<div class="row">
												<div class="col-12">
													<h4 class="ticket-title">NOS Primavera Sound 2019</h4>
												</div>
											</div>
											<div class="row">
												<div class="col-12">
													<p class="ticket-date card-text">6 JUN 2019 at 16:00</p>
												</div>
											</div>
											<div class="row">
												<div class="col-12">
													<p class="ticket-location card-text">Parque da Cidade</p>
												</div>
											</div>
											<div class="row justify-content-center mt-5 mb-5">
												<div class="col text-center">
													<img src="../assets/qrcode.png" alt="..." class="rounded"
														width="250" height="250">
												</div>
											</div>
											<div class="row justify-content-between">
												<div class="col-2 text-center download-button">
													<i class="fas fa-download"></i>
												</div>
												<div class="col-10 text-right">
													<p class="ticket-logo mb-0">sound.hub</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="dropdown-divider"></div>
						</div>
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
									<div class="col-12 col-md-10 mx-auto mt-5">
										<div class="activity-event-card d-flex align-items-center hover-shadow"
											tabindex="-1">
											<div class="w-25 h-100 overflow-hidden d-flex justify-content-center">
												<img class="h-100" src="../assets/event-placeholder.png" alt="">
											</div>
											<div class="d-flex align-items-center w-75">
												<div class="container-fluid">
													<div class="row align-items-center">
														<a href="event.html" class="col-12 event-link">
															<h5 class="event-title">
																NOS Primavera Sound 2019
															</h5>
														</a>

														<div class="col-7 col-md-9 mt-4">
															<div class="text-muted event-date">6 JUN 2019</div>
															<div class="text-muted event-location">Parque da Cidade, Porto</div>
														</div>

														<div class="col-5 col-md-3 mt-4">
															<button type="button"
																class="btn btn-outline-primary joined-btn w-100">
																Joined
															</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="col-12 col-md-10 mx-auto mt-5">
										<div class="activity-event-card d-flex align-items-center hover-shadow"
											tabindex="-1">
											<div class="w-25 h-100 overflow-hidden d-flex justify-content-center">
												<img class="h-100" src="../assets/event-placeholder.png" alt="">
											</div>
											<div class="d-flex align-items-center w-75">
												<div class="container-fluid">
													<div class="row align-items-center">
														<a href="event.html" class="col-12 event-link">
															<h5 class="event-title">
																NOS Primavera Sound 2019
															</h5>
														</a>

														<div class="col-7 col-md-9 mt-4">
															<div class="text-muted event-date">6 JUN 2019</div>
															<div class="text-muted event-location">Parque da Cidade, Porto</div>
														</div>

														<div class="col-5 col-md-3 mt-4">
															<button type="button"
																class="btn btn-outline-primary joined-btn w-100">
																Joined
															</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-12 col-md-10 mx-auto mt-5">
										<div class="activity-event-card d-flex align-items-center hover-shadow"
											tabindex="-1">
											<div class="w-25 h-100 overflow-hidden d-flex justify-content-center">
												<img class="h-100" src="../assets/event-placeholder.png" alt="">
											</div>
											<div class="d-flex align-items-center w-75">
												<div class="container-fluid">
													<div class="row align-items-center">
														<a href="event.html" class="col-12 event-link">
															<h5 class="event-title">
																NOS Primavera Sound 2019
															</h5>
														</a>

														<div class="col-7 col-md-9 mt-4">
															<div class="text-muted event-date">6 JUN 2019</div>
															<div class="text-muted event-location">Parque da Cidade, Porto</div>
														</div>

														<div class="col-5 col-md-3 mt-4">
															<button type="button"
																class="btn btn-outline-primary joined-btn w-100">
																Joined
															</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-12 col-md-10 mx-auto mt-5">
										<div class="activity-event-card d-flex align-items-center hover-shadow card-fade"
											tabindex="-1">
											<div class="w-25 h-100 overflow-hidden d-flex justify-content-center">
												<img class="h-100" src="../assets/event-placeholder.png" alt="">
											</div>
											<div class="d-flex align-items-center w-75">
												<div class="container-fluid">
													<div class="row align-items-center">
														<a href="event.html" class="col-12 event-link">
															<h5 class="event-title">
																NOS Primavera Sound 2019
															</h5>
														</a>

														<div class="col-7 col-md-9 mt-4">
															<div class="text-muted event-date">6 JUN 2019</div>
															<div class="text-muted event-location">Parque da Cidade, Porto</div>
														</div>

														<div class="col-5 col-md-3 mt-4">
															<button type="button"
																class="btn btn-outline-primary joined-btn w-100">
																Joined
															</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="hosting" role="tabpanel" aria-labelledby="performing-tab">
								<div class="row">
									<div class="col-12 col-md-10 mx-auto mt-5">
										<div class="activity-event-card d-flex align-items-center hover-shadow"
											tabindex="-1">
											<div class="w-25 h-100 overflow-hidden d-flex justify-content-center">
												<img class="h-100" src="../assets/event-placeholder.png" alt="">
											</div>
											<div class="d-flex align-items-center w-75">
												<div class="container-fluid">
													<div class="row align-items-center">
														<a href="event-host.html" class="col-12 event-link">
															<h5 class="event-title">
																NOS Primavera Sound 2019
															</h5>
														</a>

														<div class="col-7 col-md-9 mt-4">
															<div class="text-muted event-date">6 JUN 2019</div>
															<div class="text-muted event-location">Parque da Cidade, Porto</div>
														</div>

														<div class="col-5 col-md-3 mt-4">
															<button type="button"
																class="btn btn-outline-primary joined-btn w-100">
																Joined
															</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="col-12 col-md-10 mx-auto mt-5">
										<div class="activity-event-card d-flex align-items-center hover-shadow"
											tabindex="-1">
											<div class="w-25 h-100 overflow-hidden d-flex justify-content-center">
												<img class="h-100" src="../assets/event-placeholder.png" alt="">
											</div>
											<div class="d-flex align-items-center w-75">
												<div class="container-fluid">
													<div class="row align-items-center">
														<a href="event-host.html" class="col-12 event-link">
															<h5 class="event-title">
																NOS Primavera Sound 2019
															</h5>
														</a>

														<div class="col-7 col-md-9 mt-4">
															<div class="text-muted event-date">6 JUN 2019</div>
															<div class="text-muted event-location">Parque da Cidade, Porto</div>
														</div>

														<div class="col-5 col-md-3 mt-4">
															<button type="button"
																class="btn btn-outline-primary joined-btn w-100">
																Joined
															</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="performing" role="tabpanel" aria-labelledby="performing-tab">
								<div class="row">
									<div class="col-12 col-md-10 mx-auto mt-5">
										<div class="activity-event-card d-flex align-items-center hover-shadow"
											tabindex="-1">
											<div class="w-25 h-100 overflow-hidden d-flex justify-content-center">
												<img class="h-100" src="../assets/event-placeholder.png" alt="">
											</div>
											<div class="d-flex align-items-center w-75">
												<div class="container-fluid">
													<div class="row align-items-center">
														<a href="event.html" class="col-12 event-link">
															<h5 class="event-title">NOS Primavera Sound 2019</h5>
														</a>

														<div class="col-7 col-md-9 mt-4">
															<div class="text-muted event-date">6 JUN 2019</div>
															<div class="text-muted event-location">Parque da Cidade, Porto</div>
														</div>

														<div class="col-5 col-md-3 mt-4">
															<button type="button"
																class="btn btn-outline-primary joined-btn w-100">
																Joined
															</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="col-12 col-md-10 mx-auto mt-5">
										<div class="activity-event-card d-flex align-items-center hover-shadow card-fade"
											tabindex="-1">
											<div class="w-25 h-100 overflow-hidden d-flex justify-content-center">
												<img class="h-100" src="../assets/event-placeholder.png" alt="">
											</div>
											<div class="d-flex align-items-center w-75">
												<div class="container-fluid">
													<div class="row align-items-center">
														<a href="event.html" class="col-12 event-link">
															<h5 class="event-title">NOS Primavera Sound 2019</h5>
														</a>

														<div class="col-7 col-md-9 mt-4">
															<div class="text-muted event-date">6 JUN 2019</div>
															<div class="text-muted event-location">Parque da Cidade, Porto</div>
														</div>

														<div class="col-5 col-md-3 mt-4">
															<button type="button"
																class="btn btn-outline-primary joined-btn w-100">
																Joined
															</button>
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
			</div>
		</div>
	</div>
@endsection

