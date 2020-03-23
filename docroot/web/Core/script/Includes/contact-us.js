$(document).ready(function(){

    var lang = document.documentElement.lang;

    var type_message_placeholder = $('#type_message').attr('placeholder');
    $('#type_message').select2({
        placeholder: type_message_placeholder,
        dropdownParent: $('#type_message').parent()
    });

    $('select').on('change', function (e) {
        $('label[for="type_message"]').css('visibility', 'visible');
    });

    $('select.type-message').on('change', function(){
        $('.select2-selection__rendered').css('line-height', '45px');
    });

    $('select.type-message').on('click', function(){
        $('.select2-selection__rendered').css('line-height', '45px');
    });

    $('input[type="radio"]#type').on('change', function(){
        var value = $("input[name='personal[identity]']:checked").val();
        if (value === 'nasabah'){
            $('input#customer_name').addClass('formRequired');
            $('input#no_kontrak').addClass('formRequired');
            $('input#customer_name').prop( "disabled", false );
            $('input#no_kontrak').prop( "disabled", false );
        }else if (value === 'non-nasabah'){
            $('input#customer_name').removeClass('formRequired');
            $('input#no_kontrak').removeClass('formRequired');
            $('input#customer_name').val("");
            $('input#no_kontrak').val("");
            $('input#customer_name').prop( "disabled", true );
            $('input#no_kontrak').prop( "disabled", true );
        }
    })

    if($('textarea#message').val() != ''){
        $('label[for="message"]').css('display', 'block').css('padding', '15px 15px 5px');
    }else{
        $('textarea#message').css('padding-top', '20px');
    }

    $('textarea#message').on('click', function(){ 
        $('label[for="message"]').css('display', 'block').css('padding', '15px 15px 5px');
        $('textarea#message').css('padding-top', '35px');
    })

    $('.file-input').on('change', function(e) { 
        const sizeLimit = 500000;
        const parent = $(this).parents(".upload-image");
        const preview = parent.find("img")[0];
        const label = parent.find("b")[0];
        const file = e.target.files[0];
        const iptFrm = $(this).data("id");
        const filePdf = e.target.files[0];
        const isImage = (file.type.match("image") ? true : false);
        const isPdf = (file.type.match("application/pdf") ? true : false);


        if (file.size <= sizeLimit && isImage) { 
            var reader = new FileReader();
            if ( lang === 'id'){
                btnTextImage = 'Hapus Gambar';
            }else{
                btnTextImage = 'Remove Image';
            }
            reader.addEventListener("load", function (e) {
                $("<span class=\"pipImg\">" +
                "<img  src=\"" + e.target.result +"\" />"+
                "<br/><span class=\"remove\">"+ btnTextImage +"</span>" +
                "</span>").insertAfter("#files");

                    $(".remove").click(function(){
                    $(this).parent(".pipImg").remove();
                    });  
                if (typeof (preview) !== "undefined") {
                $("#" + iptFrm).val("/test/test.png").trigger("change");
                $(label).text(file.name);
                preview.src = reader.result;
                }
            }, false);

            if (file) {
                $(preview).show();
                reader.readAsDataURL(file);
            } else {
                $(preview).hide();
            } 
            parent.find('b').show();
            parent.find(".error-wrap").hide();
        } else {
            var errorMsg = '';
            switch (false) {
                case (file.size <= sizeLimit):
                    console.log('contact-us')
                    if(lang === 'id'){
                        errorMsg = 'Ukuran file harus kurang dari 500 KB.';
                    }else{
                        errorMsg = 'File size must be less than 500 KB.';
                    }
                    break;
                case isImage:
                    if(lang === 'id'){
                        errorMsg = 'Silakan pilih file gambar.'
                    }else{
                        errorMsg = 'Please choose image file.';
                    }
                    break;
            }
                $(preview).hide();
                parent.find('b').hide();
                parent.find(".error-wrap").show();
                parent.find(".error-wrap").html('<label id="img-error" class="error" for="img" style="display: inline-block;">' + errorMsg + '</label>');
            } 
            if (filePdf.size <= sizeLimit && isPdf) { 
                const fileReaderPdf = new FileReader();
                if ( lang === 'id'){
                    btnTextPdf = 'Hapus Pdf';
                }else{
                    btnTextPdf = 'Remove Pdf';
                }
                if (file.type == "application/pdf"){
                    const imagePDF = "/static/images/pdf_logo.png";
                    fileReaderPdf.addEventListener("load", function () {
                    $("<span class=\"pipPdf\">" +
                    "<img  src=\"" + imagePDF +"\" />"+
                    "<br/><span class=\"remove\">"+btnTextPdf+"</span>" +
                    "</span>").insertAfter("#files");
    
                        $(".remove").click(function(){
                        $(this).parent(".pipPdf").remove();
                        });  
                    if (typeof (preview) !== "undefined") {
                    $("#" + iptFrm).val("/test/test.png").trigger("change");
                    $(label).text(file.name);
                    preview.src = fileReaderPdf.result;
                    }
                }, false);
                if (file) {
                    $(preview).show();
                    fileReaderPdf.readAsDataURL(file);
                } else {
                    $(preview).hide();
                } 
                parent.find('b').show();
                parent.find(".error-wrap").hide();
            } else {
                var errorMsg = '';
                switch (false) {
                    case (file.size <= sizeLimit):
                        console.log('contact-us')
                        if(lang === 'id'){
                            errorMsg = 'Ukuran file harus kurang dari 500 KB.';
                        }else{
                            errorMsg = 'File size must be less than 500 KB.';
                        }
                        break;
                    case isImage:
                        if(lang === 'id'){
                            errorMsg = 'Silakan pilih file pdf.'
                        }else{
                            errorMsg = 'Please choose pdf file.';
                        }
                        break;
                }
                $(preview).hide();
                parent.find('b').hide();
                parent.find(".error-wrap").show();
                parent.find(".error-wrap").html('<label id="img-error" class="error" for="img" style="display: inline-block;">' + errorMsg + '</label>');
            }
        }
    });
    
    validateFormRequired($('#contact'))

    $.validator.addClassRules({

        formRequired: {
            required: true
        },
    
        formAlphabet: {
            acceptAlphabet: "[a-zA-Z]+"
        },

        formAlphanum: {
            acceptAlphanum: "[a-zA-Z0-9]+"
        },
    
        formEmail: {
            emailCust: /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/
        },
    
        formNumber: {
            required: true,
            number: true
        },
    
        formPhoneNumber: {
            required: true,
            number: true,
            maxlength: 13,
            minlength: 9
        },

        formMessage: {
            minlength: 15
        },
    
        uploadImage: {
            accept: "image/*",
            filesize: 500   //max size 1MB
        },
        uploadFile: {
            accept: "application/pdf",
            filesize: 500   //max size 1MB
        },
   
        submitHandler: function (form) {
            form.submit();
        }
    });
    
    jQuery.validator.addMethod("acceptAlphabet", function (value, element, param) {
        //console.log(value.match(new RegExp("." + param + "$")));
        return value.match(new RegExp("." + param + "$"));
    }, "Please Enter Only Letters");
    
    jQuery.validator.addMethod("acceptAlphanum", function (value, element, param) {
        //console.log(value.match(new RegExp("." + param + "$")));
        return value.match(new RegExp("." + param + "$"));
    }, "Please Enter Only Letter and Number");
    
    jQuery.validator.addMethod("emailCust", function (value, element, param) {
        return param.test(value);
    }, "Please enter a valid email address.");

    jQuery.validator.addMethod("filesize", function (value, element, param) {
        console.log("test", this.optional(element) || (element.files[0].size <= param), element.files[0], param)
        return this.optional(element) || (element.files[0].size <= param)
    }, "File size must be less than 500 KB.");

    function validateFormRequired(elementParam) {
    $(elementParam).validate({
        errorPlacement: function (error, element) {
            console.log(element)
            element.closest('.form-group').find('.error-wrap').html(error);
        }
    });
    }
    
    if(lang === 'id'){
        jQuery.extend(jQuery.validator.messages, {
            required: "Isian wajib diisi.",
            remote: "Harap perbaiki isian ini.",
            email: "Silakan isi alamat email yang valid.",
            url: "Silakan masukkan URL yang valid.",
            date: "Silakan masukkan tanggal yang valid.",
            dateISO: "Silakan masukkan tanggal yang valid (ISO).",
            number: "Silakan masukkan nomor yang valid.",
            digits: "Masukkan hanya berupa digit.",
            creditcard: "Harap masukkan nomor kartu kredit yang benar.",
            equalTo: "Silakan masukkan nilai yang sama sekali lagi.",
            accept: "Silakan masukkan nilai dengan ekstensi yang valid.",
            maxlength: jQuery.validator.format("Harap masukkan tidak lebih dari {0} karakter."),
            minlength: jQuery.validator.format("Silakan masukkan setidaknya {0} karakter."),
            rangelength: jQuery.validator.format("Masukkan nilai antara panjang {0} dan {1} karakter."),
            range: jQuery.validator.format("Silakan masukkan nilai antara {0} dan {1}."),
            max: jQuery.validator.format("Masukkan nilai kurang dari atau sama dengan {0}."),
            min: jQuery.validator.format("Silakan masukkan nilai yang lebih besar dari atau sama dengan {0}."),
            acceptAlphabet: "Masukkan hanya berupa huruf alfabet.",
            acceptAlphanum: "Nomor kontrak hanya boleh menggunakan angka & huruf",
            emailCust : "Silakan isi alamat email yang valid.",
            filesize : "Ukuran file harus kurang dari 500 Kb."
        });
    }

    $( '#submitPersonal' ).click(function(){
        var $captcha = $( '#g-recaptcha' ),
            response = grecaptcha.getResponse();
        
        if (response.length === 0) {
          $( '.msg-error').text( "reCAPTCHA wajib diisi" );
          if( !$captcha.hasClass( "error" ) ){
            $captcha.addClass( "error" );
            return false;
          }
        } else {
          $( '.msg-error' ).text('');
          $captcha.removeClass( "error" );
        }
      })

    //   Sort Select

    var options = $('select.type-message option');
    var arr = options.map(function(_, o) {
        return {
            t: $(o).text(),
            v: o.value
        };
    }).get();
    arr.sort(function(o1, o2) {
        return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0;
    });
    options.each(function(i, o) {
        console.log(i);
        o.value = arr[i].v;
        $(o).text(arr[i].t);
    });

    $('#message').keypress(function(event){
        $('#message').addClass('label-padding');
        $('.label-messages').addClass('disapper-label');
    });

     var token = localStorage.getItem("token");
    if (token != null) {
        getDataStorage(token);
    }

    function getDataStorage(token) {
        disabled = disabledField();
        $.ajax({
            type: "GET",
            url: "/user/data-customer",
            crossDomain: true,
            dataType: "json",
            headers: { sessionId: token },
      
            error: function(data) {
                console.log("error" + data);
            },
      
            fail: function(xhr, textStatus, error) {
                console.log("request failed");
            },
            success: function(dataObj) {
                if (dataObj.success === true) {
                    var data = dataObj.result.data;
                    $("#nama_lengkap").val(data.full_name);
                    $("#email_pemohon").val(data.email);
                    $("#no_handphone").val(data.phone_number);
                    // enableButton("#button1");
                    // nextButton("active");
                    disabled;
                }else{
                    !disabled;
                }
            }
        });
      }
});