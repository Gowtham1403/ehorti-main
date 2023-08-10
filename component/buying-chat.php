<?php 
session_start();
define("direct",1);
include "../server/db.php";
include "src/check-user.php";
include "src/header.php";
include "nav.php";

$userName = '';
$getUserName = $con -> query("SELECT * FROM `customer-info` WHERE email = '$_SESSION[userEmail]'");
if($getUserName -> num_rows > 0){
    $rowUserName = $getUserName -> fetch_assoc();
    $userName = $rowUserName['name'];
}
?>

<div class="seller-chat">
    <div class="container">
        <div class="chat-wrapper">
            <div class="chat-header">
                <a href="../index.php"><i class="fas fa-arrow-left"></i></a>
                <h5><span><i class="fas fa-comment"></i></span>My Chats<br></h5>
                <div class="row text-center">
                    <div class="col-6">
                        <a href="my-chats.php" style="font-size: 1.2rem;">Selling</a>
                    </div>
                    <div class="col-6 mychat-active">
                        <a href="buying-chat.php" style="font-size: 1.2rem;">Buying</a>
                    </div>
                </div>
            </div>
            <div class="chat-body chat-index" id="buyingchat-body">
                <?php 
                $getCustomer = $con -> query("SELECT DISTINCT seller_email,product_id FROM chat WHERE customer_email = '$_SESSION[userEmail]'");
                if($getCustomer -> num_rows > 0){
                        while($rowCustomer = $getCustomer -> fetch_assoc()){
                            $getCustomerEmail = $con -> query("SELECT * FROM `chat` WHERE product_id='$rowCustomer[product_id]' and  customer_email = '$_SESSION[userEmail]' and seller_email = '$rowCustomer[seller_email]' ORDER BY id DESC LIMIT 1");
                    if($getCustomerEmail -> num_rows > 0){
                        while($rowCustomerEmail = $getCustomerEmail -> fetch_assoc()){
                            $getCustomerName = $con -> query("select * from `customer-info` where email = '$rowCustomerEmail[seller_email]'");
                            if($getCustomerName -> num_rows > 0){
                                while($rowCustomerName = $getCustomerName -> fetch_assoc()){
                                    echo '<div style="position: relative;">
                                    <a href="customer-chat.php?cid='.$rowCustomerName['id'].'&bpid='.$rowCustomerEmail['product_id'].'" class="customer-list"></a>
                                    <div class="row py-2">
                                        <div class="col-2">
                                            <h1><i class="fas fa-user-circle"></i></h1>
                                        </div>
                                        <div class="col-10">';
                                    $getPrductName = $con -> query("SELECT * FROM `seller-post` WHERE id='$rowCustomer[product_id]'");
                                    if($getPrductName -> num_rows > 0){
                                        while ($rowProName = $getPrductName -> fetch_assoc()){
                                            echo '<h5 class="m-0 d-inline-block">'.ucfirst($rowCustomerName['name']).' </h5>';
                                            echo '<small class="d-inline-block">&nbsp&nbsp('.ucfirst($rowProName['name']).')</small><br>';
                                        }
                                    }
                                    
                                }
                            }
                            if($rowCustomerEmail['customer_msg']){
                                echo '<small>'.$rowCustomerEmail['customer_msg'].'</small>
                                        </div>
                                    </div>
                                </div>';
                            }
                            else{
                                if($rowCustomerEmail['seller_msg']){
                                    echo '<small>'.$rowCustomerEmail['seller_msg'].'</small>
                                            </div>
                                        </div>
                                    </div>';
                                }
                            }
                            
                        }
                    }
                        }
                    }
                    
                ?>
            </div>
        </div>
    </div>
</div>

<?php
include "src/footer.php";
?>

<script src="../server/send/chat.js"></script>

<?php
include "src/body-footer.php";
?>