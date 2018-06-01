'use strict'

/** @param ROOT_URL */
var STR_ROOT_URI_LIST_GROUP_ITEM =  window.site_url + 'customer/app/list/group_item';
var STR_ROOT_LIST_PRODUCT_ITEM = window.site_url + 'customer/app/list/product/by/';

/** @var Variable_Identify */
var txtCompanyName = '#txtCompanyName',
    areaStreetAddress = '#areaStreetAddress',
    txtEmail = '#txtEmail',
    txtPhoneNumber = '#txtPhoneNumber',
    txtNoBillAccount = '#txtNoBillAccount',
    txtDateInvoice = '#txtDateInvoice',
    btnSetBuyer = '#btnSetBuyer',
    btnResetBuyer = '#btnResetBuyer';

/** @var Variable_Item_List */
var optItemCategory = '#optItemCategory',
    optGrupItem = '#optGrupItem';

/** @var Variable_Checkbox_Item */
var selectAllItem = '#selectAllItem';
var tblListProductItem = '#tblListProductItem';

/** @var Content_Page_Order_Menu */
var orderMenu = '#orderMenu';
var rows_selected = [];
/** @var Method_Load_Category_Item */
function loadCategoryItem(element) {  
    var _path_url = window.site_url + 'customer/app/list/category';

    $.getJSON(_path_url, function( data ) {
        console.log(data);

        if(data.status == true && data.messages.length > 0)
        {
            $(element).empty();
            $('<option>').val('-').text('-- Choose Category --').appendTo($(element));
            $.each(data.messages, function (i, v) { 
                $('<option>').val(v.id_kategori).text(v.nama_kategori.toUpperCase()).appendTo( $(element));
            });
        }
        else
        {
            boxAlert.alertError(
                'ERROR', data.messages
            );
        }
    });

}


function setGroupItem(element, data){
    $(element).empty();
    $('<option>').val('-').text('-- Group Item Name --').appendTo($(element));
    $.each(data, function (i, v) { 
        $('<option>').val(v.kode_item).text(v.nama_item).appendTo( $(element));
    });
}


function loadTableWithCheckbox(_tools_name, _url_name)
{
    var table = $(_tools_name).DataTable({
        'ajax': _url_name,
        'columnDefs': [{
           'targets': 0,
           'searchable':false,
           'orderable':false,
           'width':'1%',
           'className': 'dt-body-center',
           'render': function (data, type, full, meta){
               return '<input type="checkbox">';
           }
        }],
        'order': [1, 'asc'],
        'rowCallback': function(row, data, dataIndex){
           // Get row ID
           var rowId = data[0];
  
           // If row ID is in the list of selected row IDs
           if($.inArray(rowId, rows_selected) !== -1){
              $(row).find('input[type="checkbox"]').prop('checked', true);
              $(row).addClass('selected');
           }
        }
    });

    return table;

}


$(document).ready(function () {

    var table;


    /** Event Load Page */
    //$(orderMenu).hide();
    $(txtDateInvoice).val(getNowDateFormat());
    loadCategoryItem(optItemCategory);


    // $(selectAllItem).on('click', function(){
    //     var rows = table_list.rows({ 'search': 'applied' }).nodes();
    //     $('input[type="checkbox"]', rows).prop('checked', this.checked);
    // });

    $('#example tbody').on('click', 'input[type="checkbox"]', function(e){
        var $row = $(this).closest('tr');
        console.log("hello");

        // Get row data
        var data = table.row($row).data();

        console.log(data);
  
        // Get row ID
        var rowId = data[0];
  
        // Determine whether row ID is in the list of selected row IDs 
        var index = $.inArray(rowId, rows_selected);
  
        // If checkbox is checked and row ID is not in list of selected row IDs
        if(this.checked && index === -1){
           rows_selected.push(rowId);
  
        // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
        } else if (!this.checked && index !== -1){
           rows_selected.splice(index, 1);
        }
  
        if(this.checked){
           $row.addClass('selected');
        } else {
           $row.removeClass('selected');
        }
  
        // Update state of "Select all" control
        updateDataTableSelectAllCtrl(table);
  
        // Prevent click event from propagating to parent
        e.stopPropagation();
    });
  


    // Handle click on table cells with checkboxes
    $('#example').on('click', 'tbody td, thead th:first-child', function(e){
        $(this).parent().find('input[type="checkbox"]').trigger('click');
    });

    // Handle click on "Select all" control
    $('thead input[name="select_all"]').on('click', function(e){
        if(this.checked){
            $('#example tbody input[type="checkbox"]:not(:checked)').trigger('click');
        } else {
            $('#example tbody input[type="checkbox"]:checked').trigger('click');
        }

        // Prevent click event from propagating to parent
        e.stopPropagation();
    });

    // Handle table draw event
    // table.on('draw', function(){
    //     // Update state of "Select all" control
    //     updateDataTableSelectAllCtrl(table);
    // });
  




    /** Event Button Reset Buyer Click */
    $(btnResetBuyer).click(function (e) { 
        e.preventDefault();
        //$(orderMenu).hide();
        $('#frmIdentify')[0].reset();
        $(txtDateInvoice).val(getNowDateFormat());
    });


    /** Event Category Chooser */
    $(optItemCategory).change(function (e) { 
        e.preventDefault();

        if($(this).val() != '-'){
            axios.post(STR_ROOT_URI_LIST_GROUP_ITEM, { id_kategori : $(this).val() }).then(function (response) {
                if(response.data.status == true){
                    setGroupItem(optGrupItem, response.data.messages)
                }
            }).catch(function (error) {
                console.log(error);
            });
        }
        else{
            warning_messages('Please choose category item');
        }

    });


    /** Event Group Item Name Change */
    $(optGrupItem).change(function (e) { 
        e.preventDefault();
        
        if($(this).val() != '-')
        {
            if ( $.fn.DataTable.isDataTable('#example') ) {
                $('#example').DataTable().destroy();
            }
            table = loadTableWithCheckbox('#example', STR_ROOT_LIST_PRODUCT_ITEM + $(this).val());
        }
        else{
            warning_messages('Please choose group item name');
        }

    });


    /** Even Button Set Buyer Click */
    $(btnSetBuyer).click(function (e) { 
        e.preventDefault();
        
        if($(txtCompanyName).val() == '')
            warning_messages('Please enter company name field');
        
        if($(areaStreetAddress).val() == '')
            warning_messages('Please enter street address field');

        if($(txtPhoneNumber).val() == '')
            warning_messages('Please enter phone number field');

        if($(txtNoBillAccount).val() == '')
            warning_messages('Please enter bill account number field');

        _account_list_order.company_name = setIdentify(
            $(txtCompanyName).val(),
            $(areaStreetAddress).val(),
            $(txtEmail).val(),
            $(txtPhoneNumber).val(),
            $(txtNoBillAccount).val(),
            $(txtDateInvoice).val()
        );

        $(orderMenu).show();

    });

});