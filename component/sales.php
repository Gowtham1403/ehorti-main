<?php 

session_start();
define("direct",1);
include "../server/db.php";
include "src/check-user.php";
include "src/header.php";
include "nav.php";
include "src/remaining-time.php";

if(isset($_GET['dpid'])){
    $getImg = $con -> query("SELECT * FROM `seller-post` WHERE id = '$_GET[dpid]'");
    if($getImg -> num_rows > 0){
        while($dpid = $getImg -> fetch_assoc()){
            $deletePost = $con -> query("DELETE FROM `seller-post` WHERE id = '$_GET[dpid]'");
            if($deletePost === true){
                $imgLoc = '../server/receive/'.$dpid["product-img"].'';
                unlink($imgLoc);

                echo '<script>window.alert("Post Deleted !");window.location.href = "sales.php";</script>';
            }
            
        }
    }
    
    
}

if(isset($_GET['pid'])){
?>

<div class="modal fade login" data-bs-backdrop="static" data-bs-keyboard="false" id="loginModal">

    <!-- pop up Post Update box  -->

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header login-modal">
                <h2 class="modal-title ms-4">Update Post Info</h2>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <form autocomplete="off" enctype="multipart/form-data" id="upatePostForm">
                    <input type="text" value="<?php echo $_GET['pid']; ?>" id="updatePostId" hidden>
                    <div class="form-group mt-3">
                        <input type="number" name="upprice" class="form-control" placeholder="Price (Per Quantity)"
                            autofocus required>
                    </div>
                    <div class="form-group mt-4 pass">
                        <input type="number" name="upquantity" class="form-control" placeholder="Available Quantity"
                            required>
                    </div>
                    <span style="color: #ff0000;" id="updatePostError"></span>
                    <div class="form-group mt-3 row">
                        <div class="col-6">
                            <div class="form-group">
                                <a href="sales.php" class="btn btn-outline-success form-control"
                                    style="padding: 10px 0;">Cancel</a>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <button type="submit" id="updatePostBtn"
                                    class="btn btn-success form-control">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php } ?>

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
                        <a href="my-account.php">Purchase</a>
                    </div>
                    <div class="col-6 col-md-9 col-lg-9">
                        <a href="sales.php" class="active-tab">Sales (Post)</a>
                    </div>
                    <div class="col-lg-1">
                    </div>
                </div>
            </div>
        </div>
        <!--product-->
        <div class="main">
            <div class="row">
                <?php 
                    $getPost = $con -> query("SELECT * FROM `seller-post` WHERE email= '$_SESSION[userEmail]' ORDER BY id DESC");
                    if($getPost -> num_rows > 0){
                        while($postInfo = $getPost -> fetch_assoc()){
                            
                ?>
                <div class="col-6 col-md-4 col-lg-3 px-2 mt-1 mt-lg-3">
                    <div class="box">
                        <a href="#" class="overlay-link"></a>
                        <div class="box-header">
                            <img class="img-fluid" src="../server/receive/<?php echo $postInfo['product-img']; ?>"
                                alt="post-img">
                        </div>
                        <div class="box-content">
                            <div class="row">
                                <div class="col-9 ">
                                    <h3 class="text-truncate"><?php echo ucfirst($postInfo['name']); ?></h3>
                                </div>
                                <div class="col-3 mt-lg-1 px-2">
                                    <a class="del-icon" href="?dpid=<?php echo $postInfo['id']; ?>"><i
                                            class="fas fa-trash"></i></a>
                                </div>
                            </div>
                            <h5 class="text-truncate">
                                <span style="font-family: 'Arial';">₹
                                </span>
                                <?php echo $postInfo['price'].'.00'; ?>
                                <span style="font-size: 0.9rem;"> - 1 <?php echo $postInfo['unit']; ?></span>
                                <span style="font-size: 0.7rem;">
                                    <?php echo "(".$postInfo['quantity']." ".$postInfo['unit'].")"; ?>
                                </span>
                            </h5>
                            <div class="d-flex justify-content-between">
                                <p class="p-0 m-0">
                                    <?php                                     
                                    echo time_elapsed_string($postInfo['posted_time']);                            
                                    ?>
                                </p>
                                <a href="?pid=<?php echo $postInfo['id']; ?>">Edit-Post</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }}else{ ?>
                <span>No Post Found.</span><a class="link" href="selling.php">Start Selling</a>
                <?php }?>
            </div>
        </div>
    </div>
</div>

<?php include "src/footer.php"; ?>
<script src="../server/send/update-post.js"></script>
<?php include "src/body-footer.php"; ?>