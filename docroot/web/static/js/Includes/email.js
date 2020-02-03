var email_label_element = document.getElementById("email-label");
var default_email_label = email_label_element.textContent;

function changeLabel(ele_id){
    if(ele_id == "email-input"){
        email_label_element.textContent = "EMAIL";
    }
}

function deleteLabel(ele_id){
    if (ele_id == "email-input" && document.getElementById(ele_id).value.length > 0) {
        email_label_element.classList.add("exist");
        document.getElementById(ele_id).classList.add("exist-input");
        $("#btn-verify").removeAttr("disabled").removeAttr("style");
    }
    else {
        email_label_element.classList.remove("exist");
        email_label_element.textContent = default_email_label;
    }
}

function verify(){
    var token = window.localStorage.getItem("token");
    var dataEmail = {
        'email' : $('#email-input').val()
    };
    console.log(dataEmail);
    $.ajax({
        type: 'POST',
        url: '/user/verify-email-request',
        data: dataEmail,
        dataType: 'json',
        headers: { 'sessionId': token },
        error: function (data) {
            console.log('error' + data);
        },

        fail: function (xhr, textStatus, error) {
            console.log('request failed')
        },

        success: function (dataObj) {
            if (dataObj.success === true) {
                // var verify_code = dataObj.result.data.email_verify_code
                console.log(dataObj.result.data)
                $("#email-sent").removeClass("hide");
                $("#email-verify").addClass("hide");
            }
        }
    })
}

function dataCustomer(token){
    $.ajax({
        type: 'GET',
        url: '/user/data-customer',
        crossDomain: true,
        dataType: 'json',
        headers: {'sessionId': token},

        error: function(data) {
            console.log('error' + data);
        },

        fail: function(xhr, textStatus, error) {
            console.log('request failed')
        },

        success: function(dataObj){
            if(dataObj.success === true) {
                var data = dataObj.result.data;
                console.log(data);
                $("#email-input").focus();
                $('#email-input').val(data.email);
            }
        }
    });
}

function back(){
    var lang = document.documentElement.lang
    window.location="/"+lang+"/user/dashboard";
}

$(document).ready(function(){
    var token = window.localStorage.getItem("token");
    dataCustomer(token);
});