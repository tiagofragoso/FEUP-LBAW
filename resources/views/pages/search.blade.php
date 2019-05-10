@extends('layouts.app')

@section('title', 'Search')
@section('container', 'search-page')

@section('scripts')
	<script defer type="text/javascript" src="/js/search.js"> </script>
@endsection

@section('content')
<span class="position-absolute trigger"><!-- hidden trigger to apply 'stuck' styles --></span>
<div class="d-flex banner-container justify-content-center align-items-center">
    <div class="container mx-2 mx-sm-0 search-container">
        <div class="row">
            <h1 class="col-12 slogan mb-3">
                Sound.hub, where sound meets.
            </h1>
            <h5 class="col-12 slogan-sub mb-3">
                Search for worldwide music events to collaborate and attend at any time and place.
            </h5>
        </div>
        <form class="container search-card p-4" action="#results-container">
            <div class="row">
                <div class="col-12 input-group mb-3">
                    <input type="text" class="form-control py-3 py-md-4 h-100" placeholder="Search..." id="search-input" aria-describedby="button-go">
                    <div class="input-group-append h-100">
                        <button type="submit" class="btn btn-primary px-2 px-sm-4 px-md-5 w-100" type="button" id="button-go">Go!</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="dropdown col-6 col-sm-4 col-lg-2 mt-3">
                    <button type="button" class="btn btn-outline-primary w-100 h-100 dropdownField text-left" data-field="dropdownDate"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="mr-1 far fa-calendar-alt"></i>
                        Date
                    </button>
                    <div class="dropdown-menu p-4" aria-labelledby="dropdownDate">
                        <h6 class="dropdown-title">Dates</h6>
                        <p>
                            This will be a date picker...
                        </p>
                    </div>
                </div>
                <div class="dropdown col-6 col-sm-4 col-lg-2 mt-3">
                    <button type="button" class="btn btn-outline-primary w-100 h-100 dropdownField text-left" data-field="dropdownLocation"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="mr-1 fas fa-map-marker-alt"></i>
                        Location
                    </button>
                    <div class="dropdown-menu p-4" aria-labelledby="dropdownLocation">
                        <h6 class="dropdown-title">Location</h6>
                        <p>
                            This will be a location input...
                        </p>
                    </div>
                </div>
                <div class="dropdown col-6 col-sm-4 col-lg-2 mt-3">
                    <button type="button" class="btn btn-outline-primary w-100 h-100 dropdownField text-left" data-field="dropdownPrice"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="mr-1 fas fa-ticket-alt"></i>
                        Price
                    </button>
                    <div class="dropdown-menu p-4" aria-labelledby="dropdownPrice">
                        <h6 class="dropdown-title">Price</h6>
                        <p>
                            This will be a price input...
                        </p>
                    </div>
                </div>
                <div class="dropdown col-6 col-sm-4 col-lg-2 mt-3">
                    <button type="button" class="btn btn-outline-primary w-100 h-100 dropdownField text-left" data-field="dropdownCategory"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="mr-1 fas fa-tag"></i>
                        Category
                    </button>
                    <div class="dropdown-menu p-4" aria-labelledby="dropdownCategory">
                        <h6 class="dropdown-title">Category</h6>
                        <p>
                            This will be a category selection...
                        </p>
                    </div>
                </div>
                <div class="dropdown col-6 col-sm-4 col-lg-2 mt-3">
                    <button type="button" class="btn btn-outline-primary w-100 h-100 dropdownField text-left" data-field="dropdownStatus"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="mr-1 fas fa-check-circle"></i>
                        Status
                    </button>
                    <div class="dropdown-menu p-4" aria-labelledby="dropdownStatus">
                        <h6 class="dropdown-title">Status</h6>
                        <p>
                            This will be the status selection...
                        </p>
                    </div>
                </div>
                <div class="dropdown col-6 col-sm-4 col-lg-2 mt-3">
                    <button type="button" class="btn btn-outline-primary dropdown-toggle w-100 h-100 dropdownField text-left"
                        data-field="dropdownSort" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="mr-1 fas fa-random"></i>
                        Sort by
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownSort2">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="banner-overlay w-100 h-100 position-absolute"></div>
</div>

