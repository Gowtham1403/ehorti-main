<?php
define("direct",1);
include "../db.php"; 
if($_POST['key'] === "productSearch"){
  $searchTerm = $_POST['searchTerm'];
  $dataJson = array();
  $data = array();
  $sql = "SELECT * FROM `seller-post` WHERE name LIKE '%".$searchTerm."%'"; 
  $result = $con->query($sql); 
  if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $data[] = $row['name'];
  }
  echo json_encode($data);

  }
  else{
      echo json_encode($data);
  }
}

if($_POST['key'] === "addressSearch"){
  $searchTerm = $_POST['locSearchTerm'];
  $dataJson = array();
  $data = array();
  $sql = "SELECT * FROM `customer-info` WHERE street_name LIKE '%".$searchTerm."%'"; 
  $result = $con->query($sql); 
  if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $data[] = $row['street_name'];
  }
  echo json_encode($data);

  }
  else{
      echo json_encode($data);
  }
}

 $con -> close();
?>