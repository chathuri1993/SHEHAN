<?php

include './queryAll.php';

$search_param = $_POST['search_param'];
$search_val = $_POST['search_val'];
$grn_date = $_POST['grn_date'];
$dataOutPut = "";
if ($search_val == null) {
    $dataOutPut = getGRNRecords($grn_date);
}else if($grn_date==null){
    $dataOutPut =getGRNRecords_Filter($search_param, $search_val);
}else{
      $dataOutPut =  getGRNRecords_FilterWithDate($search_param, $search_val,$grn_date);
}
echo json_encode($dataOutPut);
