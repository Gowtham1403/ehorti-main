<?php 
define("direct",1);
include "../db.php";

if($_POST['key'] === "updateUsername"){
    $updateName = $con -> query("UPDATE `customer-info` SET `name`= '$_POST[updateUsername]' WHERE email='$_POST[updateEmail]'");
    if($updateName === true){
        echo "success";
    }
}
elseif($_POST['key'] === "updateProfile"){
    $gender = $_POST['gender']["male"].$_POST['gender']["female"].$_POST['gender']["others"];
    $updateProfile = $con -> query("UPDATE `customer-info` SET `gender`= '$gender',`mobile`= '$_POST[mobile]',`street_name`= '$_POST[address]',`district`= '$_POST[district]',`state`= '$_POST[state]',`pincode`= '$_POST[pincode]' WHERE email = '$_POST[updateUseremail]'");
    if($updateProfile === true){
        echo 'success';
    }
}
else{
    header("location:../../../index.php");
}

$con -> close();
?>