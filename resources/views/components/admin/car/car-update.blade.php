<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Car</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">

                                <label class="form-label mt-2">Name *</label>
                                <input type="text" class="form-control" id="carNameUpdate">

                                <label class="form-label mt-2">Brand *</label>
                                <input type="text" class="form-control" id="carBrandUpdate">

                                <label class="form-label mt-2">Model *</label>
                                <input type="text" class="form-control" id="carModelUpdate">

                                <label class="form-label mt-2">Year of Manufactere *</label>
                                <input type="text" class="form-control" id="carYearUpdate">

                                <label class="form-label mt-2">Type *</label>
                                <input type="text" class="form-control" id="carTypeUpdate">

                                <label class="form-label mt-2">Daily Rent Price *</label>
                                <input type="text" class="form-control" id="carPriceUpdate">

                                <br>
                                <img class="w-15" id="oldImg" src="{{ asset('images/default.jpg') }}">
                                <br>

                                <label class="form-label">Image</label>
                                <input oninput="oldImg.src=window.URL.createObjectURL(this.files[0])" type="file"
                                    class="form-control" id="carImgUpdate">

                                <input type="text" class="" id="updateId">
                                <input type="text" class="" id="filePath">

                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" class="btn bg-gradient-secondary" data-bs-dismiss="modal"
                    aria-label="Close">Close</button>
                <button onclick="Update()" id="update-btn" class="btn bg-gradient-success">Update</button>
            </div>
        </div>
    </div>
</div>

<script>

    async function FillUpUpdateForm(id, filePath) {

        document.getElementById('updateId').value = id;
        document.getElementById('filePath').value = filePath;
        document.getElementById('oldImg').src = filePath;

        showLoader();

        console.log(id);

        let res = await axios.post("/car-by-id", {
            id: id
        })
        hideLoader();

        document.getElementById('carNameUpdate').value = res.data['name'];
        document.getElementById('carBrandUpdate').value = res.data['brand'];
        document.getElementById('carModelUpdate').value = res.data['model'];
        document.getElementById('carYearUpdate').value = res.data['year'];
        document.getElementById('carTypeUpdate').value = res.data['car_type'];
        document.getElementById('carPriceUpdate').value = res.data['daily_rent_price'];

    }

    async function Update() {

        let carNameUpdate = document.getElementById('carNameUpdate').value;
        let carBrandUpdate = document.getElementById('carBrandUpdate').value;
        let carModelUpdate = document.getElementById('carModelUpdate').value;
        let carYearUpdate = document.getElementById('carYearUpdate').value;
        let carTypeUpdate = document.getElementById('carTypeUpdate').value;
        let carPriceUpdate = document.getElementById('carPriceUpdate').value;
        let carImgUpdate = document.getElementById('carImgUpdate').files[0];
        let updateId = document.getElementById('updateId').value;
        let filePath = document.getElementById('filePath').value;

        if (carNameUpdate.length === 0) {
            errorToast("Car Name Required !");
        } 
        else if (carBrandUpdate.length === 0) {
            errorToast("Car Brand Required !");
        } 
        else if (carModelUpdate.length === 0) {
            errorToast("Car Model Required !");
        } 
        else if (carYearUpdate.length === 0) {
            errorToast("Year of Manufacture Required !");
        } 
        else if (carTypeUpdate.length === 0) {
            errorToast("Car Type Required !");
        } 
        else if (carPriceUpdate.length === 0) {
            errorToast("Daily Rent Price Required !");
        } 
        else {
            document.getElementById('update-modal-close').click();

            let formData = new FormData();

            formData.append('img', carImgUpdate);
            formData.append('name', carNameUpdate);
            formData.append('brand', carBrandUpdate);
            formData.append('model', carModelUpdate);
            formData.append('year', carYearUpdate);
            formData.append('car_type', carTypeUpdate);
            formData.append('daily_rent_price', carPriceUpdate);
            formData.append('id', updateId);
            formData.append('file_path', filePath);

            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            };

            showLoader();
            let res = await axios.post("/car-update", formData, config);
            hideLoader();

            if (res.status === 200 && res.data === 1) {
                document.getElementById("update-form").reset();
                successToast("Request success !");
                await getList();
            } 
            else {
                errorToast("Request fail !");
            }
        }
    }
</script>
