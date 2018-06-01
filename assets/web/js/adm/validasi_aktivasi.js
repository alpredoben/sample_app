'use strict'

var url_validasi_aktivasi = window.site_url + 'admin/master/validasi/aktivasi';
var url_aktivasi_po = window.site_url + 'admin/master/aktivasi/po';

var tblValidasiAktivasi = '#tblValidasiAktivasi';
var tblPurchaseOrder = '#tblPurchaseOrder';

function showSOUser(tools){

    $.getJSON(window.site_url + 'admin/data/user/by/2', function( data ) {
        console.log(data);
        //var messages = data.messages;
        $(tools).empty();
        

        if(data.status == true){
            $('<option>').val('-').text('ALL SALES USER').appendTo($(tools));
            $.each(data.messages, function( index, value ) {
                $('<option>').val(value.user_id).text(value.username + ' ['+value.level_name+']').appendTo($(tools));
            });
        }
        else{
            $('<option>').val('-').text(data.messages).appendTo($(tools));
        }

        
    });
}

function ApproveActivated(id_pengguna, id_penawaran) { 
    var _path_url = window.site_url + 'admin/master/set/item/actived' ;
    $.ajax({
        type: "POST",
        url: _path_url,
        data: JSON.stringify({"id_pengguna":id_pengguna, "id_penawaran":id_penawaran}),
        dataType: "json",
        contentType:"application/json",
        success: function (response) {
            console.log(response);
            var tbl;
            if(response.status == true){
                box_alert.alertSuccess('Successfull Validation', response.messages);

                if ( $.fn.DataTable.isDataTable(tblValidasiAktivasi) ) {
                    $(tblValidasiAktivasi).DataTable().destroy();
                    tbl = config_tools.loadTableMaster(tblValidasiAktivasi, url_validasi_aktivasi);
                }

                loadInformation();
            }
            else{
                box_alert.alertError('Error Validation', response.messages);
            }
        }
    });
}


$(document).ready(function () {

    var optionSalesOrder = '#optionSalesOrder';
    var table_validasi_aktivasi = config_tools.loadTableMaster(tblValidasiAktivasi, url_validasi_aktivasi);
    var table_aktivasi_po = config_tools.loadTableMaster(tblPurchaseOrder, url_aktivasi_po);


    setInterval(function(){ loadInformation(); }, 1800000);

    
    showSOUser(optionSalesOrder);

    $(optionSalesOrder).change(function (e) { 
        e.preventDefault();
        var tbl;
        if ( $.fn.DataTable.isDataTable(tblValidasiAktivasi) ) {
            $(tblValidasiAktivasi).DataTable().destroy();
        }

        if($(this).val() == '-'){
            tbl = config_tools.loadTableMaster(tblValidasiAktivasi, url_validasi_aktivasi);
        }
        else{
            tbl = config_tools.loadTableMaster(tblValidasiAktivasi, url_validasi_aktivasi + '/2/user/'+ $(this).val());
        }
        
    });

});