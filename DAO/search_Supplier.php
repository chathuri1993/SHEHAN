<?php

include './queryAll.php';
$supplierKey = $_POST['supplier_name_Key'];
if ($supplierKey == "") {
    $dataOutPut = getDetails("supplier", "name", "ASC");
} else {
    $dataOutPut = getDetailsLike("supplier", "name", $supplierKey);
}
echo json_encode($dataOutPut);
