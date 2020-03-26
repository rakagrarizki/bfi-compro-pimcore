// preview uploaded image //
var title = document.getElementById("upload-text");
var image = document.getElementById('preview-upload');
var button = document.getElementById( 'upload-button' );
var input = document.getElementById( 'file-upload' );
var infoArea = document.getElementById( 'file-upload-filename' );

input.addEventListener( 'change', showFileName );
title.setAttribute("style", "margin-bottom: -15px;");

function showFileName( event ) {    
    var input = event.srcElement;
    var fileName = input.files[0].name;
    var lang = document.documentElement.lang

    title.setAttribute("style", "margin-bottom: 10px;");
    if(lang == 'id'){
        button.textContent = "Pilih FIle";
    }else{
        button.textContent = "Choose File";
    }
    image.src = URL.createObjectURL(event.target.files[0]);
    infoArea.textContent = fileName;
    return photo = fileName;
}

$(document).ready(function(){
    var token = window.localStorage.getItem("token");
    var lang = document.documentElement.lang

    if(token == null){
        window.location = "/" + lang + "/login";
    }

    $('ul.contract-wrapper').hide();
    checkStatusVerify(token);
    dataCustomer(token);
    applicationStep(token);
    checkAssignmentList(token);
    contractStatusList(lang, token);

    if($("#name-input").val() != ""){
        $('#name-input').prev().css({
            'display': 'block',
            'padding': '15px 15px 5px'
        });
        $('#name-input').css({
            'padding-top': '35px',
            'padding-bottom': '15px'
        });
    }

    if($("#email-input").val() != ""){
        $('#email-input').prev().css({
            'display': 'block',
            'padding': '15px 15px 5px'
        });
        $('#email-input').css({
            'padding-top': '35px',
            'padding-bottom': '15px'
        });
    }

    if($("#phone-input").val() != ""){
        $('#phone-input').prev().css({
            'display': 'block',
            'padding': '15px 15px 5px'
        });
        $('#phone-input').css({
            'padding-top': '35px',
            'padding-bottom': '15px'
        });
    }

    if( $("#ktp-input").val() != ""){
        $('#ktp-input').prev().css({
            'display': 'block',
            'padding': '15px 15px 5px'
        });
        $('#ktp-input').css({
            'padding-top': '35px',
            'padding-bottom': '15px'
        });
    }

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
        }
    });
    
    $('#btn-submit').click(function(event) { 
        var formData = {
            'name' : $('#name-input').val(),
            'email' : $('#email-input').val(),
            'phone': $('#phone-input').val(),
            'no_ktp' : $('#ktp-input').val(),
            'path_ktp' : $('#file-upload').val()
        };
        console.log(formData)

        if($('#name-input').val() == '' || $('#email-input').val() == '' || $('#phone-input').val() == '' || $('#ktp-input').val() == '' || $('#file-upload').val() == ''){
            var errorMsg;
            if(lang == 'id'){
                errorMsg = "Verifikasi ktp gagal, silahkan periksa kembali data ktp.";
            }else{
                errorMsg = "ID card verification failed, please re-check your ID card data.";
            }
            $(".error-wrap").html('<label id="verify-ktp-error" class="error" for="verify-ktp" style="display: inline-block;">' + errorMsg + '</label>');
            return;
        }

        var dataKTP = {
            'no_ktp' : $('#ktp-input').val(),
            'path_ktp' : $('#file-upload').val()

        }
        console.log(dataKTP)

        $.ajax({
            type: 'POST',
            url: '/user/verify-no-ktp',
            data: dataKTP,
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
                    console.log('berhasil verify ktp')
                    $('#popup-ktp').modal('hide');
                    location.reload();
                }else{
                    var errorMsg;
                    if(lang == 'id'){
                        errorMsg = "Verifikasi ktp gagal, silahkan periksa kembali data ktp.";
                    }else{
                        errorMsg = "ID card verification failed, please re-check your ID card data.";
                    }
                    $(".error-wrap").html('<label id="verify-ktp-error" class="error" for="verify-ktp" style="display: inline-block;">' + errorMsg + '</label>');
                }
            }
        })
    });

    validateFormRequired($('#validate-ktp'));

    $.validator.addClassRules({

        formRequired: {
            required: true
        },
    
        formAlphabet: {
            acceptAlphabet: "[a-zA-Z]+"
        },
    
        formEmail:- {
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
    
        uploadImage: {
            accept: "image/*",
            filesize: 500   //max size 1MB
        },
    
        submitHandler: function (form) {
            form.submit();
        }
    });

    $(".formNumber").on("keydown", function (e) {
        if (e.which != 8 && e.which != 0 && e.which != 144 && (e.which < 46 || e.which > 57) && (e.which < 96 || e.which > 105)) {
            return false;
        }
    });
    
    jQuery.validator.addMethod("acceptAlphabet", function (value, element, param) {
        // console.log(value.match(new RegExp("." + param + "$")));
        // console.log(/^[a-z]+$/i.test(value));
        return /^[a-z ]+$/i.test(value);
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
            console.log(error)
            element.closest('.input-text-group').find('.error-wrap').html(error);
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
            acceptAlphabet: "Masukkan hanya berupa huruf alfabet.",
            emailCust : "Silakan isi alamat email yang valid.",
            filesize : "Ukuran file harus kurang dari 500 Kb."
        });
    }
});

