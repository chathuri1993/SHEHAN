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

function getProductDetails() {
    global $DB;

    $details = $DB->query("SELECT *,c.name as cname, s.name as sname FROM product p inner join category c on p.idcategory=c.idcategory inner join supplier s on p.idsupplier=s.idsupplier order by p.idproduct desc;");
    return $details;
}

function getProductDetailsWhere($column, $val) {
    global $DB;
    if ($column == "available_qty") {
        $details = $DB->query("SELECT *,c.name as cname, s.name as sname FROM product p inner join category c on p.idcategory=c.idcategory "
                . "inner join supplier s on p.idsupplier=s.idsupplier where  $column <= '$val' order by p.idproduct");
    } else if ($column == "unit_price") {
        $details = $DB->query("SELECT *,c.name as cname, s.name as sname FROM product p inner join category c on p.idcategory=c.idcategory "
                . "inner join supplier s on p.idsupplier=s.idsupplier where  $column >= '$val' order by p.idproduct");
    } else {
        $details = $DB->query("SELECT *,c.name as cname, s.name as sname FROM product p inner join category c on p.idcategory=c.idcategory "
                . "inner join supplier s on p.idsupplier=s.idsupplier where $column LIKE '%$val%' order by p.idproduct");
    }

    return $details;
}

function getProductDetailsLike($key) {
    global $DB;

    $details = $DB->query("SELECT *,c.name as cname, s.name as sname FROM product p inner join category c on p.idcategory=c.idcategory inner join supplier s on p.idsupplier=s.idsupplier order by p.idproduct where p.itemcode='$key'");
    return $details;
}

function geProducts($key) {
    global $DB;
    $details = $DB->query("SELECT * FROM product as p inner join supplier as s on p.idsupplier=s.idsupplier where p.idproduct='$key' ;");
    return $details;
}

function getGRNRecords($grn_date, $all_load) {
    if ($all_load == "all") {
        global $DB;
        $details = $DB->query("SELECT * FROM grn as g inner join supplier as s on g.suplierId=s.idsupplier order by issued_date desc");
        return $details;
    } else {
        global $DB;
        $details = $DB->query("SELECT * FROM grn as g inner join supplier as s on g.suplierId=s.idsupplier where issued_date LIKE '%$grn_date%' order by issued_date desc");
        return $details;
    }
}

function getGRNRecords_FilterWithDate($column, $val, $grn_date) {
    global $DB;
    $details = $DB->query("SELECT * FROM grn as g inner join supplier as s on g.suplierId=s.idsupplier where $column LIKE '%$val%' and issued_date LIKE '%$grn_date%'");
    return $details;
}

function getGRNTrans($grn_From, $grn_To) {
    global $DB;
//     $details = $DB->query("SELECT * FROM grn gr inner join grnregistry g on gr.idgrn=g.idgrn inner join product p on g.idproduct=p.idproduct inner join supplier s on gr.suplierId=s.idsupplier where date(issued_date) between '$grn_From' and '$grn_To'");

    $details = $DB->query("SELECT * FROM grn as g inner join supplier as s on g.suplierId=s.idsupplier where date(issued_date) between '$grn_From' and '$grn_To'");
    return $details;
}

function getGRNTransTotal($grn_From, $grn_To) {
    global $DB;
    $details = $DB->query("SELECT sum(totoal_amount) as co FROM grn as g inner join supplier as s on g.suplierId=s.idsupplier where date(issued_date) between '$grn_From' and '$grn_To'");
    foreach ($details as $value) {
        $grnTot = $value["co"];
    }
    return $grnTot;
}

function getGRNProductRecords($key) {
    global $DB;
    $details = $DB->query("SELECT * FROM grnregistry g inner join product p on g.idproduct=p.idproduct where idgrn='$key'");
    return $details;
}

function getGRNPrint($key) {
    global $DB;
    $details = $DB->query("SELECT * FROM grn gr inner join grnregistry g on gr.idgrn=g.idgrn inner join product p on g.idproduct=p.idproduct inner join supplier s on gr.suplierId=s.idsupplier where gr.idgrn='$key'");
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

function saveProduct($itemcode, $description, $reorderlevel, $category, $supplier, $unitprice) {
    global $DB;
//    idproduct, itemcode, description, available_qty, reorder_level, idcategory, idsupplier, unit_price
    $dataArray = array("idproduct" => 0, "itemcode" => "$itemcode", "description" => "$description", "reorder_level" => "$reorderlevel", "idcategory" => "$category", "idsupplier" => "$supplier", "unit_price" => "$unitprice");
    $status = $DB->insert("product", $dataArray);
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

function updateProduct($description, $reorderlevel, $category, $supplier, $unitprice, $itemid) {
    global $DB;
    $dataArray = array("description" => "$description", "reorder_level" => "$reorderlevel", "idcategory" => "$category", "idsupplier" => "$supplier", "unit_price" => "$unitprice");
    $DB->where("idproduct", $itemid);
    $DB->update("product", $dataArray);
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
        $productCount = '';
        $details = $DB->query("SELECT available_qty as pc FROM product WHERE idproduct='$idproduct'");
        foreach ($details as $value) {
            $productCount = $value["pc"];
        }
        $totalProduct = $productCount + $qty;
        $dataArray2 = array("available_qty" => $totalProduct);
        $DB->where("idproduct", $idproduct);
        $status2 = $DB->update("product", $dataArray2);
        if ($status2 == TRUE) {
            return "Success";
        } else {
            return "Error";
        }
    } else {
        return "Error";
    }
}
