<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Create Customer</h6>
            </div>
            <div class="modal-body">
                <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Name *</label>
                                <input type="text" class="form-control" id="customerName">
                                <label class="form-label">E-mail *</label>
                                <input type="text" class="form-control" id="customerEmail">
                                <label class="form-label">Phone Number *</label>
                                <input type="text" class="form-control" id="customerPhone">
                                <label class="form-label">Address *</label>
                                <input type="text" class="form-control" id="customerAddress">
                                <label class="form-label">Password *</label>
                                <input type="password" class="form-control" id="customerPassword">
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

        let customerName = document.getElementById('customerName').value;
        let customerEmail = document.getElementById('customerEmail').value;
        let customerPhone = document.getElementById('customerPhone').value;
        let customerAddress = document.getElementById('customerAddress').value;
        let customerPassword = document.getElementById('customerPassword').value;

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
            document.getElementById('modal-close').click();

            showLoader();
            let res = await axios.post("/customer-create", {
                name: customerName,
                email: customerEmail,
                phone: customerPhone,
                address: customerAddress,
                password: customerPassword
            });
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
