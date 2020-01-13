var name_label_element = document.getElementById("name-label");
var email_label_element = document.getElementById("email-label");
var phone_label_element = document.getElementById("phone-label");
var ktp_label_element = document.getElementById("ktp-label");

var default_name_label = name_label_element.textContent;
var default_email_label = email_label_element.textContent;
var default_phone_label = phone_label_element.textContent;
var default_ktp_label = ktp_label_element.textContent;

if ($("li").hasClass("active")){
    $(".active #poin1,#poin2").html("<i class='fa fa-check'></i>");
    $(".active .tool-tip").addClass("hide");
}


function changeLabel(ele_id) {
    if (ele_id == "name-input"){
        name_label_element.textContent = "NAMA LENGKAP";
    }
    else if(ele_id == "email-input"){
        email_label_element.textContent = "EMAIL";
    }
    else if(ele_id == "phone-input"){
        phone_label_element.textContent = "NOMOR HANDPHONE";
    }
    else if(ele_id == "ktp-input"){
        ktp_label_element.textContent = "NOMOR KTP";
    }
}

function deleteLabel(ele_id) {
    if (ele_id == "name-input" && document.getElementById(ele_id).value.length > 0){
        name_label_element.classList.add("exist");
        document.getElementById(ele_id).classList.add("exist-input");
        return name = document.getElementById(ele_id).value;
    }
    else if (ele_id == "email-input" && document.getElementById(ele_id).value.length > 0) {
        email_label_element.classList.add("exist");
        document.getElementById(ele_id).classList.add("exist-input");
        return email = document.getElementById(ele_id).value;
    }
    else if (ele_id == "phone-input" && document.getElementById(ele_id).value.length > 0) {
        phone_label_element.classList.add("exist");
        document.getElementById(ele_id).classList.add("exist-input");
        return phone = document.getElementById(ele_id).value;
    }
    else if (ele_id == "ktp-input" && document.getElementById(ele_id).value.length > 0) {
        ktp_label_element.classList.add("exist");
        document.getElementById(ele_id).classList.add("exist-input");
    }
    else {
        if (ele_id == "name-input"){
            name_label_element.classList.remove("exist");
            name_label_element.textContent = default_name_label;
        }
        else if(ele_id == "email-input"){
            email_label_element.classList.remove("exist");
            email_label_element.textContent = default_email_label;
        }
        else if(ele_id == "phone-input"){
            phone_label_element.classList.remove("exist");
            phone_label_element.textContent = default_phone_label;
        }
        else if(ele_id == "ktp-input"){
            ktp_label_element.classList.remove("exist");
            ktp_label_element.textContent = default_ktp_label;
        }
    }
}

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
    title.setAttribute("style", "margin-bottom: 10px;");
    button.textContent = "Ubah File";
    image.src = URL.createObjectURL(event.target.files[0]);
    infoArea.textContent = fileName;
    return photo = fileName;
}

$(document).ready(function(){
    var token = window.localStorage.getItem("token");

    $('ul.contract-wrapper').hide();
    checkStatus(token);
    applicationStep(token);
    checkAssignmentList(token);
    contractStatusList(token);
    
    $('#btn-submit').click(function(event) { 

        var formData = {
            'name' : $('#name-input').val(),
            'email' : $('#email-input').val(),
            'phone': $('#phone-input').val(),
            'no_ktp' : $('#ktp-input').val(),
            'path_ktp' : $('#file-upload').val()
        };
        console.log(formData)

        var dataKTP = {
            'no_ktp' : $('#ktp-input').val(),
            'path_ktp' : 'text'
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
                }
            }
        })
    });

    window.onload = function(){
        if(this.localStorage.token == null){
            window.location="/login"
        }else{
            $('.link-log').find('.login').hide();
            $('.link-about-top').hide()
            $('.link-log').find('.user').removeClass('hide');

            if(this.localStorage.full_name != null){
                $('.link-log').find('.full_name').text(this.localStorage.full_name);
            }else{
                getCustomer(token);
            }
        }
    }

    // window.onload = function(){
    //     var elements = document.querySelectorAll('[id="telat"]');
    //     for(var i = 0; i < elements.length; i++) {
    //         elements[i].innerHTML += (
    //             "<div class='outdate'>TELAT BAYAR</div>" +
    //             "<div class='outdate-note'>" +
    //                 "<div class='circle'>" +
    //                     "<i class='fa fa-exclamation'></i>"+
    //                 "</div>"+
    //                 "<span>Anda terlambat membayar 5 hari</span>"+
    //             "</div>"
    //         );
    //     }
    // }

});

