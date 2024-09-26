<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card px-5 py-5">
                <div class="row justify-content-between ">
                    <div class="align-items-center col">
                        <h4>Rental</h4>
                    </div>
                    <div class="align-items-center col">
                        <button data-bs-toggle="modal" data-bs-target="#create-modal"
                            class="float-end btn m-0 bg-gradient-secondary">Create</button>
                    </div>
                </div>
                <hr class="bg-dark " />
                <table class="table" id="tableData">
                    <thead>
                        <tr class="bg-light">
                            <th>No</th>
                            <th>Customer Name</th>
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
        let res = await axios.get("/rental-list");
        hideLoader();

        let tableList = $("#tableList");
        let tableData = $("#tableData");

        tableData.DataTable().destroy();
        tableList.empty();

        res.data.forEach(function(item, index) {
            let row = `<tr>
                <td>${index+1}</td>
                <td>${item['user']['name']}</td>
                <td>${item['car']['name']}</td>
                <td>${item['car']['brand']}</td>
                <td>${item['start_date']}</td>
                <td>${item['end_date']}</td>
                <td>${item['total_cost']}</td>
                <td>${item['status']}</td>
                <td>
                    <button data-id="${item['id']}" data-car="${item['car_id']}" class="updateStatusBtn btn btn-outline-dark text-sm px-3 py-1 btn-sm m-0"><i class="bi bi-cloud-upload text-sm"></i></button>
                    <button data-id="${item['id']}" class="editBtn btn btn-outline-dark text-sm px-3 py-1 btn-sm m-0"><i class="bi bi-pencil-square text-sm"></i></button>
                    <button data-id="${item['id']}" class="deleteBtn btn btn-outline-dark text-sm px-3 py-1 btn-sm m-0"><i class="fa text-sm  fa-trash-alt"></i></button>
                </td>
                </tr>`

            tableList.append(row)
        })

        $('.updateStatusBtn').on('click', async function() {
            let id = $(this).data('id');
            let car_id = $(this).data('car');

            $("#status-modal").modal('show');
            $("#rentalId").val(id);
            $("#carId").val(car_id);
        });

        $('.editBtn').on('click', async function() {

            let id = $(this).data('id');
            await FillUpUpdateForm(id);
            $("#update-modal").modal('show');

        });

        $('.deleteBtn').on('click', function() {

            let id = $(this).data('id');
            $("#delete-modal").modal('show');
            $("#deleteId").val(id);

        });

        new DataTable('#tableData', {
            order: [
                [0, 'desc']
            ],
            lengthMenu: [5, 10, 15, 20, 30]
        });

    }

</script>
