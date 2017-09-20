<?php

include './queryAll.php';

$search_param = $_POST['search_param'];
$search_val = $_POST['search_val'];
$grn_date = $_POST['grn_date'];
$all_load = $_POST['all_load'];
$dataOutPut = "";
if ($search_val == null) {
    $dataOutPut = getGRNRecords($grn_date,$all_load);
}else{
      $dataOutPut =  getGRNRecords_FilterWithDate($search_param, $search_val,$grn_date);
}
echo json_encode($dataOutPut);
