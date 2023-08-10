<?php 
define("direct",1);
session_start();
include "src/check-user.php";
include "../server/db.php";
include "src/remaining-time.php";
include "src/header.php";
include "nav.php";

if(isset($_GET['ap'])){
    $pur = $con -> query("INSERT INTO `purchase-post`(`email`, `post_id`) VALUES ('$_SESSION[userEmail]','$_GET[ap]')");
    if($pur === true){
        echo '<script>window.alert("Added Success.");window.location.href="buying.php?pid='.$_GET['pid'].'";</script>';
    }
}

if(isset($_GET['pid'])){
    $pid = $_GET['pid'];
}else{
    echo '<script>window.location.href = "../index.php";</script>';
}
?>
<div class="buy">
    <div class="container w-75">
        <?php 
        $sellerDistrict = '';
        $sellerStreetName = '';
        $chatID = '';
        $getPostDetails = $con -> query("SELECT * FROM `seller-post` WHERE id = '$pid'");
        if($getPostDetails -> num_rows > 0){
            $row = $getPostDetails -> fetch_assoc();      
            $getSellerDetails = $con-> query("SELECT * FROM `customer-info` WHERE email = '$row[email]'");
            if($getSellerDetails -> num_rows > 0){
                $rowAddrees = $getSellerDetails -> fetch_assoc();
                $sellerStreetName = $rowAddrees['street_name'];
                $sellerDistrict = $rowAddrees['district'];
                $chatID = $rowAddrees['id'];
            }
        ?>
        <div class="row">
            <div class="col-12 col-md-7">
                <div class="post-img-box text-center">
                    <div class="save-purchase-btn">
                        <a href="buying.php?pid=<?php echo $row['id']; ?>&ap=<?php echo $row['id']; ?>"><i
                                class="fas fa-cart-plus"></i> Save to
                            Purchase</a>
                    </div>
                    <img src="../server/receive/<?php echo $row['product-img']; ?>" class="img-fluid" alt="product-img">
                </div>
                <div class="mob-price-quan price-quan d-none">
                    <h3>Price&nbsp; &nbsp;: &nbsp;<span
                            style="font-family: 'Arial';">₹</span><?php echo $row['price']; ?>.00
                        <span style="font-size: 1rem;"> - 1 <?php echo $row['unit']; ?></span>
                    </h3>
                    <h5>Quantity : <?php echo $row['quantity'].$row['unit']; ?></h5>
                    <div class="row">
                        <div class="col-12 col-md-8">
                            <p class="address w-100">
                                <?php echo ucfirst($sellerStreetName)." ,".ucfirst($sellerDistrict); ?></p>
                        </div>
                        <div class="col-12 col-md-4">
                            <p><?php echo time_elapsed_string($row['posted_time'])?></p>
                        </div>
                    </div>
                </div>
                <div class="post-details mt-3">
                    <h4 class="pb-2">Product Details</h4>
                    <div class="row">
                        <div class="col-6">
                            <h5>Category</h5>
                            <h6><?php echo $row['category']; ?></h6>
                        </div>
                        <div class="col-6">
                            <h5>Product Name</h5>
                            <h6><?php echo ucfirst($row['name']); ?></h6>
                        </div>
                    </div>
                    <hr>
                    <h4>Description</h4>
                    <p><?php echo $row['description']; ?></p>
                </div>
            </div>
            <div class="col-12 col-md-5">
                <div class="price-quan">
                    <h3>Price&nbsp; &nbsp;: &nbsp;<span
                            style="font-family: 'Arial';">₹</span><?php echo $row['price']; ?>.00
                        <span style="font-size: 1rem;"> - 1 <?php echo $row['unit']; ?></span>
                    </h3>
                    <h5>Quantity : <?php echo $row['quantity'].$row['unit']; ?></h5>
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <p class="address w-100">
                                <?php echo ucfirst($sellerStreetName)." ,".ucfirst($sellerDistrict); ?></p>
                        </div>
                        <div class="col-12 col-lg-4">
                            <p><?php echo time_elapsed_string($row['posted_time'])?></p>
                        </div>
                    </div>
                </div>
                <div class="seller-details mt-3">
                    <h4>Seller Description</h4>
                    <p class="mb-4 address w-100">
                        <?php echo ucfirst($sellerStreetName)." ,".ucfirst($sellerDistrict); ?>
                    </p>
                    <div class="seller-loc-map">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3929.948484524695!2d78.10563051474173!3d9.938244492893531!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3b00cf5f2a5a41d5%3A0xdb79749e3b4ea67a!2sThathaneri%20Main%20Rd%2C%20Madurai%2C%20Tamil%20Nadu%20625018!5e0!3m2!1sen!2sin!4v1638695917510!5m2!1sen!2sin"
                            style="border:0;" class="w-100">
                        </iframe>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <a href="seller-chat.php?cid=<?php echo $chatID; ?>&proid=<?php echo $pid; ?>"
                                class="btn btn-dark w-100 mt-3">Chat</a>
                        </div>
                        <div class="col-12 col-md-6">
                            <a href="seller-chat.php?cid=<?php echo $chatID; ?>"
                                class="btn btn-dark w-100 mt-3">Call</a>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <?php }else{
            echo '<script>window.location.href = "../index.php";</script>';
        } ?>
    </div>
</div>


<?php 
include "src/footer.php";
include "src/body-footer.php";
$con -> close();
?>