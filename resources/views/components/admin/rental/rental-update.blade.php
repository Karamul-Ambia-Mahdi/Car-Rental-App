<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Update Rental</h6>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">

                                <label class="form-label">Customer Name</label>
                                <select type="text" class="form-control form-select" id="customerNameUpdate">
                                    <option value="">Select Customer</option>
                                </select>

                                <label class="form-label">Car Name</label>
                                <select type="text" class="form-control form-select" id="carNameUpdate">
                                    <option value="">Select Car</option>
                                </select>

                                <label class="form-label mt-2">Start Date</label>
                                <input id="startDateUpdate" type="date" class="form-control" />

                                <label class="form-label mt-2">End Date</label>
                                <input id="endDateUpdate" type="date" class="form-control" />

                                <label class="form-label">Status</label>
                                <select type="text" class="form-control form-select" id="statusUpdate">
                                    <option value="Pending">Pending</option>
                                    <option value="Ongoing">Ongoing</option>
                                    <option value="Completed">Completed</option>
                                    <option value="Canceled">Canceled</option>
                                </select>

                                <input type="text" class="d-none" id="updateId">

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
    async function UpdateFillCustomerDropDown() {

        $("#customerNameUpdate").empty();

        let res = await axios.get("/customer-list");

        res.data.forEach(function(item, i) {
            let option = `<option value="${item['id']}">${item['name']}</option>`
            $("#customerNameUpdate").append(option);
        });
    }

    async function UpdateFillCarDropDown() {

        $("#carNameUpdate").empty();

        let res = await axios.get("/car-list");

        res.data.forEach(function(item, i) {
            let option = `<option value="${item['id']}">${item['name']}</option>`
            $("#carNameUpdate").append(option);
        });
    }

    async function FillUpUpdateForm(id) {

        document.getElementById('updateId').value = id;

        showLoader();
        await UpdateFillCustomerDropDown();
        await UpdateFillCarDropDown();

        let res = await axios.post("/rental-by-id", {
            id: id
        })
        hideLoader();

        console.log(res);

        document.getElementById('customerNameUpdate').value = res.data['user_id'];
        document.getElementById('carNameUpdate').value = res.data['car_id'];
        document.getElementById('startDateUpdate').value = res.data['start_date'];
        document.getElementById('endDateUpdate').value = res.data['end_date'];
        document.getElementById('statusUpdate').value = res.data['status'];

    }

    async function Update() {

        let customerName = document.getElementById('customerNameUpdate').value;
        let carName = document.getElementById('carNameUpdate').value;
        let startDate = document.getElementById('startDateUpdate').value;
        let endDate = document.getElementById('endDateUpdate').value;
        let status = document.getElementById('statusUpdate').value;

        let id = document.getElementById('updateId').value;

        if (customerName.length === 0) {
            errorToast("Customer Name Required !");
        } 
        else if (carName.length === 0) {
            errorToast("Car Name Required !");
        } 
        else if (startDate.length === 0 || endDate.length === 0) {
            errorToast("Date Range Required !");
        } 
        else {
            document.getElementById('update-modal-close').click();

            showLoader();

            let res = await axios.post("/rental-update/" + startDate + '/' + endDate, {

                id: id,
                user_id: customerName,
                car_id: carName,
                status: status
            });

            hideLoader();

            if (res.status === 200 && res.data['status'] === 'success') {

                successToast(res.data['message']);
                document.getElementById("update-form").reset();

                await getList();
            } 
            else {
                errorToast(res.data['message'])
            }
        }
    }
</script>
