$(document).ready(function () {
    function validateEmail($email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test( $email );
    }

    function htmlEntities(str) {
        return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    }

    function RenderingErrorContent(msg){
        $('#errorNewsletter').find('.body-text').html(msg);
    }

    $("#sendNewsletter").submit(function (e) {
        e.preventDefault();
        var getUrl = window.location;
        var baseUrl = getUrl.protocol + "//" + getUrl.host + "/";

        //var email = $('#email').val();
        var email = document.forms['sendNewsletter']['email'].value;
        $('#email').text(email);

        if(email == ''){
            RenderingErrorContent('<p>Harap isi Email</p>');

            $('#errorNewsletter').modal('show');
            $('body').css("padding-right",0);
        }else {
            if(!validateEmail(email)) {
                RenderingErrorContent('<p>Format Email salah</p>');

                $('#errorNewsletter').modal('show');
            }
            else{
                $("#button-klik").hide();
                $("#ajax-loading").append("<img src=\"/static/images/ajax-loader.gif\" />");
                $.ajax({
                    method: "POST",
                    url: "/register/newsletter",
                    data: {
                        email: htmlEntities(email)
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
                            RenderingErrorContent('<p>Email berhasil terdaftar</p>');
                            $("#ajax-loading").hide();
                            $("#button-klik").show();
                            $('#errorNewsletter').modal('show');
                        }
                        else if(data.success == 0) {
                            RenderingErrorContent('<p>' + data.message + '</p>');
                            $("#ajax-loading").hide();
                            $("#button-klik").show();

                            $('#errorNewsletter').modal('show');
                        }
                    }
                });
            }
        }
    });

});