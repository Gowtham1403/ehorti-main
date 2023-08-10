<?php 

session_start();
define("direct",1);
include "../server/db.php";
include "src/check-user.php";
include "src/header.php";
include "nav.php";

if(isset($_GET['pdid'])){
    $pdel = $con -> query("DELETE FROM `purchase-post` WHERE post_id = '$_GET[pdid]'");
    if($pdel === true){
        echo '<script>window.alert("deleted Success");window.location.href="my-account.php";</script>';
    }
}

?>

<div class="profile">
    <div class="container">
        <!-- header -->
        <div class="header">
            <div class="row">
                <div class="col-2 text-center">
                    <h1 class="user-icon"><i class="far fa-user-circle"></i></h1>
                </div>
                <div class="col-10 p-0">
                    <div class="info" style="margin-top: 0px; text-align: left;">
                        <?php 
                        $getuserName = $con -> query("SELECT * FROM `customer-info` WHERE email = '$_SESSION[userEmail]'");
                        if($getuserName -> num_rows > 0){
                            $userinfo = $getuserName -> fetch_assoc();
                        ?>
                        <h2 class="mb-1"><?php echo ucfirst($userinfo['name']); ?></h2>
                        <p class="mb-1"><?php echo $userinfo['email']; ?></p>
                        <a href="edit-profile.php">Edit Profile</a>
                        <?php } ?>

                    </div>
                </div>
            </div>
            <div class="header-2">
                <div class="row opt">
                    <div class="col-6 col-md-3 col-lg-2 text-center">
                        <a href="my-account.php" class="active-tab">Purchase</a>
                    </div>
                    <div class="col-6 col-md-9 col-lg-9">
                        <a href="sales.php">Sales (Post)</a>
                    </div>
                    <div class="col-lg-1">

                    </div>
                </div>
            </div>
        </div>
        <!--product-->

        <div class="main">
            <div class="row ">
                <?php
                
                $pur = $con -> query("SELECT * FROm `purchase-post` WHERE email='$_SESSION[userEmail]'");
                if($pur -> num_rows > 0){
                    while($purchaseInfo = $pur -> fetch_assoc()){
                        $sell = $con -> query("SELECT * FROM `seller-post` WHERE id = '$purchaseInfo[post_id]'");
                        while($sellInfo = $sell -> fetch_assoc()){
                ?>

                <div class="col-6 col-md-4 col-lg-3 px-2">
                    <div class="box">
                        <div class="box-header">
                            <img class="img-fluid" src="../server/receive/<?php echo $sellInfo['product-img']; ?>"
                                alt="post-img">
                        </div>
                        <div class="box-content">
                            <div class="row">
                                <div class="col-9 ">
                                    <h3 class="text-truncate"><?php echo ucfirst($sellInfo['name']); ?></h3>
                                </div>
                                <div class="col-3 mt-lg-1 px-2">
                                    <a class="del-icon" href="?pdid=<?php echo $sellInfo['id']; ?>"><i
                                            class="fas fa-trash"></i></a>
                                </div>
                            </div>
                            <h5>
                                <span style="font-family: 'Arial';">₹
                                </span>
                                <?php echo $sellInfo['price'].'.00'; ?>
                                <span style="font-size: 0.9rem;"> - 1 <?php echo $sellInfo['unit']; ?></span>
                                <span style="font-size: 0.7rem;">
                                    <?php echo "(".$sellInfo['quantity']." ".$sellInfo['unit'].")"; ?>
                                </span>
                            </h5>
                            <div class="d-flex" style="justify-content: space-between;">
                                <a href="seller-chat.php?cid=<?php 
                                    $cus = $con -> query("SELECT * FROM `customer-info` WHERE email='$sellInfo[email]'");
                                    if($cus -> num_rows > 0){
                                        $cusInfo = $cus -> fetch_assoc();
                                        echo $cusInfo['id']; 
                                    }                         
                                    ?>&proid=<?php echo $sellInfo['id']; ?>">View
                                    Chat</a>
                                <a href="#">View Mobile</a>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                    }}}else{
                        echo "<h6>No Purchase Found.</h6>";
                    }
                ?>
            </div>
        </div>
    </div>
</div>

<?php include "src/footer.php"; ?>
<?php include "src/body-footer.php"; ?>