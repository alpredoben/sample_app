'use strict'

var box_alert = new BoxAlertInformation();

function load_table_produk() {  
    var tabel_product =  $('#tblProdukKopi').DataTable({
        "processing": true, 
        "serverSide": true, 
        "ajax": {
            "url": window.site_url + 'admin/list/produk',
            "type": "POST"
        },   
        "columnDefs": [
            { 
                "targets": [ 0 ], 
                "orderable": false, 
            },
        ],    
    });

    return tabel_product;
}

function EditProduct(id){
    var _url = window.site_url + 'admin/show/produk/' + id;
    $.getJSON(_url, function( data ) {
        var set_edit = data.messages;
        $('#txtIDKopi').val(set_edit.product_id);
        $('#txtIDKopi').attr('readonly', true);
        $('#txtNamaKopi').val(set_edit.product_name);
        $('#btnSimpan').text('Update');
        $('#btnKembali').show();
    });
}

function ResetFormProduct()
{
    $('#txtIDKopi').val('');
    $('#txtNamaKopi').val('');
}

function LoadLocationWindow(){
    window.location.reload();
}

function DeleteProduct(id){
    var _url = window.site_url + 'admin/hapus/produk/' + id;

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
                        var tbl = load_table_produk();
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

$(document).ready(function () {
    
    var btnKembali = '#btnKembali';
    var btnSimpan = '#btnSimpan';

    var txtIDKopi = '#txtIDKopi';
    var txtNamaKopi = '#txtNamaKopi';
    var tableProduk =  load_table_produk();

    $(btnKembali).hide();

    $(btnKembali).click(function (e) { 
        e.preventDefault();
        LoadLocationWindow();
    });

    $(btnSimpan).click(function (e) { 
        e.preventDefault();
        
        var text_button = $(btnSimpan).text();
        var set_data = null;
        var url_root = '';

        if(text_button.toLowerCase() == 'simpan')
        {
            if($(txtIDKopi).val() != '' && $(txtNamaKopi).val() != '')
               url_root = window.site_url + 'admin/tambah/produk';
            else
                box_alert.alertError('WARNING', 'Silahkan isi ID Produk dan Nama Produk Kopi dengan benar', 'warning');
        }
        else
        {
            if($(txtNamaKopi).val() != '')
                url_root = window.site_url + 'admin/ubah/produk';
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
                tableProduk.ajax.reload();
            }
            else{
                box_alert.alertError('ERROR', messages);
            }

        }).catch(function (error) {
            console.log(error);
        });

        if(text_button.toLowerCase() == 'update'){
            $(btnSimpan).text('Simpan');
            $('#txtIDKopi').removeAttr('readonly');
            $('#btnKembali').hide();
        }
            
        ResetFormProduct();

    });
    
    

});