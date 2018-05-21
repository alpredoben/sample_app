
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
}