/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function supplier_Table(data) {
    var tableDesign = "";

    for (var i = 0; i < data.length; i++) {
        tableDesign += "<tr>";
        tableDesign += "<td>" + data[i].name + "<input type='hidden' value='" + data[i].idsupplier + "' id='supid" + i + "'/></td>";
        tableDesign += "<td>" + data[i].contactno + "</td>";
        tableDesign += "<td>" + data[i].address + "</td>";
        tableDesign += "<td>" + data[i].company_discount + "%</td>";
        tableDesign += "<td class='text-center'><button class='btn btn-default btn-primary btntablesize' onclick='loadSupFormData(" + data[i].idsupplier + ")'>View</button></td>";
        if (data[i].active_status == 1) {
            tableDesign += "<td class='text-center'><button class='btn btn-default btn-danger btntablesize' onclick='active_status_supplier(" + data[i].idsupplier + ",0)'>Block</button></td>";
        } else {
            tableDesign += "<td class='text-center'><button class='btn btn-default btn-success btntablesize' onclick='active_status_supplier(" + data[i].idsupplier + ",1)'>Active</button></td>";
        }
        tableDesign += "</tr>";

    }
    return tableDesign;
}

function supplierRegitation() {
    var readyStatus = "true";
    var name = $('#supplier_name').val();
    var contactno = $('#supplier_contactno').val();
    var address = $('#supplier_address').val();
    var discount = $('#supplier_discount').val();
    var action = $('#supplier_action').val();
    if (name == "") {
        $('#name_span').html("Please fill requred data");
        readyStatus = "false";
    }
    if (contactno == "") {
        $('#contactno_span').html("Please fill requred data");
        readyStatus = "false";
    }
    if (address == "") {
        $('#address_span').html("Please fill requred data");
        readyStatus = "false";
    }

    var id = $('#supplier_id').val();
    if (readyStatus == "true") {
        $.ajax({
            type: "POST",
            url: './DAO/supplier_Registration.php',
            data: {
                name: name,
                contactno: contactno,
                address: address,
                discount: discount,
                action: action,
                id: id
            },
            dataType: 'JSON',
            success: function(data) {
                if (data != "Error") {
                    $('#supplier_table').empty();
                    var tableDesign = supplier_Table(data);

                    $('#supplier_table').append(tableDesign);
                    $('#supplier_status').html("<div class='alert alert-success'><strong>Success!</strong></div>");
                    sup_clear();
                } else {
                    $('#supplier_status').html("<div class='alert alert-danger'><strong>Error!</strong>Please try again.</div>");
                }
            },
            error: function(e) {
                console.log(e);
            }
        });
    }
}

function loadSupplierDetails() {
    $.ajax({
        type: "POST",
        url: './DAO/view_Suppliers.php',
        data: {
        },
        dataType: 'JSON',
        success: function(data) {
            $('#supplier_table').empty();
            var tableDesign = supplier_Table(data);

            $('#supplier_table').append(tableDesign);
        },
        error: function(e) {
            console.log(e);
        }
    });
}

function loadSupFormData(val) {
    $('#supplier_status').empty();
    sup_changeText();
    $.ajax({
        type: "POST",
        url: './DAO/load_Supplier.php',
        data: {
            supplierKey: val
        },
        dataType: 'JSON',
        success: function(data) {
            for (var i = 0; i < data.length; i++) {
                $('#supplier_name').val(data[i].name);
                $('#supplier_contactno').val(data[i].contactno);
                $('#supplier_address').val(data[i].address);
                $('#supplier_discount').val(data[i].company_discount);
                $('#supplier_id').val(data[i].idsupplier);
            }
        },
        error: function(e) {
            console.log(e);
        }
    });
}
function searchSupplier() {
    $('#supplier_status').empty();
    var sup_name_key = $('#supplier_name_key').val();
    $.ajax({
        type: "POST",
        url: './DAO/search_Supplier.php',
        data: {
            supplier_name_Key: sup_name_key
        },
        dataType: 'JSON',
        success: function(data) {
            $('#supplier_table').empty();
            var tableDesign = supplier_Table(data);
            $('#supplier_table').append(tableDesign);
        },
        error: function(e) {
            console.log(e);
        }
    });
}

