<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light border-navbar">
        <a class="navbar-brand" href="home.html"><img src="../assets/logo-horizontal.svg" height="30" alt="logo" /></a>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="form-inline mr-auto d-none d-lg-block" action="search.html">
                <div class="input-group mb-3 my-2 my-lg-0">
                    <input type="text" class="form-control" placeholder="Search" aria-label="Search"
                        aria-describedby="button-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" id="button-addon2">Go!</button>
                    </div>
                </div>
            </form>
            <ul class="navbar-nav">
                @if (Auth::check())
                <li class="nav-item mr-2 my-auto d-none d-lg-block">
                    <a href="create-event.html">
                        <button type="button" class="btn btn-primary">Create event</button>
                    </a>
                </li>
                @endif
                <li class="nav-item my-lg-auto d-lg-none mt-3">
                    <a class="nav-link text-muted" href="search.html">Search page</a>
                </li>
                @if (Auth::check())
                <li class="nav-item my-auto d-lg-none">
                    <a class="nav-link text-muted" href="create-event.html">Create event</a>
                </li>
                @endif
                <li class="nav-item my-auto">
                <a class="nav-link text-muted" href="{{ url('/about') }}">About</a>
                </li>
                @if (Auth::check())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="../assets/user.svg" class="rounded-circle border border-light" />
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item text-muted" href="{{ url('/profile') }}">My profile</a>
                        <a class="dropdown-item text-muted" href="{{ url('/settings') }}">Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-muted" href="{{ url('/logout') }}">Log out</a>
                    </div>
                </li>
                @else
                <li class="nav-item my-auto">
                        <a class="nav-link" href="{{ url('/login') }}">Sign in</a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
