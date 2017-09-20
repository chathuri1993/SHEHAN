<?php

include './queryAll.php';

if ($_POST['action'] == 'save') {
    $suppliername = $_POST['name'];
    $supplier_contactno = $_POST['contactno'];
    $supplier_address = $_POST['address'];
    $supplier_discount = $_POST['discount'];
    $status = saveSupplier($suppliername, $supplier_contactno, $supplier_address, $supplier_discount);
    if ($status == 'Success') {
        $dataOutPut = getDetails("supplier", "name", "ASC");
    } else {
        $dataOutPut = "Error";
    }
} else if ($_POST['action'] == 'update') {
    $suppliername = $_POST['name'];
    $supplier_contactno = $_POST['contactno'];
    $supplier_address = $_POST['address'];
    $supplier_discount = $_POST['discount'];
    $supplier_id = $_POST['id'];
    $status = updateSupplier($suppliername, $supplier_contactno, $supplier_address, $supplier_id, $supplier_discount);

    $dataOutPut = getDetails("supplier", "name", "ASC");
}

echo json_encode($dataOutPut);
