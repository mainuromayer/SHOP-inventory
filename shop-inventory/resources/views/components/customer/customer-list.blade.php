<!-- CUSTOMER LIST START ======================= -->
<div class="content">
    <div class="container-fluid">
        <div class="row py-4 align-items-center justify-content-center">
            <div class="col-md-12 col-sm-12 col-lg-12">
                <div class="card px-5 py-5">
                    <div class="row justify-content-between ">
                        <div class="align-items-center col">
                            <h4>Customer</h4>
                        </div>
                        <div class="align-items-center col">
                            <button data-bs-toggle="modal" data-bs-target="#create-modal"
                                    class="float-end btn m-0 text-white"
                                    style="background-image: linear-gradient(to top, rgb(0, 34, 141), rgb(37, 93, 157))">
                                Create
                            </button>
                        </div>
                    </div>
                    <hr class="bg-dark "/>
                    <table class="table" id="tableData">
                        <thead>
                        <tr class="bg-light">
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
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
<!-- CUSTOMER LIST END ========================= -->


<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>

<script>
    getList();

    async function getList() {
        showLoader();
        let res = await axios.get('/list-customer');
        hideLoader();

        let tableList = $('#tableList');
        let tableData = $('#tableData');

        tableData.DataTable().destroy();
        tableList.empty();// Destroy the existing DataTable instance

        res.data.forEach(function (item, index) {
            let row = `<tr>
                            <td>${index+1}</td>
                            <td>${item['name']}</td>
                            <td>${item['email']}</td>
                            <td>${item['mobile']}</td>
                            <td>
                                <button data-id="${item['id']}" class="btn btn-sm text-white mx-2 editBtn" style="background-image: linear-gradient(to top, rgb(0, 34, 141), rgb(37, 93, 157))">Edit</button>
                                <button data-id="${item['id']}" class="btn btn-sm text-white deleteBtn" style="background-image: linear-gradient(to top, rgb(141, 0, 0), rgb(157, 37, 37))">Delete</button>
                            </td>
                        </tr>`
            tableList.append(row);

        });

        $('.editBtn').on('click', async function () {
            let id= $(this).data('id');
            await FillUpUpdateForm(id)
            $("#update-modal").modal('show');


        });

        $('.deleteBtn').on('click',function (){
            let id = $(this).data('id');
            $('#delete-modal').modal('show');
            $('#deleteID').val(id);
        });

        new DataTable('#tableData', {
            responsive: true,
            order: [[0,'desc']],
            lengthMenu: [5,10,15,20,30]
        });

    }
</script>
