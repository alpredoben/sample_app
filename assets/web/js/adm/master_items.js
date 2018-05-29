'use strict'


$(document).ready(function () {
    
    var datatable_master_item;

    datatable_master_item = config_tools.loadTableMaster(tblMasterItem, url_datatable_item_list);

    $(btnKembali).hide();

    $(btnKembali).click(function (e) { 
        e.preventDefault();
        config_tools.loadLocationWindow();
    });

    $(btnSimpanItem).click(function (e) { 
        e.preventDefault();
        
        var text_button = $(btnSimpanItem).text();
        var set_data = null;
        var url_root = (text_button.toLowerCase() == 'update') ? url_update_item : url_insert_item;

        if($(txtKodeItem).val() == ''){
            box_alert.alertError('WARNING', 'Kode ' + window.nama_master_item +' kosong. Silahkan diisi', 'warning');
            return false;
        }

        if($(txtNamaItem).val() == ''){
            box_alert.alertError('WARNING', 'Nama ' + window.nama_master_item +' kosong. Silahkan diisi', 'warning');
            return false;
        }

        set_data = {
            "id_item"   : $(txtKodeItem).val(),
            "nama_item" : $(txtNamaItem).val(),
        };

        axios.post(url_root, set_data).then(function (response) {
            var messages = response.data.messages, 
                status   = response.data.status;
            
            console.log(response);

            if(status == true){
                
                if(text_button.toLowerCase() == 'update')
                    ResetFormItem();
                else
                    config_tools.resetFormMaster(txtKodeItem, txtNamaItem);

                box_alert.alertSuccess('SUCCESS', messages);
                datatable_master_item.ajax.reload();
            }
            else{
                box_alert.alertError('ERROR', messages);
            }

        }).catch(function (error) {
            console.log(error);
        });


    });
    
    

});