function active_status_supplier(id, status) {

    $('#supplier_status').empty();
    var status_word = "";
    if (status == 0) {
        status_word = "block";
    } else {
        status_word = "active";
    }
    if (confirm('Are you sure you want to ' + status_word + ' this supplier?')) {

        $.ajax({
            type: "POST",
            url: './DAO/active_status_Supplier.php',
            data: {
                supplier_id: id,
                status: status
            },
            dataType: 'JSON',
            success: function(data) {
                if (data != "Error") {
                    $('#supplier_table').empty();
                    var tableDesign = supplier_Table(data);
                    $('#supplier_table').append(tableDesign);
                    $('#supplier_status').html("<div class='alert alert-success'><strong>Success!</strong></div>");
                } else {
                    $('#supplier_status').html("<div class='alert alert-danger'><strong>Error!</strong>Please try again.</div>");
                }
            },
            error: function(e) {
                console.log(e);
            }
        });
    } else {
        // Do nothing!
    }
}


// ********************************* GRN ****************************************//

function loadSupplierNames() {
    $.ajax({
        type: "POST",
        url: './DAO/view_Suppliers.php',
        data: {
        },
        dataType: 'JSON',
        success: function(data) {
            $('#grn_supplier_name').empty();
            $('#grn_products').empty();
            var optionDesign = "<option value='0' selected='true' disabled='disabled'>Please select supplier</option>";
            var optionDesignP = "";
//            var optionDesign = "";

            for (var i = 0; i < data.length; i++) {
                if (data[i].active_status == '1') {
                    optionDesign += "<option value=" + data[i].idsupplier + ">" + data[i].name + "</option>";
                }
            }
            $('#grn_supplier_name').append(optionDesign);

            $('#grn_products').append(optionDesignP);
            var id = new Date().getUTCMilliseconds();
            $('#grn_id').append(id);

//            $('#grn_supplier_name').editableSelect();

        },
        error: function(e) {
            console.log(e);
        }
    });
}

function loadProducts(val) {
//    if ($('#grn_table').html() != "") {
//        if (confirm('Clear you have added data after select supplier again')) {
//            grn_clear();
//        } else {
//            // Do nothing!
//        }
//    }

    if (val != 0) {
        $.ajax({
            type: "POST",
            url: './DAO/load_Products.php',
            data: {
                supplierKey: val
            },
            dataType: 'JSON',
            success: function(data) {
                $('#grn_products').empty();
                var optionDesign = "";

                for (var i = 0; i < data.length; i++) {
                    optionDesign += "<option value=" + data[i].idproduct + ">" + data[i].description + "</option>";
                }
                $('#grn_products').append(optionDesign);

//            $('#grn_supplier_name').editableSelect();
            },
            error: function(e) {
                console.log(e);
            }
        });
    }
    grn_add_clear();

}
function loadProductDetails(val) {
    if (val != 0) {
        $.ajax({
            type: "POST",
            url: './DAO/load_Product_Details.php',
            data: {
                productKey: val
            },
            dataType: 'JSON',
            success: function(data) {

                for (var i = 0; i < data.length; i++) {
                    $('#grn_discount').val(data[i].company_discount);
                    $('#grn_unit_price').val(parseFloat(Math.round((data[i].unit_price) * 100) / 100).toFixed(2));
                }
            },
            error: function(e) {
                console.log(e);
            }
        });
    }
}

function change_grn_action(val) {
    if (val != 0) {
        $.ajax({
            type: "POST",
            url: './DAO/load_Product_Details.php',
            data: {
                productKey: val
            },
            dataType: 'JSON',
            success: function(data) {

                for (var i = 0; i < data.length; i++) {
                    $('#grn_discount').val(data[i].company_discount + "%");
                    $('#grn_unit_price').val(data[i].unit_price);
                }
            },
            error: function(e) {
                console.log(e);
            }
        });
    }
}

