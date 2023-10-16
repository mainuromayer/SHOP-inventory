<!-- PRODUCT UPDATE START ======================= -->
<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Update Product</h6>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">

                                <label class="form-label">Category</label>
                                <select type="text" class="form-control form-select" id="productCategoryUpdate">
                                    <option value="">Select Category</option>
                                </select>

                                <label class="form-label mt-2">Name</label>
                                <input type="text" class="form-control" id="productNameUpdate">

                                <label class="form-label mt-2">Price</label>
                                <input type="text" class="form-control" id="productPriceUpdate">

                                <label class="form-label mt-2">Unit</label>
                                <input type="text" class="form-control" id="productUnitUpdate">

                                <br/>
                                <img class="w-15" id="oldImg" src="{{asset('images/default-img.jpg')}}"/>
                                <br/>

                                <label class="form-label">Image</label>
                                <input oninput="oldImg.src=window.URL.createObjectURL(this.files[0])" type="file" class="form-control" id="productImgUpdate">

                                <input type="text" class="d-none form-control" id="updateID" readonly>
                                <input type="text" class="d-none form-control" id="filePath" readonly>


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
<!-- PRODUCT UPDATE END ========================= -->


<script>
    async function UpdateFillCategoryDropDown(){
        let res = await axios.get('/list-category');
        res.data.forEach(function (item, index){
            let option = `<option value="${item['id']}">${item['name']}</option>`
            $('#productCategoryUpdate').append(option);
        })
    }


    async function FillUpUpdateForm(id,filePath){
        document.getElementById('updateID').value=id;
        document.getElementById('filePath').value=filePath;
        document.getElementById('oldImg').src=filePath;

        showLoader();
        await UpdateFillCategoryDropDown();
        let res=await axios.post("/product-by-id",{id:id})
        hideLoader();

        document.getElementById('productNameUpdate').value = res.data['name'];
        document.getElementById('productPriceUpdate').value = res.data['price'];
        document.getElementById('productUnitUpdate').value = res.data['unit'];
        document.getElementById('productCategoryUpdate').value = res.data['category_id'];
    }


    async function Update() {
        let productCategoryUpdate = document.getElementById('productCategoryUpdate').value;
        let productNameUpdate = document.getElementById('productNameUpdate').value;
        let productPriceUpdate = document.getElementById('productPriceUpdate').value;
        let productUnitUpdate = document.getElementById('productUnitUpdate').value;
        let updateID = document.getElementById('updateID').value;
        let filePath = document.getElementById('filePath').value;
        let productImgUpdate = document.getElementById('productImgUpdate').files[0];


        if (productCategoryUpdate.length === 0) {
            errorToast("product Category Required!")
        }
        else if(productNameUpdate.length===0){
            errorToast("product Name Required!")
        }
        else if(productPriceUpdate.length===0){
            errorToast("product Price Required!")
        }
        else if(productUnitUpdate.length===0){
            errorToast("product Unit Required!")
        }
        else {
            document.getElementById('update-modal-close').click();

            let formData = new FormData();
            formData.append('img',productImgUpdate)
            formData.append('id',updateID)
            formData.append('name',productNameUpdate)
            formData.append('price',productPriceUpdate)
            formData.append('unit',productUnitUpdate)
            formData.append('category_id',productCategoryUpdate)
            formData.append('file_path',filePath)

            const config = {
                header:{
                    'content-type':'multipart/form-data'
                }
            }

            showLoader();
            let res = await axios.post('/update-product',formData,config)
            hideLoader();

            if (res.status === 200 && res.data === 1){
                successToast('Product Updated');

                document.getElementById('update-form').reset();

                await getList();
            }
            else{
                errorToast('Request Fail!');
            }
        }
    }
</script>
