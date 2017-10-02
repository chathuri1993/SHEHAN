<?php

include './queryAll.php';

$searchparam=$_POST['search_param'];
$searchval=$_POST['search_val']; 
$dataOutPut="";
if($searchval==''){
  $dataOutPut = getProductDetails();  
}else{
     $dataOutPut = getProductDetailsWhere($searchparam,$searchval);  
}
echo json_encode($dataOutPut);


