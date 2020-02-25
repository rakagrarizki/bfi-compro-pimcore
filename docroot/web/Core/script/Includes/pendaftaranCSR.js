var stepTitle = document.getElementById("step-title");
var stepSubtitle = document.getElementById("step-subtitle");
var listStep1 = document.getElementById("list-step1");
var listStep2 = document.getElementById("list-step2");
var listStep3 = document.getElementById("list-step3");
var listStep4 = document.getElementById("list-step4");


////// switch stepper //////
var step1 = document.getElementById("stepper-csr-1");
var step2 = document.getElementById("stepper-csr-2");
var step3 = document.getElementById("stepper-csr-3");
var step4 = document.getElementById("stepper-csr-4");

//// next ////
function nextToStep2(){
    step1.classList.add("hide");
    step2.classList.remove("hide");
    $("#button1prev").removeClass('inactive');
    if($('#univ-input').val() != "" && $('#nim-input').val() != "" && $('#fak-input').val() != "" && $('#prodi-input').val() != "" && $('#semester-input').val() != ""){
        $("#button2next").removeClass('inactive');
    }else{
        $("#button2next").addClass('inactive');
    }
    listStep1.classList.remove("active");
    listStep2.classList.add("active");
    document.getElementById("poin1").innerHTML = "<i class='fa fa-check'></i>";
    stepTitle.textContent = "Data Universitas";
    stepSubtitle.textContent = "Silahkan masukkan data universitas anda";
}

function nextToStep3(){
    step2.classList.add("hide");
    step3.classList.remove("hide");
    $("#button2prev").removeClass('inactive');
    if($('#file-pdf-upload').val() != ""){
        $("#button3next").removeClass('inactive');
    }else{
        $("#button3next").addClass('inactive');
    }
    semester_count = $(".semester option:selected").val();
    loopSemester();
    listStep2.classList.remove("active");
    listStep3.classList.add("active");
    document.getElementById("poin1").innerHTML = "<i class='fa fa-check'></i>";
    document.getElementById("poin2").innerHTML = "<i class='fa fa-check'></i>";
    stepTitle.textContent = "Data Akademik";
    stepSubtitle.textContent = "Silahkan masukkan data akademik tiga semester terakhir anda";
}

function nextToStep4(){
    step3.classList.add("hide");
    step4.classList.remove("hide");
    $("#button3prev").removeClass('inactive');
    insertData();
    loopDataSemester();
    listStep3.classList.remove("active");
    listStep4.classList.add("active");
    document.getElementById("poin1").innerHTML = "<i class='fa fa-check'></i>";
    document.getElementById("poin2").innerHTML = "<i class='fa fa-check'></i>";
    document.getElementById("poin3").innerHTML = "<i class='fa fa-check'></i>";
    stepTitle.textContent = "Konfirmasi Data";
    stepSubtitle.textContent = "Pastikan data yang anda masukkan sudah benar";
}
//// prev ////

function backToStep1(){
    step1.classList.remove("hide");
    step2.classList.add("hide");
    listStep1.classList.add("active");
    listStep2.classList.remove("active");
    document.getElementById("poin1").textContent = "1";
    stepTitle.textContent = "Data Pemohon";
    stepSubtitle.textContent = "Silahkan masukkan data diri anda";
}

function backToStep2(){
    step2.classList.remove("hide");
    step3.classList.add("hide");
    listStep2.classList.add("active");
    listStep3.classList.remove("active");
    document.getElementById("poin2").textContent = "2";
    stepTitle.textContent = "Data Universitas";
    stepSubtitle.textContent = "Silahkan masukkan data universitas anda";
    $("#form-semester-ipk .ipk-wrapper").remove();
}

function backToStep3(){
    step3.classList.remove("hide");
    step4.classList.add("hide");
    listStep3.classList.add("active");
    listStep4.classList.remove("active");
    document.getElementById("poin3").textContent = "3";
    stepTitle.textContent = "Data Akademik";
    stepSubtitle.textContent = "Silahkan masukkan data akademik tiga semester terakhir anda";
    $('#list-ipk #ipk').empty();
}

