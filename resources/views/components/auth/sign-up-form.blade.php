<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-10 center-screen">
            <div class="card animated fadeIn w-100 p-3">
                <div class="card-body">
                    <h4>Sign Up</h4>
                    <hr />
                    <div class="container-fluid m-0 p-0">
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <label>Email Address</label>
                                <input id="email" placeholder="User Email" class="form-control" type="email" />
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Full Name</label>
                                <input id="fullName" placeholder="Full Name" class="form-control" type="text" />
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Phone Number</label>
                                <input id="phone" placeholder="Phone" class="form-control" type="mobile" />
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Address</label>
                                <input id="address" placeholder="Address" class="form-control" type="text" />
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Password</label>
                                <input id="password" placeholder="User Password" class="form-control"
                                    type="password" />
                            </div>
                        </div>
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <button onclick="onSignUp()"
                                    class="btn mt-3 w-100  bg-gradient-secondary">Complete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    async function onSignUp() {

        let email = document.getElementById('email').value;
        let fullName = document.getElementById('fullName').value;
        let phone = document.getElementById('phone').value;
        let address = document.getElementById('address').value;
        let password = document.getElementById('password').value;

        if (email.length === 0) {
            errorToast('Email is required !');
        } 
        else if (fullName.length === 0) {
            errorToast('Full Name is required !');
        } 
        else if (phone.length === 0) {
            errorToast('Phone Number is required !');
        } 
        else if (address.length === 0) {
            errorToast('Address is required !');
        } 
        else if (password.length === 0) {
            errorToast('Password is required !');
        } 
        else {
            showLoader();

            let res = await axios.post("/user-sign-up", {
                email: email,
                name: fullName,
                phone: phone,
                address: address,
                password: password
            });

            hideLoader();

            if (res.status === 200 && res.data['status'] === 'success') {
                successToast(res.data['message']);
                setTimeout(function() {
                    window.location.href = '/login'
                }, 1000);
            } 
            else {
                errorToast(res.data['message']);
            }
        }
    }
</script>
