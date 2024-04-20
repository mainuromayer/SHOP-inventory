<!-- SIGNUP START ======================== -->
<section class="gradient-custom">
    <div class="container" style="padding: 150px 0px;">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-6 mx-2">
                <div style="border-radius: 15px;" class="card bg-white p-5">
                    <div class="card-body px-5">
                        <form action="" class="mb-2">
                            @csrf
                            <h2 class="mb-2">Sign Up</h2>
                            <p class="mb-5" style="font-size: 14px;color: #707070;font-weight: 500;">Enter your
                                details below to continue</p>

                            <div class="form-fname form-outline form-white mb-4 d-flex">
                                <input type="text" id="firstName" name="firstName" class="" placeholder="First Name">
                            </div>

                            <div class="form-lname form-outline form-white mb-4 d-flex">
                                <input type="text" id="lastName" name="lastName" class="" placeholder="Last Name">
                            </div>

                            <div class="form-email form-outline form-white mb-4 d-flex">
                                <input type="email" id="email" name="email" class="" placeholder="E-mail Address">
                            </div>

                            <div class="form-number form-outline form-white mb-4 d-flex">
                                <input type="number" id="phone" name="phone" class="" placeholder="Phone Number">
                            </div>

                            <div class="form-password form-outline form-white mb-4 d-flex">
                                <input type="password" id="password" name="password" class="" placeholder="Password">
                            </div>

                            <button onclick="onSignup()" style="font-size: 20px;border: none;width: 100%;height: 50px;border-radius: 15px;background-image: linear-gradient(to right, #0c0958, #00228d, #255d9d);color: #fff;font-weight: 500;">Sign up</button>

                            <div class="text-center mt-5"
                                 style="font-size: 14px;font-weight: 500;color: #707070;">Already have a
                                account? <a class="text-decoration-none" href="{{url('/userLogin')}}"
                                            style="color: #184CA1;font-weight: 600;">Log In</a>
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
            try {
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
            } catch (error) {
                console.error('Error during signup:', error);
                hideLoader();
                errorToast('Failed to sign up. Please try again.');
            }
        }
    }
</script>
