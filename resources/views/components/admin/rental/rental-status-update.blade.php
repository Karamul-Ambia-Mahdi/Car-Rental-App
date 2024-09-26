<div class="modal animated zoomIn" id="status-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Update Status</h6>
            </div>
            <div class="modal-body">
                <form id="status-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">

                                <label class="form-label">Status</label>
                                <select type="text" class="form-control form-select" id="rentalStatus">
                                    <option value="">Select Status</option>
                                    <option value="Ongoing">Ongoing</option>
                                    <option value="Completed">Completed</option>
                                    <option value="Canceled">Canceled</option>
                                </select>

                                <input class="d-none" id="rentalId">
                                <input class="d-none" id="carId">

                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="status-modal-close" class="btn bg-gradient-secondary" data-bs-dismiss="modal"
                    aria-label="Close">Close</button>
                <button onclick="updateStatus()" id="save-btn" class="btn bg-gradient-success">Save</button>
            </div>
        </div>
    </div>
</div>

<script>

    async function updateStatus(){

        let status = document.getElementById("rentalStatus").value;
        let id = document.getElementById("rentalId").value;
        let car_id = document.getElementById("carId").value;

        document.getElementById('status-modal-close').click();

        showLoader()

        let res = await axios.post('/rental-status-update', {
            id: id,
            car_id: car_id,
            status: status
        });

        hideLoader()

        if(res.data == 1){
            document.getElementById("status-form").reset();
            successToast("Status updated successfully");
            await getList();
        }
    }
</script>
