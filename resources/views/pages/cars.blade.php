@extends('layout.app')
@section('content')
    <section class="pb-5">
        <div class="container pt-2">
            <div class="row align-items-center mt-5 mb-5">
                <div class="col-12 col-md-10 col-lg-5 mb-5 mb-lg-0">
                    <h2 class=" fw-bold mb-3">Check out our latest cars</h2>
                    <p class="lead text-muted mb-4">Discover our latest cars, pre-booking without any payment,
                        and actionable insights in one intuitive app.</p>
                </div>
            </div>
        </div>
    </section>



    <section class="pb-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8 mx-auto text-center">
                    <span class="text-muted">Happy Clients</span>
                    <p class="lead text-muted">Spotlight on Our Exceptional Happy Clients</p>
                </div>
            </div>
            <br />
            <div class="row">
                <div class="col-12 col-md-6 col-lg-3 p-3">
                    <div class="card px-0 text-center">
                        <img class=" card-img-top mb-3 w-100" src="{{ asset('/images/flower.png') }}" alt="">
                        <h5>John Doe</h5>
                        <p class="text-muted mb-4">Rating : 5/5 Stars</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 p-3">
                    <div class="card px-0 text-center">
                        <img class=" card-img-top mb-3 w-100" src="{{ asset('/images/flower.png') }}" alt="">
                        <h5>Tommy Angelo</h5>
                        <p class="text-muted mb-4">Rating : 5/5 Stars</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 p-3">
                    <div class="card px-0 text-center">
                        <img class=" card-img-top mb-3 w-100" src="{{ asset('/images/flower.png') }}" alt="">
                        <h5>Jack Sparrow</h5>
                        <p class="text-muted mb-4">Rating : 5/5 Stars</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 p-3">
                    <div class="card px-0 text-center">
                        <img class=" card-img-top mb-3 w-100" src="{{ asset('/images/flower.png') }}" alt="">
                        <h5>El Tigre</h5>
                        <p class="text-muted mb-4">Rating : 5/5 Stars</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
