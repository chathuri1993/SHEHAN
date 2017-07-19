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
            success: function (data) {
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
            error: function (e) {
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
        success: function (data) {
            $('#supplier_table').empty();
            var tableDesign = supplier_Table(data);

            $('#supplier_table').append(tableDesign);
        },
        error: function (e) {
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
        success: function (data) {
            for (var i = 0; i < data.length; i++) {
                $('#supplier_name').val(data[i].name);
                $('#supplier_contactno').val(data[i].contactno);
                $('#supplier_address').val(data[i].address);
                $('#supplier_discount').val(data[i].company_discount);
                $('#supplier_id').val(data[i].idsupplier);
            }
        },
        error: function (e) {
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
        success: function (data) {
            $('#supplier_table').empty();
            var tableDesign = supplier_Table(data);
            $('#supplier_table').append(tableDesign);
        },
        error: function (e) {
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
            success: function (data) {
                if (data != "Error") {
                    $('#supplier_table').empty();
                    var tableDesign = supplier_Table(data);
                    $('#supplier_table').append(tableDesign);
                    $('#supplier_status').html("<div class='alert alert-success'><strong>Success!</strong></div>");
                } else {
                    $('#supplier_status').html("<div class='alert alert-danger'><strong>Error!</strong>Please try again.</div>");
                }
            },
            error: function (e) {
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
        success: function (data) {
            var optionDesign = "";

            for (var i = 0; i < data.length; i++) {
                optionDesign += "<option value=" + data[i].idsupplier + ">" + data[i].name + "</option>";
            }

            $('#grn_supplier_name').append(optionDesign);

            var id = new Date().getUTCMilliseconds();
            $('#grn_id').append(id);

//            $('#grn_supplier_name').editableSelect();

        },

        error: function (e) {
            console.log(e);
        }
    });
}

function loadProducts(val) {
    if (val != 0) {
        $.ajax({
            type: "POST",
            url: './DAO/load_Products.php',
            data: {
                supplierKey: val
            },
            dataType: 'JSON',
            success: function (data) {
                var optionDesign = "";
                for (var i = 0; i < data.length; i++) {
                    optionDesign += "<option value=" + data[i].idproduct + ">" + data[i].description + "</option>";
                }
                $('#grn_products').append(optionDesign);

//            $('#grn_supplier_name').editableSelect();
            },
            error: function (e) {
                console.log(e);
            }
        });
    }
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
            success: function (data) {

                for (var i = 0; i < data.length; i++) {
                    $('#grn_discount').val(data[i].company_discount + "%");
                    $('#grn_unit_price').val(data[i].unit_price);
                }
            },
            error: function (e) {
                console.log(e);
            }
        });
    }
}

function save_grn(val) {
    if (val != 0) {
        $.ajax({
            type: "POST",
            url: './DAO/load_Product_Details.php',
            data: {
                productKey: val
            },
            dataType: 'JSON',
            success: function (data) {

                for (var i = 0; i < data.length; i++) {
                    $('#grn_discount').val(data[i].company_discount + "%");
                    $('#grn_unit_price').val(data[i].unit_price);
                }
            },
            error: function (e) {
                console.log(e);
            }
        });
    }
}