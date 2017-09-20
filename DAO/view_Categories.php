<?php

include './queryAll.php';

$dataOutPut = getDetails("category", "name", "ASC");

echo json_encode($dataOutPut);
