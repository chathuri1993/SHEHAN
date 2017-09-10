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
function geProducts($key) {
    global $DB;

    $details = $DB->query("SELECT * FROM product as p inner join supplier as s on p.idsupplier=s.idsupplier where p.idproduct='$key' ;");
    return $details;
}

function getDetailsCondition($tableName, $columnName, $key) {
    global $DB;
    if ($tableName == NULL)
        return NULL;
    $details = $DB->query("SELECT * FROM $tableName where $columnName='$key'");
    return $details;
}

function getDetailsLike($tableName, $columnName, $key) {
    global $DB;
    if ($tableName == NULL)
        return NULL;
    $details = $DB->query("SELECT * FROM $tableName where $columnName like '%$key%'");
    return $details;
}

function saveSupplier($suppliername, $supplier_contactno, $supplier_address, $supplier_discount) {
    global $DB;
    $dataArray = array("idsupplier" => 0, "name" => "$suppliername", "contactno" => "$supplier_contactno", "address" => "$supplier_address", "company_discount" => "$supplier_discount");
    $status = $DB->insert("supplier", $dataArray);
    if ($status == TRUE) {
        return "Success";
    } else {
        return "Error";
    }
}

function updateSupplier($suppliername, $supplier_contactno, $supplier_address, $id, $supplier_discount) {
    global $DB;
    $dataArray = array("name" => "$suppliername", "contactno" => "$supplier_contactno", "address" => "$supplier_address", "company_discount" => "$supplier_discount");
    $DB->where("idsupplier", $id);
    $DB->update("supplier", $dataArray);
}

function active_status($table, $column, $colval, $key, $value) {
    global $DB;
    $dataArray = array("$key" => "$value");
    $DB->where($column, $colval);
    $status = $DB->update($table, $dataArray);
    if ($status == TRUE) {
        return "Success";
    } else {
        return "Error";
    }
}
function save_grn(){
    
}