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


}

