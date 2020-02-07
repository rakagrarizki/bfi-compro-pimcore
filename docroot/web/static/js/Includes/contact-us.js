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
            $('input#no_kontrak').prop( "disabled", false );
        }else if (value === 'non-nasabah'){
            $('input#no_kontrak').prop( "disabled", true );
        }
    })

    if($('textarea#message').val() != ''){
        $('label[for="message"]').css('display', 'block').css('padding', '15px 15px 5px');
    }else{
        $('textarea#message').css('padding-top', '20px');
    }

    $('textarea#message').on('change', function(){ 
        $('label[for="message"]').css('display', 'block').css('padding', '15px 15px 5px');
        $('textarea#message').css('padding-top', '35px');
    })

    if (window.File && window.FileList && window.FileReader) {
        $("#files").on("change", function(e) {
         const sizeLimit = 500000;
         const parent = $(this).parents(".upload-image");
         const preview = parent.find("img")[0];
         const label = parent.find("b")[0];
         const file = e.target.files[0];
         const iptFrm = $(this).data("id");
         const isImage = (file.type.match("image") ? true : false);

        if (file.size <= sizeLimit && isImage) { 
            const fileReader = new FileReader();
            fileReader.onload = (function(e) {
              $("<span class=\"pip\">" +
                "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                "<br/><span class=\"remove\">Remove image</span>" +
                "</span>").insertAfter("#files");
                $(".remove").click(function(){
                $(this).parent(".pip").remove();
                 });
            });
            fileReader.readAsDataURL(file);
          }
        });
      } else {
        alert("Your browser doesn't support to File API")
      }
    
    validateFormRequired($('#contact'))

    $.validator.addClassRules({

        formRequired: {
            required: true
        },
    
        formAlphabet: {
            acceptAlphabet: "[a-zA-Z]+"
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

        submitHandler: function (form) {
            form.submit();
        }
    });
    
    jQuery.validator.addMethod("acceptAlphabet", function (value, element, param) {
        //console.log(value.match(new RegExp("." + param + "$")));
        return value.match(new RegExp("." + param + "$"));
    }, "Please Enter Only Letters");
    
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
});