<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'MysqliDb.php';
$DB = new MysqliDb('localhost', 'root', '', 'dyosub_blkguest');

function getDetails($tableName, $columnName, $order) {
    global $DB;
    if ($tableName == NULL)
        return NULL;
    $details = $DB->query("SELECT * FROM $tableName order by $columnName $order");
    return $details;
}
function saveSupplier(){
    
}
function saveDesign($username, $designid, $designdate, $designname) {
    global $DB;

    $dataArray = array("idlogodesign" => 0, "username" => "$username", "designid" => "$designid", "designdate" => "$designdate", "designname" => "$designname");
    $status = $DB->insert("logodesign", $dataArray);
    if ($status == TRUE) {
        return "Success";
    } else {
        return "Error";
    }
}

function updateSubCategory($keyWords, $subcatid) {
    global $DB;
    $dataArray = array("keywords" => "$keyWords");
    $DB->where("idsubcategory", $subcatid);
    $DB->update("subcategory", $dataArray);
}

?>