function save_Grn() {
    var array = getTableData();
    var readyStatus = "true";
    var grinid = $('#grn_id').val();
    var supplier_id = $('#grn_supplier_name').val();
    var total_amount = $('#grn_total_amount').val();
    var paid_amount = $('#grn_paid_amount').val();
    var balance = $('#grn_balance').val();

    var productid = $('#grn_products option:selected').val();
    if (paid_amount == "") {
        $('#grn_paid_amount_span').html("Please fill required data");
        readyStatus = "false";
    }
    if (productid == undefined) {
        $('#grn_product_span').html("Please select requred data");
        readyStatus = "false";
    }
    if (readyStatus == "true") {
        $.ajax({
            type: "POST",
            url: './DAO/save_grn.php',
            data: {
                grnid: grinid,
                supplier_id: supplier_id,
                grntotalamount: total_amount,
                grnpaidamount: paid_amount,
                grnbalance: balance,
                grn_table: JSON.stringify(array)

            },
            dataType: 'JSON',
            success: function(data) {

                // Success unoth print wenawa **************
                if (data == "1") {
                    $('#grn_status').html("<div class='alert alert-success'><strong>Success!</strong></div>");
                    $.ajax({
                        type: "POST",
                        url: './DAO/print_grn.php',
                        data: {
                            grnid: grinid
                        },
                        dataType: 'JSON',
                        success: function(data) {
                            var tableDesign = "";
//idgrnregistry, qty, unit_price, idgrn, idproduct, idproduct, itemcode, description, available_qty, reorder_level, idcategory, idsupplier, unit_price

                            for (var i = 0; i < data.length; i++) {
                                tableDesign += "<tr>";
                                tableDesign += "<td>" + data[i].itemcode + "</td>";
                                tableDesign += "<td>" + data[i].description + "</td>";
                                tableDesign += "<td>" + data[i].qty + "</td>";
                                tableDesign += "<td>" + parseFloat(Math.round(data[i].unit_price * 100) / 100).toFixed(2) + "</td>";
                                tableDesign += "</tr>";

                                $('#grn_records_issued').html("Issued By: " + data[i].issued_by);
                                $('#grn_records_ref').html("GRN ID: " + grinid);
                                $('#grn_records_tot').html(parseFloat(Math.round(data[i].totoal_amount * 100) / 100).toFixed(2));
                                $('#grn_records_paid').html(parseFloat(Math.round(data[i].totoal_amount * 100) / 100).toFixed(2));
                                $('#grn_records_balance').html(parseFloat(Math.round(data[i].balance * 100) / 100).toFixed(2));
                                $('#grn_records_sup').html("Supplier: " + data[i].name);
                            }

                            $('#grn_print_products').append(tableDesign);
                            $('#grn_print').modal('show');
                        },
                        error: function(e) {
                            console.log(e);

                        }
                    });

                    grn_clear();

                } else {
                    $('#grn_status').html("<div class='alert alert-danger'><strong>Error!</strong>Please try again.</div>");
                }
            },
            error: function(e) {
                console.log(e);
                $('#grn_status').html("<div class='alert alert-danger'><strong>Error!</strong>Please try again.</div>");
            }
        });
    }
}
function getTableData() {
    var array = [];
    var headers = [];
    var txt = "";

    $('#grn_product_table th').each(function(index, item) {
        headers[index] = $(item).html();
    });
    $('#grn_product_table tr').has('td').each(function() {
        var arrayItem = {};
        $('td', $(this)).each(function(index, item) {
            arrayItem[headers[index]] = $(item).html();
        });
        array.push(arrayItem);
    });
    return array;

}
function generateId() {

    $.ajax({
        type: "POST",
        url: './DAO/generateID.php',
        data: {
        },
        dataType: 'JSON',
        success: function(data) {
            $("#grn_id").val(data);
        },
        error: function(e) {
            console.log(e);
        }
    });
}

