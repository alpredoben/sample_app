
getLoadMasterPenawaran('kopi', pageFormsContent);

function masterPenawaranMethod(_category='')
{

    var _json_penawaran = {};
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

            if($(btnSubmitItem).text().toLowerCase() == 'update')
                data_update.kuantitas = parseInt($(this).val())

            _json_penawaran.kuantitas_item = parseInt($(this).val());
            $(this).val( config_tools.convertNumberToCurrency($(this).val()) )
        });
       
        $(txtKuantitasItem).keydown(function (e) { 
            config_tools.setOnlyNumberInputValue(e);
        });

        
        /** #################### @name EVENT_TEXTBOX_HARGA_ITEM ################## **/
        $(txtHargaItem).blur(function (e) { 
            e.preventDefault();
            if($(btnSubmitItem).text().toLowerCase() == 'update')
                data_update.harga_item = parseInt($(this).val())

            _json_penawaran.harga_item = parseInt($(this).val());
            $(this).val( config_tools.convertNumberToCurrency($(this).val()) )
        });

        $(txtHargaItem).keydown(function (e) { 
            config_tools.setOnlyNumberInputValue(e);
        });


        /** #################### @name EVENT_TEXTBOX_DISKON_ITEM ################## **/
        $(txtDiskonItem).blur(function (e) { 
            e.preventDefault();
            if($(btnSubmitItem).text().toLowerCase() == 'update')
                data_update.diskon =  parseInt($(this).val())

            _json_penawaran.diskon_item = parseInt($(this).val());
        });
       
        $(txtDiskonItem).keydown(function (e) { 
            config_tools.setOnlyNumberInputValue(e);
        });


        /** #################### @name EVENT_BUTTON_SAVE_DATA_OR_UPDATE ################## **/
        $(btnSubmitItem).click(function (e) { 
            e.preventDefault();

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
    
            _json_penawaran.id_item = $(optionItemName).val();
            _json_penawaran.id_user = window.sess_all_data.unik_id_pengguna
            //console.log(_json_penawaran);

            if(text_button.toLowerCase() == 'update'){
                data_update.id_user = window.sess_all_data.unik_id_pengguna;

                $.ajax({
                    type: "post",
                    url: url_update_penawaran +  data_update.id_kategori,
                    contentType: "application/json",
                    data: JSON.stringify({ data_update : data_update }),
                    dataType: "json",
                    success: function (response) {
                        console.log(response);

                        if(response.status == true){
                            box_alert.alertSuccess('Successfully', response.messages);
                            table_master_penawaran.ajax.reload()
                        }
                        else{
                            box_alert.alertError('Failed', response.messages);
                        }

                        data_update = {};
                        ResetFormItem();
                    }
                });

            }
            else{

                $.ajax({
                    type: "post",
                    url: url_insert_penawaran +  _category.toLowerCase(),
                    contentType: "application/json",
                    data: JSON.stringify({ input_produk : _json_penawaran }),
                    dataType: "json",
                    success: function (response) {
                        console.log(response);

                        if(response.status == true){
                            box_alert.alertSuccess('Successfully', response.messages);
                            table_master_penawaran.ajax.reload()
                        }
                        else
                            box_alert.alertError('Failed', response.messages);

                        _json_penawaran = {};
                        ResetFormItem();
                    }
                });
            
            
            }


        });
    
    });


}