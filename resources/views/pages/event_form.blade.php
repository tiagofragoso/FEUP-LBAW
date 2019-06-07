@extends('layouts.app')

@section('title', $title)
@section('container', 'event-form-page')

@section('scripts')
<script defer type="module" src="/js/event_form.js"> </script>
@endsection

@section('content')
<div id="content" class="container my-0 my-sm-5">
	<div class="row">
		<div class="card-wrapper col-12 mx-auto">
		<form method="POST" action="{{ empty($event)? '/events' : '/events/'.$event->id }}" class="card mb-5" enctype="multipart/form-data">
			@if (!empty($event))
				{{ method_field('PUT') }}
			@endif
			{{ csrf_field() }}
				<div class="img-container w-100 d-flex align-items-center position-relative overflow-hidden">
					<input type="file" id="photo" name="photo" style="display:none;" accept="image/png, image/jpeg" >
					<div class="event-btns d-flex flex-row position-absolute">
						<label for="photo" class="btn btn-light border-light">
							<i class="fas fa-camera mr-1"></i> Upload a photo
						</label>
					</div>
					<button type="button" class="btn btn-light border-light position-absolute help-btn" data-toggle="modal" data-target="#help-modal">
							<div class="help-text mr-3 ">Having trouble filling out the form? Click here.</div>
							<i class="fas fa-question mr-1"></i>
					</button>
					<img id="img" class="d-block w-100" src="{{ !empty($event)? $event->image() : asset('assets/event-placeholder.png') }}" alt="Event photo">
				</div>
				<div class="modal fade" id="help-modal" tabindex="-1" role="dialog" aria-labelledby="help-modal-title" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="help-modal-title">Filling out the event form</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="container">
										<div class="row">
											<ol>
												<li>Give your event an <strong>appealing title</strong>.</li>
												<li>Upload an <strong>attractive image</strong>.<small>(Optional)</small></li>
												<li>Fill out the <strong>location</strong> and <strong>address</strong> fields.<small>(Optional)</small></li>
												<li>Add a <strong>brief description</strong>.</li>
												<li>Choose the event <strong>category, performance type and visibility</strong>.</li>
												<li>Fill out the <strong>date range</strong>.<small>(Optional for planning status)</small></li>
												<li>Choose the event <strong>status</strong>. The <strong>planning</strong> phase is used to gather information
													from the users before deciding on final event information. The <strong>tickets</strong> phase is applicable
													when core event info is set.</li>
												<li>Choose the <strong>ticket price</strong>.<small>(Optional for planning status)</small></li>
												<li>Write a <strong>comprehensive description</strong> describing the event.</li>
												<li><strong>Submit!</strong></li>
											</ol>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
				<div class="container-fluid mt-3">
					@if ($errors->has('photo'))
						<span class="invalid-feedback" style="display:block;">
							{{ $errors->first('photo') }}
						</span>
					@endif
					<div class="row justify-content-between align-items-start">
						<div class="col-12 col-md-8 mb-2 mb-md-0">
							<input type="text" name="title" class="form-control form-control-lg {{$errors->has('title')? 'is-invalid' : '' }}" 
								placeholder="Event title" value="{{old('title', !empty($event->title)? $event->title : '') }}" required maxlength="60">
							@if ($errors->has('title'))
								<span class="invalid-feedback">
									{{ $errors->first('title') }}
								</span>
                        	@endif
						</div>
						<div class="col-12 col-md-4">
							<div class="input-group categoryInput">
								<div class="input-group-prepend">
									<label class="input-group-text" for="category"><i
											class="fas fa-tag"></i></label>
								</div>
								<select id="category" name="category" type="text" class="custom-select border-blue {{$errors->has('category')? 'is-invalid' : '' }}"
									placeholder="Category" aria-label="category" required>
									<option {{ !empty(old('category', !empty($event->category)? $event->category : '')) ? '' : 'selected' }} disabled value="">Category</option>
									@foreach ($categories as $cat)
										<option value="{{ $cat->id }}" {{ (old('category', !empty($event->category)? $event->category : '')) == $cat->id ? 'selected' : '' }}>
											{{ $cat->name }}
										</option>
									@endforeach
								</select>
								@if ($errors->has('category'))
									<span class="invalid-feedback">
										{{ $errors->first('category') }}
									</span>
                        		@endif
							</div>
						</div>
					</div>
					<hr>
					<div class="row mb-3 justify-content-between align-items-start">
						<div class="col-12 col-md-8 order-1 order-md-0">
							<input type="text" name="location" class="form-control {{$errors->has('location')? 'is-invalid' : '' }} " maxlength="50" 
								value="{{ old('location', !empty($event->location)? $event->location : '') }}" placeholder="Location">
							@if ($errors->has('location'))
								<span class="invalid-feedback">
									{{ $errors->first('location') }}
								</span>
							@endif
						</div>
						<div class="col-12 col-md-4 order-0 order-md-1 mb-3 mb-md-0">
							<div class="input-group">
								<div class="input-group-prepend">
									<label class="input-group-text" for="type">
										<i class="fas fa-music"></i>
									</label>
								</div>
								<select name="type" class="custom-select border-blue {{$errors->has('type')? 'is-invalid' : '' }}" id="type" required>
									<option {{ !empty(old('type', !empty($event->type)? $event->type : '')) ? '' : 'selected' }} disabled value="">Performance type</option>
									<option value="Concert" {{ (old('type', !empty($event->type)? $event->type : '') == 'Concert')? 'selected' : ''}}>Concert</option>
									<option value="Festival" {{ (old('type', !empty($event->type)? $event->type : '') == 'Festival')? 'selected' : ''}}>Festival</option>
									<option value="Liveset" {{ (old('type', !empty($event->type)? $event->type : '') == 'Liveset')? 'selected' : ''}}>Liveset</option>
								</select>
								@if ($errors->has('type'))
									<span class="invalid-feedback">
										{{ $errors->first('type') }}
									</span>
								@endif
							</div>
						</div>
					</div>
					<div class="row mb-3 justify-content-between align-items-start">
						<div class="col-12 col-md-8 mb-3 mb-md-0">
							<input name="address" class="form-control form-control {{$errors->has('address')? 'is-invalid' : '' }}" maxlength="100"
								value="{{ old('address', !empty($event->address)? $event->address : '') }}" type="text" placeholder="Address">
							@if ($errors->has('address'))
								<span class="invalid-feedback">
									{{ $errors->first('address') }}
								</span>
							@endif
						</div>
						<div class="col-12 col-md-4 ">
							<div class="input-group">
								<div class="input-group-prepend">
									<label class="input-group-text" for="Visibility"><i
											class="fas fa-eye"></i></label>
								</div>
								<select name="private" class="custom-select border-blue {{$errors->has('private')? 'is-invalid' : '' }}" id="Visibility" required>
									<option {{ is_null(old('private', isset($event->private)? $event->private : null)) ? 'selected' : '' }} disabled value="">Visibility</option>
									<option value="0" {{ (old('private', isset($event->private)? $event->private : '') === 0)? 'selected' : ''}}>Public</option>
									<option value="1" {{ (old('private', isset($event->private)? $event->private : '') === 1)? 'selected' : ''}}>Private</option>
								</select>
								@if ($errors->has('private'))
									<span class="invalid-feedback">
										{{ $errors->first('private') }}
									</span>
								@endif
							</div>
						</div>
						
					</div>
					<div class="row mb-3 justify-content-between">
						<div class="col-12 col-md-8 order-1 order-md-0">
							<textarea class="form-control {{$errors->has('brief')? 'is-invalid' : '' }}" rows="4" name="brief" placeholder="Brief description"
								style="resize:none" required maxlength="140">{{ old('brief', !empty($event->brief)? $event->brief : '') }}</textarea>
							@if ($errors->has('brief'))
								<span class="invalid-feedback">
									{{ $errors->first('brief') }}
								</span>
							@endif
						</div>
						<div class="col-12 col-md-4 mb-3 mb-md-0 input-group order-0 order-md-1">
							<div class="input-group w-100 justify-content-stretch">
								<div class="input-group-prepend">
									<label class="input-group-text" for="dateSelect">
										<i class="mr-1 far fa-calendar-alt"></i>
									</label>
								</div>
								<input type="text" style="display:none;" name="start_date" value="{{ old('start_date', !empty($event->start_date)? $event->start_date: '' ) }}">
								<input type="text" style="display:none;" name="end_date" value="{{ old('end_date', !empty($event->end_date)? $event->end_date: '' ) }}">
								<div class="dropup flex-grow-1">
									<button id="date-toggle" type="button" class="w-100 h-100 dropdownField text-left custom-select border-blue " data-field="dropdownDate"
										data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-flip="false" title="">
										<div class="h-100 w-100 d-flex flex-column justify-content-around">
											<span id="start-date-label">Start date</span>
											<span class="text-muted mx-3">to</span>
											<span id="end-date-label">End date</span>
										</div>
									</button>
									<div id="date-dropdown" aria-labelledby="dropdownDate" class="dropdown-menu dropdown-menu-right"></div>
								</div>
							</div>
							@if ($errors->has('start_date') || $errors->has('end_date'))
								<span class="invalid-feedback" style="display:block;">
									{{ $errors->first('start_date').$errors->first('end_date') }}
								</span>
							@endif
						</div>
					</div>
					<div class="row justify-content-between">
						<div class="col-12 col-md-8 mb-2 mb-lg-0 ">
							<div class="d-flex flex-row justify-content-between position-relative">
								<input type="radio" id="step-1" name="status" value="Planning" style="display: none;" 
									{{ (old('status', !empty($event->status)? $event->status : '') == 'Planning' || empty(old('status', !empty($event->status)? $event->status : '')))? 'checked' : ''}}>
								<div class="progress progress-1 position-absolute"></div>
								<div class="ml-5 step-wrapper d-flex flex-column align-items-center">
									<label for="step-1"
										class="step rounded-circle d-flex align-items-center justify-content-center">
										1
									</label>
									<span>Planning</span>
								</div>
								<input type="radio" id="step-2" name="status" value="Tickets" style="display: none;" {{ (old('status', !empty($event->status)? $event->status : '') == 'Tickets')? 'checked' : ''}}>
								<div class="progress progress-3 position-absolute"></div>
								<div class="mr-5 step-wrapper d-flex flex-column align-items-center">
									<label for="step-2"
										class="step rounded-circle d-flex align-items-center justify-content-center">
										2
									</label>
									<span>Buy a ticket</span>
								</div>
							</div>
							@if ($errors->has('status'))
								<span class="invalid-feedback" style="display: block;">
									{{ $errors->first('status') }}
								</span>
							@endif
						</div>
						<div class="col-12 col-md-4">
							<div class="input-group priceSelect w-100">
								<div class="input-group-prepend">
									<label class="input-group-text" for="priceSelect"><i
											class="fas fa-ticket-alt"></i></label>
								</div>
								<input type="number" name="price" min="0" placeholder="Free" id="priceSelect" value="{{ old('price', !empty($event->price)? $event->price : '') }}"
									class="custom-select {{$errors->has('price')? 'is-invalid' : '' }}">
								<div class="input-group-append">
									<select class="custom-select currency" name="currency">
										@foreach ($currencies as $curr)
											<option value="{{ $curr->id }}" {{ (old('currency', !empty($event->currency)? $event->currency : '') == $curr->id)? 'selected' : ''}}>{{ $curr->symbol }}</option>
										@endforeach
									</select>
								</div>
								@if ($errors->has('price'))
									<span class="invalid-feedback">
										{{ $errors->first('price') }}
									</span>
								@endif
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
							<textarea rows="6" class="form-control" name="description" required
								placeholder="Comprehensive event description">{{ old('description', !empty($event->description)? $event->description : '') }}</textarea>
							@if ($errors->has('description'))
								<span class="invalid-feedback">
									{{ $errors->first('description') }}
								</span>
							@endif
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