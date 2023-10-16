<!-- LOGIN START ======================= -->
<section class="gradient-custom">
    <div class="container" style="padding: 150px 0px;">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-6 mx-2">
                <div style="border-radius: 15px;" class="card bg-white p-5">
                    <div class="card-body px-5">

                        <form action="" method="get" class="mb-md-5 mt-md-4">

                            <h2 class="mb-2">Login</h2>
                            <p class="mb-5" style="font-size: 14px;color: #707070;font-weight: 500;">Enter your
                                details below to continue</p>

                            <div class="form-email form-outline form-white mb-4 d-flex">
                                <span class="icon-envelope"></span>
                                <input type="email" id="email" class="" placeholder="E-mail Address">
                            </div>

                            <div class="form-password form-outline form-white mb-4 d-flex">
                                <span class="icon-lock"></span>
                                <input type="password" id="password" class="" placeholder="Password">
                                <label for="password">
                                    <i onclick="togglePasswordVisibility()" class="eye_open fas fa-eye-slash" style="position: relative;top: 15px;"></i>
                                </label>
                            </div>

                            {{--                            <div class="form-outline form-white pb-3">--}}
                            {{--                                <input type="checkbox" name="remember" id="remember" value="">--}}
                            {{--                                <label class="form-label" for="remember" style="font-size: 14px;font-weight: 500;color: #707070;padding-left: 11px;">--}}
                            {{--                                    &nbsp; Remember me</label>--}}
                            {{--                            </div>--}}

                            <button onclick="SubmitLogin()"  type="submit" style="font-size: 20px;border: none;width: 100%;height: 50px;border-radius: 15px;background-image: linear-gradient(to right, #0c0958, #00228d, #255d9d);color: #fff;font-weight: 500;">
                                Login
                            </button>

                            <div class="small my-3 text-center">
                                <a href="{{url('/sendOtp')}}" class="" style="text-decoration: none;font-size: 14px;font-weight: 500;color: #707070;">Forgot
                                    Password?</a>
                            </div>

                            <div class="text-center" style="font-size: 14px;font-weight: 600;color: #707070;">
                                Don't have account? <a class="text-decoration-none" href="{{url('/userSignup')}}" style="color: #184CA1;font-weight: 600;">Sign up here</a>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- LOGIN END ========================= -->

<script>
    function togglePasswordVisibility() {
        let password = document.getElementById("password");
        let eyeIcon = document.querySelector('.form-password i');

        if (password.type === "password") {
            password.type = "text";
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        } else {
            password.type = "password";
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        }
    }
</script>
<script>
    async function SubmitLogin(){
        event.preventDefault();
        let email = document.getElementById('email').value;
        let password = document.getElementById('password').value;

        if(email.length === 0 && password.length === 0){
            errorToast('Email & Password is required');
        }else if(email.length === 0){
            errorToast('Email is required');
        }else if(password.length === 0){
            errorToast('Password is required');
        }else{
            showLoader();
            let res = await axios.post("/user-login",{email:email, password:password});
            hideLoader();

            if(res.status === 200 && res.data['status'] === 'success') {
                successToast(res.data['message']);
                setTimeout(function(){
                    window.location.href = '/dashboard';
                }, 200)
            }
            else{
                errorToast(res.data['message']);
            }
        }
    }
</script>
