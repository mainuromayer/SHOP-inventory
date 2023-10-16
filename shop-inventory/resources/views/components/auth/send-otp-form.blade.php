<!-- SEND-OTP START ======================= -->
<section class="gradient-custom">
    <div class="container" style="padding: 150px 0px;">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-6 mx-2">
                <div style="border-radius: 15px;" class="card bg-white p-5">
                    <div class="card-body px-5">

                        <form action="" class="mb-md-5 mt-md-4">

                            <h2 class="mb-2">Send OTP</h2>
                            <p class="mb-5" style="font-size: 14px;color: #707070;font-weight: 500;">Enter your
                                email below to continue</p>

                            <!-- email start -->
                            <div class="form-email form-outline form-white mb-4 d-flex">
                                <span class="icon-envelope"></span>
                                <input type="email" id="email" class="" placeholder="E-mail Address">
                            </div>
                            <!-- email end -->

                            <button onclick="SendOTP()"  type="submit" style="font-size: 20px;border: none;width: 100%;height: 50px;border-radius: 15px;background-image: linear-gradient(to right, #0c0958, #00228d, #255d9d);color: #fff;font-weight: 500;">
                                Next
                            </button>

                            <div class="text-right pt-3" style="font-size: 14px;font-weight: 600;color: #707070;">
                                <a class="text-decoration-none" href="{{url('/userLogin')}}" style="color: #184CA1;font-weight: 600;">back</a>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- SEND-OTP END ========================= -->

<script>
    async function SendOTP(){
        event.preventDefault();
        let email =  document.getElementById('email').value;
        if (email.length === 0){
            errorToast('Enter your email Address');
        }
        else {
            showLoader();
            let res = await axios.post('/send-otp', {email:email});
            hideLoader();

            if(res.status === 200 && res.data['status'] === 'success'){
                successToast(res.data['message']);
                sessionStorage.setItem('email', email);
                setTimeout(function(){
                    window.location.href = '/verifyOtp';
                }, 200)
            }
            else{
                errorToast(res.data['message']);
            }
        }
    }
</script>

