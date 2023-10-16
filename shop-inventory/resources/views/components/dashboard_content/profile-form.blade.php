<!-- PROFILE FORM START ======================= -->
<section class="content">
    <div class="container-fluid">
        <div class="row py-5 align-items-center justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header" style="background-image: linear-gradient(to bottom, rgb(12, 9, 88), rgb(0, 34, 141), rgb(37, 93, 157))">
                        <h3 class="card-title text-white">User Profile</h3>
                    </div>

                    <form>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="firstName">First Name</label>
                                <input type="text" class="form-control" id="firstName" placeholder="First Name">
                            </div>
                            <div class="form-group">
                                <label for="lastName">Last Name</label>
                                <input type="text" class="form-control" id="lastName" placeholder="Last Name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" readonly class="form-control" id="email" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="number" class="form-control" id="phone" placeholder="Phone">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Password">
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" onclick="onUpdate()" class="btn text-white" style="background-image: linear-gradient(to top, rgb(44, 141, 0), rgb(41, 157, 37));">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- PROFILE FORM END ========================= -->


<script>
    getProfile();
    async function getProfile(){
        showLoader();
        let res = await axios.get('/user-profile')
        hideLoader();
        if (res.status === 200 && res.data['status'] === 'success'){
            let data=res.data['data'];
            document.getElementById('firstName').value=data['firstName'];
            document.getElementById('lastName').value=data['lastName'];
            document.getElementById('phone').value=data['phone'];
            document.getElementById('email').value=data['email'];
            document.getElementById('password').value=data['password'];
        }
        else{
            errorToast(res.data['message']);
        }
    }

    async function onUpdate(){
        event.preventDefault();
        let firstName = document.getElementById('firstName').value;
        let lastName = document.getElementById('lastName').value;
        let phone = document.getElementById('phone').value;
        let password = document.getElementById('password').value;

        if(firstName.length === 0){
            errorToast('First Name is required');
        }else if(lastName.length === 0){
            errorToast('Last Name is required');
        }else if(phone.length === 0){
            errorToast('Phone Number is required');
        }else if(password.length === 0){
            errorToast('Password is required');
        }else{
            showLoader();
            let res = await axios.post("/user-update",{
                firstName:firstName,
                lastName:lastName,
                phone:phone,
                password:password
            });
            hideLoader();

            if(res.status === 200 && res.data['status'] === 'success'){
                successToast(res.data['message']);
                await getProfile();
            }
            else{
                errorToast(res.data['message']);
            }
        }
    }
</script>
