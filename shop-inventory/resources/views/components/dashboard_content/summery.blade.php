<!-- DASHBOARD SUMMERY START ======================= -->

<!-- content-header start -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row my-2">
            <div class="col-12">
                <h1 class="m-0">Dashboard</h1>
            </div>
        </div>
    </div>
</div>
<!-- content-header end -->

<!-- main content start -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">

            <div class="col-lg-3 col-6">
                <div class="small-box text-white" style="background-image: linear-gradient(to top right, rgb(12, 9, 88), rgb(37, 93, 157))">
                    <div class="inner">
                        <h3>
                            <span class="text-white" id="product"><!-- product number --></span>
                        </h3>
                        <p class="text-white">Products</p>
                    </div>
                    <div class="icon text-white-50">
                        <i class="fa-solid fa-bag-shopping" style="font-size: 70px;"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box text-white" style="background-image: linear-gradient(to top right, rgb(12, 9, 88), rgb(37, 93, 157))">
                    <div class="inner">
                        <h3>
                            <span class="text-white" id="category"><!-- category total --></span>
                        </h3>
                        <p class="text-white">Category</p>
                    </div>
                    <div class="icon text-white-50">
                        <i class="fa-solid fa-bars-staggered" style="font-size: 70px;"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box text-white" style="background-image: linear-gradient(to top right, rgb(12, 9, 88), rgb(37, 93, 157))">
                    <div class="inner">
                        <h3>
                            <span class="text-white" id="customer"><!-- customer total --></span>
                        </h3>
                        <p class="text-white">Customer</p>
                    </div>
                    <div class="icon text-white-50">
                        <i class="fa-solid fa-user-friends" style="font-size: 70px;"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box text-white" style="background-image: linear-gradient(to top right, rgb(12, 9, 88), rgb(37, 93, 157))">
                    <div class="inner">
                        <h3>
                            <span class="text-white" id="invoice"><!-- invoice total --></span>
                        </h3>
                        <p class="text-white">Invoice</p>
                    </div>
                    <div class="icon text-white-50">
                        <i class="fa-solid fa-file-lines" style="font-size: 70px;"></i>
                    </div>
                </div>
            </div>


        </div>
        <!-- Small boxes (End box) -->
        <br>
        <!-- Small boxes (Stat box) -->
        <div class="row">

            <div class="col-lg-3 col-6">
                <div class="small-box text-white" style="background-image: linear-gradient(to top right, #4A051C, #830A48)">
                    <div class="inner">
                        <h3><i class="fa-solid fa-bangladeshi-taka-sign text-white"></i>
                            <span class="text-white" id="total"><!-- sale total --></span>
                        </h3>
                        <p class="text-white">Total Sale</p>
                    </div>
                    <div class="icon text-white-50">
                        <i class="fa-solid fa-coins" style="font-size: 70px;"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box text-white" style="background-image: linear-gradient(to top right, #42033D, #680E4B)">
                    <div class="inner">
                        <h3><i class="fa-solid fa-bangladeshi-taka-sign text-white"></i>
                            <span class="text-white" id="vat"><!-- vat total --></span>
                        </h3>
                        <p class="text-white">Vat</p>
                    </div>
                    <div class="icon text-white-50">
                        <i class="fa-solid fa-coins" style="font-size: 70px;"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box text-white" style="background-image: linear-gradient(to top right, #093824, #379634)">
                    <div class="inner">
                        <h3><i class="fa-solid fa-bangladeshi-taka-sign text-white"></i>
                            <span class="text-white" id="payable"><!-- payable collection --></span>
                        </h3>
                        <p class="text-white">Total</p>
                    </div>
                    <div class="icon text-white-50">
                        <i class="fa-solid fa-coins" style="font-size: 70px;"></i>
                    </div>
                </div>
            </div>

        </div>
        <!-- Small boxes (End box) -->
    </div>
</section>
<!-- main content end -->

<!-- DASHBOARD SUMMERY END ========================= -->


<script>
    getList();
    async function getList() {
        showLoader();
        let res=await axios.get("/summary");

        document.getElementById('product').innerText=res.data['product']
        document.getElementById('category').innerText=res.data['category']
        document.getElementById('customer').innerText=res.data['customer']
        document.getElementById('invoice').innerText=res.data['invoice']
        document.getElementById('total').innerText=res.data['total']
        document.getElementById('vat').innerText=res.data['vat']
        document.getElementById('payable').innerText=res.data['payable']


        hideLoader();
    }
</script>

