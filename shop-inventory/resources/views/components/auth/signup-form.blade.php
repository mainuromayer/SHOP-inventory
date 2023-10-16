<!-- SIGNUP START ======================== -->
<section class="gradient-custom">
    <div class="container" style="padding: 150px 0px;">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-6 mx-2">
                <div style="border-radius: 15px;" class="card bg-white p-5">
                    <div class="card-body px-5">
                        <form action="" class="mb-2">
                            <h2 class="mb-2">Sign Up</h2>
                            <p class="mb-5" style="font-size: 14px;color: #707070;font-weight: 500;">Enter your details below to continue</p>

                            <!-- first name start -->
                            <div class="form-fname form-outline form-white mb-4 d-flex">
                                <input type="text" id="firstName" class="" placeholder="First Name">
                            </div>
                            <!-- first name end -->

                            <!-- last name start -->
                            <div class="form-lname form-outline form-white mb-4 d-flex">
                                <input type="text" id="lastName" class="" placeholder="Last Name">
                            </div>
                            <!-- last name end -->

                            <!-- email start -->
                            <div class="form-email form-outline form-white mb-4 d-flex">
                                <input type="email" id="email" class="" placeholder="E-mail Address">
                            </div>
                            <!-- email end -->

                            <!-- phone start -->
                            <div class="form-number form-outline form-white mb-4 d-flex">
                                <input type="number" id="phone" class="" placeholder="Phone Number">
                            </div>
                            <!-- phone end -->

                            <!-- password start -->
                            <div class="form-password form-outline form-white mb-4 d-flex">
                                <input type="password" id="password" class="" placeholder="Password">
                                <label for="password">
                                    <i onclick="togglePasswordVisibility()" class="eye_open fas fa-eye-slash" style="position: relative;top: 15px;"></i>
                                </label>
                            </div>
                            <!-- password end -->

                            <!-- remember start -->
                            <!-- <div class="form-outline form-white pb-3">
                                <input type="checkbox" name="remember" id="remember" value="">
                                <label class="form-label" for="remember"
                                       style="font-size: 14px;font-weight: 500;color: #707070;padding-left: 11px;">
                                     &nbsp; I agree with terms &amp; Conditions</label>
                            </div> -->
                            <!-- remember end -->

                            <button type="submit" onclick="onSignup()" style="font-size: 20px;border: none;width: 100%;height: 50px;border-radius: 15px;background-image: linear-gradient(to right, #0c0958, #00228d, #255d9d);color: #fff;font-weight: 500;">Sign up</button>

                            <div class="text-center mt-5"
                                 style="font-size: 14px;font-weight: 500;color: #707070;">Already have a
                                account? <a class="text-decoration-none" href="{{url('/userLogin')}" style="color: #184CA1;font-weight: 600;">Log In</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- SIGNUP END ========================== -->

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
    async function onSignup(){
        event.preventDefault();
        let firstName = document.getElementById('firstName').value;
        let lastName = document.getElementById('lastName').value;
        let email = document.getElementById('email').value;
        let phone = document.getElementById('phone').value;
        let password = document.getElementById('password').value;

        if(firstName.length === 0){
            errorToast('First Name is required');
        }else if(lastName.length === 0){
            errorToast('Last Name is required');
        }else if(email.length === 0){
            errorToast('E-mail Address is required');
        }else if(phone.length === 0){
            errorToast('Phone Number is required');
        }else if(password.length === 0){
            errorToast('Password is required');
        }else{
            showLoader();
            let res = await axios.post("/user-signup",{
                firstName:firstName,
                lastName:lastName,
                email:email,
                phone:phone,
                password:password
            });
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