<div class="container mt-5" id="results-container">
    <div class="row">
        <div class="col-12">
            <h2>
                Search for: <span id="search-query">Trending events</span>
            </h2>
        </div>
    </div>
    <div class="row mt-3 mb-5">
        <div class="dropdown col-6 col-sm-4 col-lg-2 mt-3">
            <button type="button" class="btn btn-outline-primary w-100 h-100 dropdownField text-left" data-field="dropdownDate"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="mr-1 far fa-calendar-alt"></i>
                Date
            </button>
            <div class="dropdown-menu p-4" aria-labelledby="dropdownDate">
                <h6 class="dropdown-title">Dates</h6>
                <p>
                    This will be a date picker...
                </p>
            </div>
        </div>
        <div class="dropdown col-6 col-sm-4 col-lg-2 mt-3">
            <button type="button" class="btn btn-outline-primary w-100 h-100 dropdownField text-left" data-field="dropdownLocation"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="mr-1 fas fa-map-marker-alt"></i>
                Location
            </button>
            <div class="dropdown-menu p-4" aria-labelledby="dropdownLocation">
                <h6 class="dropdown-title">Location</h6>
                <p>
                    This will be a location input...
                </p>
            </div>
        </div>
        <div class="dropdown col-6 col-sm-4 col-lg-2 mt-3">
            <button type="button" class="btn btn-outline-primary w-100 h-100 dropdownField text-left" data-field="dropdownPrice"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="mr-1 fas fa-ticket-alt"></i>
                Price
            </button>
            <div class="dropdown-menu p-4" aria-labelledby="dropdownPrice">
                <h6 class="dropdown-title">Price</h6>
                <p>
                    This will be a price input...
                </p>
            </div>
        </div>
        <div class="dropdown col-6 col-sm-4 col-lg-2 mt-3">
            <button type="button" class="btn btn-outline-primary w-100 h-100 dropdownField text-left" data-field="dropdownCategory"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="mr-1 fas fa-tag"></i>
                Category
            </button>
            <div class="dropdown-menu p-4" aria-labelledby="dropdownCategory">
                <h6 class="dropdown-title">Category</h6>
                <p>
                    This will be a category selection...
                </p>
            </div>
        </div>
        <div class="dropdown col-6 col-sm-4 col-lg-2 mt-3">
            <button type="button" class="btn btn-outline-primary w-100 h-100 dropdownField text-left" data-field="dropdownStatus"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="mr-1 fas fa-check-circle"></i>
                Status
            </button>
            <div class="dropdown-menu p-4" aria-labelledby="dropdownStatus">
                <h6 class="dropdown-title">Status</h6>
                <p>
                    This will be the status selection...
                </p>
            </div>
        </div>
        <div class="dropdown col-6 col-sm-4 col-lg-2 mt-3">
            <button type="button" class="btn btn-outline-primary dropdown-toggle w-100 h-100 dropdownField text-left"
                data-field="dropdownSort" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="mr-1 fas fa-random"></i>
                Sort by
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownSort2">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6 col-lg-4">
            <a href="event.html" class="event-card mb-5 hover-shadow link" tabindex="-1">
                <header class="w-100 position-relative event-header d-flex align-items-center">
                    <img src="../assets/event-placeholder.png" class="w-100" alt="">
                    <div class="position-absolute w-100 h-100 gradient-overlay"></div>
                    <h6 class="position-absolute event-title px-3">
                        NOS Primavera Sound 2019
                    </h6>
                </header>
                <article class="event-info py-2">
                    <div class="container-fluid">
                        <div class="row d-flex align-items-center mt-1">
                            <i class="col-1 far fa-calendar-alt"></i>
                            <div class="col-10">6 JUN 2019</div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row d-flex align-items-center mt-1">
                            <i class="col-1 fas fa-map-marker-alt"></i>
                            <div class="col-10">Parque da Cidade, Porto</div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row d-flex align-items-center mt-1">
                            <i class="col-1 fas fa-ticket-alt"></i>
                            <div class="col-10">50€</div>
                        </div>
                    </div>
                </article>
            </a>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
            <a href="event.html" class="event-card mb-5 hover-shadow link" tabindex="-1">
                <header class="w-100 position-relative event-header d-flex align-items-center">
                    <img src="../assets/event-placeholder.png" class="w-100" alt="">
                    <div class="position-absolute w-100 h-100 gradient-overlay"></div>
                    <h6 class="position-absolute event-title px-3">
                        NOS Primavera Sound 2019
                    </h6>
                </header>
                <article class="event-info py-2">
                    <div class="container-fluid">
                        <div class="row d-flex align-items-center mt-1">
                            <i class="col-1 far fa-calendar-alt"></i>
                            <div class="col-10">6 JUN 2019</div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row d-flex align-items-center mt-1">
                            <i class="col-1 fas fa-map-marker-alt"></i>
                            <div class="col-10">Parque da Cidade, Porto</div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row d-flex align-items-center mt-1">
                            <i class="col-1 fas fa-ticket-alt"></i>
                            <div class="col-10">50€</div>
                        </div>
                    </div>
                </article>
            </a>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
            <a href="event.html" class="event-card mb-5 hover-shadow link" tabindex="-1">
                <header class="w-100 position-relative event-header d-flex align-items-center">
                    <img src="../assets/event-placeholder.png" class="w-100" alt="">
                    <div class="position-absolute w-100 h-100 gradient-overlay"></div>
                    <h6 class="position-absolute event-title px-3">
                        NOS Primavera Sound 2019
                    </h6>
                </header>
                <article class="event-info py-2">
                    <div class="container-fluid">
                        <div class="row d-flex align-items-center mt-1">
                            <i class="col-1 far fa-calendar-alt"></i>
                            <div class="col-10">6 JUN 2019</div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row d-flex align-items-center mt-1">
                            <i class="col-1 fas fa-map-marker-alt"></i>
                            <div class="col-10">Parque da Cidade, Porto</div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row d-flex align-items-center mt-1">
                            <i class="col-1 fas fa-ticket-alt"></i>
                            <div class="col-10">50€</div>
                        </div>
                    </div>
                </article>
            </a>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
            <a href="event.html" class="event-card mb-5 hover-shadow link" tabindex="-1">
                <header class="w-100 position-relative event-header d-flex align-items-center">
                    <img src="../assets/event-placeholder.png" class="w-100" alt="">
                    <div class="position-absolute w-100 h-100 gradient-overlay"></div>
                    <h6 class="position-absolute event-title px-3">
                        NOS Primavera Sound 2019
                    </h6>
                </header>
                <article class="event-info py-2">
                    <div class="container-fluid">
                        <div class="row d-flex align-items-center mt-1">
                            <i class="col-1 far fa-calendar-alt"></i>
                            <div class="col-10">6 JUN 2019</div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row d-flex align-items-center mt-1">
                            <i class="col-1 fas fa-map-marker-alt"></i>
                            <div class="col-10">Parque da Cidade, Porto</div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row d-flex align-items-center mt-1">
                            <i class="col-1 fas fa-ticket-alt"></i>
                            <div class="col-10">50€</div>
                        </div>
                    </div>
                </article>
            </a>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
            <a href="event.html" class="event-card mb-5 hover-shadow link" tabindex="-1">
                <header class="w-100 position-relative event-header d-flex align-items-center">
                    <img src="../assets/event-placeholder.png" class="w-100" alt="">
                    <div class="position-absolute w-100 h-100 gradient-overlay"></div>
                    <h6 class="position-absolute event-title px-3">
                        NOS Primavera Sound 2019
                    </h6>
                </header>
                <article class="event-info py-2">
                    <div class="container-fluid">
                        <div class="row d-flex align-items-center mt-1">
                            <i class="col-1 far fa-calendar-alt"></i>
                            <div class="col-10">6 JUN 2019</div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row d-flex align-items-center mt-1">
                            <i class="col-1 fas fa-map-marker-alt"></i>
                            <div class="col-10">Parque da Cidade, Porto</div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row d-flex align-items-center mt-1">
                            <i class="col-1 fas fa-ticket-alt"></i>
                            <div class="col-10">50€</div>
                        </div>
                    </div>
                </article>
            </a>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
            <a href="event.html" class="event-card mb-5 hover-shadow link" tabindex="-1">
                <header class="w-100 position-relative event-header d-flex align-items-center">
                    <img src="../assets/event-placeholder.png" class="w-100" alt="">
                    <div class="position-absolute w-100 h-100 gradient-overlay"></div>
                    <h6 class="position-absolute event-title px-3">
                        NOS Primavera Sound 2019
                    </h6>
                </header>
                <article class="event-info py-2">
                    <div class="container-fluid">
                        <div class="row d-flex align-items-center mt-1">
                            <i class="col-1 far fa-calendar-alt"></i>
                            <div class="col-10">6 JUN 2019</div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row d-flex align-items-center mt-1">
                            <i class="col-1 fas fa-map-marker-alt"></i>
                            <div class="col-10">Parque da Cidade, Porto</div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row d-flex align-items-center mt-1">
                            <i class="col-1 fas fa-ticket-alt"></i>
                            <div class="col-10">50€</div>
                        </div>
                    </div>
                </article>
            </a>
        </div>
    </div>
</div>
@endsection