'use strict'


/** ######################## PRODUCT OFFER ################################## */

/** Load Inisial Page Form Product Coffee */
loadContentPage(window.site_url + 'sales/load_form_produk', pageFormsContent, detailPenawaranProduk); 

function detailPenawaranProduk()
{

    var _json_produk = {};
    var offerProductTable;


    $(document).ready(function () {

        offerProductTable = config_tools.loadTableMaster('#tblPenawaranProduk', url_datatable_penawarn_kopi);

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

                    if(response.status == true)
                        box_alert.alertSuccess('Successfully', response.messages);
                    else
                        box_alert.alertError('Failed', response.messages);

                    _json_produk = {};
                }
            });

       

        });
    
    });


}


/** ####################### MACHINE OFFER #################################### */
/** Load Inisial page Form product Coffee */

function detailPenawaranMesin()
{
    var _json_mesin = {};
    var offerMachineTable;

    $(document).ready(function () {

        //offerMachineTable = config_tools.loadTableMaster('#tblPenawaranMesin', url_datatable_penawaran_machine);

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
    
            _json_mesin.id_mesin = $(optionMesin).val();
            _json_mesin.session_user_data = window.sess_all_data;

            $.ajax({
                type: "post",
                url: url_tambah_penawaran_mesin,
                contentType: "application/json",
                data: JSON.stringify({ input_mesin : _json_mesin }),
                dataType: "json",
                success: function (response) {
                    console.log(response);

                    if(response.status == true)
                        box_alert.alertSuccess('Successfully', response.messages);
                    else
                        box_alert.alertError('Failed', response.messages);

                    _json_mesin = {};
                }
            });

        });
    
    });
}