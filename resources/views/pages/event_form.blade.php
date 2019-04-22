@extends('layouts.app')

@section('title', $title)

@section('content')
<div id="content" class="container my-0 my-sm-5">
	<div class="row">
		<div class="card-wrapper col-12 mx-auto">
		<form method="POST" action="/events" class="card mb-5">
			{{ csrf_field() }}
				<div class="img-container w-100 d-flex align-items-center position-relative overflow-hidden">
					<label for="photo" class="btn btn-light border-light position-absolute tag-button">
						<i class="fas fa-camera mr-1"></i> Upload a photo
					</label>
					<input type="file" id="photo" name="photo" style="display:none;" accept="image/png, image/jpeg" >
					<img class="d-block w-100" src="../assets/event-placeholder.png" alt="First slide">
				</div>
				<div class="container-fluid mt-3">
					<div class="row justify-content-between align-items-center">
						<div class="col-12 col-md-8 mb-2 mb-md-0">
							<input type="text" class="form-control form-control-lg" placeholder="Event title">
						</div>
						<div class="col-12 col-md-4">
							<div class="input-group categoryInput">
								<div class="input-group-prepend">
									<label class="input-group-text" for="category"><i
											class="fas fa-tag"></i></label>
								</div>
								<input id="category" type="text" class="form-control border-blue"
									placeholder="Category" aria-label="category">
							</div>
						</div>
					</div>
					<hr>
					<div class="row mb-3 justify-content-between align-items-start">
						<div class="col-12 col-md-8 order-1 order-md-0">
							<input type="text" class="form-control" placeholder="Location">
						</div>
						<div class="col-12 col-md-4 input-group order-0 order-md-1 mb-3 mb-md-0">
							<div class="input-group w-100 justify-content-stretch">
								<div class="input-group-prepend">
									<label class="input-group-text" for="dateSelect">
										<i class="mr-1 far fa-calendar-alt"></i>
									</label>
								</div>
								<div class="dropdown flex-grow-1" id="dateSelect">
									<button class="btn w-100 custom-select text-left" type="button"
										data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Date
									</button>
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<a class="dropdown-item" href="#">TBD</a>
										<a class="dropdown-item" href="#">Free</a>
										<a class="dropdown-item" href="#">Insert value</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row mb-3 justify-content-between align-items-start">
						<div class="col-12 col-md-8 mb-3 mb-md-0">
							<input class="form-control form-control" type="text" placeholder="Address">
						</div>
						<div class="col-12 col-md-4">
							<div class="input-group">
								<div class="input-group-prepend">
									<label class="input-group-text" for="Visibility">
										<i class="fas fa-music"></i>
									</label>
								</div>
								<select class="custom-select border-blue" id="Visibility">
									<option selected disabled>Performance type</option>
									<option value="1">Concert</option>
									<option value="2">Festival</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row mb-3 justify-content-between">
						<div class="col-12 col-md-8 order-1 order-md-0">
							<textarea class="form-control" rows="3" placeholder="Brief description"
								style="resize:none"></textarea>
						</div>
						<div class="col-12 col-md-4 mb-3 mb-md-0 order-0 order-md-1">
							<div class="input-group">
								<div class="input-group-prepend">
									<label class="input-group-text" for="Visibility"><i
											class="fas fa-eye"></i></label>
								</div>
								<select class="custom-select border-blue" id="Visibility">
									<option selected disabled>Visibility</option>
									<option value="1">Public</option>
									<option value="2">Private</option>
								</select>
							</div>
						</div>

					</div>
					<div class="row justify-content-between">
						<div class="col-12 col-md-8 mb-2 mb-lg-0 ">
							<div class="d-flex flex-row justify-content-between position-relative">
								<div class="progress progress-3 position-absolute"></div>
								<div class="ml-3 step-wrapper d-flex flex-column align-items-center">
									<div
										class="step complete rounded-circle d-flex align-items-center justify-content-center">
										1
									</div>
									<span>Planning</span>
								</div>
								<div class="mr-3 step-wrapper d-flex flex-column align-items-center">
									<div
										class="step complete rounded-circle d-flex align-items-center justify-content-center">
										2
									</div>
									<span>Buy a ticket</span>
								</div>
							</div>
						</div>
						<div class="col-12 col-md-4">
							<div class="input-group priceSelect w-100">
								<div class="input-group-prepend">
									<label class="input-group-text" for="priceSelect"><i
											class="fas fa-ticket-alt"></i></label>
								</div>
								<div class="dropdown flex-grow-1" id="priceSelect">
									<button class="btn w-100 custom-select text-left" type="button"
										data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Price
									</button>
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<a class="dropdown-item" href="#">TBD</a>
										<a class="dropdown-item" href="#">Free</a>
										<a class="dropdown-item" href="#">Insert value</a>
									</div>
								</div>
								<div class="input-group-append">
									<select class="custom-select currency">
										<option selected>€</option>
										<option value="1">$</option>
										<option value="2">£</option>
									</select>
								</div>
							</div>
						</div>

					</div>
					<div class="row">
						<div class="col-12">
							<hr>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-12">
							<textarea rows="5" class="form-control"
								placeholder="Comprehensive event description"></textarea>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-6">
							<button class="btn btn-info w-100">Cancel</button>
						</div>
						<div class="col-6">
							<a href="event-host.html" class="btn btn-primary w-100">Submit</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection