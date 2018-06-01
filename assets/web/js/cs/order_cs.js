'use strict'

var URL_CATEGORY_ITEM = window.site_url + 'customer/app/list/category';
var URL_GROUP_ITEM_LIST = window.site_url + 'customer/app/list/group_item';
var URL_PRODUCT_ITEM = window.site_url + 'customer/app/list/product/by/';
var URL_ADD_LIST_ORDER_ITEM = window.site_url + 'customer/app/add/order/item';

var _list_cart = {}

/** Load Category */
function load_category_item(element) {  
    
    $.getJSON(URL_CATEGORY_ITEM, 
        function (data) {
            
            if(data.status == true && data.messages.length > 0){
                $(element).empty();
                $('<option>').val('-').text('-- Choose Category --').appendTo($(element));

                $.each(data.messages, function (i, v) { 
                    $('<option>').val(v.id_kategori).text(v.nama_kategori.toUpperCase()).appendTo( $(element));
                });

            }
            else{
                box_alert.alertError('ERROR', data.messages);
            }
        }
    );

}


/** Load Group Item List */
function set_group_item_list(element, data){
    $(element).empty();
    $('<option>').val('-').text('-- Group Item Name --').appendTo($(element));
    $.each(data, function (i, v) { 
        $('<option>').val(v.kode_item).text(v.nama_item).appendTo( $(element));
    });
}

/** Load Datatable */
function load_datatable_item(_element, _path_url) 
{
    var mytable = $(_element).DataTable({
        ajax: _path_url,
        columnDefs:[
            {
                targets:0,
                checkboxes:{
                    selectRow:true
                }
            }
        ],
        select:{
            style: 'multi'
        },
        order:[[1, 'asc']],
        searching:false
    });

    return mytable;
}


$(document).ready(function () {

    var list_table;

    _list_cart.id_list = [];

    $('#txtDateInvoice').val(get_now_date_format());
    load_category_item('#optItemCategory');

    /** Event Item Category Change */
    $('#optItemCategory').change(function (e) { 
        e.preventDefault();
        
        if($(this).val() != '-'){

            axios.post(URL_GROUP_ITEM_LIST, { id_kategori : $(this).val() }).then(function (response) {
                if(response.data.status == true){
                    set_group_item_list(
                        '#optItemGroup', response.data.messages
                    )
                }
                else{
                    box_alert.alertError('Error', response.data.messages);
                }
            }).catch(function (error) {
                console.log(error);
            });

        }
        else {
            warning_messages('Please choose item category');
        }

    });

    $('#optItemGroup').change(function (e) { 
        e.preventDefault();
        
        if($(this).val() != '-'){

            if( $.fn.DataTable.isDataTable('#myListTable') ){
                $('#myListTable').DataTable().destroy();
            }

            list_table = load_datatable_item(
                '#myListTable', URL_PRODUCT_ITEM + $(this).val()
            );
        }
        else{
            warning_messages('Please choose item group name');
        }

    });

    $('#btnInsertItem').click(function (e) { 
        e.preventDefault();
        var rowsel = list_table.column(0).checkboxes.selected();
        
        if(rowsel.length > 0){
            _list_cart.id_list.push(rowsel.join(','));
            
            axios.post(URL_ADD_LIST_ORDER_ITEM, { list_item : rowsel.join(',') }).then(function (response) {

                if(response.data.status == true){
                    box_alert.alertSuccess('INSERT SUCCESS', response.data.messages);
                }
                else{
                    box_alert.alertError('INSERT FAILED', response.data.messages);
                }


            }).catch(function (error) {
                console.log(error);
            });



        }
        else{
            warning_messages('Please check or choose item which will you want to insert');
        }


    });


   
});