<?php

include './queryAll.php';

$grn_From = $_POST['grn_From'];
$grn_To = $_POST['grn_To'];

$dataOutPut = getGRNTrans($grn_From, $grn_To);

echo json_encode($dataOutPut);
