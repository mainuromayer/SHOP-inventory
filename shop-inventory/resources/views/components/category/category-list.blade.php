<!-- CATEGORY LIST START ======================= -->
<section class="content">
    <div class="container-fluid">
        <div class="row py-4 align-items-center justify-content-center">
            <div class="col-md-12 col-sm-12 col-lg-12">
                <div class="card px-5 py-5">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Category</h4>
                        </div>
                        <div class="col-md-6 text-right">
                            <button data-bs-toggle="modal" data-bs-target="#create-modal"
                                    class="float-end btn m-0 text-white"
                                    style="background-image: linear-gradient(to top, rgb(0, 34, 141), rgb(37, 93, 157))">
                                Create
                            </button>
                        </div>
                    </div>
                    <hr class="bg-secondary"/>
                    <div class="table-responsive">
                        <table class="table" id="tableData">
                            <thead>
                            <tr class="bg-light">
                                <th>No</th>
                                <th>Category</th>
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
</section>
<!-- CATEGORY LIST END ========================= -->


<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>

<script>
    getList();


    async function getList() {
        showLoader();
        let res = await axios.get('/list-category');
        hideLoader();

        let tableList = $('#tableList')
        let tableData = $('#tableData')

        tableData.DataTable().destroy();
        tableList.empty();// Destroy the existing DataTable instance

        res.data.forEach(function(item, index) {

            let row = `<tr>
                    <td style="vertical-align: middle">${index + 1}</td>
                    <td>${item['name']}</td>
                    <td>
                        <button data-id="${item['id']}" class="btn btn-sm text-white mx-2 my-auto editBtn" style="background-image: linear-gradient(to top, rgb(0, 34, 141), rgb(37, 93, 157))">Edit</button>
                        <button data-id="${item['id']}" class="btn btn-sm text-white my-auto deleteBtn" style="background-image: linear-gradient(to top, rgb(141, 0, 0), rgb(157, 37, 37))">Delete</button>
                    </td>
                </tr>`;

            tableList.append(row);
        });


        $('.editBtn').on('click', async function () {
            let id = $(this).data('id');
            await FillUpUpdateForm(id);
            $("#update-modal").modal('show');
            $('#updateID').val(id);
        });

        $('.deleteBtn').on('click', function () {
            let id = $(this).data('id');
            $('#delete-modal').modal('show');
            $('#deleteID').val(id);
        });

        new DataTable('#tableData', {
            responsive: true,
            order: [[0, 'desc']],
            lengthMenu: [5, 10, 15, 20, 30]
        });

    }
</script>
