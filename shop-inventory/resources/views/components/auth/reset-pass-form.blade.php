<!-- Reset Password START ======================= -->
<section class="gradient-custom">
    <div class="container h-100" style="padding: 150px 0px;">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-6 mx-2">
                <div style="border-radius: 15px;" class="card bg-white p-5">
                    <div class="card-body px-5">

                        <form action="" class="mb-md-5 mt-md-4">
                            @csrf
                            <h2 class="mb-4">SET NEW PASSWORD</h2>
                            <!-- new password start -->
                            <div class="new_password form-password form-outline form-white mb-4 d-flex">
                                <input type="password" id="password" name="password" class="" placeholder="New Password">
                                <label for="password">
                                    <i onclick="togglePasswordVisibility1()" class="eye_open fas fa-eye-slash" style="position: relative;top: 15px;"></i>
                                </label>
                            </div>
                            <!-- new password end -->

                            <!-- confirm password start -->
                            <div class="confirm_password form-password form-outline form-white mb-4 d-flex">
                                <input type="password" id="confirm_password" name="confirm_password" class="" placeholder="Confirm Password">
                                <label for="confirm_password">
                                    <i onclick="togglePasswordVisibility2()" class="eye_open fas fa-eye-slash" style="position: relative;top: 15px;"></i>
                                </label>
                            </div>
                            <!-- confirm password end -->


                            <button type="submit" onclick="ResetPassword()" style="font-size: 20px;border: none;width: 100%;height: 50px;border-radius: 15px;background-image: linear-gradient(to right, #0c0958, #00228d, #255d9d);color: #fff;font-weight: 500;">
                                Next
                            </button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Reset Password END ========================= -->

<script>
    function togglePasswordVisibility1() {
        let password = document.getElementById("password");
        let eyeIcon1 = document.querySelector('.new_password i');

        if (password.type === "password") {
            password.type = "text";
            eyeIcon1.classList.remove('fa-eye-slash');
            eyeIcon1.classList.add('fa-eye');
        } else {
            password.type = "password";
            eyeIcon1.classList.remove('fa-eye');
            eyeIcon1.classList.add('fa-eye-slash');
        }
    }
</script>

<script>
    function togglePasswordVisibility2() {
        let confirmPass = document.getElementById("confirm_password");
        let eyeIcon2 = document.querySelector('.confirm_password i');

        if (confirmPass.type === "password") {
            confirmPass.type = "text";
            eyeIcon2.classList.remove('fa-eye-slash');
            eyeIcon2.classList.add('fa-eye');
        } else {
            confirmPass.type = "password";
            eyeIcon2.classList.remove('fa-eye');
            eyeIcon2.classList.add('fa-eye-slash');
        }
    }
</script>


<script>
    async function ResetPassword(){
        event.preventDefault();
        let password = document.getElementById('password').value;
        let confirm_password = document.getElementById('confirm_password').value;

        if(password === 0){
            errorToast('Password is Required');
        }else if(confirm_password === 0){
            errorToast('Confirm Password is Required');
        }else if(password !== confirm_password){
            errorToast('Password & Confirm Password is must be same');
        }else{
            showLoader();
            let res = await axios.post('/reset-password', {password:password})
            hideLoader();

            if(res.status === 200 && res.data['status'] === 'success'){
                successToast(res.data['message']);
                setTimeout(function(){
                    window.location.href = '/userLogin';
                }, 200);
            }
            else{
                errorToast(res.data['message']);
            }
        }
    }
</script>
