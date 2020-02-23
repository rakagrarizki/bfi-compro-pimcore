$(document).ready(function () {
    function validateEmail($email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test($email);
    }

    function htmlEntities(str) {
        return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    }

    function RenderingErrorContent(msg) {
        $('#errorNewsletter').find('.body-text').html(msg);
    }

    $("#sendNewsletter").submit(function (e) {
        e.preventDefault();
        var getUrl = window.location;
        var baseUrl = getUrl.protocol + "//" + getUrl.host + "/";

        //var email = $('#email').val();
        var email = document.forms['sendNewsletter']['email'].value;
        var lang = document.forms['sendNewsletter']['lang'].value;
        $('#email').text(email);
        var inputError = "";
        var wrongFormat = "";
        var emailExist = "";

        if (lang === "en") {
            inputError = "Please Input Email";
            wrongFormat = "Invalid Email Format";
            emailExist = "Email Successfully Registered";
        } else {
            inputError = "Harap isi Email";
            wrongFormat = "Format Email Salah";
            emailExist = "Email Berhasil Terdaftar";
        }


        if (email == '') {
            RenderingErrorContent('<p>' + inputError + '</p>');

            $('#errorNewsletter').modal('show');
            $('body').css("padding-right", 0);
        } else {
            if (!validateEmail(email)) {
                RenderingErrorContent('<p>' + wrongFormat + '</p>');

                $('#errorNewsletter').modal('show');
            } else {
                $("#button-klik").hide();
                $("#ajax-loading").append("<img src=\"/static/images/ajax-loader.gif\" />");
                $.ajax({
                    method: "POST",
                    url: "/newsletter",
                    data: {
                        email: htmlEntities(email),
                        lang: htmlEntities(lang)
                    },
                    dataType: 'json',
                    error: function (data) {
                        console.log('error' + data);
                    },
                    fail: function (xhr, textStatus, error) {
                        console.log('request failed')
                    },
                    success: function (data) {

                        if (data.success == 1) {
                            RenderingErrorContent('<p>' + emailExist + '</p>');
                            $("#ajax-loading").hide();
                            $("#button-klik").show();
                            $('#errorNewsletter').modal('show');
                            $('#errorNewsletter').find('.modal-body').css('padding', '50px');
                            $('#errorNewsletter').find('.modal-dialog').css('margin', 'auto');
                        } else if (data.success == 0) {
                            RenderingErrorContent('<p>' + data.message + '</p>');
                            $("#ajax-loading").hide();
                            $("#button-klik").show();

                            $('#errorNewsletter').modal('show');
                            $('#errorNewsletter').find('.modal-body').css('padding', '50px');
                            $('#errorNewsletter').find('.modal-dialog').css('margin', 'auto');
                        }
                    }
                });
            }
        }
    });

});