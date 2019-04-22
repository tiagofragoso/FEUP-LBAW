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
							<input type="text" name="title" class="form-control form-control-lg" placeholder="Event title">
						</div>
						<div class="col-12 col-md-4">
							<div class="input-group categoryInput">
								<div class="input-group-prepend">
									<label class="input-group-text" for="category"><i
											class="fas fa-tag"></i></label>
								</div>
								<select id="category" name="category" type="text" class="custom-select border-blue"
									placeholder="Category" aria-label="category">
									<option selected disabled>Category</option>
									@foreach ($categories as $cat)
										<option value="{{ $cat->id }}">{{ $cat->name }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<hr>
					<div class="row mb-3 justify-content-between align-items-start">
						<div class="col-12 col-md-8 order-1 order-md-0">
							<input type="text" name="location" class="form-control" placeholder="Location">
						</div>
						<div class="col-12 col-md-4 input-group order-0 order-md-1 mb-3 mb-md-0">
							<div class="input-group w-100 justify-content-stretch">
								<div class="input-group-prepend">
									<label class="input-group-text" for="dateSelect">
										<i class="mr-1 far fa-calendar-alt"></i>
									</label>
								</div>
								<input type="datetime-local" name="date" class="custom-select border-blue">
							</div>
						</div>
					</div>
					<div class="row mb-3 justify-content-between align-items-start">
						<div class="col-12 col-md-8 mb-3 mb-md-0">
							<input name="address" class="form-control form-control" type="text" placeholder="Address">
						</div>
						<div class="col-12 col-md-4">
							<div class="input-group">
								<div class="input-group-prepend">
									<label class="input-group-text" for="type">
										<i class="fas fa-music"></i>
									</label>
								</div>
								<select name="type" class="custom-select border-blue" id="type">
									<option selected disabled>Performance type</option>
									<option value="Concert">Concert</option>
									<option value="Festival">Festival</option>
									<option value="Liveset">Liveset</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row mb-3 justify-content-between">
						<div class="col-12 col-md-8 order-1 order-md-0">
							<textarea class="form-control" rows="3" name="brief" placeholder="Brief description"
								style="resize:none"></textarea>
						</div>
						<div class="col-12 col-md-4 mb-3 mb-md-0 order-0 order-md-1">
							<div class="input-group">
								<div class="input-group-prepend">
									<label class="input-group-text" for="Visibility"><i
											class="fas fa-eye"></i></label>
								</div>
								<select name="private" class="custom-select border-blue" id="Visibility">
									<option selected disabled>Visibility</option>
									<option value="0">Public</option>
									<option value="1">Private</option>
								</select>
							</div>
						</div>

					</div>
					<div class="row justify-content-between">
						<div class="col-12 col-md-8 mb-2 mb-lg-0 ">
							<div class="d-flex flex-row justify-content-between position-relative">
								<div class="progress progress-3 position-absolute"></div>
								<input id="step-1" name="status" value="Planning" style="display: none;" checked>
								<div class="ml-3 step-wrapper d-flex flex-column align-items-center">
									<label for="step-1"
										class="step complete rounded-circle d-flex align-items-center justify-content-center">
										1
								</label>
									<span>Planning</span>
								</div>
								<input id="step-2" name="status" value="Buy a ticket" style="display: none;">
								<div class="mr-3 step-wrapper d-flex flex-column align-items-center">
									<label for="step-2"
										class="step complete rounded-circle d-flex align-items-center justify-content-center">
										2
									</label>
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
								<input type="number" name="price" min="0" placeholder="Free" id="priceSelect" class="custom-select">
								<div class="input-group-append">
									<select class="custom-select currency" name="currency">
										@foreach ($currencies as $curr)
											<option value="{{ $curr->id }}">{{ $curr->symbol }}</option>
										@endforeach
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
							<textarea rows="5" class="form-control" name="description"
								placeholder="Comprehensive event description"></textarea>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-6">
							<a href="{{ url('/') }}" class="btn btn-info w-100">Cancel</a>
						</div>
						<div class="col-6">
							<button type="submit" class="btn btn-primary w-100">Submit</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection