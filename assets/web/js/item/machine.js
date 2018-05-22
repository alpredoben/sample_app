'use strict'

/** Document Ready Function */
$(document).ready(function () {
    
    /** DEFAULT VARIABLE */
    var btnKembali = '#btnKembali';
    var myDataTables;

    /** MASTER MACHINE VARIABLE */
    var btnSimpanMesin = '#btnSimpanMesin';
    var txtIDMesin     = '#txtIDMesin';
    var txtNamaMesin   = '#txtNamaMesin';

    myDataTables = config_tools.loadTableMaster('#tblDataMesin', url_machine_list);

    /** EVENT MASTER MACHINE */
    $(btnKembali).hide();

    $(btnKembali).click(function (e) { 
        e.preventDefault();
        config_tools.loadLocationWindow();
    });

    $(btnSimpanMesin).click(function (e) { 
        e.preventDefault();
        
        var text_button = $(btnSimpanMesin).text();
        var set_data = null;
        var url_root = '';

        if(text_button.toLowerCase() == 'simpan')
        {
            if($(txtIDMesin).val() != '' && $(txtNamaMesin).val() != '')
                url_root = window.site_url + 'admin/mesin/tambah/mesin';
            else
                box_alert.alertError('WARNING', 'Silahkan isi ID Mesin dan Nama Mesin dengan benar', 'warning');
        }
        else
        {
            if($(txtNamaMesin).val() != '')
                url_root = window.site_url + 'admin/mesin/ubah/mesin';
            else
                box_alert.alertError('WARNING', 'Silahkan diisi update Nama Mesin', 'warning');
        }

        set_data = {
            "id_mesin"   : $(txtIDMesin).val(),
            "nama_mesin" : $(txtNamaMesin).val(),
        };

        // console.log(set_data);
        // console.log(url_root);

        axios.post(url_root, set_data).then(function (response) {
            var messages = response.data.messages, 
                status   = response.data.status;

            if(status == true){
                box_alert.alertSuccess('SUCCESS', messages);
                myDataTables.ajax.reload();
            }
            else{
                box_alert.alertError('ERROR', messages);
            }

        }).catch(function (error) {
            console.log(error);
        });

        if(text_button.toLowerCase() == 'update'){
            $(btnSimpanMesin).text('Simpan');
            $('#txtIDMesin').removeAttr('readonly');
            $('#btnKembali').hide();
        }
        
        config_tools.resetFormMaster(txtIDMesin, txtNamaMesin);

    });
    
    

});