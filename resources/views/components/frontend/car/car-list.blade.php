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
                <span class="text-muted">All Cars</span>
                <p class="lead text-muted">Spotlight on Our Exceptional Cars</p>
            </div>
        </div>

        <br />

        <div class="row">
            <div class="col-auto w-20">
                <select class="form-select" aria-label="Default select example" id="type" onchange="getList()">
                    <option value="">Type</option>
                    <option value="Coupe">Coupe</option>
                    <option value="Hatchback">Hatchback</option>
                    <option value="Sedan">Sedan</option>
                    <option value="SUV">SUV</option>
                </select>
            </div>
            <div class="col-auto w-20">
                <select class="form-select" aria-label="Default select example" id="brand" onchange="getList()">
                    <option value="">Brand</option>
                    <option value="Audi">Audi</option>
                    <option value="BMW">BMW</option>
                    <option value="Cadillac">Cadillac</option>
                    <option value="Dodge">Dodge</option>
                    <option value="Fiat">Fiat</option>
                    <option value="Ford">Ford</option>
                    <option value="Land Rover">Land Rover</option>
                    <option value="Mercedes-Benz">Mercedes-Benz</option>
                    <option value="Nissan">Nissan</option>
                    <option value="Porsche">Porsche</option>
                    <option value="Tesla">Tesla</option>
                </select>
            </div>
            <div class="col-auto w-20">
                <select class="form-select" aria-label="Default select example" id="price" onchange="getList()">
                    <option value="">Price</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="150">150</option>
                    <option value="200">200</option>
                    <option value="250">250</option>
                    <option value="300">300</option>
                    <option value="350">350</option>
                    <option value="400">400</option>
                    <option value="450">450</option>
                    <option value="500">500</option>
                </select>
            </div>
            <div class="col-auto w-30">
                <input type="text" class="form-control" id="search" placeholder="Search">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-secondary mb-3" onclick="getList()">Search</button>
            </div>
        </div>

        <br />

        <div class="row" id="carCard">

        </div>

    </div>
</section>

<script>
    getList();

    async function getList() {

        let search = document.getElementById('search').value;
        let type = document.getElementById('type').value;
        let brand = document.getElementById('brand').value;
        let price = document.getElementById('price').value;

        showLoader();
        let res = await axios.post('/all-cars', {
            search: search,
            type: type,
            brand: brand,
            price: price
        });
        hideLoader();

        let carCard = $("#carCard");

        carCard.empty();

        res.data.available_cars.forEach(function(car) {
            let card = `<div class="col-12 col-md-6 col-lg-3 p-3">
            <div class="card px-0 text-center">
                    <img class=" card-img-top mb-3 w-100" src="${car['image']}" alt="">
                    <div class="card-body">
                        <h4 class="mb-2">${car['name']}</h4>
                        <h6 class="text-muted mb-2">${car['car_type']}</h6>
                        <h6 class="text-muted mb-2">${car['year']}</h6>
                        <h5 class="text-muted mb-2">$${car['daily_rent_price']}/per day</h5>
                        <button data-id="${car['id']}" data-img="${car['image']}" data-name="${car['name']}" class="btn bookBtn btn-sm bg-gradient-secondary m-3">Rent Now</button>
                    </div>
                </div>
                </div>`

            carCard.append(card);
        });

        res.data.ongoing_cars.forEach(function(car) {
            let card = `<div class="col-12 col-md-6 col-lg-3 p-3">
            <div class="card px-0 text-center">
                    <img class=" card-img-top mb-3 w-100" src="${car['image']}" alt="">
                    <div class="card-body">
                        <h4 class="mb-2">${car['name']}</h4>
                        <h6 class="text-muted mb-2">${car['car_type']}</h6>
                        <h6 class="text-muted mb-2">${car['year']}</h6>
                        <h5 class="text-muted mb-2">$${car['daily_rent_price']}/per day</h5>
                        <button data-id="${car['id']}" data-name="${car['name']}" class="btn bookBtn btn-sm btn-outline-secondary m-3">Make a booking</button>
                    </div>
                </div>
                </div>`

            carCard.append(card);
        });

        $('.bookBtn').on('click', async function() {

            let id = $(this).data('id');
            let name = $(this).data('name');
            $("#booking-modal").modal('show');
            $("#bookingCarId").val(id);
            $("#bookingCarName").val(name);
        });
    }
</script>
