<?php

include './queryAll.php';
$supplierKey=$_POST['productKey'];
$dataOutPut = geProducts($supplierKey);

echo json_encode($dataOutPut);