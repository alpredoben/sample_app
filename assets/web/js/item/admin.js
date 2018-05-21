'use strict'

var box_alert = new BoxAlertInformation();
var config_tools = new ConfigTools();

var url_product_list = window.site_url + 'admin/produk/list/produk';
var url_machine_list = window.site_url + 'admin/mesin/list/mesin';


/** Event Admin Product */
function EditProduct(id){
    var _url = window.site_url + 'admin/produk/show/produk/' + id;
    $.getJSON(_url, function( data ) {
        var set_edit = data.messages;
        $('#txtIDKopi').val(set_edit.product_id);
        $('#txtIDKopi').attr('readonly', true);
        $('#txtNamaKopi').val(set_edit.product_name);
        $('#btnSimpanKopi').text('Update');
        $('#btnKembali').show();
    });
}

function DeleteProduct(id){
    var _url = window.site_url + 'admin/produk/hapus/produk/' + id;

    $.confirm({
        title: 'HAPUS PRODUK!',
        content: 'Apakah anda yakin, ingin menghapus produk ini ?',
        theme:'modern',
        type:'red',
        buttons: {
            ya: function () {
                $.getJSON(_url, function( data ) {
                    console.log(data);
                    if(data.status == true){
                        box_alert.alertSuccess('BERHASIL INFO', data.messages);
                        if ( $.fn.DataTable.isDataTable('#tblProdukKopi') ) {
                            $('#tblProdukKopi').DataTable().destroy();
                        }
                        var tbl = config_tools.loadTableMaster('#tblProdukKopi', url_product_list);
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

/** Even Admin Machine */
function EditMachine(id){
    var _url = window.site_url + 'admin/mesin/show/mesin/' + id;
    $.getJSON(_url, function( data ) {
        var set_edit = data.messages;
        $('#txtIDMesin').val(set_edit.machine_id);
        $('#txtIDMesin').attr('readonly', true);
        $('#txtNamaMesin').val(set_edit.machine_name);
        $('#btnSimpanMesin').text('Update');
        $('#btnKembali').show();
    });
}

function DeleteMachine(id){
    var _url = window.site_url + 'admin/mesin/hapus/mesin/' + id;

    $.confirm({
        title: 'HAPUS PRODUK!',
        content: 'Apakah anda yakin, ingin menghapus data mesin ini ?',
        theme:'modern',
        type:'red',
        buttons: {
            ya: function () {
                $.getJSON(_url, function( data ) {
                    console.log(data);
                    if(data.status == true){
                        box_alert.alertSuccess('BERHASIL INFO', data.messages);
                        if ( $.fn.DataTable.isDataTable('#tblProdukKopi') ) {
                            $('#tabelDataMesin').DataTable().destroy();
                        }
                        var tbl = config_tools.loadTableMaster('#tabelDataMesin', url_machine_list);
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



/** Document Ready Function */
$(document).ready(function () {
    
    /** DEFAULT VARIABLE */
    var btnKembali = '#btnKembali';
    var myDataTables;

    /** MASTER PRODUCT VARIABLE */
    var btnSimpanKopi = '#btnSimpanKopi';
    var txtIDKopi     = '#txtIDKopi';
    var txtNamaKopi   = '#txtNamaKopi';

    consoel.log(window.state_active);

    switch (window.state_active.toUpperCase()) {
        case 'product':
            myDataTables = config_tools.loadTableMaster('#tblProdukKopi', url_product_list);
            break;
        case 'machine':
            myDataTables = config_tools.loadTableMaster('#tabelDataMesin', url_machine_list);
            break;
        default:
            myDataTables = null;
            break;
    }


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