<?php
define("direct",1);
session_start();
include "src/check-user.php";
include "../server/db.php";
include "src/header.php";
include "nav.php";
$productName = '';
if(isset($_GET['cid']) && isset($_GET['proid'])){
    $cid = $_GET['cid'];
    $proid = $_GET['proid'];
}
else{
    echo '<script>window.location.href = "../index.php";</script>';
}
?>

<!-- seller chat -->

<div class="seller-chat">
    <div class="container">
        <?php 
            $getSellerDetails = $con -> query("SELECT * FROM `customer-info` WHERE id = '$cid'");
            if($getSellerDetails -> num_rows > 0 ){ 
                while($row = $getSellerDetails -> fetch_assoc()){
        ?>
        <div class="chat-wrapper">
            <div class="chat-header">
                <a href="buying.php?pid=<?php echo $proid; ?>"><i class="fas fa-arrow-left"></i></a>
                <h5><span><i class="fas fa-user-circle"></i></span><?php echo ucfirst($row['name']); ?><br>
                </h5>
            </div>

            <div class="chat-body" id="chat-body">
                <?php
                $loadChats = $con -> query("SELECT * FROM `chat` WHERE product_id='$proid' and customer_email='$_SESSION[userEmail]' and seller_email = '$row[email]'");
                if($loadChats -> num_rows > 0){
                    while($rowChat = $loadChats -> fetch_assoc()){
                        if($rowChat['product_id'] === $proid and $rowChat['customer_email'] === $_SESSION['userEmail']){
                            if($rowChat['customer_msg']){
                                echo '<div class="customer-msg mb-3">
                                <span>'.$rowChat['customer_msg'].'</span>
                            </div>';
                            }
                        } 
                        if($rowChat['product_id'] === $proid and $rowChat['seller_email'] === $row['email']){
                            if($rowChat['seller_msg']){
                                echo '<div class="seller-msg mb-3">
                                <span>'.$rowChat['seller_msg'].'</span>
                            </div>';
                            }
                        }
                    }
                }
            ?>
            </div>
            <div class="chat-footer">
                <form class="d-flex" autocomplete="off">
                    <div class="form-group w-100">
                        <input type="text" id="chatInput" class="form-control" placeholder="Message">
                        <input type="text" hidden id="sellerEmail" value="<?php echo $row['email']; ?>">
                        <input type="text" hidden id="productID" value="<?php echo $proid; ?>">
                    </div>
                    <div class="form-group d-none" id="chatBtn">
                        <button type="submit" id="sendBtn" class="btn"><i class="fas fa-paper-plane"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <?php }} ?>
    </div>
</div>


<?php include "src/footer.php";?>

<script src="../server/send/chat.js"></script>

<?php include "src/body-footer.php"; ?>