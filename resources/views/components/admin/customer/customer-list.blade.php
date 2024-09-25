<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card px-5 py-5">
                <div class="row justify-content-between ">
                    <div class="align-items-center col">
                        <h4>Customer</h4>
                    </div>
                    <div class="align-items-center col">
                        <button data-bs-toggle="modal" data-bs-target="#create-modal"
                            class="float-end btn m-0 bg-gradient-secondary">Create</button>
                    </div>
                </div>
                <hr class="bg-dark" />
                <div class="table-responsive">
                    <table class="table" id="tableData">
                        <thead>
                            <tr class="bg-light">
                                <th>No</th>
                                <th>Name</th>
                                <th>E-mail</th>
                                <th>Phone Number</th>
                                <th>Address</th>
                                <th>Rental History</th>
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
</div>

<script>
    getList();

    async function getList() {
        showLoader();
        let res = await axios.get("/customer-list");
        hideLoader();

        let tableList = $("#tableList");
        let tableData = $("#tableData");

        tableData.DataTable().destroy();
        tableList.empty();

        res.data.forEach(function(item, index) {
            let row = `<tr>
                <td>${index+1}</td>
                <td>${item['name']}</td>
                <td>${item['email']}</td>
                <td>${item['phone']}</td>
                <td>${item['address']}</td>
                <td>
                    <button data-id="${item['id']}" class="viewBtn btn btn-outline-dark text-sm px-3 py-1 btn-sm m-0"><i class="fa text-sm fa-eye"></i></button>
                </td>
                <td>
                    <button data-id="${item['id']}" class="btn editBtn btn-sm btn-outline-success">Edit</button>
                    <button data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-danger">Delete</button>
                </td>
                </tr>`

            tableList.append(row);
        });

        $('.viewBtn').on('click', async function() {
            let id = $(this).data('id');

            await RentalHistory(id)
        })

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
