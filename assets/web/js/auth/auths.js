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
    
            axios.post(window.site_url + 'user/login/validate', data_set).then(function (response) {
                var messages = response.data.messages;
                var status = response.data.status;

                if(status == false)
                {
                    boxAlert.alertError('Login Gagal', messages);
                }
                else{
                    console.log(messages);
                    window.location.href = messages; 
                }
                
                console.log(response);
    
            }).catch(function (error) {
                console.log(error);
            });
        }
        else{
            boxAlert.alertError('Login Gagal', 'ID dan Password User Kosong. Silahkan Isi Dengan Benar!!', 'warning');
        }

    });
    
    

});