<?php

include './queryAll.php';
$supplierKey=$_POST['supplierKey'];
$dataOutPut = getDetailsCondition("product", "idsupplier", $supplierKey);

echo json_encode($dataOutPut);