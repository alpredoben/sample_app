'use strict'


/** ######################## PRODUCT OFFER ################################## */

loadContentPage(window.site_url + 'sales/load_form_produk', pageFormsContent, detailPenawaranProduk); 

/** ####################### @name PRODUCT_OFFER #################################### */

function detailPenawaranProduk()
{

    var _json_produk = {};
    var offerProductTable;
    
    $(btnKembali).hide();

    $(document).ready(function () {

        offerProductTable = config_tools.loadTableMaster('#tblPenawaranProduk', url_datatable_penawaran_kopi);

        $(btnKembali).click(function (e) { 
            e.preventDefault();
            config_tools.loadLocationWindow();
        });


        /** Kuantitas Produk Kopi*/
        $(txtKuantitasKopi).blur(function (e) { 
            e.preventDefault();
            _json_produk.kuantitas_produk = parseInt($(this).val());
            $(this).val( config_tools.convertNumberToCurrency($(this).val()) )
        });
       

        $(txtKuantitasKopi).keydown(function (e) { 
            config_tools.setOnlyNumberInputValue(e);
        });

        
        /** Harga Produk Kopi */
        $(txtHargaKopi).blur(function (e) { 
            e.preventDefault();
            _json_produk.harga_produk = parseInt($(this).val());
            $(this).val( config_tools.convertNumberToCurrency($(this).val()) )
        });

        $(txtHargaKopi).keydown(function (e) { 
            config_tools.setOnlyNumberInputValue(e);
        });


        /** Diskon Produk Kopi */
        $(txtDiskonKopi).blur(function (e) { 
            e.preventDefault();
            _json_produk.diskon_produk = parseInt($(this).val());
        });
       
        $(txtDiskonKopi).keydown(function (e) { 
            config_tools.setOnlyNumberInputValue(e);
        });

        /** Tombol Simpan Produk Detail Kopi */
        $(btnSubmitKopi).click(function (e) { 
            e.preventDefault();
            var id_produk = $(optionProdukKopi).val();
            var kuantitas_produk = $(txtKuantitasKopi).val();
            var harga_produk = $(txtHargaKopi).val();
            var diskon_produk = $(txtDiskonKopi).val();
            var text_button = $(btnSubmitKopi).text();

            if($(optionProdukKopi).val() == '-'){
                box_alert.alertError(false, 'Silahkan pilih nama produk kopi');
                return false;
            }

            if($(txtKuantitasKopi).val() == '' || $(txtKuantitasKopi).val() == 0){
                box_alert.alertError(false, 'Silahkan isi jumlah/kuantitas mesin pilihan');
                return false;
            }

            if($(txtHargaKopi).val() == '' || $(txtHargaKopi).val() == 0){
                box_alert.alertError(false, 'Silahkan isi harga penawaran produk kopi pilihan');
                return false;
            }

            if($(txtDiskonKopi).val() == ''){
                box_alert.alertError(false, 'Silahkan isi diskon harga penawaran produk kopi pilihan');
                return false;
            }
    

            if(text_button.toLowerCase() == 'update'){

            }
            else{
                _json_produk.id_produk = $(optionProdukKopi).val();
                _json_produk.session_user_data = window.sess_all_data;

                $.ajax({
                    type: "post",
                    url: url_tambah_penawaran_kopi,
                    contentType: "application/json",
                    data: JSON.stringify({ input_produk : _json_produk }),
                    dataType: "json",
                    success: function (response) {
                        console.log(response);

                        if(response.status == true){
                            box_alert.alertSuccess('Successfully', response.messages);
                            offerProductTable.ajax.reload()
                        }
                        else
                            box_alert.alertError('Failed', response.messages);

                        _json_produk = {};
                    }
                });
            }



            

       

        });
    
    });


}


/** ####################### @name MACHINE_OFFER #################################### */

