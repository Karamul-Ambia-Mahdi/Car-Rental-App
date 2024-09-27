@extends('layout.frontend.app')
@section('content')
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