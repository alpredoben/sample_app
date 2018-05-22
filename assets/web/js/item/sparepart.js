'use strict'

/** Document Ready Function */
$(document).ready(function () {
    
    /** DEFAULT VARIABLE */
    var btnKembali = '#btnKembali';
    var myDataTables;

    /** MASTER SPAREPART VARIABLE */
    var btnSimpanSparepart = '#btnSimpanSparepart';
    var txtIDSparepart     = '#txtIDSparepart';
    var txtNamaSparepart   = '#txtNamaSparepart';

    myDataTables = config_tools.loadTableMaster('#tblDataSparepart', url_sparepart_list);

    /** EVENT MASTER SPAREPART */
    $(btnKembali).hide();

    $(btnKembali).click(function (e) { 
        e.preventDefault();
        config_tools.loadLocationWindow();
    });

    $(btnSimpanSparepart).click(function (e) { 
        e.preventDefault();
        
        var text_button = $(btnSimpanSparepart).text();
        var set_data = null;
        var url_root = '';

        if(text_button.toLowerCase() == 'simpan')
        {
            if($(txtIDSparepart).val() != '' && $(txtNamaSparepart).val() != '')
                url_root = window.site_url + 'admin/sparepart/tambah/sparepart';
            else
                box_alert.alertError('WARNING', 'Silahkan isi ID Sparepart dan Nama Sparepart dengan benar', 'warning');
        }
        else
        {
            if($(txtNamaSparepart).val() != '')
                url_root = window.site_url + 'admin/sparepart/ubah/sparepart';
            else
                box_alert.alertError('WARNING', 'Silahkan diisi update Nama Sparepart', 'warning');
        }

        set_data = {
            "id_sparepart"   : $(txtIDSparepart).val(),
            "nama_sparepart" : $(txtNamaSparepart).val(),
        };

        console.log(set_data);
        console.log(url_root);

        axios.post(url_root, set_data).then(function (response) {
            console.log(response);
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
            $(btnSimpanSparepart).text('Simpan');
            $('#txtIDSparepart').removeAttr('readonly');
            $('#btnKembali').hide();
        }
        
        config_tools.resetFormMaster(txtIDSparepart, txtNamaSparepart);

    });
    
    

});