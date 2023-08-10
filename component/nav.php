<?php 
 if(!defined('direct')){
     header("location:../../index.php");
 }
?>
<!-- navigation -->
<span id="identify-innerNav"></span>
<nav class="navbar navbar-expand-md fixed-top">
    <div class="container">
        <div class="order-first d-flex">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span><i class="fas fa-bars"></i></span>
            </button>
            <div class="loc-bar d-flex">
                <a class="navbar-brand" href="../index.php">E-HORTI</a>
                <form>
                    <div class="form-group d-flex">
                        <input type="text" list="locSearchSuggestion" class="form-control" id="loc-search"
                            placeholder="Enter Address" required autocomplete="off">
                        <datalist id="locSearchSuggestion" class="text-truncate">
                        </datalist>
                        <button type="submit" id="locBtn" class="btn"><i class="fas fa-map-marker-alt"></i></button>
                    </div>
                </form>
            </div>

        </div>
        <div class="search-bar">
            <form action="#">
                <div class="form-group d-flex">
                    <input type="text" list="searchSug" id="searchInput" placeholder="Search" class="form-control"
                        required autocomplete="off">
                    <datalist id="searchSug">
                    </datalist>
                    <button type="submit" id="seaBtn" class="btn btn-success"><i class="fas fa-search"></i></button>
                </div>
            </form>
        </div>
        <div class="sell-btn">
            <a href="selling.php"><i class="fas fa-plus"></i> Sell</a>
        </div>
        <div class="btns-bar order-last">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="pro-hide d-md-flex">
                    <?php 
                    if(isset($_SESSION['userEmail'])){
                    ?>
                    <div class="dropdown">
                        <button class="btn profile-btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Profile
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="../index.php">Buying</a></li>
                            <li><a class="dropdown-item" href="my-account.php">My Account</a></li>
                            <li><a class="dropdown-item" href="selling.php">Start Selling</a></li>
                            <li><a class="dropdown-item" href="my-chats.php">My Chats</a></li>
                            <li><a class="dropdown-item" href="#">My Ads</a></li>
                            <li>
                                <a href="src/logout.php" class="dropdown-item">
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
                                echo '<a href="my-account.php">Create Profile</a>';
                            }else{
                                echo ucfirst($row['name']);
                            } ?></h1>
                            <p class="m-0"><?php echo $row['email']; ?></p>
                            <p class="m-0"><?php echo $row['mobile']; ?></p>
                        </span>
                    </div>
                    <div class="pro-body">
                        <h6><a href="../index.php">Buying</a></h6>
                        <h6><a href="my-account.php">My Account</a></h6>
                        <h6><a href="selling.php">Start Selling</a></h6>
                        <h6><a href="my-chats.php">My Chats</a></h6>
                        <h6><a href="#">My Ads</a></h6>
                    </div>
                    <?php } ?>
                    <div class="pro-footer">
                        <a href="src/logout.php" class="btn btn-dark mt-2 py-2 w-100">
                            Logout
                        </a>
                        <?php              
                         } else{
                        echo '<a href="index.php" class="btn btn-dark w-100 mt-2 py-2">Login
                        </a>'; 
                      }  ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- end navigation -->