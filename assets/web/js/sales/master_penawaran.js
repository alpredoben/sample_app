
getLoadMasterPenawaran('kopi', pageFormsContent);

function masterPenawaranMethod(_category)
{

    var _json_item_offer = {};
    var table_master_penawaran;
    
    $(btnKembali).hide();

    table_master_penawaran = config_tools.loadTableMaster(tblMasterPenawaran, url_datatable_penawaran + _category);

    $(document).ready(function () {

        
        $(btnKembali).click(function (e) { 
            e.preventDefault();
            config_tools.loadLocationWindow();
        });


        /** #################### @name EVENT_TEXTBOX_KUANTITAS_ITEM ################## **/
        $(txtKuantitasItem).blur(function (e) { 
            e.preventDefault();
            _json_item_offer.kuantitas_item = parseInt($(this).val());
            $(this).val( config_tools.convertNumberToCurrency($(this).val()) )
        });
       
        $(txtKuantitasItem).keydown(function (e) { 
            config_tools.setOnlyNumberInputValue(e);
        });

        
        /** #################### @name EVENT_TEXTBOX_HARGA_ITEM ################## **/
        $(txtHargaItem).blur(function (e) { 
            e.preventDefault();
            _json_item_offer.harga_item = parseInt($(this).val());
            $(this).val( config_tools.convertNumberToCurrency($(this).val()) )
        });

        $(txtHargaItem).keydown(function (e) { 
            config_tools.setOnlyNumberInputValue(e);
        });


        /** #################### @name EVENT_TEXTBOX_DISKON_ITEM ################## **/
        $(txtDiskonItem).blur(function (e) { 
            e.preventDefault();
            _json_item_offer.diskon_item = parseInt($(this).val());
        });
       
        $(txtDiskonItem).keydown(function (e) { 
            config_tools.setOnlyNumberInputValue(e);
        });


        /** #################### @name EVENT_BUTTON_SAVE_DATA_OR_UPDATE ################## **/
        $(btnSubmitItem).click(function (e) { 
            e.preventDefault();
            var items_id        = $(optionItemName).val();
            var kuantitas_item  = $(txtKuantitasItem).val();
            var harga_item      = $(txtHargaItem).val();
            var diskon_item     = $(txtDiskonItem).val();
            var text_button     = $(btnSubmitItem).text();

            if($(optionItemName).val() == '-'){
                box_alert.alertError(false, 'Silahkan pilih nama item');
                return false;
            }

            if($(txtKuantitasItem).val() == '' || $(txtKuantitasItem).val() == 0){
                box_alert.alertError(false, 'Silahkan isi jumlah/kuantitas');
                return false;
            }

            if($(txtHargaItem).val() == '' || $(txtHargaItem).val() == 0){
                box_alert.alertError(false, 'Silahkan isi harga item');
                return false;
            }

            if($(txtDiskonItem).val() == ''){
                box_alert.alertError(false, 'Silahkan isi diskon harga item');
                return false;
            }
    

            if(text_button.toLowerCase() == 'update'){

            }
            else{

                _json_item_offer.items_id = $(optionItemName).val();
                _json_item_offer.session_user_data = window.sess_all_data;

                $.ajax({
                    type: "post",
                    url: url_tambah_penawaran +  segment_item,
                    contentType: "application/json",
                    data: JSON.stringify({ input_produk : _json_item_offer }),
                    dataType: "json",
                    success: function (response) {
                        console.log(response);

                        if(response.status == true){
                            box_alert.alertSuccess('Successfully', response.messages);
                            table_master_penawaran.ajax.reload()
                        }
                        else
                            box_alert.alertError('Failed', response.messages);

                        _json_item_offer = {};
                    }
                });
            
            
            }


        });
    
    });


}