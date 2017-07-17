<?php

include './queryAll.php';

$dataOutPut = getDetails("supplier", "name", "ASC");

echo json_encode($dataOutPut);
