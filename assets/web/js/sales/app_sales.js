'use strict'

/** ######################  @name DEFINE_VARIABLE_CLASS ############################# */
var box_alert = new BoxAlertInformation();
var config_tools = new ConfigTools();

/** ##################### @name DEFINE_VARIABLE_ROUTE_URL ########################### */
var url_master_penawaran        = window.site_url + 'sales/master/penawaran/item/';
var url_insert_penawaran        = window.site_url + 'sales/master/penawaran/insert/item/'; 
var url_update_active_penawaran = window.site_url + 'sales/master/penawaran/set/activate/item/';
var url_delete_penawaran        = window.site_url + 'sales/master/penawaran/delete/item/';
var url_select_penawaran        = window.site_url + 'sales/master/penawaran/select/item/';
var url_update_penawaran        = window.site_url + 'sales/master/penawaran/update/item/';
var url_datatable_penawaran     = window.site_url + 'sales/master/penawaran/datatable/item/';
var url_aktivasi_penawaran      = window.site_url + 'sales/master/aktivasi_penawaran/item';

/** ####################  @name DEFINE_VARIABLE_ELEMENT_HTML ####################### */
var optionItemName      = '#optionItemName',
    txtKuantitasItem    = '#txtKuantitasItem',
    txtHargaItem        = '#txtHargaItem',
    txtDiskonItem       = '#txtDiskonItem',
    btnSubmitItem       = '#btnSubmitItem',
    btnKembali          = '#btnKembali',
    tblMasterPenawaran  = '#tblMasterPenawaran',
    pageFormsContent    = '#pageFormsContent',
    segment_item        = '';    

var btnUpdatePenawaran   = '#btnUpdatePenawaran';
var btnAktifasiPenawaran = '#btnAktifasiPenawaran';
var btnHapusPenawaran    = '#btnHapusPenawaran';

var data_update = {};


/** #################### @name RESET_FORM_PENAWARAN ############################ */
function ResetFormItem(){
    $(btnSubmitItem).text('Simpan');
    $(optionItemName).prop('disabled', false);
    $(btnKembali).hide();
    $(txtKuantitasItem).val('');
    $(txtDiskonItem).val('');
    $(txtHargaItem).val('');
    $(optionItemName).val('-');
}

/** ####################  @name LOAD_CONTENT_PAGE_METHOD ####################### */
function getLoadMasterPenawaran(_type_name, _elements){
    var _path = url_master_penawaran + '/' + _type_name.toLowerCase();  

    $.ajax({
        url: _path,
        success: function(response){
            $(_elements).empty();
            $(_elements).html(response);
            masterPenawaranMethod( _type_name.toLowerCase() );
        }
    });
}


/** ####################### @name METHOD_ACTIVITIES_OFFER ################# */

function UpdateActivatePenawaran(_type_name, id){
    var _url = url_update_active_penawaran + _type_name.toLowerCase() + '/by/' + id;

    $.confirm({
        title: 'SET WAIT PENAWARAN!',
        content: 'Anda ingin mengajukan aktivasi penawaran data ini?',
        theme:'modern',
        type:'dark',
        buttons: {
            ya: function () {
                $.getJSON(_url, function( data ) {
                    
                    if(data.status == true){
                        box_alert.alertSuccess('BERHASIL INFO', data.messages);
                        var tbl;
    
                        if ( $.fn.DataTable.isDataTable(tblMasterPenawaran) ) {
                            $(tblMasterPenawaran).DataTable().destroy();
                            tbl = config_tools.loadTableMaster(
                                tblMasterPenawaran, url_datatable_penawaran + _type_name.toLowerCase()
                            );
                        }
                    }
                    else{
                        box_alert.alertError('GAGAL INFO', data.messages);
                    }
                });
            },
            tidak: function(){}
        }
    });
}

function DeleteItemPenawaran(_type_name, id){
    var _url = url_delete_penawaran + _type_name.toLowerCase() + '/by/' + id;

    $.confirm({
        title: 'HAPUS DATA ',
        content: 'Apakah anda yakin, ingin menghapus data ini ?',
        theme:'modern',
        type:'dark',
        buttons: {
            ya: function () {
                $.getJSON(_url, function( data ) {
                    console.log(data);
                    if(data.status == true){
                        box_alert.alertSuccess('BERHASIL INFO', data.messages);
                        var tbl;

                        if ( $.fn.DataTable.isDataTable(tblMasterPenawaran) ) {
                            $(tblMasterPenawaran).DataTable().destroy();
                            tbl = config_tools.loadTableMaster(
                                tblMasterPenawaran, url_datatable_penawaran + _type_name.toLowerCase()
                            );
                        }
                         
                    }
                    else{
                        box_alert.alertError('GAGAL INFO', data.messages);
                    }
                });
            },
            tidak: function(){}
        }
    });
}

function ShowItemPenawaran(_type_name, id){
    var _path = url_select_penawaran + _type_name.toLowerCase() + '/by/' + id;

    $.ajax({
        type: "get",
        url: _path,
        success: function (response) {
            console.log(response);
            
            if(response.status == true){
                data_update = response.messages;

                $(optionItemName).val(data_update.id_item);
                $(optionItemName).prop('disabled', true);
                $(txtKuantitasItem).val( config_tools.convertNumberToCurrency(data_update.kuantitas) );
                $(txtHargaItem).val( config_tools.convertNumberToCurrency(data_update.harga_item) );
                $(txtDiskonItem).val(data_update.diskon);
                $(btnSubmitItem).text('Update');
                $(btnKembali).show();
            }
            else{
                box_alert.alertError('GAGAL', response.messages);
            }

        }
    });

}