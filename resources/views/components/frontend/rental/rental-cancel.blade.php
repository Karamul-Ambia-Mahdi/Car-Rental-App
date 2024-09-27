<div class="modal animated zoomIn" id="cancel-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h3 class=" mt-3 text-warning">Cancel !</h3>
                <p class="mb-3">Are you sure to cancel the booking?</p>
                <input class="d-none" id="cancelId" />
            </div>
            <div class="modal-footer justify-content-end">
                <div>
                    <button type="button" id="cancel-modal-close" class="btn bg-gradient-success mx-2"
                        data-bs-dismiss="modal">Close</button>
                    <button onclick="rentalCancel()" type="button" id="confirmCancel"
                        class="btn bg-gradient-danger">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    async function rentalCancel() {

        let id = document.getElementById('cancelId').value;

        document.getElementById('cancel-modal-close').click();

        showLoader();
        let res = await axios.post("/cancel-rental", {
            id: id
        });
        hideLoader();

        if (res.status === 200 && res.data['status'] === 'success') {
            successToast(res.data['message']);
            await getList();
        } 
        else {
            errorToast(res.data['message']);
        }
    }
</script>
