//  Account System

// Login Account

const loginBtn = document.getElementById("loginBtn"),
emailEle = document.getElementById("emailEle"),
passEle = document.getElementById("passEle"),
loginError = document.querySelector(".login-error");

if(loginBtn){
    loginBtn.onclick = (e) => {
    e.preventDefault();
    if(emailEle.value !== "" && passEle.value !== ""){
        if(verifyEmail(emailEle.value) === true){
            $.ajax({
                method : "POST",
                url: "server/receive/account.php",
                data: {
                    key : "login",
                    email : emailEle.value.toLowerCase(),
                    password : passEle.value
                },
                async : false,
                dataType: "text",
                success: function (response) {
                    if(response === "success"){
                        window.location.href = "index.php";
                    }
                    else{
                        loginError.innerHTML  = response;
                    }
                }
            });
        }
        else{
        emailEle.focus();
        emailEle.classList.add("input-error");
        loginError.innerText = "Invalid Email Address";
    }
    }
    else{
        emailEle.focus();
        emailEle.classList.add("input-error");
        loginError.innerText = "Invalid Email and Password";
    }
}}


// Create Account

const signup = document.getElementById("signup"),
continueBtn = document.getElementById("continueBtn"),
continuePage = document.getElementById("continue"),
signupEmailPhone = document.getElementById("signup-emailPhone"),
errorMsg = document.querySelector(".error-msg");

if(continueBtn){
    continueBtn.onclick = (e) => {
        e.preventDefault();
        
        signupEmailPhone.focus();
        if(verifyEmail(signupEmailPhone.value) === true){
            $.ajax({
                method : "POST",
                url: "server/receive/account.php",
                data: {
                    key : "signup",
                    email : signupEmailPhone.value
                },
                async : false,
                dataType: "text",
                success: function (response) {
                    errorMsg.innerText = "";
                    if(response === "success"){
                            signup.classList.add("d-none");
                            continuePage.classList.remove("d-none");
                    }
                    else{
                            errorMsg.innerHTML  = response;
                    }
                }
            });
            
        }
        else{
            signupEmailPhone.classList.add("input-error");
            errorMsg.innerText = "Invalid Email Address";
        }  
    }
}


function verifyEmail(emailValue){
    let atPos = 0,dotPos = 0;
   for(let i = 0; i < emailValue.length; i++){
      if(emailValue[i] === '@'){
          atPos = i;
      }
      if(emailValue[i] === '.'){
          dotPos = i;
      }
   }
   if(atPos >= 2 && dotPos >= atPos+2){
        return true;
   }
   else
        return false;
}

const otpBtn = document.getElementById("otpBtn"),
otpEle = document.getElementById("emailOtp"),
otpErrorMsg = document.querySelector(".otp-error-msg"),
passwordBtn = document.getElementById("passwordBtn"),
passwordBox = document.getElementById("passwordBox"),
pass = document.getElementById("pass"),
cpass = document.getElementById("cpass"),
passError = document.querySelector(".pass-error-msg");

if(otpBtn){
    otpBtn.onclick = (e) => {
        e.preventDefault();
        otpEle.focus(); 
        if(otpEle.value !== ""){
            $.ajax({
                    method : "POST",
                    url: "server/receive/account.php",
                    data: {
                        key : "otpVerify",
                        otp : otpEle.value
                    },
                    async : false,
                    dataType: "text",
                    success: function (response) {
                        otpErrorMsg.innerText = "";
                        if(response === "success"){
                            passwordBox.classList.remove("d-none");
                            continuePage.classList.add("d-none");
                        }
                        else{
                            otpErrorMsg.innerHTML  = response;
                        }
                    }
            });
        }
        else{
            otpEle.classList.add("input-error");
            otpErrorMsg.innerHTML  = "OTP is Required";
        }
    }
}

if(passwordBtn){
    passwordBtn.onclick = (e) => {
        e.preventDefault();
        pass.focus();
        if(verifyPassCpass(pass,cpass) === true){
            $.ajax({
                method : "POST",
                url: "server/receive/account.php",
                data: {
                    key : "passwordVerify",
                    password : pass.value          
                },
                async : false,
                dataType: "text",
                success: function (response) {                            
                    passError.innerText = "";
                    if(response === "success"){
                        $('#loginModal').modal('hide');
                        location.href = "index.php";
                    }
                    else{
                        passError.innerHTML  = response;
                    }
                }
            });
        }
    }
}


function verifyPassCpass(passEle,cpassEle){
    if(passEle.value != ""  && cpassEle.value != ""){
        if(passEle.value.length <= 5){
            passError.innerText = "Password Contains 8 Character";
            passEle.classList.add("input-error");
            return false;
        }
        if(cpassEle.value.length <= 5){
            passError.innerText = "Confirm Password Contains 8 Character";
            passEle.classList.add("input-error");
            return false;
        }
        if(passEle.value !== cpassEle.value){
            passError.innerText = "Password and Confirm Password Not Same";
            passEle.classList.add("input-error");
            return false;
        }
        return true;
    }
    else{
        passError.innerText = "Password and Confirm Password Contains 8 Character";
        passEle.classList.add("input-error");
        return false;
    }
}