function getCustomer(token){
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
            var data = dataObj.result.data;
            if(dataObj.success === true) {
                window.localStorage.setItem('full_name', data.full_name);
                $('.link-log').find('.full_name').text(data.full_name);
            }
        }
    });
}

function checkStatus(token) {
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
            var data = dataObj.result.data
            if (dataObj.success === true) {
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
            }
        }
    })
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
            var data = dataObj.result.data
            if (dataObj.success === true) {
                for(var i=0; i < data.length; i++){ 
                    var newel = $('#status').clone();
                    newel.attr('id', 'status'+i);
                    $('.status-wrapper').append(newel).append("<hr/>");
                }
                $.each(data, function( index, value ) {
                    console.log(value.assignment_id)    
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
            var data = dataObj.result.data;
            if (dataObj.success === true) {
                $.each(data, function( index, value ) {
                    $('.stepper-row').find('#step'+(index+1)).text(value.step_id);
                    $('.stepper-row').find('#label-step'+(index+1)).text(value.desc);
                })
            }
        }
    })
}

function contractStatusList(token) {
    var dataContract = {
        'started_index': 10,
        'length': 11
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
            var data = dataObj.result.data
            if (dataObj.success === true) {
                $('a.contract-box').removeClass('hide');
                for(var i=0; i < data.length; i++){ 
                    var newel = $('#contract').clone();
                    newel.attr('id', 'contract'+i);
                    $(newel).insertAfter(".contract-box:first");
                }
                $.each(data, function( index, value ) {
                    console.log(value)
                    $('#contract'+index).attr('href', '/detail?contract_number='+value.contract_number);
                    $('#contract'+index).find('h5.category').text(value.category_desc);
                    $('#contract'+index).find('h5.product').text(value.product_desc);
                    $('#contract'+index).find('p.contract_number').text(value.contract_number);
                    $('#contract'+index).find('p.angsuran_perbulan').text(value.angsuran_perbulan);
                    $('#contract'+index).find('p.tanggal_jatuh_tempo').text(value.tanggal_jatuh_tempo);

                    if(value.product_desc == "Sertifikat Rumah"){
                        $('#contract'+index).find('.icon > img').attr('src', '/_default_upload_bucket/form_credit/Rumah.png');
                    }else if(value.product_desc == "BPKB Mobil"){
                        $('#contract'+index).find('.icon > img').attr('src', '/_default_upload_bucket/form_credit/Mobil.png');
                    }else if(value.product_desc == "BPKB Motor"){
                        $('#contract'+index).find('.icon > img').attr('src', '/_default_upload_bucket/form_credit/Motor.png');
                    }else if(value.product_desc == "Alat Berat & Mesin Refinancing"){
                        $('#contract'+index).find('.icon > img').attr('src', '/_default_upload_bucket/form_credit/D_alat%20berat.png');
                    }
                    
                    //just example if status != telat
                    if(value.contract_number == '21231213'){
                        $('#contract'+index).find('.status').css('visibility', 'hidden');
                        $('#contract'+index).find('.warning').css('visibility', 'hidden');
                    }
                })
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
            var data = dataObj.result.data
            if (dataObj.success === true) {
                if(data[0].status_id == 1){
                    $(statusNumber).find('div.fail-notif').css('visibility', 'hidden');
                }else if(data[0].status_id == 2){
                    $(statusNumber).find('div.fail-notif > span:last').text(data[0].status_desc)
                }else{
                    $(statusNumber).find('div.fail-notif > span:first').hide()
                    $(statusNumber).find('div.fail-notif > span:last').text(data[0].status_desc)
                }

                //add icon done and fail
                for(var i=1;i<=data[0].step_id;i++){
                    if(i<data[0].step_id || data[0].status_id == 1){
                        $(statusNumber).find('span#step'+i).parent().addClass('done');
                        $(statusNumber).find('span#step'+i).text('');
                    }
                    if(data[0].status_id == 2 && i==data[0].step_id) {
                        $(statusNumber).find('span#step'+i).parent().addClass('fail');
                        $(statusNumber).find('span#step'+i).text('');
                    }
                    $(statusNumber).find('span#step'+i).parent().addClass('active')
                }
                console.log(data)
            }
        }
    })
}