//********************************************* GRN Records

function setGRNHiddenValue() {
    $('#all_grnrecords').val("all");
    loadGRNRecords();
}
function loadGRNRecords(page) {

    var search_param = $('#search_param').val();
    var search_val = $('#search_val').val();
    var grn_date = $('#date').val();
    var all = $('#all_grnrecords').val();

    $.ajax({
        type: "POST",
        url: './DAO/load_grn.php',
        data: {
            search_param: search_param,
            search_val: search_val,
            grn_date: grn_date,
            all_load: all
        },
        dataType: 'JSON',
        success: function(data) {
            if (data.length > 0) {
                if (page == undefined) {
                    page = 1;
                } 
                var tableDesign = "";
                var pageId = 1;
                var paginationCount = 10;
                var dataCount = data.length / paginationCount;

                var totalpages = Math.ceil(dataCount);
                $('#date').on("click", function() {
                    $('#pagination-demo').on("pageClick");
                });
                $('#pagination-demo').twbsPagination('destroy');
                $('#pagination-demo').twbsPagination({
                    totalPages: totalpages,
                    visiblePages: totalpages,
                    onPageClick: function(event, page) {

                        pageId = page * paginationCount;
                        if (data.length <= pageId) {
                            pageId = data.length;
                        }

                        $('#grn_records_table').empty();
                        var tableDesign = "";
//idgrn, issued_date, totoal_amount, paid_amount, balance, issued_by, discount, suplierId, idsupplier, name, contactno, address, active_status, company_discount
                        for (var i = (page - 1) * paginationCount; i < pageId; i++) {
                            tableDesign += "<tr>";
                            tableDesign += "<td>" + data[i].idgrn + "<input type='hidden' value='" + data[i].issued_by + "' id='" + data[i].idgrn + "'/></td>";
                            tableDesign += "<td>" + data[i].issued_date + "</td>";
                            tableDesign += "<td>" + parseFloat(Math.round(data[i].totoal_amount * 100) / 100).toFixed(2) + "</td>";
                            tableDesign += "<td>" + parseFloat(Math.round(data[i].paid_amount * 100) / 100).toFixed(2) + "</td>";
                            tableDesign += "<td>" + parseFloat(Math.round(data[i].balance * 100) / 100).toFixed(2) + "</td>";
                            tableDesign += "<td>" + data[i].name + "</td>";
                            tableDesign += "<td class='text-center'><button class='btn btn-default btn-primary' data-toggle='modal' data-target='#grn_products' onclick='loadGRNProducts(" + data[i].idgrn + ")'>More Details</button></td>";
                            tableDesign += "</tr>";

                        }
                        if ($('#all_grnrecords').val() == "all") {
                            $('#all_grnrecords').val("0");
                            $('#date').val("");
                        }
                        $('#grn_records_table').append(tableDesign);

                    }

                });
            } else {
                $('#grn_records_table').empty();
            }

        },
        error: function(e) {
            console.log(e);
        }
    });

}

function loadGRNProducts(val) {

    $.ajax({
        type: "POST",
        url: './DAO/load_grn_products.php',
        data: {
            grnid: val
        },
        dataType: 'JSON',
        success: function(data) {

            var tableDesign = "";
//idgrnregistry, qty, unit_price, idgrn, idproduct, idproduct, itemcode, description, available_qty, reorder_level, idcategory, idsupplier, unit_price

            for (var i = 0; i < data.length; i++) {
                tableDesign += "<tr>";
                tableDesign += "<td>" + data[i].itemcode + "</td>";
                tableDesign += "<td>" + data[i].description + "</td>";
                tableDesign += "<td>" + data[i].qty + "</td>";
                tableDesign += "<td>" + parseFloat(Math.round(data[i].unit_price * 100) / 100).toFixed(2) + "</td>";
                tableDesign += "</tr>";

            }
            var variableName = "#" + val;
            $('#grn_records_issued').html("Issued By: " + $(variableName).val());
            $('#grn_records_ref').html("GRN ID: " + val);
            $('#grn_records_products').append(tableDesign);
        },
        error: function(e) {
            console.log(e);
        }
    });
}

