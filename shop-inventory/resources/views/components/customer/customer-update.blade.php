<!-- CUSTOMER UPDATE START ======================= -->
<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Customer</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Customer Name *</label>
                                <input type="text" class="form-control" id="customerNameUpdate">

                                <label class="form-label mt-3">Customer Email *</label>
                                <input type="text" class="form-control" id="customerEmailUpdate">

                                <label class="form-label mt-3">Customer Mobile *</label>
                                <input type="text" class="form-control" id="customerMobileUpdate">

                                <input type="text" class="d-none form-control" id="updateID" readonly>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" class="btn mx-2 text-white" data-bs-dismiss="modal" aria-label="Close" style="background-image: linear-gradient(to top, rgb(0, 34, 141), rgb(37, 93, 157))">Close</button>
                <button onclick="Update()" id="update-btn" class="btn text-white" style="background-image: linear-gradient(to top, rgb(44, 141, 0), rgb(41, 157, 37));">Update</button>
            </div>
        </div>
    </div>
</div>
<!-- CUSTOMER UPDATE END ========================= -->


<script>
    async function FillUpUpdateForm(id){
        document.getElementById('updateID').value=id;
        showLoader();
        let res=await axios.post("/customer-by-id",{id:id})
        hideLoader();
        document.getElementById('customerNameUpdate').value = res.data['name'];
        document.getElementById('customerEmailUpdate').value = res.data['email'];
        document.getElementById('customerMobileUpdate').value = res.data['mobile'];
    }

    async function Update() {

        let customerName = document.getElementById('customerNameUpdate').value;
        let customerEmail = document.getElementById('customerEmailUpdate').value;
        let customerMobile = document.getElementById('customerMobileUpdate').value;
        let updateID = document.getElementById('updateID').value;


        if (customerName.length === 0) {
            errorToast("Customer Name Required!")
        }
        else if(customerEmail.length===0){
            errorToast("Customer Email Required!")
        }
        else if(customerMobile.length===0){
            errorToast("Customer Mobile Required!")
        }
        else {
            document.getElementById('update-modal-close').click();
            showLoader();
            let res = await axios.post("/update-customer",{name:customerName,email:customerEmail,mobile:customerMobile,id:updateID})
            hideLoader();

            if(res.status===200 && res.data===1){
                successToast('Updated Successful');
                document.getElementById("update-form").reset();
                await getList();
            }
            else{
                errorToast("Request Fail!")
            }
        }
    }
</script>
