<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Create Car</h6>
            </div>
            <div class="modal-body">
                <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">

                                <label class="form-label mt-2">Name *</label>
                                <input type="text" class="form-control" id="carName">

                                <label class="form-label mt-2">Brand *</label>
                                <input type="text" class="form-control" id="carBrand">

                                <label class="form-label mt-2">Model *</label>
                                <input type="text" class="form-control" id="carModel">

                                <label class="form-label mt-2">Year of Manufactere *</label>
                                <input type="text" class="form-control" id="carYear">

                                <label class="form-label mt-2">Type *</label>
                                <input type="text" class="form-control" id="carType">

                                <label class="form-label mt-2">Daily Rent Price *</label>
                                <input type="text" class="form-control" id="carPrice">

                                <br>
                                <img class="w-15" id="newImg" src="{{ asset('images/default.jpg') }}">
                                <br>

                                <label class="form-label">Image</label>
                                <input oninput="newImg.src=window.URL.createObjectURL(this.files[0])" type="file"
                                    class="form-control" id="carImg">

                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="modal-close" class="btn bg-gradient-secondary" data-bs-dismiss="modal"
                    aria-label="Close">Close</button>
                <button onclick="Save()" id="save-btn" class="btn bg-gradient-success">Save</button>
            </div>
        </div>
    </div>
</div>

<script>

    async function Save() {

        let carName = document.getElementById('carName').value;
        let carBrand = document.getElementById('carBrand').value;
        let carModel = document.getElementById('carModel').value;
        let carYear = document.getElementById('carYear').value;
        let carType = document.getElementById('carType').value;
        let carPrice = document.getElementById('carPrice').value;
        let carImg = document.getElementById('carImg').files[0];

        if (carName.length === 0) {
            errorToast("Car Name Required !");
        } 
        else if (carBrand.length === 0) {
            errorToast("Car Brand Required !");
        } 
        else if (carModel.length === 0) {
            errorToast("Car Model Required !");
        } 
        else if (carYear.length === 0) {
            errorToast("Year of Manufacture Required !");
        } 
        else if (carType.length === 0) {
            errorToast("Car Type Required !");
        } 
        else if (carPrice.length === 0) {
            errorToast("Daily Rent Price Required !");
        } 
        else if (!carImg) {
            errorToast("Car Image Required !");
        } 
        else {
            document.getElementById('modal-close').click();

            let formData = new FormData();

            formData.append('img', carImg);
            formData.append('name', carName);
            formData.append('brand', carBrand);
            formData.append('model', carModel);
            formData.append('year', carYear);
            formData.append('car_type', carType);
            formData.append('daily_rent_price', carPrice);

            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            };

            showLoader();
            let res = await axios.post("/car-create", formData, config);
            hideLoader();

            if (res.status === 201) {

                successToast('Request Completed');
                document.getElementById("save-form").reset();

                await getList();
            } 
            else {
                errorToast("Request fail !")
            }
        }
    }
</script>