//********************************************* GRN Transactions

function loadGRNTrans() {

    var grn_From = $('#dateFrom').val();
    var grn_To = $('#dateTo').val();

    $.ajax({
        type: "POST",
        url: './DAO/load_grn_trans.php',
        data: {
            grn_From: grn_From,
            grn_To: grn_To
        },
        dataType: 'JSON',
        success: function(data) {

            if (data.length > 0) {
                var tableDesign = "";
                var tableDesign2 = "";
                $('#grn_trans_table').empty();
                for (var i = 0; i < data.length; i++) {
                    tableDesign += "<tr>";
                    tableDesign += "<td>" + data[i].idgrn + "<input type='hidden' value='" + data[i].issued_by + "' id='" + data[i].idgrn + "'/></td>";
                    tableDesign += "<td>" + data[i].issued_date + "</td>";
                    tableDesign += "<td>" + parseFloat(Math.round(data[i].totoal_amount * 100) / 100).toFixed(2) + "</td>";
//                    tableDesign += "<td>" + parseFloat(Math.round(data[i].paid_amount * 100) / 100).toFixed(2) + "</td>";
//                    tableDesign += "<td>" + parseFloat(Math.round(data[i].balance * 100) / 100).toFixed(2) + "</td>";
                    tableDesign += "<td>" + data[i].name + "</td>";
//                    tableDesign += "<td class='text-center'><table class='table' id='" + data[i].idgrn + "'>'" + tableDesign2 + "'</table></td>";
                    tableDesign += "</tr>";
                }
                $.ajax({
                    type: "POST",
                    url: './DAO/load_grn_total.php',
                    data: {
                        grn_From: grn_From,
                        grn_To: grn_To
                    },
                    dataType: 'JSON',
                    success: function(data) {

                        $('#grn_total').html("Total (Rs): " + parseFloat(Math.round(data * 100) / 100).toFixed(2));
                    },
                    error: function(e) {
                        console.log(e);
                    }
                });
            }
            $('#grn_trans_table').append(tableDesign);
        },
        error: function(e) {
            console.log(e);
        }
    });

}


// ********************************************************************************* Product Registration
function loadProductSupplierNames() {
    $.ajax({
        type: "POST",
        url: './DAO/view_Suppliers.php',
        data: {
        },
        dataType: 'JSON',
        success: function(data) {
            $('#item_supplier').empty();
            var optionDesign = "<option value='0' selected='true' disabled='disabled'>Please select supplier</option>";
            var optionDesignP = "";
//            var optionDesign = "";

            for (var i = 0; i < data.length; i++) {
                if (data[i].active_status == '1') {
                    optionDesign += "<option value=" + data[i].idsupplier + ">" + data[i].name + "</option>";
                }
            }
            $('#item_supplier').append(optionDesign);

        },
        error: function(e) {
            console.log(e);
        }
    });
}
function loadCategories() {
    $.ajax({
        type: "POST",
        url: './DAO/view_Categories.php',
        data: {
        },
        dataType: 'JSON',
        success: function(data) {
            $('#item_category').empty();
            var optionDesign = "<option value='0' selected='true' disabled='disabled'>Please select category</option>";
            var optionDesignP = "";
//            var optionDesign = "";

            for (var i = 0; i < data.length; i++) {
                optionDesign += "<option value=" + data[i].idcategory + ">" + data[i].name + "</option>";

            }
            $('#item_category').append(optionDesign);

        },
        error: function(e) {
            console.log(e);
        }
    });
}



