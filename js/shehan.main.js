/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function supplierRegitation() {
    var name = $('#supplier_name').val();
    var contactno = $('#supplier_contactno').val();
    var address = $('#supplier_address').val();
    var action = $('#supplier_action').val();

    $.ajax({
        type: "POST",
        url: './DAO/supplier_Registration.php',
        data: {
            name: name,
            contactno: contactno,
            address: address,
            action: action
        },
        dataType: 'JSON',
        success: function (data) {
            $('#supplier_table').empty();
            var tableDesign = "";

            for (var i = 0; i < data.length; i++) {
                tableDesign += "<tr>";
                tableDesign += "<td>" + data[i].name + "<input type='hidden' value='" + data[i].idsupplier + "'/></td>";
                tableDesign += "<td>" + data[i].contactno + "</td>";
                tableDesign += "<td>" + data[i].address + "</td>";
                tableDesign += "<td class='text-center'><button class='btn btn-default btn-primary btntablesize' onclick='sup_changeText()'>View</button></td>";
                tableDesign += "<td class='text-center'><button class='btn btn-default btn-danger btntablesize'>Block</button></td>";
                tableDesign += "</tr>";
            }

            $('#supplier_table').append(tableDesign);
        },
        error: function (e) {
            console.log(e);
        }
    });

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
            var tableDesign = "";

            for (var i = 0; i < data.length; i++) {
                tableDesign += "<tr>";
                tableDesign += "<td>" + data[i].name + "<input type='hidden' value='" + data[i].idsupplier + "' id='supid" + i + "'/></td>";
                tableDesign += "<td>" + data[i].contactno + "</td>";
                tableDesign += "<td>" + data[i].address + "</td>";
                tableDesign += "<td class='text-center'><button class='btn btn-default btn-primary btntablesize' onclick='loadSupFormData(" + data[i].idsupplier + ")'>View</button></td>";
                tableDesign += "<td class='text-center'><button class='btn btn-default btn-danger btntablesize'>Block</button></td>";
                tableDesign += "</tr>";
            }

            $('#supplier_table').append(tableDesign);
        },
        error: function (e) {
            console.log(e);
        }
    });
}

function loadSupFormData(val) {

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
                $('#supplier_id').val(data[i].idsupplier);
            }
        },
        error: function (e) {
            console.log(e);
        }
    });
}


