<?php 
if(!defined('direct')){
    header("location:../../index.php");
}
?>
<div class="modal fade login" data-bs-backdrop="static" data-bs-keyboard="false" id="loginModal">

    <!-- pop up Login Box  -->

    <div class="modal-dialog" id="loginAcc">
        <div class="modal-content">
            <div class="modal-header login-modal">
                <div class="modal-logo">
                    <img src="img/logo.jpg" />
                </div>
                <div>
                    <h2 class="modal-title">Login</h2>
                    <p class="m-0">Get access to Your Products , Services and Orders</p>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <form id="loginForm" autocomplete="off">
                    <div class="form-group mt-3">
                        <input type="text" id="emailEle" class="form-control" placeholder="Email or Phone" autofocus
                            required>
                        <span class="login-error"></span>
                    </div>
                    <div class="form-group mt-4 pass">
                        <input type="password" id="passEle" class="form-control" placeholder="Password" required>
                        <small id="hide-pass"><i class="fas fa-eye-slash"></i></small>
                        <small id="show-pass"><i class="fas fa-eye"></i></small>
                        <a href="component/forget-customer.php" class="for-pass"><i>Forget Password ?</i></a>
                    </div>
                    <div class="form-group mt-3">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success form-control" id="loginBtn">Login</button>
                        </div>
                        <a class="create-btn" id="createAccBtn">New Customer ? Create an
                            Account</a>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- end pop up Login Box  -->

    <!-- pop up Create Box  -->

    <div class="modal-dialog d-none" id="createAcc">
        <div class="modal-content">
            <div class="modal-header login-modal">
                <div class="modal-logo">
                    <img src="img/logo.jpg" />
                </div>
                <div>
                    <h2 class="modal-title">Signup</h2>
                    <p class="m-0">Look Likes Are you New Here !.Create Your Account get Our Services.</p>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            <!-- signup -->

            <div class="modal-body" id="signup">
                <form id="createForm" autocomplete="off">
                    <div class="form-group mt-3">
                        <input type="text" id="signup-emailPhone" class="form-control" placeholder="Enter your Email"
                            autofocus required>
                        <span class="error-msg"></span>
                    </div>
                    <div class="form-group mt-3">
                        <div class="form-group">
                            <button type="submit" id="continueBtn"
                                class="btn btn-success form-control">Continue</button>
                        </div>
                        <a id="loginAccBtn" class="create-btn">Already have an Account ? Login </a>
                    </div>
                </form>
            </div>

            <!-- continue page -->

            <div class="modal-body d-none" id="continue">
                <form id="otpForm" autocomplete="off">
                    <div class="form-group mt-3">
                        <input type="text" id="emailOtp" class="form-control" placeholder="Enter OTP" autofocus
                            required>
                    </div>
                    <span class="otp-error-msg"></span>
                    <div class="form-group mt-3">
                        <div class="form-group">
                            <button type="submit" id="otpBtn" class="btn btn-success form-control">Continue</button>
                        </div>
                        <a id="loginAccBtn" class="create-btn">Already have an Account ? Login</a>
                    </div>
                </form>
            </div>

            <!-- Password and confirm password -->

            <div class="modal-body d-none" id="passwordBox">
                <form autocomplete="off">
                    <div class="form-group mt-3">
                        <input type="text" id="pass" class="form-control" placeholder="Enter Password" autofocus
                            required>
                    </div>
                    <span class="pass-error-msg"></span>
                    <div class="form-group mt-3">
                        <input type="text" id="cpass" class="form-control" placeholder="Enter Confirm Password"
                            autofocus required>
                    </div>
                    <div class="form-group mt-3">
                        <div class="form-group">
                            <button type="submit" id="passwordBtn" class="btn btn-success form-control">Create
                                Account</button>
                        </div>
                        <a id="loginAccBtn" class="create-btn">Already have an Account ? Login</a>
                    </div>
                </form>
            </div>


        </div>
    </div>

    <!-- end pop up Create Box  -->


</div>