function ProductRegitation() {
    var readyStatus = "true";
    var itemcode = $('#item_code').val();
    var description = $('#item_des').val();
    var reorderlevel = $('#reorder_level').val();
    var category = $('#item_category').val();
    var supplier = $('#item_supplier').val();
    var unitprice = $('#item_unitprice').val();
    var action = $('#item_action').val();
    var itemid = $('#item_id').val();

    if (itemcode == "") {
        $('#item_code_span').html("Please fill requred data");
        readyStatus = "false";
    }
    if (description == "") {
        $('#item_des_span').html("Please fill requred data");
        readyStatus = "false";
    }
    if (reorderlevel == "") {
        $('#reorder_span').html("Please fill requred data");
        readyStatus = "false";
    }
    if (category == "0") {
        $('#item_category_span').html("Please fill requred data");
        readyStatus = "false";
    }
    if (supplier == "0") {
        $('#item_sup_span').html("Please fill requred data");
        readyStatus = "false";
    }
    if (unitprice == "") {
        $('#unitprice_span').html("Please fill requred data");
        readyStatus = "false";
    }

    if (readyStatus == "true") {
        $.ajax({
            type: "POST",
            url: './DAO/product_registration.php',
            data: {
                itemcode: itemcode,
                description: description,
                reorderlevel: reorderlevel,
                category: category,
                supplier: supplier,
                unitprice: unitprice,
                action: action,
                itemid: itemid
            },
            dataType: 'JSON',
            success: function(data) {
                if (data != "Error") {
                    $('#item_table').empty();
//                  var tableDesign = item_Table(data,paginationCountt,0);
                    loadItemDetails(1);
//                    $('#item_table').append(tableDesign);
                    $('#item_status').html("<div class='alert alert-success'><strong>Success!</strong></div>");
                    item_clear();
                } else {
                    $('#item_status').html("<div class='alert alert-danger'><strong>Error!</strong>Please try again.</div>");
                }
            },
            error: function(e) {
                console.log(e);
            }
        });
    }
}

function item_Table(data, datalength, startval) {
    var tableDesign = "";
//idproduct, itemcode, description, available_qty, reorder_level, idcategory, idsupplier, unit_price, activestatus, idcategory, name, idsupplier, name, contactno, address, active_status, company_discount
    for (var i = startval; i < datalength; i++) {
        if(data[i].available_qty> data[i].reorder_level ){
            
            tableDesign += "<tr>";
        }else{
            tableDesign += "<tr class='danger'>";
        }
        
        tableDesign += "<td>" + data[i].itemcode + "<input type='hidden' value='" + data[i].idproduct + "' id='itemid" + i + "'/></td>";
        tableDesign += "<td>" + data[i].description + "</td>";
        tableDesign += "<td>" + data[i].unit_price + "</td>";
        tableDesign += "<td>" + data[i].cname + "</td>";
        tableDesign += "<td>" + data[i].available_qty + "</td>";
        tableDesign += "<td>" + data[i].sname + "</td>";
        tableDesign += "<td>" + data[i].reorder_level + "</td>";
        tableDesign += "<td class='text-center'><button class='btn btn-default btn-primary btntablesize' onclick='loadItemFormData(" + data[i].idproduct + ")'>View</button></td>";
        if (data[i].activestatus == 1) {
            tableDesign += "<td class='text-center'><button class='btn btn-default btn-danger btntablesize' onclick='active_status_item(" + data[i].idproduct + ",0)'>Block</button></td>";
        } else {
            tableDesign += "<td class='text-center'><button class='btn btn-default btn-success btntablesize' onclick='active_status_item(" + data[i].idproduct + ",1)'>Active</button></td>";
        }
        tableDesign += "</tr>";

    }
    return tableDesign;
}
function loadItemFormData(val) {
    $('#item_status').empty();
    product_changeText();
    $.ajax({
        type: "POST",
        url: './DAO/load_Item.php',
        data: {
            productid: val
        },
        dataType: 'JSON',
        success: function(data) {
            for (var i = 0; i < data.length; i++) {
                $('#item_code').val(data[i].itemcode);
                $('#item_des').val(data[i].description);
                $('#reorder_level').val(data[i].reorder_level);
                $('#item_unitprice').val(data[i].unit_price);
                $('#item_category').val(data[i].idcategory);
                $('#item_supplier').val(data[i].idsupplier);
                $('#item_id').val(data[i].idproduct);
            }
        },
        error: function(e) {
            console.log(e);
        }
    });
}

