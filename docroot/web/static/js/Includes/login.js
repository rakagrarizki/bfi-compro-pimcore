// var phone_label_element = document.getElementById("phone-label");
// var default_phone_label = phone_label_element.textContent;

// function changeLabel(ele_id) {
//     if(ele_id == "phone-input"){
//         phone_label_element.textContent = "NOMOR HANDPHONE";
//     }
// }

// function deleteLabel(ele_id) {
//     if (ele_id == "phone-input" && document.getElementById(ele_id).value.length > 0) {
//         phone_label_element.classList.add("exist");
//         document.getElementById(ele_id).classList.add("exist-input");
//         $("#btn-login").removeAttr("disabled").removeAttr("style");
//     }
//     else {
//         if(ele_id == "phone-input"){
//             phone_label_element.classList.remove("exist");
//             phone_label_element.textContent = default_phone_label;
//         }
//     }
// }

$(document).ready(function(){

    function disableButton(button) {
        $(button).css("background-color", "#dddddd");
        $(button).css("border-color", "#dddddd");
        $(button).attr("disabled", "disabled");
    }
  
    function enableButton(button) {
        $(button).css("background-color", "#F8991D");
        $(button).css("border-color", "#F8991D");
        $(button).removeAttr("disabled");
    }
    $("#phone-input").on("keyup", function(e) {
        if (
            $("#phone-input").val() == "" ||
            $(this).val() == ""
        ) {
            disableButton("#btn-login");
        } else {
            enableButton("#btn-login");
        }
    });
    // if($('input.style-input').val() != ''){
    //     $('input.style-input').prev().css({
    //         'display': 'block',
    //         'padding': '15px 15px 5px'
    //     });
    //     $('input.style-input').css({
    //         'padding-top': '35px',
    //         'padding-bottom': '15px'
    //     });
    //     $("#btn-login").removeAttr("disabled").removeAttr("style");
    // }

    $("input.style-input").on('focus', function () {
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
    
    $("input.style-input").on('focusout', function () {
        if ($(this).val() == "") {
            $(this).prev().css("display", "none");
            $(this).css({
                'padding-top': '20px',
                'padding-bottom': '20px'
            });
        }else{
            $("#btn-login").removeAttr("disabled").removeAttr("style");
        }
    });

    $('#otp-form').find('input').each(function() {
        $(this).attr('maxlength', 1);
        $(this).on('keypress', function(e) {
            var parent = $($(this).parent());
            
            if(e.keyCode === 8) {
                var prev = parent.find('input#' + $(this).data('previous'));
                
                if(prev.length) {
                    $(prev).select().val("");
                }
            }
            else if((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105)) {
                var next = parent.find('input#' + $(this).data('next'));
                
                if(next.length) {
                    $(next).removeAttr("disabled").select();
                }
                else {
                    $("#btn-verify").removeAttr("disabled").removeAttr("style");
                    // if(parent.data('autosubmit')) {
                    // 	parent.submit();
                    // }
                }
            }
        });
    });
    
    window.onload = function(){
        var lang = document.documentElement.lang

        if(this.localStorage.token != null){
            window.location="/"+lang+"/user/dashboard";
        }
    }
});


