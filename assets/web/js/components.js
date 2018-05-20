'use strict'

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

    
}

class ConfigTools{
    getConfig(){
        return 'hello';
    }
}