<?php

include './queryAll.php';
$supplierKey=$_POST['supplierKey'];
$dataOutPut = getDetailsCondition("supplier", "idsupplier", $supplierKey);

echo json_encode($dataOutPut);
