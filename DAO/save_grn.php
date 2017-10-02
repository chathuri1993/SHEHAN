<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include './queryAll.php';


$grn_product = $_POST['grn_table'];
$grn_id = $_POST['grnid'];
$grn_supplier_name = $_POST['supplier_id'];
$grn_total_amount = $_POST['grntotalamount'];
$grn_paid_amount = $_POST['grnpaidamount'];
$grn_balance = $_POST['grnbalance'];
$issued_by = "Chathuri";
$discount ="0";

$status2="";
$status = save_grn($grn_id, $grn_total_amount, $grn_paid_amount, $grn_balance, $issued_by, $discount,$grn_supplier_name);
if ($status == "1") {
    $data = json_decode($grn_product, true);
    $sports = array();
    foreach ($data as $item) {
        $qty = $item['QTY'];
        $product = $item['Item Description'];
        $productid = $item['Productid'];
        $unitprice = $item['Purchase Price'];
        $producttotal = $item['Amount'];
        $status2 = save_grnRegistry($grn_id, $qty, $unitprice, $productid);
    }
}

echo json_encode($status);
