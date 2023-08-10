<?php

define("direct" ,1);
include "../db.php";


if($_POST['key'] === 'updatePost'){
    $updatePost  = $con -> query("UPDATE `seller-post` SET `price`='$_POST[updatePrice]',`quantity`='$_POST[updateQuan]' WHERE id = '$_POST[updatePostId]'");
    if($updatePost === true){
        echo "success";
    }
    
}


?>