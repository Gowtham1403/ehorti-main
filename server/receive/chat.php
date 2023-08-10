<?php
define("direct",1);
include "../db.php";
session_start();
$userEmail = '';
if(isset($_SESSION['userEmail'])){
    $userEmail = $_SESSION['userEmail'];
}else{
    echo "userNotFound";
}


if($_POST['key'] === "chatSend"){
    $customerMsg = mysqli_real_escape_string($con,$_POST['customerMsg']);
    $sellerEmail = mysqli_real_escape_string($con,$_POST['sellerEmail']);
    $chatMsg = $con -> query("INSERT INTO `chat`(`product_id`,`customer_email`, `seller_email`, `customer_msg`) VALUES ('$_POST[productID]','$userEmail','$sellerEmail','$customerMsg')");
    if($chatMsg === TRUE){
        $loadChats = $con -> query("SELECT * FROM `chat` WHERE product_id='$_POST[productID]' and customer_email='$_SESSION[userEmail]'");
                if($loadChats -> num_rows > 0){
                    while($rowChat = $loadChats -> fetch_assoc()){
                        if($rowChat['product_id'] === $_POST['productID'] and $rowChat['customer_email'] === $_SESSION['userEmail']){
                            if($rowChat['customer_msg']){
                                echo '<div class="customer-msg mb-3">
                                <span>'.$rowChat['customer_msg'].'</span>
                            </div>';
                            }
                        } 
                        if($rowChat['product_id'] === $_POST['productID'] and $rowChat['seller_email'] === $sellerEmail){
                            if($rowChat['seller_msg']){
                                echo '<div class="seller-msg mb-3">
                                <span>'.$rowChat['seller_msg'].'</span>
                            </div>';
                            }
                        }
                    }
                }
    }
    
}

if($_POST['key'] === "customerChatSend"){
    $sellerMsg = mysqli_real_escape_string($con,$_POST['sellerMsg']);
    $customerEmail = mysqli_real_escape_string($con,$_POST['customerEmail']);
    $chatMsg = $con -> query("INSERT INTO `chat`(`product_id`,`customer_email`, `seller_email`, `seller_msg`) VALUES ('$_POST[productID]','$customerEmail','$userEmail','$sellerMsg')");
    if($chatMsg === TRUE){
        $loadChats = $con -> query("SELECT * FROM `chat` WHERE product_id='$_POST[productID]' and customer_email='$_SESSION[userEmail]'");
                if($loadChats -> num_rows > 0){
                    while($rowChat = $loadChats -> fetch_assoc()){
                        if($rowChat['product_id'] === $_POST['productID'] and $rowChat['customer_email'] === $_SESSION['userEmail']){
                            if($rowChat['customer_msg']){
                                echo '<div class="seller-msg mb-3">
                                <span>'.$rowChat['customer_msg'].'</span>
                            </div>';
                            }
                        } 
                        if($rowChat['product_id'] === $_POST['productID'] and $rowChat['seller_email'] === $sellerEmail){
                            if($rowChat['seller_msg']){
                                echo '<div class="customer-msg mb-3">
                                <span>'.$rowChat['seller_msg'].'</span>
                            </div>';
                            }
                        }
                    }
                }
    }
    
}


$con -> close();
?>