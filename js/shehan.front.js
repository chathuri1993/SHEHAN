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
     var products =$('#grn_products option:selected').html()
//    var products = $("#grn_products").text();
    var markup = "";
    markup += "<tr>";
    markup += "<td>" + products + "</td>";
    markup += "<td>" + unit_price + "</td>";
    markup += "<td>" + discount + "</td>";
    markup += "<td>" + qty + "</td>";
    markup += "<td><input type='checkbox' name='grn_status'/></td>";
    markup += "</tr>";
    $("#grn_table").append(markup);
}

function deleteRow() {
    $("#grn_table").find('input[name="grn_status"]').each(function () {
        if ($(this).is(":checked")) {
            $(this).parents("tr").remove();
        }
    });
}