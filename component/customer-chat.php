<?php
define("direct",1);
session_start();
include "src/check-user.php";
include "../server/db.php";
include "src/header.php";
include "nav.php";
$customerName='';
$buying = false;
if(isset($_GET['cid']) && isset($_GET['pid'])){
    $cid = $_GET['cid'];
    $proid = $_GET['pid'];
}
elseif(isset($_GET['cid']) && isset($_GET['bpid'])){
    $cid = $_GET['cid'];
    $proid = $_GET['bpid'];
    $buying = true;
}
else{
    echo '<script>window.location.href = "../index.php";</script>';
}
?>

<!-- seller chat -->

<div class="seller-chat">
    <div class="container">
        <?php 
        $getcustomerName = $con -> query("SELECT * FROM `customer-info` WHERE id = '$cid'");
        if($getcustomerName -> num_rows > 0){
            $rowName = $getcustomerName -> fetch_assoc();
            $customerName = $rowName['name'];
        ?>
        <div class="chat-wrapper">
            <div class="chat-header">
                <a href="buying-chat.php"><i class="fas fa-arrow-left"></i></a>
                <h5><span><i class="fas fa-user-circle"></i></span><?php echo ucfirst($customerName); ?><br></h5>
            </div>

            <div class="chat-body" id="customerChat-body">
                <?php 
                if($buying === false){
                    $getMsg = $con -> query("SELECT * FROM `chat` WHERE product_id='$proid' and customer_email = '$rowName[email]' and seller_email = '$_SESSION[userEmail]'");
                    if($getMsg -> num_rows > 0){
                        while ($rowMsg = $getMsg -> fetch_assoc()){
                            if($rowMsg['customer_msg']){
                                    echo '<div class="seller-msg mb-3">
                                    <span>'.$rowMsg['customer_msg'].'</span>
                                </div>';
                                }
                            if($rowMsg['seller_msg']){
                                echo '<div class="customer-msg mb-3">
                                <span>'.$rowMsg['seller_msg'].'</span>
                            </div>';
                            }
                        }
                    }
                }
                elseif($buying === true){
                    $getSellerEmail = $con -> query("SELECT * FROM `chat` WHERE product_id = '$proid'");
                    if($getSellerEmail -> num_rows > 0){
                        while($rowSellerEmail = $getSellerEmail -> fetch_assoc()){
                            $sellerEmail = $rowSellerEmail['seller_email'];
                        }}
                        $getMsg = $con -> query("SELECT * FROM `chat` WHERE product_id='$proid' and customer_email = '$_SESSION[userEmail]' and seller_email = '$sellerEmail'");
                        if($getMsg -> num_rows > 0){
                            while ($rowMsg = $getMsg -> fetch_assoc()){
                                if($rowMsg['customer_msg']){
                                        echo '<div class="customer-msg mb-3">
                                        <span>'.$rowMsg['customer_msg'].'</span>
                                    </div>';
                                    }
                                if($rowMsg['seller_msg']){
                                    echo '<div class="seller-msg mb-3">
                                    <span>'.$rowMsg['seller_msg'].'</span>
                                </div>';
                                }
                            }
                        }
                    
                }
                else{
                    echo "no buying Chat";
                }
                    
                ?>
            </div>
            <?php 
                if($buying === false){
            ?>
            <div class="chat-footer">
                <form class="d-flex" autocomplete="off">
                    <div class="form-group w-100">
                        <input type="text" id="customerChatInput" class="form-control" placeholder="Message">
                        <input type="text" hidden id="cusSellerEmail" value="<?php echo $rowName['email'] ; ?>">
                        <input type="text" hidden id="cusproductID" value="<?php echo $proid; ?>">
                    </div>
                    <div class="form-group d-none" id="customerChatBtn">
                        <button type="submit" id="customerSendBtn" class="btn"><i
                                class="fas fa-paper-plane"></i></button>
                    </div>
                </form>
            </div>
            <?php  } ?>
            <?php 
                if($buying === true){
            ?>
            <div class="chat-footer">
                <form class="d-flex" autocomplete="off">
                    <div class="form-group w-100">
                        <input type="text" id="customerChatInput" class="form-control" placeholder="Message">
                        <input type="text" hidden id="cusSellerEmail" value="<?php echo $sellerEmail ; ?>">
                        <input type="text" hidden id="cusproductID" value="<?php echo $proid; ?>">
                    </div>
                    <div class="form-group d-none" id="customerChatBtn">
                        <button type="submit" id="sellerSendBtn" class="btn"><i class="fas fa-paper-plane"></i></button>
                    </div>
                </form>
            </div>
            <?php  } ?>
        </div>
        <?php
        }
        ?>
    </div>
</div>


<?php include "src/footer.php";?>

<script src="../server/send/chat.js"></script>

<?php include "src/body-footer.php"; ?>