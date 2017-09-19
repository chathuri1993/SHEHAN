<?php

include './queryAll.php';

$grnid = $_POST['grnid'];

$dataOutPut = getGRNPrint($grnid);

echo json_encode($dataOutPut);
