<!-- PRODUCT DELETE START ======================= -->
<div class="modal animated zoomIn" id="delete-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h3 class=" mt-3 text-warning">Delete !</h3>
                <p class="mb-3">Once delete, you can't get it back.</p>
                <input class="d-none form-control" id="deleteID" readonly>
                <input class="d-none form-control" id="deleteFilePath" readonly>
            </div>
            <div class="modal-footer justify-content-end">
                <div>
                    <button type="button" id="delete-modal-close" class="btn mx-2 text-white" data-bs-dismiss="modal" style="background-image: linear-gradient(to top, rgb(0, 34, 141), rgb(37, 93, 157))">Cancel</button>
                    <button onclick="itemDelete()" type="button" id="confirmDelete" class="btn text-white" style="background-image: linear-gradient(to top, rgb(141, 0, 0), rgb(157, 37, 37));">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- PRODUCT DELETE END ========================= -->


<script>
    async function itemDelete(){
        let id = document.getElementById('deleteID').value;
        let deleteFilePath = document.getElementById('deleteFilePath').value;

        document.getElementById('delete-modal-close').click();

        showLoader();
        let res=await axios.post("/delete-product",{id:id,file_path:deleteFilePath})
        hideLoader();

        if(res.data === 1){
            successToast('Product Deleted');
            await getList();
        }
        else{
            errorToast('Request Fail!');
        }
    }
</script>
