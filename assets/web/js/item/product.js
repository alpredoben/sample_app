'use strict'

/** Document Ready Function */
$(document).ready(function () {
    
    /** DEFAULT VARIABLE */
    var btnKembali = '#btnKembali';
    var myDataTables;

    /** MASTER PRODUCT VARIABLE */
    var btnSimpanKopi = '#btnSimpanKopi';
    var txtIDKopi     = '#txtIDKopi';
    var txtNamaKopi   = '#txtNamaKopi';

    myDataTables = config_tools.loadTableMaster('#tblProdukKopi', url_product_list);

    /** EVENT MASTER PRODUCT */
    $(btnKembali).hide();

    $(btnKembali).click(function (e) { 
        e.preventDefault();
        config_tools.loadLocationWindow();
    });

    $(btnSimpanKopi).click(function (e) { 
        e.preventDefault();
        
        var text_button = $(btnSimpanKopi).text();
        var set_data = null;
        var url_root = '';

        if(text_button.toLowerCase() == 'simpan')
        {
            if($(txtIDKopi).val() != '' && $(txtNamaKopi).val() != '')
               url_root = window.site_url + 'admin/produk/tambah/produk';
            else
                box_alert.alertError('WARNING', 'Silahkan isi ID Produk dan Nama Produk Kopi dengan benar', 'warning');
        }
        else
        {
            if($(txtNamaKopi).val() != '')
                url_root = window.site_url + 'admin/produk/ubah/produk';
            else
                box_alert.alertError('WARNING', 'Silahkan diisi update Nama Produk Kopi', 'warning');
        }

        set_data = {
            "id_produk" : $(txtIDKopi).val(),
            "nama_produk" : $(txtNamaKopi).val(),
        };

        console.log(set_data);
        console.log(url_root);

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
            $(btnSimpanKopi).text('Simpan');
            $('#txtIDKopi').removeAttr('readonly');
            $('#btnKembali').hide();
        }
        
        config_tools.resetFormMaster(txtIDKopi, txtNamaKopi);

    });
    
    

});