'use strict'

/** ###############################  @name DEFINE_VARIABLE_CLASS ###################### */
var box_alert    = new BoxAlertInformation();
var config_tools = new ConfigTools();


/** ############################### @name DEFINE_VARIABLE_ELEMENT_HTML ##################### */
var txtKodeItem     = '#txtKodeItem',
    txtNamaItem     = '#txtNamaItem',
    btnSimpanItem   = '#btnSimpanItem',
    btnKembali      = '#btnKembali',
    tblMasterItem   = '#tblMasterItem';

/** @name DEFINE_VARIABLE_ROUTE_ */
var url_insert_item         = window.site_url + 'admin/master/item/insert/item/' + window.nama_master_item;
var url_update_item         = window.site_url + 'admin/master/item/update/item/' + window.nama_master_item;
var url_select_item         = window.site_url + 'admin/master/item/select/item/' + window.nama_master_item;
var url_delete_item         = window.site_url + 'admin/master/item/delete/item/' + window.nama_master_item;
var url_datatable_item_list = window.site_url + 'admin/master/item/datatable/item/' + window.nama_master_item;

/** ################################ @name ALL_METHOD_ ###################################### */
function ResetFormItem(){
    $(btnSimpanItem).text('Simpan');
    $(txtKodeItem).removeAttr('readonly')
    $(btnKembali).hide();
    config_tools.resetFormMaster(txtKodeItem, txtNamaItem);
}

function SelectListItem(item_id) { 
    var _path_url = url_select_item + '/by/' + item_id; //
    console.log(_path_url);
    $.getJSON(_path_url, 
        function( data ) {
            var _edit   = data.messages;
            var _status = data.status;
            
            if(_status == true){
                $(txtKodeItem).val(_edit.kode_item);
                $(txtKodeItem).attr('readonly', true);
                $(txtNamaItem).val(_edit.nama_item);
                $(btnSimpanItem).text('Update');
                $(btnKembali).show();
            }
            else{
                box_alert.alertError(false, _edit);
            }

        }
    );

}

function DeleteListItem(item_id){
    var _path_url = url_delete_item  + '/by/' + item_id;

    $.confirm({
        title: 'HAPUS ITEM',
        content: 'Apakah anda yakin, ingin menghapus item ini ?',
        theme:'modern',
        type:'dark',
        buttons: {
            ya: function () {
                $.getJSON(_path_url,
                    function (data) {
                        
                        if(data.status == true) 
                        {
                            box_alert.alertSuccess('BERHASIL INFO', data.messages);

                            if ( $.fn.DataTable.isDataTable(tblMasterItem) ) 
                            {
                                $(tblMasterItem).DataTable().destroy();
                                
                                var table_items = config_tools.loadTableMaster(
                                    tblMasterItem, url_datatable_item_list
                                );
                            }
                        }
                        else{
                            box_alert.alertError('HAPUS DATA GAGAL', data.messages);
                        }
                    }
                );

            },
            tidak: function(){}
        }
    });
}


/** ########################### LOAD PEMBERITAHUAN ################################# */
function loadInformation(){

    $.ajax({
        type: "get",
        url: window.site_url + 'admin/info/aktifasi',
        success: function (response) {
            console.log(response);
            $('#admInfo').empty();

            if(response.status == true){
                $('li#admInfo').append('<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">PEMBERITAHUAN ['+response.messages+'] <span class="caret"></span></a><ul class="dropdown-menu"><li><a href="' + window.site_url + 'admin/dashboard"> Ada '+ response.messages +' Item Menunggu Validasi</a></li></ul>');
            }
            else{
                $('#admInfo').append('<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">PEMBERITAHUAN [0] <span class="caret"></span></a>');
            }
        }
    });

    
}

loadInformation();

//setInterval(function(){ loadInformation(); }, 1800000);