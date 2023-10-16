<!-- PRODUCT CREATE START ======================= -->
<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Create Product</h6>
            </div>
            <div class="modal-body">
                <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">

                                <label class="form-label">Category</label>
                                <select type="text" class="form-control form-select" id="productCategory">
                                    <option value="">Select Category</option>
                                </select>

                                <label class="form-label mt-2">Name</label>
                                <input type="text" class="form-control" id="productName">

                                <label class="form-label mt-2">Price</label>
                                <input type="text" class="form-control" id="productPrice">

                                <label class="form-label mt-2">Unit</label>
                                <input type="text" class="form-control" id="productUnit">

                                <br/>
                                <img class="w-15" id="newImg" src="{{asset('images/default-img.jpg')}}"/>
                                <br/>

                                <label class="form-label">Image</label>
                                <input oninput="newImg.src=window.URL.createObjectURL(this.files[0])" type="file" class="form-control" id="productImg">

                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="modal-close" class="btn mx-2 text-white" data-bs-dismiss="modal" aria-label="Close" style="background-image: linear-gradient(to top, rgb(141, 0, 0), rgb(157, 37, 37));">Close
                </button>
                <button onclick="Save()" id="save-btn" class="btn text-white" style="background-image: linear-gradient(to top, rgb(44, 141, 0), rgb(41, 157, 37));">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- PRODUCT CREATE END ========================= -->


<script>
    FillCategoryDropDown();

    async function FillCategoryDropDown(){
        let res = await axios.get('/list-category');
        res.data.forEach(function (item, index){
            let option = `<option value="${item['id']}">${item['name']}</option>`
            $('#productCategory').append(option);
        })
    }




    async function Save(){
        let productCategory = document.getElementById('productCategory').value;
        let productName = document.getElementById('productName').value;
        let productPrice = document.getElementById('productPrice').value;
        let productUnit = document.getElementById('productUnit').value;
        let productImg = document.getElementById('productImg').files[0];


        if (productCategory.length === 0) {
            errorToast("product Category Required !");
        }
        else if(productName.length===0){
            errorToast("product Name Required !");
        }
        else if(productPrice.length===0){
            errorToast("product Price Required !");
        }
        else if(productUnit.length===0){
            errorToast("product Unit Required !");
        }
        else if(!productImg){
            errorToast("product Image Required !");
        }
        else {
            document.getElementById('modal-close').click();

            let formData = new FormData();
            formData.append('img',productImg)
            formData.append('name',productName)
            formData.append('price',productPrice)
            formData.append('unit',productUnit)
            formData.append('category_id',productCategory)

            const config = {
                header:{
                    'content-type':'multipart/form-data'
                }
            }

            showLoader();
            let res = await axios.post('/create-product',formData,config)
            hideLoader();

            if (res.status === 201){
                successToast('Product Created');

                document.getElementById('save-form').reset();

                await getList();
            }
            else{
                errorToast('Request Fail!');
            }
        }
    }
</script>