function detailPenawaranMesin()
{
    var _json_mesin = {};
    var offerMachineTable;
    
    $(btnKembali).hide();

    $(document).ready(function () {

        offerMachineTable = config_tools.loadTableMaster('#tblPenawaranMesin', url_datatable_penawaran_machine);

        $(btnKembali).click(function (e) { 
            e.preventDefault();
            config_tools.loadLocationWindow();
        });


        /** Kuantitas Produk Kopi*/
        $(txtKuantitasMesin).blur(function (e) { 
            e.preventDefault();
            _json_mesin.kuantitas_mesin = parseInt($(this).val());
            $(this).val( config_tools.convertNumberToCurrency($(this).val()) )
        });
       

        $(txtKuantitasMesin).keydown(function (e) { 
            config_tools.setOnlyNumberInputValue(e);
        });

        
        /** Harga Produk Kopi */
        $(txtHargaMesin).blur(function (e) { 
            e.preventDefault();
            _json_mesin.harga_mesin = parseInt($(this).val());
            $(this).val( config_tools.convertNumberToCurrency($(this).val()) )
        });

        $(txtHargaMesin).keydown(function (e) { 
            config_tools.setOnlyNumberInputValue(e);
        });


        /** Diskon Produk Kopi */
        $(txtDiskonMesin).blur(function (e) { 
            e.preventDefault();
            _json_mesin.diskon_mesin = parseInt($(this).val());
        });
       
        $(txtDiskonMesin).keydown(function (e) { 
            config_tools.setOnlyNumberInputValue(e);
        });

        /** Tombol Simpan Produk Detail Kopi */
        $(btnSubmitMesin).click(function (e) { 
            e.preventDefault();
            var id_mesin = $(optionMesin).val();
            var kuantitas_mesin = $(txtKuantitasMesin).val();
            var harga_mesin = $(txtHargaMesin).val();
            var diskon_mesin = $(txtDiskonMesin).val();
            var text_button = $(btnSubmitMesin).text();

            if($(optionMesin).val() == '-'){
                box_alert.alertError(false, 'Silahkan pilih nama mesin');
                return false;
            }

            if($(txtKuantitasMesin).val() == '' || $(txtKuantitasMesin).val() == 0){
                box_alert.alertError(false, 'Silahkan isi jumlah/kuantitas produk kopi pilihan');
                return false;
            }

            if($(txtHargaMesin).val() == '' || $(txtHargaMesin).val() == 0){
                box_alert.alertError(false, 'Silahkan isi harga penawaran mesin pilihan');
                return false;
            }

            if($(txtDiskonMesin).val() == ''){
                box_alert.alertError(false, 'Silahkan isi diskon harga penawaran mesin pilihan');
                return false;
            }
    
            if(text_button.toLowerCase() == 'update'){


            }
            else{
                _json_mesin.id_mesin = $(optionMesin).val();
                _json_mesin.session_user_data = window.sess_all_data;
                //tblPenawaranMesin
                $.ajax({
                    type: "post",
                    url: url_tambah_penawaran_mesin,
                    contentType: "application/json",
                    data: JSON.stringify({ input_mesin : _json_mesin }),
                    dataType: "json",
                    success: function (response) {
                        console.log(response);

                        if(response.status == true){
                            box_alert.alertSuccess('Successfully', response.messages);
                            offerMachineTable.ajax.reload()
                        }
                            
                        else
                            box_alert.alertError('Failed', response.messages);

                        _json_mesin = {};
                    }
                });

            }

        });
    
    });
}



/** ###################### @name SPAREPART_OFFER ################################ */

function detailPenawaranSparepart()
{
    var _json_sparepart = {};
    var offerSparepartTable;

    $(btnKembali).hide();

    $(document).ready(function () {

        offerSparepartTable = config_tools.loadTableMaster('#tblPenawaranSparepart', url_datatable_penawaran_sparepart);

        $(btnKembali).click(function (e) { 
            e.preventDefault();
            config_tools.loadLocationWindow();
        });

        /** Kuantitas Produk Kopi*/
        $(txtKuantitasSparepart).blur(function (e) { 
            e.preventDefault();
            _json_sparepart.kuantitas_sparepart = parseInt($(this).val());
            $(this).val( config_tools.convertNumberToCurrency($(this).val()) )
        });
       

        $(txtKuantitasSparepart).keydown(function (e) { 
            config_tools.setOnlyNumberInputValue(e);
        });

        
        /** Harga Produk Kopi */
        $(txtHargaSparepart).blur(function (e) { 
            e.preventDefault();
            _json_sparepart.harga_sparepart = parseInt($(this).val());
            $(this).val( config_tools.convertNumberToCurrency($(this).val()) )
        });

        $(txtHargaSparepart).keydown(function (e) { 
            config_tools.setOnlyNumberInputValue(e);
        });


        /** Diskon Produk Kopi */
        $(txtDiskonSparepart).blur(function (e) { 
            e.preventDefault();
            _json_sparepart.diskon_sparepart = parseInt($(this).val());
        });
       
        $(txtDiskonSparepart).keydown(function (e) { 
            config_tools.setOnlyNumberInputValue(e);
        });

        /** Tombol Simpan Produk Detail Kopi */
        $(btnSubmitSparepart).click(function (e) { 
            e.preventDefault();
            var id_sparepart = $(optionSparepart).val();
            var kuantitas_sparepart = $(txtKuantitasSparepart).val();
            var harga_sparepart = $(txtHargaSparepart).val();
            var diskon_sparepart = $(txtDiskonSparepart).val();
            var text_button = $(btnSubmitSparepart).val();

            if($(optionSparepart).val() == '-'){
                box_alert.alertError(false, 'Silahkan pilih nama sparepart');
                return false;
            }

            if($(txtKuantitasSparepart).val() == '' || $(txtKuantitasSparepart).val() == 0){
                box_alert.alertError(false, 'Silahkan isi jumlah/kuantitas produk kopi pilihan');
                return false;
            }

            if($(txtHargaSparepart).val() == '' || $(txtHargaSparepart).val() == 0){
                box_alert.alertError(false, 'Silahkan isi harga penawaran sparepart pilihan');
                return false;
            }

            if($(txtDiskonSparepart).val() == ''){
                box_alert.alertError(false, 'Silahkan isi diskon harga penawaran sparepart pilihan');
                return false;
            }
    
            if(text_button.toLowerCase() == 'update'){


            }
            else{

                _json_sparepart.id_sparepart = $(optionSparepart).val();
                _json_sparepart.session_user_data = window.sess_all_data;
                
                $.ajax({
                    type: "post",
                    url: url_tambah_penawaran_sparepart,
                    contentType: "application/json",
                    data: JSON.stringify({ input_sparepart : _json_sparepart }),
                    dataType: "json",
                    success: function (response) {
                        console.log(response);

                        if(response.status == true){
                            box_alert.alertSuccess('Successfully', response.messages);
                            offerSparepartTable.ajax.reload()
                        }
                            
                        else
                            box_alert.alertError('Failed', response.messages);

                        _json_sparepart = {};
                    }
                });
                
            }

        });
    
    });
}