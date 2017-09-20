<?php

include './queryAll.php';

if ($_POST['action'] == 'save') {

    $itemcode = $_POST['itemcode'];
    $description = $_POST['description'];
    $reorderlevel = $_POST['reorderlevel'];
    $category = $_POST['category'];
    $supplier = $_POST['supplier'];
    $unitprice = $_POST['unitprice'];

    $status = saveProduct($itemcode, $description, $reorderlevel, $category, $supplier, $unitprice);
    if ($status == 'Success') {
        $dataOutPut = getProductDetails();
    } else {
        $dataOutPut = "Error";
    }
} else if ($_POST['action'] == 'update') {
   
    $description = $_POST['description'];
    $reorderlevel = $_POST['reorderlevel'];
    $category = $_POST['category'];
    $supplier = $_POST['supplier'];
    $unitprice = $_POST['unitprice'];
    $itemid = $_POST['itemid'];

    $status = updateProduct($description, $reorderlevel, $category, $supplier, $unitprice, $itemid);

     $dataOutPut = getProductDetails();
}

echo json_encode($dataOutPut);
