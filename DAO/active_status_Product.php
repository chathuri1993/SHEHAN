<?php

include './queryAll.php';
$product_id = $_POST['product_id'];
$productStatus = $_POST['status'];

$status = active_status("product", "idproduct", $product_id, "activestatus", $productStatus);
if ($status == 'Success') {
      $dataOutPut = getProductDetails();
} else {
    $dataOutPut = "Error";
}

echo json_encode($dataOutPut);
