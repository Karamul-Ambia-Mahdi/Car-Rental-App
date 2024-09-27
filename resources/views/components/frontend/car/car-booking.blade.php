<div class="modal animated zoomIn" id="booking-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Create Booking</h6>
            </div>
            <div class="modal-body">
                <form id="booking-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">

                                <label class="form-label">Car Name</label>
                                <input readonly type="text" class="form-control" id="bookingCarName">

                                <label class="form-label mt-2">Start Date</label>
                                <input id="startDate" type="date" class="form-control" />

                                <label class="form-label mt-2">End Date</label>
                                <input id="endDate" type="date" class="form-control" />

                                <input class="d-none" id="bookingCarId">

                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="booking-modal-close" class="btn bg-gradient-secondary" data-bs-dismiss="modal"
                    aria-label="Close">Close</button>
                <button onclick="BookCar()" id="book-btn" class="btn bg-gradient-success">Confirm</button>
            </div>
        </div>
    </div>
</div>

<script>
    async function BookCar() {

        let startDate = document.getElementById('startDate').value;
        let endDate = document.getElementById('endDate').value;

        let id = document.getElementById('bookingCarId').value;

        if (startDate.length === 0 || endDate.length === 0) {
            errorToast("Date Range Required !");
        } 
        else {
            document.getElementById('booking-modal-close').click();

            showLoader();
            let res = await axios.post('/create-rental/' + startDate + '/' + endDate, {
                car_id: id,
            });
            hideLoader();

            console.log(res);

            if (res.status === 200 && res.data['status'] === 'success') {

                successToast(res.data['message']);
                document.getElementById("booking-form").reset();

                setTimeout(() => {
                    window.location.href = "/rental-history";
                }, 2000);

            }
            else if(res.status === 200 && res.data['status'] === 'Unauthorized'){
                
                errorToast(res.data['message']);

                setTimeout(() => {
                    window.location.href = "/login";
                }, 2000);
            } 
            else {
                errorToast(res.data['message'])
            }
        }


    }
</script>