$(document).ready(function(){
    var lang = document.documentElement.lang;
    $("#button1next").addClass('inactive');

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
            $("#btn-verify").removeAttr("disabled").removeAttr("style");
        }
    });

    $('#name-input, #email-input, #phone-input, #alt-phone-input, #file-upload').change( function() {
        if ( $('#name-input').val() != "" && $('#email-input').val() != "" && $('#phone-input').val() != "" && 
            $('#alt-phone-input').val() != "" && $('#file-upload').val() != ""){
            if ($('#email-input-error').text() == "" && $('#name-input-error').text() == "" && 
                $('#phone-input-error').text() == "" && $('#alt-phone-input-error').text() == "" && 
                $('#file-upload-error').text() == ""){
                $("#button1next").removeClass('inactive');
            }else{
                $("#button1next").addClass('inactive');
            }
        }
    });

    $('#univ-input, #nim-input, #fak-input, #prodi-input, #semester-input').change( function() {
        if ( $('#univ-input').val() != "" && $('#nim-input').val() != "" && $('#fak-input').val() != "" && 
            $('#prodi-input').val() != "" && $('#semester-input').val() != ""){
            if ($('#univ-input-error').text() == "" && $('#nim-input-error').text() == "" && 
                $('#fak-input-error').text() == "" && $('#prodi-input-error').text() == "" && 
                $('#semester-input-error').text() == ""){
                $("#button2next").removeClass('inactive');
            }else{
                $("#button2next").addClass('inactive');
            }
        }
    });

    $('#file-pdf-upload, .last-two-digit').change(function(){
        if ($('#file-pdf-upload').val() != ""){
            if ($('#file-pdf-upload-error').text() == ""){
                $("#button3next").removeClass('inactive');
            }else{
                $("#button3next").addClass('inactive');
            }
        }
    });

    $('#file-upload').on('change', function(e) { 
        const sizeLimit = 300000;
        const parent = $(this).parents("#upload");
        const preview = parent.find("img")[0];
        const label = parent.find("span")[0];
        const file = e.target.files[0];
        const iptFrm = $(this).data("id");
        const isImage = (file.type.match("image") ? true : false);

        if (file.size <= sizeLimit && isImage) { 
            var reader = new FileReader();
            reader.addEventListener("load", function () {
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
            parent.find(".error-wrap").hide();
            $('#upload-button').text("Ubah File");
        } else {
            var errorMsg = '';
            switch (false) {
                case (file.size <= sizeLimit):
                    if(lang === 'id'){
                        errorMsg = 'Ukuran file harus kurang dari 300 KB.';
                    }else{
                        errorMsg = 'File size must be less than 300 KB.';
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
            parent.find(".error-wrap").show();
            parent.find(".error-wrap").html('<label id="img-error" class="error" for="img" style="display: inline-block;">' + errorMsg + '</label>');
        } 
    });

    $('#file-pdf-upload').on('change', function(e){
        const sizeLimit = 5000000;
        const parent = $(this).parents("#upload");
        const preview = parent.find("#show")[0];
        const label = parent.find("span")[0];
        const file = e.target.files[0];
        const iptFrm = $(this).data("id");

        if (file.size <= sizeLimit) { 
            var reader = new FileReader();
            reader.addEventListener("load", function () {
                if (typeof (preview) !== "undefined") {
                    $("#" + iptFrm).val("/test/test.png").trigger("change");
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
                    if(lang === 'id'){
                        errorMsg = 'Ukuran file harus kurang dari 5 MB.';
                    }else{
                        errorMsg = 'File size must be less than 5 MB.';
                    }
                    break;
            }
            $(preview).hide();
            parent.find('b').hide();
            parent.find(".error-wrap").show();
            parent.find(".error-wrap").html('<label id="img-error" class="error" for="img" style="display: inline-block;">' + errorMsg + '</label>');
        }
    });

    validateFormRequired($('#scholarship'));

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
            rangelength: jQuery.validator.format("Masukkan nilai antara panjang {0} dan {1} karakter."),
            range: jQuery.validator.format("Silakan masukkan nilai antara {0} dan {1}."),
            max: jQuery.validator.format("Masukkan nilai kurang dari atau sama dengan {0}."),
            min: jQuery.validator.format("Silakan masukkan nilai yang lebih besar dari atau sama dengan {0}."),
            acceptAlphabet: "Masukkan hanya berupa huruf alfabet.",
            acceptAlphanum: "Masukkan hanya berupa huruf dan angka.",
            emailCust : "Silakan isi alamat email yang valid.",
            filesize : "Ukuran file harus kurang dari 500 Kb."
        });
    }
});