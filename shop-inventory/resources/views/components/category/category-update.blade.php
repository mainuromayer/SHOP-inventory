<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Category Name *</label>
                                <input type="text" class="form-control" id="categoryNameUpdate">
                                <input class="d-none form-control" id="updateID" readonly>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" class="btn mx-2 text-white" data-bs-dismiss="modal" aria-label="Close"
                        style="background-image: linear-gradient(to top, rgb(0, 34, 141), rgb(37, 93, 157))">Close
                </button>
                <button onclick="Update()" id="update-btn" class="btn text-white"
                        style="background-image: linear-gradient(to top, rgb(44, 141, 0), rgb(41, 157, 37));">Update
                </button>
            </div>
        </div>
    </div>
</div>


<script>
    async function FillUpUpdateForm(id) {
        document.getElementById('updateID').value = id;

        showLoader();
        let res = await axios.post('/category-by-id',{id:id})
        hideLoader();

        document.getElementById('categoryNameUpdate').value = res.data['name'];
    }

    async function Update() {
        let categoryName = document.getElementById('categoryNameUpdate').value;
        let updateID = document.getElementById('updateID').value;

        if (categoryName.length === 0){
            errorToast('Category Required!');
        }
        else {
            document.getElementById('update-modal-close').click();
            showLoader();
            let res = await axios.post('/update-category',{name:categoryName, id:updateID})
            hideLoader();

            if (res.status === 200 && res.data === 1){
                successToast('Updated Successful');
                await getList();
            }
            else {
                errorToast('Request Fail!');
            }
        }
    }
</script>
