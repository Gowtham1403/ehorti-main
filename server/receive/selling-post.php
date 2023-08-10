<?php 

define("direct",1);
include "../db.php";

session_start();
if(!isset($_SESSION['userEmail'])){
    header("location:../../index.php");
}
else{
    $getUserName = $con -> query("SELECT * FROM `customer-info` WHERE email = '$_SESSION[userEmail]'");
    if($getUserName -> num_rows > 0){
        $row = $getUserName -> fetch_assoc();
        $sellerUserName = $row['name'];
    }
}

if($_FILES['postImg']['name']){
 
    move_uploaded_file($_FILES['postImg']['tmp_name'], "post-image/".$_FILES['postImg']['name']);
 
    $img = "post-image/".$_FILES['postImg']['name'];
 
}

// $date = date("Y-m-d h:i:s");
date_default_timezone_set("Asia/Calcutta");
$date = date("Y-m-d H:i:s");
$postUpload = $con -> query("INSERT INTO `seller-post`(`email`,`seller-name`,`product-img`, `name`, `category`, `price`, `quantity`, `unit`, `description`,`posted_time`) VALUES ('$_SESSION[userEmail]','$sellerUserName','$img','$_POST[postName]','$_POST[postCategory]',$_POST[postPrice],'$_POST[postQuantity]','$_POST[postUnit]','$_POST[postDescription]','$date')");
if($postUpload === true){
    echo "success";
}

$con -> close();
?>