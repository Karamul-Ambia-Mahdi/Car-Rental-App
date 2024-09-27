<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card px-5 py-5">
                <div class="row justify-content-between ">
                    <div class="align-items-center col">
                        <h4>Rental History</h4>
                    </div>
                </div>
                <hr class="bg-dark " />
                <table class="table" id="tableData">
                    <thead>
                        <tr class="bg-light">
                            <th>No</th>
                            <th>Car Name</th>
                            <th>Car Brand</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Total Cost</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableList">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<script>
    getList();

    async function getList() {

        showLoader();
        let res = await axios.get("/user-rentals");
        hideLoader();

        let tableList = $("#tableList");
        let tableData = $("#tableData");

        tableData.DataTable().destroy();
        tableList.empty();

        res.data.forEach(function(item, index) {
            let row = `<tr>
                <td>${index+1}</td>
                <td>${item['car']['name']}</td>
                <td>${item['car']['brand']}</td>
                <td>${item['start_date']}</td>
                <td>${item['end_date']}</td>
                <td>${item['total_cost']}</td>
                <td>${item['status']}</td>
                <td>
                    <button data-id="${item['id']}" class="cancelBtn btn btn-outline-dark text-sm px-3 py-1 btn-sm m-0"><i class="bi bi-x-circle text-sm"></i> Cancel</button>
                </td>
                </tr>`

            tableList.append(row)
        })

        $('.cancelBtn').on('click', async function() {
            let id = $(this).data('id');

            $("#cancel-modal").modal('show');
            $("#cancelId").val(id);
        });

        new DataTable('#tableData', {
            order: [
                [0, 'desc']
            ],
            lengthMenu: [5, 10, 15, 20, 30]
        });

    }

</script>
