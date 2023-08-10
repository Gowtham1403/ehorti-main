<?php 
define("direct",1);
include "../../server/db.php";
session_start();
$userStatus = $con -> query("UPDATE `customer-info` SET `status`= 'INACTIVE' WHERE email = '$_SESSION[userEmail]'");
session_destroy();
header("location:../../index.php");
$con->close();
?>