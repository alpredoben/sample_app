'use strict'

var box_alert = new BoxAlertInformation();
var config_tools = new ConfigTools();

/** ######################## ROUTE URL PRODUCT OFFER ################################ */
var url_tambah_penawaran_kopi       = window.site_url + 'sales/penawaran/tambah/produk/kopi';
var url_datatable_penawaran_kopi    = window.site_url + 'sales/penawaran/datatable/produk/kopi';
var url_hapus_penawaran_kopi        = window.site_url + 'sales/penawaran/hapus/produk/kopi';


/** ######################## ROUTE URL MACHINE OFFER ####################################### */
var url_tambah_penawaran_mesin      = window.site_url + 'sales/penawaran/tambah/mesin';
var url_datatable_penawaran_machine = window.site_url + 'sales/penawaran/datatable/mesin';
var url_hapus_penawaran_machine     = window.site_url + 'sales/penawaran/hapus/mesin';


/** ####################### ROUTE URL SPAREPART OFFER ######################################## */
var url_datatable_penawaran_sparepart = window.site_url + 'sales/penawaran/datatable/sparepart';
var url_tambah_penawaran_sparepart    = window.site_url + 'sales/penawaran/tambah/sparepart';
var url_hapus_penawaran_sparepart     = window.site_url + 'sales/penawaran/hapus/sparepart';

var url_set_active_penawaran        = window.site_url + 'sales/penawaran/set/wait/active';


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
    console.log(_offer_type + ' , ' +_offer_id)
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
                            tbl = config_tools.loadTableMaster('#tblPenawaranProduk', url_datatable_penawaran_kopi);
                        }

                        if ( $.fn.DataTable.isDataTable('#tblPenawaranMesin') ) {
                            $('#tblPenawaranMesin').DataTable().destroy();
                            tbl = config_tools.loadTableMaster('#tblPenawaranMesin', url_datatable_penawaran_machine);
                        }
                        if ( $.fn.DataTable.isDataTable('#tblPenawaranSparepart') ) {
                            $('#tblPenawaranSparepart').DataTable().destroy();
                            tbl = config_tools.loadTableMaster('#tblPenawaranSparepart', url_datatable_penawaran_sparepart);
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

function getLoadFormOffer(_type_name, _elements){
    switch (_type_name.toLowerCase()) {
        case 'produk':
            loadContentPage(window.site_url + 'sales/load_form_produk', _elements, detailPenawaranProduk);
            break;

        case 'mesin':
            loadContentPage(window.site_url + 'sales/load_form_mesin', _elements, detailPenawaranMesin);
            break;

        default:
            loadContentPage(window.site_url + 'sales/load_form_sparepart', _elements, detailPenawaranSparepart);
            break;
    }
}


/** ########################################## @name PRODUCT_OFFER ############################################### */
/** Update and Delete Product Offer */
function EditProductOffer(_offer_id) { 
}

function DeleteProductOffer(_offer_id){
    var _url = url_hapus_penawaran_kopi + '/' + _offer_id;

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

                        if ( $.fn.DataTable.isDataTable('#tblPenawaranProduk') ) {
                            $('#tblPenawaranProduk').DataTable().destroy();
                            tbl = config_tools.loadTableMaster('#tblPenawaranProduk', url_datatable_penawaran_kopi);
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



/** ########################################### @name MACHINE_OFFER ########################################### */
/** Update and Delete Machine Offer */
function DeleteMachineOffer(_offer_id){
    var _url = url_hapus_penawaran_machine + '/' + _offer_id;

    $.confirm({
        title: 'HAPUS DATA!',
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

                        if ( $.fn.DataTable.isDataTable('#tblPenawaranMesin') ) {
                            $('#tblPenawaranMesin').DataTable().destroy();
                            tbl = config_tools.loadTableMaster('#tblPenawaranMesin', url_datatable_penawaran_machine);
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



/** ########################################### @name SPAREPART_OFFER ########################################### */
/** Update and Delete Sparepart Offer */
function DeleteSparepartOffer(_offer_id){
    var _url = url_hapus_penawaran_sparepart + '/' + _offer_id;

    $.confirm({
        title: 'HAPUS DATA ',
        content: 'Apakah anda yakin, ingin menghapus data ini ?',
        theme:'modern',
        type:'dark',
        buttons: {
            ya: function () {
                $.getJSON(_url, function( data ) {
                    
                    if(data.status == true){
                        box_alert.alertSuccess('BERHASIL INFO', data.messages);
                        var tbl;

                        if ( $.fn.DataTable.isDataTable('#tblPenawaranSparepart') ) {
                            $('#tblPenawaranSparepart').DataTable().destroy();
                            tbl = config_tools.loadTableMaster('#tblPenawaranSparepart', url_datatable_penawaran_sparepart);
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
