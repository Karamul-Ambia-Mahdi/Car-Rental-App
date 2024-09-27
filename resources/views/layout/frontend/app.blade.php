<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Car Rental Application</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('/favicon.ico') }}" />
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/toastify.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css') }}"
        rel="stylesheet" />

    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>

    <script src="{{ asset('js/toastify-js.js') }}"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script src="{{ asset('js/config.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
</head>

<body>

    <div id="loader" class="LoadingOverlay d-none">
        <div class="Line-Progress">
            <div class="indeterminate"></div>
        </div>
    </div>

    <nav class="navbar sticky-top shadow-sm navbar-expand-lg navbar-light py-2">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/home') }}">
                <img class="img-fluid" src="{{ asset('/images/logo.png') }}" alt="" width="200px">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#header01"
                aria-controls="header01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="header01">
                <ul class="navbar-nav ms-auto mt-3 mt-lg-0 mb-3 mb-lg-0 me-4">
                    <li class="nav-item me-4"><a class="nav-link" href="{{ url('/home') }}">Home</a></li>
                    <li class="nav-item me-4"><a class="nav-link" href="{{ url('/about-page') }}">About</a></li>
                    <li class="nav-item me-4"><a class="nav-link" href="{{ url('/cars-page') }}">Cars</a></li>
                    <li class="nav-item me-4"><a class="nav-link" href="{{ url('/rental-history') }}">Rentals</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/contact-page') }}">Contact</a></li>
                </ul>
                <div><a class="btn mt-3 bg-gradient-secondary" href="{{ url('/logout') }}">Logout</a></div>
            </div>
        </div>
    </nav>

    <div>
        @yield('content')
    </div>

    <footer class="py-5 bg-light">
        <div class="container text-center pb-5 border-bottom">
            <a class="d-inline-block mx-auto mb-4" href="/home">
                <img class="img-fluid"src="{{ asset('/images/logo-2.webp') }}" alt="" width="100px"><br>
                <b><i>Quick Car Rental</i></b>
            </a>
            <ul class="d-flex flex-wrap justify-content-center align-items-center list-unstyled mb-4">
                <li><a class="link-secondary me-4" href="#">Back to Top</a></li>
                <li><a class="link-secondary me-4" href="{{ url('/about-page') }}">About</a></li>
                <li><a class="link-secondary me-4" href="{{ url('/cars-page') }}">Cars</a></li>
                <li><a class="link-secondary me-4" href="{{ url('/rental-history') }}">Rentals</a></li>
                <li><a class="link-secondary me-4" href="{{ url('/contact-page') }}">Contact</a></li>
            </ul>
            <div>
                <a class="d-inline-block me-4" href="#">
                    <img src="{{ asset('/images/facebook.svg') }}">
                </a>
                <a class="d-inline-block me-4" href="#">
                    <img src="{{ asset('/images/twitter.svg') }}">
                </a>
                <a class="d-inline-block me-4" href="#">
                    <img src="{{ asset('/images/github.svg') }}">
                </a>
                <a class="d-inline-block me-4" href="#">
                    <img src="{{ asset('/images/instagram.svg') }}">
                </a>
                <a class="d-inline-block me-4" href="#">
                    <img src="{{ asset('/images/linkedin.svg') }}">
                </a>
            </div>
        </div>
        <div class="mb-5"></div>
        <div class="container">
            <p class="text-center">All rights reserved © Quick Car Rental 2024-2025</p>
        </div>
    </footer>

    <script></script>

    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>

</body>

</html>
