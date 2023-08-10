<?php
    define("direct",true);
    include "../db.php";

    if($_POST['key'] === "signup"){
        $email = mysqli_real_escape_string($con,$_POST['email']);
        $checkAllEmail = $con->query("SELECT * FROM `customer-info` WHERE email = '$email'");
        if($checkAllEmail->num_rows > 0){
            while($emailRow = $checkAllEmail -> fetch_assoc()){
                if($emailRow['email'] == $email){
                    echo 'Existing Account.<a onclick="loginBtnFun();" style="cursor:pointer;">Login</a>';
                }
            }
        }
        else{
            $token = bin2hex(random_bytes(16)); 
            $otp = rand(100000,999999);
            $otpInsert = $con -> query("INSERT INTO `customer-info`(`otp`,`token`) VALUES ('$otp','$token')");
            if($otpInsert === true){
                session_start();
                $_SESSION['signupEmail'] = $email;
                $_SESSION['signupToken'] = $token;
                echo "success";
            }
        }
        
    }
    elseif($_POST['key'] === "otpVerify"){
        $otp = mysqli_real_escape_string($con,$_POST['otp']);
        session_start();
        if(isset($_SESSION['signupEmail']) && isset($_SESSION['signupToken'])){
            $signupEmail = $_SESSION['signupEmail'];
            $signupToken = $_SESSION['signupToken'];
            $verifyOtp = $con->query("SELECT * FROM `customer-info` WHERE token = '$signupToken' and otp = '$otp'");
            if($verifyOtp -> num_rows > 0){
                echo "success";
            }
            else{
                echo "Incorrect OTP";
            }
        }
        else{
            echo "Something Wrong.Try Again";
        }
    }
    elseif( $_POST['key'] === "passwordVerify"){
        $password = mysqli_real_escape_string($con,$_POST['password']);
        session_start();
        if(isset($_SESSION['signupEmail']) && $_SESSION['signupToken']){
            $signupEmail = $_SESSION['signupEmail'];
            $signupToken = $_SESSION['signupToken'];
            $verifyPass = $con->query("UPDATE `customer-info` SET `email` = '$signupEmail' ,`password`= '$password',`status` = 'ACTIVE' WHERE token = '$signupToken'");
            if($verifyPass === true){
                $_SESSION['userEmail'] = $signupEmail;
                echo "success";
            }
            else{
                echo "Something Wrong.Try Again";
            }
        }
        else{
            echo "Something Wrong.Try Again";
        }
    }
    elseif($_POST['key'] === "login"){
        $loginEmail = mysqli_real_escape_string($con,$_POST['email']);
        $loginPassword = mysqli_real_escape_string($con,$_POST['password']);
        $login = $con -> query("SELECT * FROM `customer-info` WHERE email = '$loginEmail' and password = '$loginPassword'");
        if($login -> num_rows > 0){
            while($loginRecord = $login -> fetch_assoc()){
                if($loginRecord['email'] === $loginEmail && $loginRecord['password'] === $loginPassword){
                    session_start();
                    $_SESSION['userEmail'] = $loginEmail;
                    echo "success";
                }
            }
        }
        else{
            echo 'Account not Found.<a onclick="createBtnFun();" style="cursor:pointer;">Create Account</a>';
        }
        
        
    }
    else{
        header("location:../../../index.php");
    }
    $con->close();
?>