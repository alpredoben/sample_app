'use strict'

var data_set = null;
var boxAlert = new BoxAlertInformation();
var configTools = new ConfigTools();



$(document).ready(function () {
    
    var txtUserLogin = '#user_id',
        txtUserPassword = '#user_pwd',
        btnSubmitLogin = '#btn_login';

    $(btnSubmitLogin).click(function (e) { 
        e.preventDefault();

        if($(txtUserLogin).val() != '' && $(txtUserPassword).val() != ''){
            data_set = {
                "user_id"  : $(txtUserLogin).val(),
                "user_pwd" : $(txtUserPassword).val()
            };
    
            axios.post(root_login, data_set).then(function (response) {
                response = response.data;
                if(response.status == false)
                {
                    boxAlert.alertError('Login Gagal', response.messages);
                }
                else{
                    window.location = response.messages; // header('Location : site')
                }
    
    
            }).catch(function (error) {
                console.log(error);
            });
        }
        else{
            boxAlert.alertError('Login Gagal', 'ID dan Password User Kosong. Silahkan Isi Dengan Benar!!', 'warning');
        }

    });
    
    

});