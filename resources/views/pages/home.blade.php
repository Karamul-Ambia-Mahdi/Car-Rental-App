@extends('layout.app')
@section('content')
    <section class="pb-5">
        <div class="container pt-2">
            <div class="row align-items-center mt-5 mb-5">
                <div class="col-12 col-md-10 col-lg-5 mb-5 mb-lg-0">
                    <h2 class=" fw-bold mb-3">Make Your Journey Delightful With Our Services.</h2>
                    <p class="lead text-muted mb-4">Discover our latest cars, pre-booking without any payment,
                        and actionable insights in one intuitive app.</p>
                    <div class="d-flex flex-wrap"><a class="btn bg-gradient-secondary me-2 mb-2 mb-sm-0"
                            href="{{ url('/cars') }}">Rent A Car</a>
                        <a class="btn bg-gradient-secondary mb-2 mb-sm-0" href="{{ url('/login') }}">Login</a>
                    </div>
                </div>
                <div class="col-12 col-lg-6 offset-lg-1">
                    <img class="img-fluid" src="{{ asset('/images/Land-Rover-Defender-02.png') }}" alt="">
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

    <br />

    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-5 mb-5 mb-lg-0">
                    <h2 class="fw-bold mb-5">Reach Out to Us: Let's Connect and Explore Opportunities Together</h2>
                    <h4 class="fw-bold">Address</h4>
                    <p class="text-muted mb-5">Shop No-21, Shapla Super Market, Station Road, Sreemangal-3210</p>
                    <h4 class="fw-bold">Contact Us</h4>
                    <p class="text-muted mb-1">quick.car.rental@test.com</p>
                    <p class="text-muted mb-0">+880 1234 - 567890</p>
                </div>
                <div class="col-12 col-lg-6 offset-lg-1">
                    <form action="#">
                        <input class="form-control mb-3" type="text" placeholder="Name">
                        <input class="form-control mb-3" type="email" placeholder="E-mail">
                        <textarea class="form-control mb-3" name="message" cols="30" rows="10" placeholder="Your Message..."></textarea>
                        <button class="btn bg-gradient-secondary w-100">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
