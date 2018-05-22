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
                        if ( $.fn.DataTable.isDataTable('#tblDataMesin') ) {
                            $('#tblDataMesin').DataTable().destroy();
                        }
                        var tbl = config_tools.loadTableMaster('#tblDataMesin', url_machine_list);
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
