<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include './queryAll.php';


$grn_product = $_POST['grn_table'];
$product = "";
$x = "";
$array = json_decode($grn_product, true);

$data = json_decode($grn_product, true);
$sports = array();
foreach ($data as $item) {
    $Qty = $item['Qty'];
    $product = $item['Product'];
    $productid = $item['Productid'];
    $unitprice= $item['Unit price'];
    $unitprice= $item['price'];
}

echo json_encode($sports);
