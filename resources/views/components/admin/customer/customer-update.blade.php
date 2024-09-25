<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Customer</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Name *</label>
                                <input type="text" class="form-control" id="customerNameUpdate">
                                <label class="form-label">E-mail *</label>
                                <input type="text" class="form-control" id="customerEmailUpdate">
                                <label class="form-label">Phone Number *</label>
                                <input type="text" class="form-control" id="customerPhoneUpdate">
                                <label class="form-label">Address *</label>
                                <input type="text" class="form-control" id="customerAddressUpdate">
                                <label class="form-label">Password *</label>
                                <input type="password" class="form-control" id="customerPasswordUpdate">

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
    async function FillUpUpdateForm(id) {
        document.getElementById('updateId').value = id;

        showLoader();
        let res = await axios.post("/customer-by-id", {
            id: id
        })
        hideLoader();

        document.getElementById('customerNameUpdate').value = res.data['name'];
        document.getElementById('customerEmailUpdate').value = res.data['email'];
        document.getElementById('customerPhoneUpdate').value = res.data['phone'];
        document.getElementById('customerAddressUpdate').value = res.data['address'];
        document.getElementById('customerPasswordUpdate').value = res.data['password'];
    }

    async function Update() {

        let customerName = document.getElementById('customerNameUpdate').value;
        let customerEmail = document.getElementById('customerEmailUpdate').value;
        let customerPhone = document.getElementById('customerPhoneUpdate').value;
        let customerAddress = document.getElementById('customerAddressUpdate').value;
        let customerPassword = document.getElementById('customerPasswordUpdate').value;

        let updateId = document.getElementById('updateId').value;

        if (customerName.length === 0) {
            errorToast("Customer Name Required !");
        } 
        else if (customerEmail.length === 0) {
            errorToast("Customer E-mail Required !");
        } 
        else if (customerPhone.length === 0) {
            errorToast("Customer Phone Number Required !");
        } 
        else if (customerAddress.length === 0) {
            errorToast("Customer Address Required !");
        } 
        else if (customerPassword.length === 0) {
            errorToast("Customer Password Required !");
        } 
        else {
            document.getElementById('update-modal-close').click();

            showLoader();
            let res = await axios.post("/customer-update", {
                id: updateId,
                name: customerName,
                email: customerEmail,
                password: customerPassword,
                phone: customerPhone,
                address: customerAddress
            })
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
