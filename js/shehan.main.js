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
    console.log(sup_name_key);
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
        status_word = "active";
    } else {
        status_word = "block";
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


// Iterate Values *******************************
//    for (x in array) {
//        txt += array[x].Product;
//         console.log(txt);
//    }
//   

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
                console.log(data.length);
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

function searchGRNRecords() {
    console.log($('#search_param').val());
    console.log($('#search_val').val());
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
                    console.log(data[i]);
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
                        
                        $('#grn_total').html("Total (Rs): "+parseFloat(Math.round(data * 100) / 100).toFixed(2) );
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