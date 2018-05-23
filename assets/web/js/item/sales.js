'use strict'

var box_alert = new BoxAlertInformation();
var config_tools = new ConfigTools();

/** ######################## ROUTE URL PRODUCT OFFER ################################ */
var url_tambah_penawaran_kopi = window.site_url + 'sales/penawaran/tambah/produk/kopi';
var url_datatable_penawarn_kopi = window.site_url + 'sales/penawaran/datatable/produk/kopi';
var url_tampil_data_produk = window.site_url + 'sales/tampil/data/produk';

/** Update and Delete Product Offer Root URI */
var url_hapus_penawaran_kopi = window.site_url + 'sales/penawaran/hapus/produk/kopi';
var url_set_active_penawaran = window.site_url + 'sales/penawaran/set/wait/active';


/** ######################## ROUTE URL MACHINE OFFER ####################################### */
var url_tambah_penawaran_mesin = window.site_url + 'sales/penawaran/tambah/mesin';
var url_datatable_penawaran_machine = window.site_url + 'sales/penawaran/datatable/mesin';

/** Variable Page Form Content */
var pageFormsContent = '#pageFormsContent';

/** Variable Product Coffee */
var optionProdukKopi = '#optionProdukKopi',
    txtKuantitasKopi = '#txtKuantitasKopi',
    txtHargaKopi     = '#txtHargaKopi',
    txtDiskonKopi    = '#txtDiskonKopi',
    btnSubmitKopi    = '#btnSubmitKopi';

/** Method Load Content Function */
function loadContentPage(_path, _tools, methods) 
{
    $.ajax({
        url: _path,
        success: function(response){
            $(_tools).empty();
            $(_tools).html(response);
            methods();
        }
    });
}

/** Up To Wait Active Offer Function */
function UpToWaitActiveOffer(_offer_type, _offer_id){
    var _url = url_set_active_penawaran + '/' + _offer_type + '/' + _offer_id;
    
    $.confirm({
        title: 'SET WAIT PENAWARAN!',
        content: 'Anda ingin mengajukan aktivasi penawaran data '+_offer_type+' ini?',
        theme:'modern',
        type:'dark',
        buttons: {
            ya: function () {
                $.getJSON(_url, function( data ) {
                    
                    if(data.status == true){
                        box_alert.alertSuccess('BERHASIL INFO', data.messages);
                        var tbl;
    
                        if ( $.fn.DataTable.isDataTable('#tblPenawaranProduk') ) {
                            $('#tblPenawaranProduk').DataTable().destroy();
                            tbl = config_tools.loadTableMaster('#tblPenawaranProduk', url_datatable_penawarn_kopi);
                        }

                        if ( $.fn.DataTable.isDataTable('#tblPenawaranMesin') ) {
                            $('#tblPenawaranMesin').DataTable().destroy();
                            //tbl = config_tools.loadTableMaster('#tblPenawaranProduk', url_datatable_penawarn_kopi);
                        }
                        if ( $.fn.DataTable.isDataTable('#tblPenawaranSparepart') ) {
                            $('#tblPenawaranSparepart').DataTable().destroy();
                            //tbl = config_tools.loadTableMaster('#tblPenawaranProduk', url_datatable_penawarn_kopi);
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


/** ########################################## PRODUCT OFFER ############################################### */
/** Load Form Penawaran Prouct */
function getLoadFormPenawaranProduct(_str, _locates) 
{
    var _path = window.site_url + _str
    loadContentPage(_path, _locates, detailPenawaranProduk);
}

/** Update and Delete Product Offer */
function EditProductOffer(_offer_id) { 
}

function DeleteProductOffer(_offer_id){
    var _url = url_hapus_penawaran_kopi + '/' + _offer_id;

    $.confirm({
        title: 'HAPUS DATA PENAWARAN PRODUK!',
        content: 'Apakah anda yakin, ingin menghapus data ini ?',
        theme:'modern',
        type:'dark',
        buttons: {
            ya: function () {
                $.getJSON(_url, function( data ) {
                    console.log(data);
                    if(data.status == true){
                        box_alert.alertSuccess('BERHASIL INFO', data.messages);
                        if ( $.fn.DataTable.isDataTable('#tblPenawaranProduk') ) {
                            $('#tblPenawaranProduk').DataTable().destroy();
                        }
                        var tbl = config_tools.loadTableMaster('#tblPenawaranProduk', url_datatable_penawarn_kopi);
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



/** ########################################### MACHINE OFFER ########################################### */
/** Load Form Penawaran Machine */
function getLoadFormPenawaranMachine(_str, _locates)
{
    var _path = window.site_url + _str
    loadContentPage(_path, _locates, detailPenawaranMesin);
}