/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function supplierRegitation() {
    $.ajax({
        type: "POST",
        url: './DAO/supplierRegistration.php',
        data: { 
        },
        dataType: 'JSON',
        success: function (data) {

        },
        error: function (e) {
            console.log(e);
        }
    });

}

