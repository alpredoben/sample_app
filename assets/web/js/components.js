
class BoxAlertInformation
{

    alertSuccess(title='', message='')
    {
        $.alert({
            title: (title == '') ? "SUCCESS INFO" : title.toUpperCase(),
            content: (message == '') ? 'Event Process Successfully' : message,
            type: "green",
            theme : "modern",
            typeAnimated: true
        });
    }

    alertError(title='', message='', mode='error')
    {
        $.alert({
            title: (title == '') ? mode.toUpperCase() + " INFO" : title,
            content: (message == '') ? 'Event Process Failed' : message,
            type: (mode.toLowerCase() == 'error') ? "red" : "orange",
            theme : "modern",
            typeAnimated: true
        });
    }

    alertTest(){
        return "hello";
    }
    
}

class ConfigTools{
    loadTableMaster(_tools_name, _url_name){
        var table_master =  $(_tools_name).DataTable({
            "processing": true, 
            "serverSide": true, 
            "ajax": {
                "url": _url_name,
                "type": "POST"
            },   
            "columnDefs": [
                { 
                    "targets": [ 0 ], 
                    "orderable": false, 
                },
            ],    
        });
    
        return table_master;
    }

    loadLocationWindow(){
        window.location.reload();
    }

    resetFormMaster(_first, _second){
        $(_first).val('');
        $(_second).val('');
    }

    convertNumberToCurrency(currencies) {
        currencies = parseInt(currencies);
    
        var	number_string = currencies.toString(),
            sisa 	= number_string.length % 3,
            rupiah 	= number_string.substr(0, sisa),
            ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
    
        if (ribuan) {
            var separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
    
        return rupiah;
    }

    setOnlyNumberInputValue(e){
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 || (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || (e.keyCode >= 35 && e.keyCode <= 40)) {
            return;
        }
        
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    }

}