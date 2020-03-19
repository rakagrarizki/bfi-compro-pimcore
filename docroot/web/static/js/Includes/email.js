// var email_label_element = document.getElementById("email-label");
// var default_email_label = email_label_element.textContent;

// function changeLabel(ele_id){
//     if(ele_id == "email-input"){
//         email_label_element.textContent = "EMAIL";
//     }
// }

// function deleteLabel(ele_id){
//     if (ele_id == "email-input" && document.getElementById(ele_id).value.length > 0) {
//         email_label_element.classList.add("exist");
//         document.getElementById(ele_id).classList.add("exist-input");
//         $("#btn-verify").removeAttr("disabled").removeAttr("style");
//     }
//     else {
//         email_label_element.classList.remove("exist");
//         email_label_element.textContent = default_email_label;
//     }
// }

function validateFormRequired(elementParam) {
    $(elementParam).validate({
        errorPlacement: function(error, element) {
            console.log(element);
            element
                .closest(".form-group")
                .find(".error-wrap")
                .html(error);
        }
    });
}

$.validator.addClassRules({
    formRequired: {
        required: true
    },
    formEmail: {
        emailCust: /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/
    }
});
var lang = document.documentElement.lang;
if (lang === "id") {
    jQuery.extend(jQuery.validator.messages, {
        required: "Isian wajib diisi.",
        emailCust: "Silakan isi alamat email yang valid."
    });
}

jQuery.validator.addMethod("emailCust", function (value, element, param) {
    return param.test(value);
  });

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
        async: false,
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
                // $("#email-input").focus();
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

    if($('input#email-input').val() != ''){
        $('input#email-input').prev().css({
            'display': 'block',
            'padding': '15px 15px 5px'
        });
        $('input#email-input').css({
            'padding-top': '35px',
            'padding-bottom': '15px'
        });
        $("#btn-verify").removeAttr("disabled").removeAttr("style");
    }

    $("input#email-input").on('focus', function () {
        if ($(this).attr("id") !== "ex6SliderVal") {
            $(this).prev().css({
                'display': 'block',
                'padding': '15px 15px 5px'
            });
            $(this).css({
                'padding-top': '35px',
                'padding-bottom': '15px'
            });
        }
    });
    
    $("input#email-input").on('focusout', function () {
        if ($(this).val() == "") {
            $(this).prev().css("display", "none");
            $(this).css({
                'padding-top': '20px',
                'padding-bottom': '20px'
            });
        }else{
            $("#btn-verify").removeAttr("disabled").removeAttr("style");
        }
    });
});