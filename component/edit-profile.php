<?php 
define('direct',1);
include "../server/db.php";
include "src/header.php";
session_start();
include "nav.php";

?>

<div class="my-acc">
    <div class="container">
        <?php if(isset($_SESSION['userEmail'])){ 
            $fetchData = $con -> query("SELECT * FROM `customer-info` WHERE email = '$_SESSION[userEmail]'");
            if($fetchData -> num_rows > 0){
                $row = $fetchData->fetch_assoc();
        ?>
        <div class="main-wrapper">
            <div class="header">
                <div class="row">
                    <div class="col-md-2">
                        <h1 class="m-0"><i class="fas fa-user-circle"></i></h1>
                    </div>
                    <div class="col-md-10">
                        <form action="#">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="text" id="updateKey" value="<?php echo $_SESSION['userEmail'];
                         ?>" hidden>
                                        <input type="text" id="nameUpdateInput" class="form-control"
                                            placeholder="Enter Username" value="<?php echo $row['name']; ?>">
                                        <span id="nameUpdateErr"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mt-md-0 mt-2">
                                        <button class="btn btn-warning w-100" id="nameUpdateBtn">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="body">
                <h6 class="">User Email : <?php if(isset($_SESSION['userEmail'])){
                            echo $_SESSION['userEmail'];
                         } ?></h6>
                <form action="#">
                    <input type="text" id="updateKey" value="<?php echo $_SESSION['userEmail'];
                         ?>" hidden>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mt-2 mt-md-0">
                                <label for="upMobile">Mobile</label>
                                <?php 
                                    if($row['mobile'] != " "){
                                        echo '<input placeholder="Enter Mobile" value="'.$row['mobile'].'"
                                type="number"
                                class="form-control" required id="upMobile">';
                                }else{
                                echo '<input placeholder="Enter Mobile" value="'.$row['mobile'].'" type="number"
                                class="form-control" required disabled id="upMobile">';
                                }
                                ?>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="mt-4">Gender</label><br>
                            <?php 
                            if($row["gender"] === "Male"){
                                echo '<div class="form-check form-check-inline mr-1">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="upGenderMale"
                                    value="Male" checked>
                                <label class="form-check-label" for="upGenderMale">Male</label>
                            </div>';
                            }else{
                                echo '<div class="form-check form-check-inline mr-1">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="upGenderMale"
                                    value="Male">
                                <label class="form-check-label" for="upGenderMale">Male</label>
                            </div>';
                            }
                            if($row["gender"] === "Female"){
                                echo '<div class="form-check form-check-inline mr-1">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                    id="upGenderFemale" value="Female" checked>
                                <label class="form-check-label" for="upGenderFemale">Female</label>
                            </div>';
                            }
                            else{
                                echo '<div class="form-check form-check-inline mr-1">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                    id="upGenderFemale" value="Female">
                                <label class="form-check-label" for="upGenderFemale">Female</label>
                            </div>';
                            }
                            if($row["gender"] === "Others"){
                                echo '<div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                    id="upGenderOthers" value="Others" checked>
                                <label class="form-check-label" for="upGenderOthers">Others</label>
                            </div>';
                            }
                            else{
                                echo '<div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                    id="upGenderOthers" value="Others">
                                <label class="form-check-label" for="upGenderOthers">Others</label>
                            </div>';
                            }
                            ?>



                        </div>
                        <div class="col-md-6">
                            <div class="form-group mt-4">
                                <label for="upPincode">Pincode</label>
                                <input placeholder="Enter Pincode" value="<?php echo $row['pincode']; ?>" type="number"
                                    class="form-control" id="upPincode">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mt-4">
                                <label for="upAddress">Address</label>
                                <textarea placeholder="Enter Address (Area , Street Name)" type="text"
                                    class="form-control" id="upAddress"><?php echo $row['street_name']; ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mt-4">
                                <label for="upDistrict">District</label>
                                <input placeholder="Enter District" value="<?php echo $row['district']; ?>" type="text"
                                    class="form-control" id="upDistrict">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mt-4">
                                <label for="upState">State</label>
                                <select id="upState" class="form-control" value="<?php echo $row['state']; ?>">
                                    <?php 
                                     if($row['state'] != ""){
                                        echo '<option value="'.$row['state'].'">'.$row['state'].'</option>';
                                }else{
                                echo ' <option value="" selected disabled>- Select State -</option>';
                                }
                                ?>
                                    <option value="Tamilnadu">Tamilnadu</option>
                                </select>
                            </div>
                        </div>
                        <span id="updateErr" class="text-center pt-2"></span>
                        <div class="col-md-5"></div>
                        <div class="col-md-3 col-5">
                            <div class="form-group my-4">
                                <a href="../index.php" class="btn btn-outline-success">Cancel</a>
                            </div>
                        </div>
                        <div class="col-md-4 col-7">
                            <div class="form-group my-4">
                                <button class="btn btn-success" id="updateProfileBtn">Update Profile</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php }}else{
            header("location:../../index.php");
        } ?>
    </div>
</div>

<?php include "src/footer.php"; ?>

<script src="../server/send/my-account.js"></script>

<?php include "src/body-footer.php"; ?>