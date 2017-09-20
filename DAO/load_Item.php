<?php

include './queryAll.php';
$productid=$_POST['productid'];

$dataOutPut = getDetailsCondition("product", "idproduct", $productid);

echo json_encode($dataOutPut);
