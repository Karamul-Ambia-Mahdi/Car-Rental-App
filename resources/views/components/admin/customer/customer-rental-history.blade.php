<div class="modal animated zoomIn" id="details-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Rental History</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div id="rentalHistory" class="modal-body p-3">
                <div class="container-fluid">

                    <br />

                    <div class="row">
                        <div class="col-8">
                            <span class="text-bold text-dark">Customer Details</span>
                            <p class="text-xs mx-0 my-1">Name: <span id="CusName"></span></p>
                            <p class="text-xs mx-0 my-1">Phone: <span id="CusPhone"></span></p>
                            <p class="text-xs mx-0 my-1">Address: <span id="CusAddress"></span></p>
                        </div>
                    </div>

                    <hr class="mx-0 my-2 p-0 bg-secondary" />

                    <div class="row">
                        <div class="col-12">
                            <table class="table w-100" id="rentalHistoryTable">
                                <thead class="w-100">
                                    <tr class="text-xs text-bold">
                                        <td>No</td>
                                        <td>Car Name</td>
                                        <td>Car Brand</td>
                                        <td>Start Date</td>
                                        <td>End Date</td>
                                        <td>Total Cost</td>
                                        <td>Status</td>
                                    </tr>
                                </thead>
                                <tbody class="w-100" id="rentalHistoryList">

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <hr class="mx-0 my-2 p-0 bg-secondary" />

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>



<script>
    async function RentalHistory(id) {

        console.log(id);

        showLoader();

        let res = await axios.post('/customer-rental-history', {
            cus_id: id
        });

        hideLoader();

        console.log(res);

        if (res.data['status'] === 'empty') {
            errorToast(res.data['message']);
        } 
        else {
            document.getElementById('CusName').innerText = res['data']['0']['user']['name'];
            document.getElementById('CusPhone').innerText = res['data']['0']['user']['phone'];
            document.getElementById('CusAddress').innerText = res['data']['0']['user']['address'];

            let rentalHistoryList = $('#rentalHistoryList');

            rentalHistoryList.empty();

            res.data.forEach(function(item, index) {
                let row = `<tr class="text-xs">
                        <td>${index+1}</td>
                        <td>${item['car']['name']}</td>
                        <td>${item['car']['brand']}</td>
                        <td>${item['start_date']}</td>
                        <td>${item['end_date']}</td>
                        <td>${item['total_cost']}</td>
                        <td>${item['status']}</td>
                     </tr>`

                rentalHistoryList.append(row)
            });

            $("#details-modal").modal('show')
        }
    }
</script>
