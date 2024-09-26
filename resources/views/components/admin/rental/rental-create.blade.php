<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Create Rental</h6>
            </div>
            <div class="modal-body">
                <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">

                                <label class="form-label">Customer Name</label>
                                <select type="text" class="form-control form-select" id="customerName">
                                    <option value="">Select Customer</option>
                                </select>

                                <label class="form-label">Car Name</label>
                                <select type="text" class="form-control form-select" id="carName">
                                    <option value="">Select Car</option>
                                </select>

                                <label class="form-label mt-2">Start Date</label>
                                <input id="startDate" type="date" class="form-control" />

                                <label class="form-label mt-2">End Date</label>
                                <input id="endDate" type="date" class="form-control" />

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

    FillCustomerDropDown();
    FillCarDropDown();

    async function FillCustomerDropDown() {

        let res = await axios.get("/customer-list");

        res.data.forEach(function(item, i) {
            let option = `<option value="${item['id']}">${item['name']}</option>`
            $("#customerName").append(option);
        });
    }

    async function FillCarDropDown() {

        let res = await axios.get("/car-list");

        res.data.forEach(function(item, i) {
            let option = `<option value="${item['id']}">${item['name']}</option>`
            $("#carName").append(option);
        });
    }

    async function Save() {

        let customerName = document.getElementById('customerName').value;
        let carName = document.getElementById('carName').value;
        let startDate = document.getElementById('startDate').value;
        let endDate = document.getElementById('endDate').value;

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
            document.getElementById('modal-close').click();

            showLoader();

            let res = await axios.post("/rental-create/" + startDate + '/' + endDate, {

                user_id: customerName,
                car_id: carName
            });

            hideLoader();

            if (res.status === 200 && res.data['status'] === 'success') {

                successToast(res.data['message']);
                document.getElementById("save-form").reset();

                await getList();
            } 
            else {
                errorToast(res.data['message'])
            }
        }
    }
</script>
