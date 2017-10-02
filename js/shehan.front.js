/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function sup_changeText() {
    $('#supplier_save').html("Update");
    $('#supplier_action').val("update");
    var offset = 20; //Offset of 20px

    $(' body,html').animate({
        scrollTop: $("#pagetop").offset().top + offset
    }, 500);
}
function product_changeText() {
    $('#item_save').html("Update");
    $('#item_action').val("update");
    $("#item_code").prop('disabled', true);
    var offset = 20; //Offset of 20px

    $(' body,html').animate({
        scrollTop: $("#pagetop").offset().top + offset
    }, 500);
}
function sup_cancel() {
    $('#supplier_save').html("Save");
    $('#supplier_action').val("save");
    $('#supplier_name').val("");
    $('#supplier_contactno').val("");
    $('#supplier_address').val("");
    $('#supplier_name_key').val("");
    $('#supplier_status').empty();
    $('#supplier_discount').val("");
}
function sup_clear() {
     $("#item_code").prop('disabled', false);
    $('#supplier_save').html("Save");
    $('#supplier_action').val("save");
    $('#supplier_name').val("");
    $('#supplier_contactno').val("");
    $('#supplier_address').val("");
    $('#supplier_name_key').val("");
    $('#supplier_discount').val("");

}
function item_cancel() {
 $("#item_code").prop('disabled', false);
    $('#item_save').html("Save");
    $('#item_action').val("save");
    $('#item_code').val("");
    $('#item_des').val("");
    $('#reorder_level').val("");
    $('#item_unitprice').val("");
    $('#item_category').val("0");
    $('#item_supplier').val("0");
    $('#item_id').val("0");
    $('#item_name_key').val("");
    $('#item_status').empty();

}
function item_clear() {
       $('#item_save').html("Save");
    $('#item_action').val("save");
    $('#item_code').val("");
    $('#item_des').val("");
    $('#reorder_level').val("");
    $('#item_unitprice').val("");
    $('#item_category').val("0");
    $('#item_supplier').val("0");
    $('#item_name_key').val("");
    $('#item_id').val("0");

}
function clearElement(val) {
    $(val).html("");
}
function addRow() {
    var readyStatus = "true";
    var qty = $("#grn_qty").val();
    var unit_price = $("#grn_unit_price").val();
    var discount = $("#grn_discount").val();
    var products = $('#grn_products option:selected').html();
    var productid = $('#grn_products option:selected').val();

    if (unit_price == "") {
        $('#grn_unit_price_span').html("Please fill");
        readyStatus = "false";
    }
    if (discount == "") {
        $('#grn_discount_span').html("Please fill");
        readyStatus = "false";
    }
    if (productid == undefined) {
        $('#grn_product_span').html("Please select requred data");
        readyStatus = "false";
    }
    if (qty == "") {
        $('#grn_qty_span').html("Please fill");
        readyStatus = "false";
    }
    if (readyStatus == "true") {

        var array = [];
        var headers = [];
        var txt = "";
        var status = "false";

        $('#grn_product_table tr').has('td').each(function() {
            var arrayItem = {};
            $('td', $(this)).each(function(index, item) {
                if (index == 1) {
                    if ($(item).html() == products) {
                        status = "true";
                    }
                    console.log($(item).html());
                }

            });
        });
        console.log(status);
        if (status == "false") {
            var markup = "";
            var purchasePrice = parseFloat(unit_price - ((unit_price * discount) / 100)).toFixed(2);
            var amount = purchasePrice * qty;
            
            markup += "<tr>";
            markup += "<td><input type='checkbox' name='grn_status'/></td>";
            markup += "<td>" + products + "</td>";
            markup += "<td style='display:none;'>" + productid + "</td>";
            markup += "<td>" + qty + "</td>";
            markup += "<td>" + purchasePrice + "</td>";            
            markup += "<td class='grn_total'>" + parseFloat(Math.round(amount * 100) / 100).toFixed(2) + "</td>";
            markup += "</tr>";
            $("#grn_table").append(markup);

            sumOfColumns();
            grn_add_clear();
        } else {
            alert("Product already exist. Please remove existing value.");
        }
    }

//    var products = $("#grn_products").text();

}

function deleteRow() {
    $("#grn_table").find('input[name="grn_status"]').each(function() {
        if ($(this).is(":checked")) {
            $(this).parents("tr").remove();
        }
    });
     $("#grn_total_amount").val("0.00");
    sumOfColumns();
    grn_add_clear();
}

function sumOfColumns() {
    var totalPrice = 0;

    $(".grn_total").each(function() {
        totalPrice += parseFloat($(this).html());
        $("#grn_total_amount").val(parseFloat(Math.round(totalPrice * 100) / 100).toFixed(2));
    });
}

// GRN 

function grn_clear() {
    $('#grn_id').val("");
    $('select#grn_supplier_name').empty();
    $('select#grn_products').empty();
    $('#grn_qty').val("");
    $('#grn_unit_price').val("");
    $('#grn_discount').val("");
    $('#grn_total_amount').val("0.00");
    $('#grn_paid_amount').val("");
    $('#grn_balance').val("0.00");
    $('#grn_table').empty();

    generateId();
    loadSupplierNames();
}

function grn_add_clear() {
//    $('select#grn_products').val("0");
    $('#grn_qty').val("1");
    $('#grn_unit_price').val("");
    $('#grn_discount').val("");
    $('#grn_paid_amount').val("");
    $('#grn_balance').val("0.00");
}

$(document).keyup(function(e) {
    $('#grn_paid_amount').keypress(function(e) {
        if (e.which == 13) {
            var total = $('#grn_total_amount').val();
            var paid = $('#grn_paid_amount').val();
            var balance = parseFloat(Math.round(paid * 100) / 100).toFixed(2) - parseFloat(Math.round(total * 100) / 100).toFixed(2);
            $("#grn_paid_amount").val(parseFloat(Math.round(paid * 100) / 100).toFixed(2));
            $("#grn_balance").val(parseFloat(Math.round(balance * 100) / 100).toFixed(2));
        }
    });
}
);

function printPage() {
    window.print();
}