function checkStatusVerify(token) {
    $.ajax({
        type: 'GET',
        url: '/user/check-verify-status',
        crossDomain: true,
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
                var data = dataObj.result.data
                if(data.is_phone_number_verify == true){
                    $('span#poin1').parent().addClass('active')
                    $('span#poin3').parent().children('a.tool-tip').hide()
                }
                if(data.is_email_verify == true){
                    $('span#poin2').parent().addClass('active')
                    $('span#poin2').parent().children('a.tool-tip').hide()
                    $('span#poin3').parent().children('a.tool-tip').show()
                }
                if(data.is_ktp_verify == true){
                    $('span#poin3').parent().addClass('active')
                    $('span#poin3').parent().children('a.tool-tip').hide()
                    $('section#verify-section > .container').hide()
                    $('p.not-verify').addClass('hide')
                    $('p.verify').removeClass('hide')
                    $('ul.contract-wrapper').show()
                }
                if(data.is_noktp == true){
                    $('span#poin3').parent().find('a#ktp-false').hide()
                    $('span#poin3').parent().find('a#ktp').show()
                }else{
                    $('span#poin3').parent().find('a#ktp-false').show()
                    $('span#poin3').parent().find('a#ktp').hide()
                }
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
                $('#name-input').val(data.full_name);
                $('#email-input').val(data.email);
                $('#phone-input').val(data.phone_number);
            }
        }
    });
}

function checkAssignmentList(token) {
    $.ajax({
        type: 'GET',
        url: '/user/assignment-list',
        crossDomain: true,
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
                var data = dataObj.result.data
                for(var i=0; i < data.length; i++){ 
                    var newel = $('#status').clone();
                    newel.attr('id', 'status'+i);
                    $('.status-wrapper').append(newel).append("<hr/>");
                }
                $.each(data, function( index, value ) {
                    // console.log(value.assignment_id)    
                    $('li.status-box').removeClass('hide');
                    $('#status'+index).find('div.assignment > p').text(value.assignment_id);
                    $('#status'+index).find('div.credit-type > p').text(value.category_desc+' - '+value.product_desc);
                    var statusNumber = '#status'+index
                    applicationStatus(token, statusNumber ,value.assignment_id);
                    
                });
                $('.status-box:first').hide()
            }
        }
    })
}

function applicationStep(token) {
    $.ajax({
        type: 'GET',
        url: '/user/application-step-list',
        crossDomain: true,
        dataType: 'json',
        headers: {'sessionId': token },

        error: function (data) {
            console.log('error' + data);
        },

        fail: function (xhr, textStatus, error) {
            console.log('request failed')
        },

        success: function (dataObj) {
            if (dataObj.success === true) {
                var data = dataObj.result.data;
                $.each(data, function( index, value ) {
                    $('.stepper-row').find('.step'+(index+1)).text(value.step_id);
                    $('.stepper-row').find('.label-step'+(index+1)).text(value.desc);
                })
            }
        }
    })
}

