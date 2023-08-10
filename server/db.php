<?php
if(!defined("direct")){
    header("location:../index.php");
}
$host = "localhost";
$uname = "root";
$upass = "";
$dbname = "e-horti";
$con = new mysqli($host,$uname,$upass,$dbname);
if($con -> connect_errno){
    die("Connection Terminated".$con -> connect_errno);
}
?>