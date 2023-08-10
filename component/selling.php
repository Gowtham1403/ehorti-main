<?php 
session_start();
define('direct',1);
if(!$_SESSION['userEmail']){
    header("location:../index.php");
}

include "../server/db.php";
include "src/header.php";
include "nav.php";

$checkUpdateName = $con -> query("SELECT * FROM `customer-info` WHERE email = '$_SESSION[userEmail]'");
if($checkUpdateName -> num_rows > 0){
    while($getUname = $checkUpdateName -> fetch_assoc()){
        if($getUname['name'] !== '' and  $getUname['mobile'] !== ''){
?>

<div class="selling-post">
    <div class="container w-75">
        <div class="post">
            <form id="postSellingForm" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-4">
                        <div class="post-img">
                            <img id="blah" src="#" class="img-fluid" alt="Preview Image" />
                            <div class="form-group mt-4 pt-3">
                                <input type="file" name="postImg" id="postImgName" accept=".png,.jpg,.jpeg"
                                    class="form-control" onchange="readURL(this);">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="post-detail px-lg-5">
                            <h4>Fill Product Details</h4>
                            <h6 class="h6 my-3 d-flex">
                                <span class="me-1"><i class="fas fa-map-marker-alt"></i></span>
                                <?php 
                                    if(isset($_SESSION['userEmail'])){
                                        $address = $con -> query("SELECT * FROM `customer-info` WHERE email = '$_SESSION[userEmail]'");
                                        if($address -> num_rows > 0){
                                            $row = $address -> fetch_assoc();
                                            echo ucfirst($row['street_name']).','.ucfirst($row['district']).'.<br>'.ucfirst($row['state']).",".'Pincode - '.$row['pincode'];
                                        }
                                    }
                                ?>
                            </h6>
                            <div class="form-group mb-2">
                                <label for="postName">Name <span style="color: red;">*</span></label>
                                <input type="text" id="postName" name="postName" class="form-control"
                                    placeholder="Enter Product Name">
                            </div>
                            <div class="form-group mb-2">
                                <label for="postCategory">Category <span style="color: red;">*</span></label>
                                <select name="postCategory" id="postCategory" class="form-control">
                                    <option value="" disabled selected>-Select Categories-</option>
                                    <option value="Vegetables">Vegetables</option>
                                    <option value="Fruits">Fruits</option>
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label for="postPrice">Price (Per Quantity)<span style="color: red;">*</span></label>
                                <input type="number" id="postPrice" name="postPrice" class="form-control"
                                    placeholder="Enter Product Price">
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <label for="postQuantity">Quantity <span style="color: red;">*</span></label>
                                        <input type="number" id="postQuantity" name="postQuantity" class="form-control"
                                            placeholder="Enter Product Quantity">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group my-4">
                                        <select id="postUnit" name="postUnit" class="form-control">
                                            <option value="" disabled selected>-Select Unit-</option>
                                            <option value="KG">KG</option>
                                            <option value="NUMBERS">NUMBERS</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="postQuantity">Description</label>
                                <textarea id="postDescription" name="postDescription" class="form-control" cols="30"
                                    rows="2" placeholder="Enter Some Description"></textarea>
                            </div>
                            <span id="postErr"></span>
                            <div class="row mt-4">
                                <div class="col-md-6"></div>
                                <div class="col-6 col-md-3">
                                    <a href="../index.php" class="btn btn-outline-success w-100">Cancel</a>
                                </div>
                                <div class="col-6 col-md-3">
                                    <button type="submit" id="postUploadBtn"
                                        class="btn btn-success w-100">Upload</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php }
else{
    echo '
    <div class="selling-post">
        <div class="mt-5 post">
            <h5>Update Your Profile. Then You will Post :)</h5>
            <a href="edit-profile.php">Update Profile</a>
        </div>
    </div>';
}
    }
} ?>



<?php include "src/footer.php" ?>

<script src="../server/send/selling-post.js"></script>

<?php include "src/body-footer.php" ?>