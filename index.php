<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/all.min.css" />
    <link rel="stylesheet" href="public/css/bootstrap.min.css" />
    <link rel="stylesheet" href="public/css/bootstrap.min.css.map" />
    <link rel="stylesheet" href="public/css/animate.min.css" />
    <link rel="stylesheet" href="public/css/hamburgers.min.css" />
    <link rel="stylesheet" href="public/css/slick.css" />
    <link rel="stylesheet" href="public/css/slick-theme.css" />
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/responsive.css">
    <!-- <link rel="icon" href="img/logo.png" /> -->

    <title>E-HORTI</title>
</head>

<body>
    <?php
define('direct',true);
include "component/src/remaining-time.php";
    session_start();
    include "server/db.php";
    $uDistrict = '';
    if(isset($_SESSION['userEmail'])){
        $userStatus = $con -> query("UPDATE `customer-info` SET `status`='ACTIVE' WHERE email = '$_SESSION[userEmail]'");
        $user = $con -> query("SELECT * FROM `customer-info` WHERE email = '$_SESSION[userEmail]'");
        if($user -> num_rows > 0){
            $userInfo = $user -> fetch_assoc();
            $uDistrict = $userInfo['district'];
        }
    }else{
        include "component/account.php";
    }
?>
    <!-- navigation -->

    <nav class="navbar navbar-expand-md fixed-top">
        <div class="container">
            <div class="order-first d-flex">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span><i class="fas fa-bars"></i></span>
                </button>

                <div class="loc-bar d-flex">
                    <a class="navbar-brand" href="index.php">E-HORTI</a>
                    <form>
                        <div class="form-group d-flex">
                            <input type="text" list="locSearchSuggestion" class="form-control" id="loc-search"
                                placeholder="Enter Address" required autocomplete="off">
                            <datalist id="locSearchSuggestion">
                            </datalist>
                            <button type="submit" id="locBtn" class="btn"><i class="fas fa-map-marker-alt"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="search-bar">
                <form>
                    <div class="form-group d-flex">
                        <input type="text" list="searchSuggestion" id="main-search" placeholder="Search"
                            class="form-control" required autocomplete="off">
                        <datalist id="searchSuggestion">
                        </datalist>
                        <button type="submit" id="searchBtn" class="btn btn-success"><i
                                class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
            <div class="sell-btn">
                <a href="component/selling.php"><i class="fas fa-plus"></i> Sell</a>
            </div>
            <div class="btns-bar order-last">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="pro-hide d-md-flex">
                        <?php 
                    if(isset($_SESSION['userEmail'])){
                    ?>
                        <div class="dropdown">
                            <button class="profile-btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Profile
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="component/my-account.php">My Account</a></li>
                                <li><a class="dropdown-item" href="component/selling.php">Start Selling</a></li>
                                <li><a class="dropdown-item" href="component/my-chats.php">My Chats</a></li>
                                <li><a class="dropdown-item" href="#">My Ads</a></li>
                                <li>
                                    <a href="component/src/logout.php" class="dropdown-item">
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <?php }
                    else{
                    echo '<a href="index.php" class="btn login-btn">Login</a>';
                    }
                    ?>
                    </div>
                    <div class="navbar-nav user-pro d-none">
                        <?php 
                    if(isset($_SESSION['userEmail'])){
                        $fetchDetails = $con -> query("SELECT * FROM `customer-info` WHERE email = '$_SESSION[userEmail]'");
                        if($fetchDetails -> num_rows > 0){
                            $row = $fetchDetails -> fetch_assoc();
                    ?>

                        <div class="pro-header d-flex">
                            <h1 class="m-0"><i class="fas fa-user-circle"></i></h1>
                            <span>
                                <h1><?php if(!$row['name']){
                                echo '<a href="component/my-account.php">Create Profile</a>';
                            }else{
                                echo ucfirst($row['name']);
                            } ?></h1>
                                <p class="m-0"><?php echo $row['email']; ?></p>
                                <p class="m-0"><?php echo $row['mobile']; ?></p>
                            </span>
                        </div>
                        <div class="pro-body">
                            <h6><a href="component/my-account.php">My Account</a></h6>
                            <h6><a href="component/selling.php">Start Selling</a></h6>
                            <h6><a href="component/my-chats.php">My Chats</a></h6>
                            <h6><a href="#">My Ads</a></h6>
                        </div>
                        <?php }  ?>
                        <div class="pro-footer">
                            <a href="component/src/logout.php" class="btn btn-dark mt-2 py-2 w-100">
                                Logout
                            </a>
                            <?php } else{
                            echo '<a href="index.php" class="btn btn-dark w-100 mt-2 py-2">Login
                            </a>';
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- end navigation -->

    <!-- category nav -->
    <div class="cat-nav p-0">
        <!-- <div class="container mob-view">
            <div class="d-flex">
                <h6>Categories</h6>
                <a href="#">See All</a>
            </div>
            <div class="d-flex">
                <a href="#">
                    <div class="box me-2">
                        <div class="box-header">
                            <img src="public/img/cat-veg.png" class="img-fluid" alt="vegetables">
                        </div>
                        <div class="box-footer">
                            <h5>Vegetables</h5>
                        </div>
                    </div>
                </a>
                <a href="#">
                    <div class="box">
                        <div class="box-header">
                            <img src="public/img/cat-fruit.png" class="img-fluid" alt="vegetables">
                        </div>
                        <div class="box-footer">
                            <h5>Fruits</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="container large-view">
            <div class="row">
                <div class="col-md-5 col-lg-4">
                    <form action="#">
                        <div class="form-group d-flex">
                            <label for="" class="my-1 mx-3">Categories</label>
                            <select id="" class="form-control">
                                <option value="">All</option>
                                <option value="">Vegetables</option>
                                <option value="">Fruits</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="col-md-2 col-lg-4"></div>
                <div class="col-md-5 col-lg-4">
                    <form action="#">
                        <div class="form-group d-flex">
                            <label for="" class="my-1 mx-3">Items</label>
                            <select id="" class="form-control">
                                <option value="">All</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>-->
    </div>

    <!-- end category nav -->

    <!-- home -->

    <?php 
        if(!isset($_GET['q']) and !isset($_GET['lq'])){ 
    ?>
    <!-- home banner -->

    <div class="container">
        <div class="home-banner pt-2 ">
            <img src="public/img/home.jpg" class="img-fluid" alt="home-img">
            <div class="overlay mt-2">
                <div class="content">
                    <h3 class="w-100">Now, Buy and Sell Our Agri Products directly with E-Horti</h3>
                    <a href="component/selling.php" class="btn mt-3 me-3">Sell</a>
                    <a href="#gopost" class="btn btn-outline mt-3">Buy</a>
                </div>
            </div>
        </div>
    </div>

    <!-- end home banner -->
    <div class="container" id="gopost">
        <div class="row mt-1">
            <?php 
            $userDistrict = '';
            if(isset($_SESSION['userEmail'])){
                $getdistrict = $con -> query("SELECT * FROM `customer-info` WHERE email = '$_SESSION[userEmail]'");
                if($getdistrict -> num_rows > 0){
                    $row = $getdistrict -> fetch_assoc();
                    $userDistrict = $row['district'];
                    $getDis = $con -> query("SELECT * FROM `customer-info`");
                    if($getDis -> num_rows > 0){
                        while($rowDistrict = $getDis -> fetch_assoc()){
                            if($userDistrict === $rowDistrict['district']){
         $sellerPosts = $con -> query("SELECT * FROM `seller-post` WHERE email = '$rowDistrict[email]' ORDER BY id DESC");
            if($sellerPosts -> num_rows){
                while($row = $sellerPosts -> fetch_assoc()){
                    $getAddress = $con -> query("SELECT * FROM `customer-info` WHERE email = '$row[email]'");
                    if($getAddress -> num_rows > 0){
                        $rowAddress = $getAddress -> fetch_assoc();
        ?>

            <div class="col-6 col-lg-3 col-md-4 px-2">
                <div class="upload-posts my-2" style="text-overflow: ellipsis;">
                    <a href="component/buying.php?pid=<?php echo $row['id']; ?>" class="post-overlay"></a>
                    <div class="post-header text-center">
                        <img src="server/receive/<?php echo $row['product-img']; ?>" alt="posts" class="img-fluid">
                    </div>
                    <div class="post-footer">
                        <h4 class="item-name"><?php echo ucfirst($row['name']); ?></h4>
                        <h5 class="text-truncate"> <span style="font-family: 'Arial';">₹</span>
                            <?php echo $row['price'].".00";
                                ?>
                            <span style="font-size: 0.9rem;">
                                <?php echo " - 1 ".$row['unit']." ( Total : ".$row['quantity']." ".$row['unit'].")"; ?>
                            </span>
                        </h5>
                        <div class="line-foot">
                            <p class="m-0">
                                <?php echo ucfirst($rowAddress['street_name']).','.ucfirst($rowAddress['district']).'.';?>
                            </p>
                            <p class="p-0 m-0">
                                <?php                                     
                                    echo time_elapsed_string($row['posted_time']);                            
                                ?>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
            <?php 
                }}}            }
            }
        }
    }
}else{
    $getAllPost = $con -> query("SELECT * FROM `seller-post` ORDER BY id DESC");
    if($getAllPost -> num_rows > 0){
        while($row = $getAllPost -> fetch_assoc()){
            $getAddress = $con -> query("SELECT * FROM `customer-info` WHERE email = '$row[email]'");
            if($getAddress -> num_rows > 0){
                while($rowAddress = $getAddress -> fetch_assoc()){
        ?>
            <div class="col-6 col-lg-3 col-md-4 px-2">
                <div class="upload-posts my-2" style="text-overflow: ellipsis;">
                    <a href="component/buying.php?pid=<?php echo $row['id']; ?>" class="post-overlay"></a>
                    <div class="post-header text-center">
                        <img src="server/receive/<?php echo $row['product-img']; ?>" alt="posts" class="img-fluid">
                    </div>
                    <div class="post-footer">
                        <h4 class="item-name"><?php echo ucfirst($row['name']); ?></h4>
                        <h5 class="text-truncate"> <span style="font-family: 'Arial';">₹</span>
                            <?php echo $row['price'].".00";
                                ?>
                            <span style="font-size: 0.9rem;">
                                <?php echo " - 1 ".$row['unit']." ( Total : ".$row['quantity']." ".$row['unit'].")"; ?>
                            </span>
                        </h5>
                        <div class="line-foot">
                            <p class="m-0">
                                <?php echo ucfirst($rowAddress['street_name']).','.ucfirst($rowAddress['district']).'.';?>
                            </p>
                            <p class="p-0 m-0">
                                <?php                                     
                                    echo time_elapsed_string($row['posted_time']);                            
                                ?>
                            </p>
                        </div>

                    </div>
                </div>
            </div>

            <?php }} }}?>
        </div>
    </div>

    <?php  } }else{ ?>


    <div class="container" id="gopost">
        <div class="row mt-1">
            <?php 
            if(isset($_GET['q'])){
            $sellerPosts = $con -> query("SELECT * FROM `seller-post` WHERE name LIKE '%".$_GET['q']."%'");
            echo '<div class="d-flex justify-content-between mt-4 mx-auto search-subbar">
            <h5>Searching Result</h5>
        </div>';
            if($sellerPosts -> num_rows){
                while($row = $sellerPosts -> fetch_assoc()){
                    $getAddress = $con -> query("SELECT * FROM `customer-info` WHERE email = '$row[email]' and district = '$uDistrict'");
                    if($getAddress -> num_rows > 0){
                        $rowAddress = $getAddress -> fetch_assoc();
        ?>

            <div class="col-6 col-lg-3 col-md-4 px-2">
                <div class="upload-posts my-2" style="text-overflow: ellipsis;">
                    <a href="component/buying.php?pid=<?php echo $row['id']; ?>" class="post-overlay"></a>
                    <div class="post-header text-center">
                        <img src="server/receive/<?php echo $row['product-img']; ?>" alt="posts" class="img-fluid">
                    </div>
                    <div class="post-footer">
                        <h4 class="item-name"><?php echo ucfirst($row['name']); ?></h4>
                        <h5 class="text-truncate"> <span style="font-family: 'Arial';">₹</span>
                            <?php echo $row['price'].".00";
                                ?>
                            <span style="font-size: 0.9rem;">
                                <?php echo " - 1 ".$row['unit']." (".$row['quantity']." ".$row['unit'].")"; ?>
                            </span>
                        </h5>
                        <div class="line-foot">
                            <p class="m-0">
                                <?php echo ucfirst($rowAddress['street_name']).','.ucfirst($rowAddress['district']).'.';?>
                            </p>
                            <p class="p-0 m-0">
                                <?php                                     
                                    echo time_elapsed_string($row['posted_time']);                            
                                ?>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
            <?php 
                    }
                    else{
                        echo "<h2>Post Not In Your District</h2>";
                    }
                }
            }
        }
        if(isset($_GET['lq'])){
            $sellerPosts = $con -> query("SELECT * FROM `customer-info` WHERE street_name LIKE '%".$_GET['lq']."%'");
            $countPost = $sellerPosts -> num_rows + 1;
            echo '<div class="d-flex justify-content-between mt-4 mx-auto search-subbar">
            <h5>Searching Result</h5>
        </div>';
        while($getLoc = $sellerPosts -> fetch_assoc()){
            if($getLoc['district'] === $uDistrict){
            $getlocpost = $con -> query("SELECT * FROM `seller-post` WHERE email = '$getLoc[email]' ORDER BY id DESC");
            if($getlocpost -> num_rows > 0){
                while($postInfo = $getlocpost -> fetch_assoc()){
       ?>
            <div class="col-6 col-lg-3 col-md-4 px-2">
                <div class="upload-posts my-2" style="text-overflow: ellipsis;">
                    <a href="component/buying.php?pid=<?php echo $postInfo['id']; ?>" class="post-overlay"></a>
                    <div class="post-header text-center">
                        <img src="server/receive/<?php echo $postInfo['product-img']; ?>" alt="posts" class="img-fluid">
                    </div>
                    <div class="post-footer">
                        <h4 class="item-name"><?php echo ucfirst($postInfo['name']); ?></h4>
                        <h5 class="text-truncate"> <span style="font-family: 'Arial';">₹</span>
                            <?php echo $postInfo['price'].".00";
                                ?>
                            <span style="font-size: 0.9rem;">
                                <?php echo " - 1 ".$postInfo['unit']." (".$postInfo['quantity']." ".$postInfo['unit'].")"; ?>
                            </span>
                        </h5>
                        <div class="line-foot">
                            <p class="m-0">
                                <?php echo ucfirst($getLoc['street_name']).','.ucfirst($getLoc['district']).'.';?>
                            </p>
                            <p class="p-0 m-0">
                                <?php                                     
                                    echo time_elapsed_string($postInfo['posted_time']);                            
                                ?>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
            <?php } } }else{
                        echo "<h2>Post Not In Your District</h2>";
                    } } } ?>
        </div>
    </div>

    <?php }?>

    <!-- other Location -->

    <?php if(!isset($_GET['lq']) and !isset($_GET['q'])){ ?>
    <div class="container" id="gopost">
        <div class="row mt-1">
            <?php
            if(isset($_SESSION['userEmail'])){
                echo '<h5>Other District</h5>';
            $getUserLoc = $con -> query("SELECT * FROm `customer-info` WHERE email = '$_SESSION[userEmail]'");
            if($getUserLoc -> num_rows > 0){
                $rowAdd = $getUserLoc -> fetch_assoc();
                $getOtherLoc = $con -> query("SELECT * FROM `customer-info`");
                if($getOtherLoc -> num_rows > 0){
                    while($row = $getOtherLoc -> fetch_assoc()){
                        if($row['district'] !== $rowAdd['district']){
                           $otherloc = $con -> query("SELECT * FROM `seller-post` WHERE email = '$row[email]' ORDER BY id DESC");
                           if($otherloc -> num_rows > 0){
                               while ($rowOtherLoc = $otherloc -> fetch_assoc()){
            ?>
            <div class="col-6 col-lg-3 col-md-4 px-2">
                <div class="upload-posts my-2" style="text-overflow: ellipsis;">
                    <a href="component/buying.php?pid=<?php echo $rowOtherLoc['id']; ?>" class="post-overlay"></a>
                    <div class="post-header text-center">
                        <img src="server/receive/<?php echo $rowOtherLoc['product-img']; ?>" alt="posts"
                            class="img-fluid">
                    </div>
                    <div class="post-footer">
                        <h4 class="item-name"><?php echo ucfirst($rowOtherLoc['name']); ?></h4>
                        <h5 class="text-truncate"><span style="font-family: 'Arial';">₹</span>
                            <?php echo $rowOtherLoc['price'].".00";
                                ?>
                            <span style="font-size: 0.9rem;">
                                <?php echo " - 1 ".$rowOtherLoc['unit']." (".$rowOtherLoc['quantity']." ".$rowOtherLoc['unit'].")"; ?>
                            </span>
                        </h5>
                        <div class="line-foot">
                            <p class="m-0">
                                <?php echo ucfirst($row['street_name']).','.ucfirst($row['district']).'.';?>
                            </p>
                            <p class="p-0 m-0">
                                <?php                                     
                                    echo time_elapsed_string($rowOtherLoc['posted_time']);                            
                                ?>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
            <?php }}} }}}}} ?>
        </div>

        <!-- end other Location -->

        <!-- end home -->

        <!-- script -->

        <script src="public/js/jquery.min.js"></script>
        <script src="public/js/bootstrap.min.js"></script>
        <script src="public/js/all.min.js"></script>
        <script src="public/js/hamburgers.js"></script>
        <script src="public/js/slick.min.js"></script>
        <script src="public/js/smooth-scroll.min.js"></script>
        <script src="public/js/script.js"></script>
        <script src="public/js/datalist-css.min.js"></script>
        <script src=" server/send/account.js"></script>

        <!-- end script -->


</body>

</html>
<?php 
    $con -> close();
?>