function contractStatusList(lang, token) {
    var dataContract = {
        'started_index': 1,
        'length': 100
    }

    $.ajax({
        type: 'POST',
        url: '/user/contract-status-list',
        data: dataContract,
        crossDomain: true,
        dataType: 'json',
        headers: {'sessionId': token},

        error: function (data) {
            console.log('error' + data);
        },

        fail: function (xhr, textStatus, error) {
            console.log('request failed')
        },

        success: function (dataObj) {
            if (dataObj.success === true) {
                var data = dataObj.result.data
                $('a.contract-box').removeClass('hide');
                for(var i=0; i < data.length; i++){ 
                    var newel = $('#contract').clone();
                    newel.attr('id', 'contract'+i);
                    $(newel).insertAfter(".contract-box:first");
                }
                $.each(data, function( index, value ) {
                    var options = { year: 'numeric', month: 'long', day: 'numeric' };
                    var date = new Date(data[0].tanggal_jatuh_tempo);
                    var now = new Date();
                    now.setHours(0,0,0,0);

                    var due_date = date.toLocaleDateString(lang+'-'+lang, options);
                    var difference_in_ms = Math.abs(now - date);
                    var difference_in_days = difference_in_ms / (1000 * 3600 * 24); 

                    $('#contract'+index).attr('href', '/'+lang+'/user/profile/detail-kontrak?contract_number='+value.contract_number);
                    $('#contract'+index).find('h5.category').text(value.category_desc);
                    $('#contract'+index).find('h5.product').text(value.product_desc);
                    $('#contract'+index).find('p.contract_number').text(value.contract_number);
                    $('#contract'+index).find('p.angsuran_perbulan').text(value.angsuran_perbulan);
                    $('#contract'+index).find('p.tanggal_jatuh_tempo').text(due_date);

                    if(value.product_desc == "Sertifikat Rumah"){
                        $('#contract'+index).find('.icon > img').attr('src', '/_default_upload_bucket/form_credit/Rumah.png');
                    }else if(value.product_desc == "BPKB Mobil"){
                        $('#contract'+index).find('.icon > img').attr('src', '/_default_upload_bucket/form_credit/Mobil.png');
                    }else if(value.product_desc == "BPKB Motor"){
                        $('#contract'+index).find('.icon > img').attr('src', '/_default_upload_bucket/form_credit/Motor.png');
                    }else if(value.product_desc == "Alat Berat & Mesin Refinancing"){
                        $('#contract'+index).find('.icon > img').attr('src', '/_default_upload_bucket/form_credit/D_alat%20berat.png');
                    }
                    
                    if(difference_in_days > 0){
                        $('#contract'+index).find('.warning > span').text("Anda terlambat membayar "+ difference_in_days +" hari");
                    }else{
                        $('#contract'+index).find('.status').css('visibility', 'hidden');
                        $('#contract'+index).find('.warning').css('visibility', 'hidden');
                    }
                });
                $('.contract-box:first').hide()
            }
        }
    })
}

function applicationStatus(token, statusNumber, assignmentId) {
    var dataAssignment = {
        'assignment_id': assignmentId
    }

    console.log(dataAssignment)

    $.ajax({
        type: 'POST',
        url: '/user/application-status-list',
        data: dataAssignment,
        crossDomain: true,
        dataType: 'json',
        async: false,
        headers: {'sessionId': token},

        error: function (data) {
            console.log('error' + data);
        },

        fail: function (xhr, textStatus, error) {
            console.log('request failed')
        },

        success: function (dataObj) {
            if (dataObj.success === true) {
                var data = dataObj.result.data
                // if(data[0].status_id == 1){
                //     $(statusNumber).find('div.fail-notif').css('visibility', 'hidden');
                // }else if(data[0].status_id == 2){
                //     $(statusNumber).find('div.fail-notif').css('visibility', 'visible');
                //     $(statusNumber).find('div.fail-notif > span:last').text(data[0].status_desc)
                // }else{
                //     $(statusNumber).find('div.fail-notif').css('visibility', 'visible');
                //     $(statusNumber).find('div.fail-notif > span:first').hide()
                //     $(statusNumber).find('div.fail-notif > span:last').text(data[0].status_desc)
                // }
                
                //add icon done and fail
                for(var i=0;i<data.length;i++){
                    console.log(statusNumber + 'span.step'+(i+1), data[i].step_id, data[i].status_id, )
                    if(data[i].status_id == 1 && (i+1)==data[i].step_id){
                        $(statusNumber).find('span.step'+(i+1)).parent().addClass('done');
                        $(statusNumber).find('span.step'+(i+1)).parent().addClass('active')
                        $(statusNumber).find('span.step'+(i+1)).text('');
                    } else if(data[i].status_id == 2 && (i+1)==data[i].step_id) {
                        $(statusNumber).find('span.step'+(i+1)).parent().addClass('fail');
                        $(statusNumber).find('span.step'+(i+1)).parent().addClass('active')
                        $(statusNumber).find('span.step'+(i+1)).text('');
                    } else {
                        $(statusNumber).find('span.step'+(i+1)).text((i+1));
                    }
                }
                console.log(data)
            }
        }
    })
}
