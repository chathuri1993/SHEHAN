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
//foreach ($array as $customer) {
// $customer+=array[x].Product
//}
//for ($grn_product as x) {
//        $product += array[x].Product;
//         console.log(txt);
//    }
echo json_encode($customer);
