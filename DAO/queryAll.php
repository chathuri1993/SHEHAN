<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'MysqliDb.php';
$DB = new MysqliDb('localhost', 'root', '', 'shehan');

function getDetails($tableName, $columnName, $order) {
    global $DB;
    if ($tableName == NULL)
        return NULL;
    $details = $DB->query("SELECT * FROM $tableName order by $columnName $order");
    return $details;
}
function getDetailsCondition($tableName, $columnName, $key) {
    global $DB;
    if ($tableName == NULL)
        return NULL;
    $details = $DB->query("SELECT * FROM $tableName where $columnName='$key'");
    return $details;
}

function saveSupplier($suppliername, $supplier_contactno, $supplier_address) {
    global $DB;
    $dataArray = array("idsupplier" => 0, "name" => "$suppliername", "contactno" => "$supplier_contactno", "address" => "$supplier_address");
    $status = $DB->insert("supplier", $dataArray);
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
