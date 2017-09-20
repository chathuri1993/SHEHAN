<?php

include './queryAll.php';
$ItemNameKey = $_POST['item_name_key'];
if ($supplierKey == "") {
      $dataOutPut = getProductDetails();
} else {
    $dataOutPut = getDetailsLike("supplier", "name", $ItemNameKey);
}
echo json_encode($dataOutPut);
