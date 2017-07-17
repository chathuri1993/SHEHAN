<?php

include './queryAll.php';

if ($_POST['action'] == 'save') {
    $suppliername = $_POST['name'];
    $supplier_contactno = $_POST['contactno'];
    $supplier_address = $_POST['address'];
    $status = saveSupplier($suppliername, $supplier_contactno, $supplier_address);
    if ($status == 'Success') {
        $dataOutPut = getDetails("supplier", "name", "ASC");
    }
}
if ($_POST['action'] == 'update') {
   
}

echo json_encode($dataOutPut);
