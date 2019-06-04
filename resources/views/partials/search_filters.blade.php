<div class="dropdown col-6 col-sm-4 col-lg-2 mt-3">
    <button type="button" class="btn btn-outline-primary w-100 h-100 dropdownField text-left" data-field="dropdownDate"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-flip="false">
        <i class="mr-1 far fa-calendar-alt"></i>
        <span>
            Date
        </span>
    </button>
    <div class="dropdown-menu p-4" aria-labelledby="dropdownDate">
        <h6 class="dropdown-title">Dates</h6>
        <div>
            <div class="datepicker-here" data-language='en' data-range="true"></div>
        </div>
    </div>
</div>
<div class="dropdown col-6 col-sm-4 col-lg-2 mt-3">
    <button type="button" class="btn btn-outline-primary w-100 h-100 dropdownField text-left" data-field="dropdownLocation"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-flip="false">
        <i class="mr-1 fas fa-map-marker-alt"></i>
        <span>
            Location
        </span>
    </button>
    <div class="dropdown-menu p-4" aria-labelledby="dropdownLocation">
        <h6 class="dropdown-title">Location</h6>
        <div class="form-group">
            <input type="text" class="form-control location-input" placeholder="Enter location">
        </div>
    </div>
</div>
<div class="dropdown col-6 col-sm-4 col-lg-2 mt-3">
    <button type="button" class="btn btn-outline-primary w-100 h-100 dropdownField text-left" data-field="dropdownPrice"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-flip="false">
        <i class="mr-1 fas fa-ticket-alt"></i>
        <span>
            Price
        </span>
    </button>
    <div class="dropdown-menu p-4" aria-labelledby="dropdownPrice">
        <h6 class="dropdown-title">Price</h6>
        <div class="form-group">
            <label for="start-price-input">Start price:</label>
            <input type="number" class="form-control mb-2 start-price-input" placeholder="Enter start price">
            <label for="end-price-input">End price:</label>
            <input type="number" class="form-control end-price-input" placeholder="Enter end price">
        </div>
    </div>
</div>
<div class="dropdown col-6 col-sm-4 col-lg-2 mt-3">
    <button type="button" class="btn btn-outline-primary w-100 h-100 dropdownField text-left" data-field="dropdownCategory"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-flip="false">
        <i class="mr-1 fas fa-tag"></i>
        <span>
            Category
        </span>
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownCategory">
        @foreach ($categories as $category)
        <div class="dropdown-item" data-value="{{ $category->id }}">{{ $category->name }}</div>
        @endforeach
    </div>
</div>
<div class="dropdown col-6 col-sm-4 col-lg-2 mt-3">
    <button type="button" class="btn btn-outline-primary w-100 h-100 dropdownField text-left" data-field="dropdownStatus"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-flip="false">
        <i class="mr-1 fas fa-check-circle"></i>
        <span>
            Status
        </span>
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownStatus">
        <div class="dropdown-item" data-value="Planning">Planning</div>
        <div class="dropdown-item" data-value="Tickets">Tickets</div>
        <div class="dropdown-item" data-value="Live">Live</div>
    </div>
</div>
<div class="dropdown col-6 col-sm-4 col-lg-2 mt-3">
    <button type="button" class="btn btn-outline-primary w-100 h-100 dropdownField text-left" data-field="dropdownSort" 
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-flip="false">
        <i class="mr-1 fas fa-random"></i>
        <span>
            Sort by
        </span>
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownSort">
        <div class="dropdown-item" data-value="start_date">Date</div>
        <div class="dropdown-item" data-value="price">Price</div>
    </div>
</div>