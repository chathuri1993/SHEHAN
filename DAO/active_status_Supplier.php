<?php

include './queryAll.php';
$supplierKey = $_POST['supplier_id'];
$supplierStatus = $_POST['status'];

$status = active_status("supplier", "idsupplier", $supplierKey, "active_status", $supplierStatus);
if ($status == 'Success') {
    $dataOutPut = getDetails("supplier", "name", "ASC");
} else {
    $dataOutPut = "Error";
}

echo json_encode($dataOutPut);
