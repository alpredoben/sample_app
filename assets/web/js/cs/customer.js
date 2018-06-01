'use strict'

var box_alert    = new BoxAlertInformation();
var config_tools = new ConfigTools();
var _account_list_order = {}

function warning_messages(msg, element){
    box_alert.alertError('warning', msg, 'warning');
    return false;
}

function setIdentify(name, address, email, phone, no_account, date_invoice) 
{  
    var data = {
        company_name: name,
        company_address: address,
        company_email: email,
        company_phone: phone,
        no_bill_account: no_account,
        invoice_date: date_invoice
    }
    return data;
}

function get_now_date_format()
{
    var today   = new Date();
    var day     = today.getDate(),
        month   = today.getMonth()+1,
        year    = today.getFullYear();

    day   = (day < 10)? '0'+day : day;
    month = (month < 10)? '0'+month : month;

    return year + '-' + month + '-' + day;
}

