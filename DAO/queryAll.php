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

function getGRNRecords($grn_date) {
    if ($grn_date == null) {
        global $DB;
        $details = $DB->query("SELECT * FROM grn as g inner join supplier as s on g.suplierId=s.idsupplier");
        return $details;
    } else {
        global $DB;
        $details = $DB->query("SELECT * FROM grn as g inner join supplier as s on g.suplierId=s.idsupplier where issued_date LIKE '%$grn_date%'");
        return $details;
    }
}

function getGRNRecords_Filter($column, $val) {
    global $DB;
    $details = $DB->query("SELECT * FROM grn as g inner join supplier as s on g.suplierId=s.idsupplier where $column LIKE '%$val%' ");
    return $details;
}

function getGRNRecords_FilterWithDate($column, $val, $grn_date) {
    global $DB;
    $details = $DB->query("SELECT * FROM grn as g inner join supplier as s on g.suplierId=s.idsupplier where $column LIKE '%$val%' and issued_date LIKE '%$grn_date%'");
    return $details;
}

function getGRNProductRecords($key) {
    global $DB;
    $details = $DB->query("SELECT * FROM grnregistry g inner join product p on g.idproduct=p.idproduct where idgrn='$key'");
    return $details;
}

function generateID() {
    global $DB;
    $today = date("Y-m-d");
    $grnCounts = '';
    $details = $DB->query("SELECT count(idgrn) as co FROM grn WHERE date(issued_date)='$today'");
    foreach ($details as $value) {
        $grnCounts = $value["co"];
    }
    return $grnCounts;
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

function save_grn($idgrn, $total_amount, $paid_amount, $balance, $issued_by, $discount, $supid) {
    global $DB;
    $dataArray = array("idgrn" => "$idgrn", "totoal_amount" => "$total_amount", "paid_amount" => "$paid_amount", "balance" => "$balance", "issued_by" => "$issued_by", "discount" => "$discount", "suplierId" => "$supid");
    $status = $DB->insert("grn", $dataArray);
    if ($status == TRUE) {
        return "1";
    } else {
        return "0";
    }
}

function save_grnRegistry($idgrn, $qty, $unit_price, $idproduct) {
    global $DB;

    $dataArray = array("idgrnregistry" => 0, "qty" => "$qty", "unit_price" => "$unit_price", "idgrn" => "$idgrn", "idproduct" => "$idproduct");
    $status = $DB->insert("grnregistry", $dataArray);
    if ($status == TRUE) {
        return "Success";
    } else {
        return "Error";
    }
}
