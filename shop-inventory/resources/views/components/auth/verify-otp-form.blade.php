<!-- Verify-OTP START ======================= -->
<section class="gradient-custom">
    <div class="container" style="padding: 150px 0px;">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-6 mx-2">
                <div style="border-radius: 15px;" class="card bg-white p-5">
                    <div class="card-body px-5">
                        @csrf
                        <form action="" class="mb-md-5 mt-md-4">

                            <h2 class="mb-2">OTP VERIFICATION</h2>
                            <p style="font-size: 14px;color: #707070;font-weight: 500;">A 6 Digit Verification code has been sent your email address</p>

                            <div id="otp" class="inputs d-flex flex-row justify-content-center my-3">
                                <input class="m-2 text-center form-control rounded" type="text" id="first" maxlength="1">
                                <input class="m-2 text-center form-control rounded" type="text" id="second" maxlength="1">
                                <input class="m-2 text-center form-control rounded" type="text" id="third" maxlength="1">
                                <input class="m-2 text-center form-control rounded" type="text" id="fourth" maxlength="1">
                                <input class="m-2 text-center form-control rounded" type="text" id="fifth" maxlength="1">
                                <input class="m-2 text-center form-control rounded" type="text" id="sixth" maxlength="1">
                            </div>
                            <button onclick="VerifyOtp()" type="submit" style="font-size: 20px;border: none;width: 100%;height: 50px;border-radius: 15px;background-image: linear-gradient(to right, #0c0958, #00228d, #255d9d);color: #fff;font-weight: 500;">Next</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Verify-OTP END ========================= -->


<script>
    async function VerifyOtp(){
        event.preventDefault();
        let otp_first_value = document.getElementById('first').value;
        let otp_second_value = document.getElementById('second').value;
        let otp_third_value = document.getElementById('third').value;
        let otp_fourth_value = document.getElementById('fourth').value;
        let otp_fifth_value = document.getElementById('fifth').value;
        let otp_sixth_value = document.getElementById('sixth').value;

        let otp_string = otp_first_value + otp_second_value + otp_third_value + otp_fourth_value + otp_fifth_value + otp_sixth_value;
        let otp_count = otp_string.length;
        let otp = parseInt(otp_string);


        if(otp_count !== 6){
            errorToast('Invalid OTP');
        }
        else{
            showLoader();
            let res = await axios.post('/verify-otp',{
                otp:otp,
                email:sessionStorage.getItem('email')
            })
            hideLoader();

            if(res.status === 200 && res.data['status'] === 'success') {
                successToast(res.data['message']);
                sessionStorage.clear();

                setTimeout(function(){
                    window.location.href = '/resetPassword';
                }, 200)
            }
            else{
                errorToast(res.data['message']);
            }
        }
    }
</script>
