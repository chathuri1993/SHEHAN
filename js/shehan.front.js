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
function sup_cancel() {
    $('#supplier_save').html("Save");
    $('#supplier_action').val("save");
    $('#supplier_name').val("");
    $('#supplier_contactno').val("");
    $('#supplier_address').val("");
    $('#supplier_name_key').val("");
    $('#supplier_status').empty();
    $('#supplier_discount').empty();
}
function sup_clear() {
    $('#supplier_save').html("Save");
    $('#supplier_action').val("save");
    $('#supplier_name').val("");
    $('#supplier_contactno').val("");
    $('#supplier_address').val("");
    $('#supplier_name_key').val("");
    $('#supplier_discount').val("");

}
function clearElement(val) {
    $(val).html("");
}
function addRow() {
    var qty = $("#grn_qty").val();
    var unit_price = $("#grn_unit_price").val();
    var discount = $("#grn_discount").val();
    var products = $('#grn_products option:selected').html();
    var productid = $('#grn_products option:selected').val();
//    var products = $("#grn_products").text();
    var markup = "";
    var price = (unit_price - ((unit_price * discount) / 100)) * qty;

    markup += "<tr>";
    markup += "<td><input type='checkbox' name='grn_status'/></td>";
    markup += "<td>" + products + "</td>";
    markup += "<td style='display:none;'>" + productid + "</td>";
    markup += "<td>" + unit_price + "</td>";
    markup += "<td>" + discount + "</td>";
    markup += "<td>" + qty + "</td>";
    markup += "<td class='grn_total'>" + parseFloat(price).toFixed(2) + "</td>";
    markup += "</tr>";
    $("#grn_table").append(markup);

    sumOfColumns();
    grn_add_clear();
}

function deleteRow() {
    $("#grn_table").find('input[name="grn_status"]').each(function() {
        if ($(this).is(":checked")) {
            $(this).parents("tr").remove();
        }
    });
    sumOfColumns();
    grn_add_clear();
}

function sumOfColumns() {

    var totalPrice = 0;


    $(".grn_total").each(function() {
        totalPrice += parseInt($(this).html());
        $("#grn_total_amount").val(parseFloat(totalPrice).toFixed(2));
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
    $('select#grn_products').val("0");
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
            var balance =  parseFloat(paid)-parseFloat(total) ; 
            $("#grn_paid_amount").val(parseFloat(paid).toFixed(2));
            $("#grn_balance").val(parseFloat(balance).toFixed(2)); 
        }
    });
});