<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card px-5 py-5">
                <div class="row justify-content-between ">
                    <div class="align-items-center col">
                        <h4>Car</h4>
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
                                <th>Image</th>
                                <th>Name</th>
                                <th>Brand</th>
                                <th>Model</th>
                                <th>Manufactured</th>
                                <th>Type</th>
                                <th>Daily Rent Price</th>
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
</div>

<script>
    getList();

    async function getList() {
        showLoader();
        let res = await axios.get("/car-list");
        hideLoader();

        let tableList = $("#tableList");
        let tableData = $("#tableData");

        tableData.DataTable().destroy();
        tableList.empty();

        res.data.forEach(function(item, index) {
            let row = `<tr>
                <td> <img class="w-90 h-auto" alt="" src="${item['image']}"> </td>
                <td>${item['name']}</td>
                <td>${item['brand']}</td>
                <td>${item['model']}</td>
                <td>${item['year']}</td>
                <td>${item['car_type']}</td>
                <td>${item['daily_rent_price']}</td>
                <td>${item['availability']}</td>
                <td>
                    <button data-path="${item['image']}" data-id="${item['id']}" class="btn editBtn btn-sm btn-outline-success">Edit</button>
                    <button data-path="${item['image']}" data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-danger">Delete</button>
                </td>
                </tr>`

            tableList.append(row);
        });

        $('.editBtn').on('click', async function() {

            let id = $(this).data('id');
            let filePath = $(this).data('path');
            await FillUpUpdateForm(id, filePath);
            $("#update-modal").modal('show');

        });

        $('.deleteBtn').on('click', function() {

            let id = $(this).data('id');
            let filePath = $(this).data('path');
            $("#delete-modal").modal('show');
            $("#deleteId").val(id);
            $("#deleteFilePath").val(filePath);

        });

        new DataTable('#tableData', {
            lengthMenu: [5, 10, 15, 20, 30]
        });
    }
</script>