function active_status_item(id, status) {

    $('#item_status').empty();
    var status_word = "";
    if (status == 0) {
        status_word = "block";
    } else {
        status_word = "active";
    }
    if (confirm('Are you sure you want to ' + status_word + ' this product?')) {

        $.ajax({
            type: "POST",
            url: './DAO/active_status_Product.php',
            data: {
                product_id: id,
                status: status
            },
            dataType: 'JSON',
            success: function(data) {
                if (data != "Error") {
                    $('#item_table').empty();
//                    loadItemDetails(1); 
                    $('#item_status').html("<div class='alert alert-success'><strong>Success!</strong></div>");
                } else {
                    $('#item_status').html("<div class='alert alert-danger'><strong>Error!</strong>Please try again.</div>");
                }
            },
            error: function(e) {
                console.log(e);
            }
        });
    } else {
        // Do nothing!
    }
}

function loadItemDetails(page) {
    $('#item_status').empty();
    var search_param = $('#search_item_param').val();
    var search_val = $('#item_name_key').val();
    $.ajax({
        type: "POST",
        url: './DAO/view_items.php',
        data: {
            search_param: search_param,
            search_val: search_val
        },
        dataType: 'JSON',
        success: function(data) {
            if (data.length > 0) {
                if (page == undefined) {
                    page = 1;
                }
                var tableDesign = "";
                var pageId = 1;
                var paginationCount = 8;
                var dataCount = data.length / paginationCount;

                var totalpages = Math.ceil(dataCount);

                $('#pagination-demo3').twbsPagination('destroy');
                $('#pagination-demo3').twbsPagination({
                    totalPages: totalpages,
                    visiblePages: totalpages,
                    onPageClick: function(event, page) {

                        pageId = page * paginationCount;
                        if (data.length <= pageId) {
                            pageId = data.length;
                        }

                        $('#item_table').empty();
                        var tableDesign = item_Table(data, pageId, (page - 1) * paginationCount);
//idgrn, issued_date, totoal_amount, paid_amount, balance, issued_by, discount, suplierId, idsupplier, name, contactno, address, active_status, company_discount
//                        for (var i = (page - 1) * paginationCount; i < pageId; i++) {
//                            tableDesign += "<tr>";
//                            tableDesign += "<td>" + data[i].idgrn + "<input type='hidden' value='" + data[i].issued_by + "' id='" + data[i].idgrn + "'/></td>";
//                            tableDesign += "<td>" + data[i].issued_date + "</td>";
//                            tableDesign += "<td>" + parseFloat(Math.round(data[i].totoal_amount * 100) / 100).toFixed(2) + "</td>";
//                            tableDesign += "<td>" + parseFloat(Math.round(data[i].paid_amount * 100) / 100).toFixed(2) + "</td>";
//                            tableDesign += "<td>" + parseFloat(Math.round(data[i].balance * 100) / 100).toFixed(2) + "</td>";
//                            tableDesign += "<td>" + data[i].name + "</td>";
//                            tableDesign += "<td class='text-center'><button class='btn btn-default btn-primary' data-toggle='modal' data-target='#grn_products' onclick='loadGRNProducts(" + data[i].idgrn + ")'>More Details</button></td>";
//                            tableDesign += "</tr>";
//
//                        }

                        $('#item_table').append(tableDesign);

                    }

                });
            } else {
                $('#grn_records_table').empty();
            }

        },
        error: function(e) {
            console.log(e);
        }
    });
}
