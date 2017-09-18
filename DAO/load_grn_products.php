<?php

include './queryAll.php';
$grn_id = $_POST['grnid'];
$dataOutPut= getGRNProductRecords($grn_id);
echo json_encode($dataOutPut);