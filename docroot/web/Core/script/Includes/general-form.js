var retryLimit = 3;

let currentToken = undefined;
let expiredDate = undefined;

function retryAjax(_this, xhr) {
    if (xhr.status == 500) {
        _this.tryCount++;
        if (_this.tryCount <= _this.retryLimit) {
            // console.log("TRY " + _this.tryCount);
            //try again
            $.ajax(_this);
            return;
        } else {
            // console.log("LAST TRY");
            // _this.url = '/credit/save-car-leads1';
            return;
        }
    }
}

function postOTP(url, data) {
    var _ret;
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        dataType: "json",
        // tryCount: 0,
        // retryLimit: retryLimit,
        async: false,
        error: function (xhr, textStatus, errorThrown) {
            // retryAjax(this, xhr);
            $("#wrongOtp").modal("show");
        },
        fail: function (xhr, textStatus, error) {
            // retryAjax(this, xhr);
            $("#failedOtp").modal("show");
        },
        success: function (result) {
            // console.log("RESULT", result);
            if (result.success === "1") {
                _ret = result;
            } else {
                // console.log('error' + result.message);
                $("#wrongOtp").modal("show");
            }
        },
    });
    return _ret;
}

function postData(url, data) {
    var _ret;
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        dataType: "json",
        tryCount: 0,
        retryLimit: retryLimit,
        async: false,
        error: function (xhr, textStatus, errorThrown) {
            retryAjax(this, xhr);
        },
        fail: function (xhr, textStatus, error) {
            retryAjax(this, xhr);
        },
        success: function (result) {
            // console.log("RESULT", result);
            if (result.success === "1") {
                _ret = result;
            } else {
                _ret = result;
                // console.log('error' + result.message);
            }
        },
    });
    return _ret;
}

function getData(url, data, cb) {
    var _ret;
    $.ajax({
        type: "GET",
        url: url,
        data: data,
        dataType: "json",
        tryCount: 0,
        retryLimit: retryLimit,
        async: false,
        error: function (xhr, textStatus, errorThrown) {
            retryAjax(this, xhr);
        },
        fail: function (xhr, textStatus, error) {
            retryAjax(this, xhr);
        },
        success: function (result) {
            if (result.success === "1") {
                _ret = result;
            } else {
                // console.log('error' + result.message);
            }
        },
    });
    return _ret;
}

function getProvince() {
    var url = "/credit/get-province";
    var data = {};
    return transformData(getData(url, data).data);
}

function getCity(provinceId) {
    if (provinceId) {
        var url = "/credit/get-city";
        var data = { province_id: provinceId };
        return transformData(postData(url, data).data);
    } else {
        return false;
    }
}

function getDistrict(cityId) {
    if (cityId) {
        var url = "/credit/get-district";
        var data = { city_id: cityId };
        return transformData(postData(url, data).data);
    } else {
        return false;
    }
}

function getSubdistrict(districtId) {
    if (districtId) {
        var url = "/credit/get-subdistrict";
        var data = { district_id: districtId };
        return transformData(postData(url, data).data);
    } else {
        return false;
    }
}

function getZipcode(subdistrictId) {
    if (subdistrictId) {
        var url = "/credit/get-zipcode";
        var data = { subdistrict_id: subdistrictId };
        return postData(url, data).data;
    } else {
        return false;
    }
}

function transformData(data) {
    var ret = [];
    $.each(data, function (idx, item) {
        ret.push({
            id: item.id,
            text: item.desc,
        });
    });
    return ret;
}

function separatordot(o) {
    var bilangan = Math.ceil(o);

    var number_string = bilangan.toString(),
        sisa = number_string.length % 3,
        rupiah = number_string.substr(0, sisa),
        ribuan = number_string.substr(sisa).match(/\d{3}/g);

    if (ribuan) {
        separator = sisa ? "." : "";
        rupiah += separator + ribuan.join(".");
    }

    return rupiah;
}

function showOtp() {
    scrollToTop();
    $(".wizard .steps, .wizard .actions").hide();
    $("#otp-success").hide();
    $("#step-summary").hide();
    $("#step-otp").show();
    showOtpWait();
    startOtp();
}

function showOtpWait() {
    $(".otp-number__text .otp-resend").hide();
    $(".otp-number__text .otp-wait").show();
}

function showOtpResend() {
    $(".otp-number__text .otp-resend").show();
    $(".otp-number__text .otp-wait").hide();
}

function showSuccessOtp() {
    $("#otp-success").show();
    $("#step-summary").hide();
    $("#step-otp").hide();
}

function requestOTP(cb) {
    var _data = {
        phone_number: $("#no_handphone").val().toString(),
    };
    postOTP("/otp/send-otp", _data);
    cb();
}

var otpTimeout = 90;
var otpTimeRemain = 0;
function startOtp() {
    otpTimeRemain = otpTimeout;
    requestOTP(otpCountDown);
}

function otpCountDown() {
    var timeElm = $("#otp-counter");
    timeElm.text(otpTimeRemain + " detik");
    setTimeout(function () {
        otpTimeRemain--;
        timeElm.text(otpTimeRemain + " detik");
        if (otpTimeRemain >= 0) {
            otpCountDown();
        } else {
            showOtpResend();
        }
    }, 1000);
}

function otpResend() {
    startOtp();
    showOtpWait();
}

function otpVerified() {
    var otp1Value = $("input[name=otp1]").val().toString(),
        otp2Value = $("input[name=otp2]").val().toString(),
        otp3Value = $("input[name=otp3]").val().toString(),
        otp4Value = $("input[name=otp4]").val().toString(),
        no_handphone = $("#no_handphone").val().toString();

    if (
        otp1Value == "" ||
        otp2Value == "" ||
        otp3Value == "" ||
        otp4Value == ""
    ) {
        var errorMsg = "";
        var lang = document.documentElement.lang;

        if (lang === "id") {
            errorMsg = "Isian wajib diisi.";
        } else {
            errorMsg = "This field is Required.";
        }
        $(".otp-number").find(".error-wrap").show();
        $(".error-wrap").html(
            '<label id="otp-error" class="error" for="otp" style="display: inline-block;">' +
                errorMsg +
                "</label>"
        );
    } else {
        var _data = {
            phone_number: no_handphone,
            otp_code: otp1Value + otp2Value + otp3Value + otp4Value,
        };
        var verifiedOtp = postOTP("/otp/validate-otp", _data);
        if (verifiedOtp.success === "1") {
            sendLastLeads();
        } else {
            $("#wrongOtp").modal("show");
        }
    }
}

function successOTP() {
    var _data = getDataRegister();
    var register = postData("/submission-register", _data);
    var lang = document.documentElement.lang;

    if (register.success === "1") {
        phone_number = register.data.phone_number;
        showSuccessOtp();
        setTimeout(function () {
            window.location = "/" + lang + "/login";
        }, 120000);
    } else {
        $("#failedOtp").modal("show");
    }
}

function checkStatus() {
    // console.log(phone_number);
    var lang = document.documentElement.lang;
    var data = {
        phone_number: phone_number,
    };
    var check = postData("/submission-login", data);
    if (check.success === "1") {
        var token = check.data.customer_token;
        localStorage.setItem("token", token);
        // console.log ('token : ' + token);
        getCustomer(token);
        window.location = "/" + lang + "/user/dashboard";
    }
}

function reInitJcf() {
    $('input[type="radio"], input[type="checkbox"]')
        .parent()
        .find("span")
        .remove();
    $('input[type="radio"], input[type="checkbox"]').unwrap();
    // jcf.destroyAll();
    jcf.replaceAll();
}

function scrollToTop() {
    $("html, body").animate(
        {
            scrollTop: 0,
        },
        400
    );
}

(function ($) {
    var lang = document.documentElement.lang;

    $(document).on("click", "#otp-resend", otpResend);
    $(document).on("click", "#otp-verification", otpVerified);

    $(document).on("click", ".countdown--reload", function (e) {
        e.preventDefault();
        countDown();
        requestOtp(credits);
        $(".countdown").removeClass("countdown--reload");
    });

    $("input.form-control").on("focus", function () {
        if (
            $(this).attr("id") !== "ex7SliderVal" &&
            $(this).attr("id") !== "down_payment"
        ) {
            $(this).prev().css({
                display: "block",
                padding: "15px 15px 5px",
            });
            $(this).css({
                "padding-top": "35px",
                "padding-bottom": "15px",
            });
        }
    });

    $("input.form-control").on("focusout", function () {
        if ($(this).val() == "") {
            $(this).prev().css("display", "none");
            $(this).css({
                "padding-top": "20px",
                "padding-bottom": "20px",
            });
        }
    });

    $(document).on("focus", ".select2", function (e) {
        $(this).parent().find("label").css({
            display: "block",
            padding: "12px 15px",
        });
    });

    $(".input-number").on("change", function () {
        $(".otp-number").find(".error-wrap").hide();
    });

    $(".file-input").change(function (e) {
        var sizeLimit = 1000000;
        var parent = $(this).parents(".upload-image");
        var preview = parent.find("img")[0];
        var label = parent.find("b")[0];
        var file = e.target.files[0];
        var iptFrm = $(this).data("id");
        var isImage = file.type.match("image") ? true : false;

        if (file.size <= sizeLimit && isImage) {
            var reader = new FileReader();
            reader.addEventListener(
                "load",
                function () {
                    if (typeof preview !== "undefined") {
                        // $("#" + iptFrm).val(reader.result).trigger("change");
                        $("#" + iptFrm)
                            .val("/test/test.png")
                            .trigger("change");
                        $(label).text(file.name);
                        preview.src = reader.result;
                    }
                },
                false
            );

            if (file) {
                $(preview).show();
                reader.readAsDataURL(file);
            } else {
                $(preview).hide();
            }
            parent.find(".error-wrap").hide();
        } else {
            var errorMsg = "";
            switch (false) {
                case file.size <= sizeLimit:
                    if (lang === "id") {
                        errorMsg = "Ukuran file harus kurang dari 1 MB.";
                    } else {
                        errorMsg = "File size must be less than 1 MB.";
                    }
                    break;
                case isImage:
                    if (lang === "id") {
                        errorMsg = "Silakan pilih file gambar.";
                    } else {
                        errorMsg = "Please choose image file.";
                    }
                    break;
            }
            parent.find(".error-wrap").show();
            parent
                .find(".error-wrap")
                .html(
                    '<label id="ktp-error" class="error" for="ktp" style="display: inline-block;">' +
                        errorMsg +
                        "</label>"
                );
        }
    });

    $(".upload-btn button").click(function () {
        var parent = $(this).parents(".upload-image");
        parent.find(".file-input").click();
    });

    $(".formLicensePlate").on("keyup", () => {
        let elm = $(".formLicensePlate");
        elm.val(elm.val().toUpperCase());
    });

    // PHONE NUMBER formPhoneNumber
    $(".formPhoneNumber").focus(function () {
        if ($.trim($(this).val()) == "") {
            $(this).val("0");
        }
    });

    $(".formPhoneNumber").on("keydown", function (e) {
        if (
            e.which != 8 &&
            e.which != 0 &&
            e.which != 144 &&
            (e.which < 46 || e.which > 57) &&
            (e.which < 96 || e.which > 105)
        ) {
            return false;
        }
        //   if (($(this).get(0).selectionStart == 0 && (e.keyCode < 35 || e.keyCode > 40)) ||
        //     ($(this).get(0).selectionStart == 1 && e.keyCode == 8)) {
        //     return false;
        //   }
    });

    $(".formPhoneNumber").on("input propertychange paste", function (e) {
        var reg = /^00+/gi;
        var reg2 = /^[+62]+/gi;
        if (this.value.match(reg)) {
            this.value = this.value.replace(reg, "0");
        }
        if (this.value.match(reg2)) {
            this.value = this.value.replace(reg2, "0");
        }
        if ($.trim($(this).val()) == "") {
            $(this).val("0");
        }
    });

    $(".formPhoneNumber").bind("contextmenu", function (e) {
        e.preventDefault();
    });

    var post_val_inputan = 0;
    $("#ex7SliderVal").on("input", function () {
        var thisval = $(this).val(),
            pricelimit = $(this).parent().next().children(".valuemax").text(),
            pricelimitmin = $(this)
                .parent()
                .next()
                .children(".valuemin")
                .text();

        thisval = thisval.replace(/\./g, "");
        pricelimit = pricelimit.replace(/\./g, "");
        pricelimitmin = pricelimitmin.replace(/\./g, "");

        if (thisval !== "") {
            if (isNaN(thisval)) {
                thisval = "";
            } else {
                if (parseInt(thisval) <= parseInt(pricelimit)) {
                    post_val_inputan = thisval;
                } else {
                    thisval = post_val_inputan;
                }
            }
        }

        $(this)
            .parents(".sliderGroup")
            .find(".calcslide")
            .slider("setValue", parseInt(thisval));

        var number_string = thisval.toString(),
            sisa = number_string.length % 3,
            rupiah = number_string.substr(0, sisa),
            ribuan = number_string.substr(sisa).match(/\d{3}/g);

        if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        $(this).val(rupiah);
    });

    if (
        typeof $("#ex7SliderVal")
            .parents(".sliderGroup")
            .find(".calcslide")
            .slider() !== "undefined"
    ) {
        if ($("#ex7SliderVal").parents(".machine-funding").length == 1) {
            // console.log('DP changed');
        } else {
            $("#ex7SliderVal")
                .parents(".sliderGroup")
                .find(".calcslide")
                .slider()
                .on("slideStop", function (ev) {
                    // console.log(ev)
                    var rawDownPayment = ev.value * 0.1;
                    var downPayment = separatordot(rawDownPayment);
                    $("#down_payment").val(downPayment);
                    $("#pocket_money").val(downPayment);
                });
        }
    }

    if ($(".calcslide").length > 0) {
        $(document).on("change", ".calcslide", function (evt) {
            var _elm = $(this);
            var _parent = _elm.parents(".sliderGroup");
            var _ifMoney = _parent.find(".c-input-trans");
            var _ifMonth = _parent.find(".c-custom-select-trans");
            var _thisVal = evt.value.newValue;

            // if (_ifMoney.length > 0) {

            var number_string = _thisVal.toString(),
                sisa = number_string.length % 3,
                rupiah = number_string.substr(0, sisa),
                ribuan = number_string.substr(sisa).match(/\d{3}/g);

            if (ribuan) {
                separator = sisa ? "." : "";
                rupiah += separator + ribuan.join(".");
            }

            _ifMoney.val(rupiah);

            var _toInt = parseInt(_thisVal);
            _toInt = _toInt > 0 ? _toInt : 0;

            nextButton("inactive");
            if (countCalculate > 0) {
                $(".warning-calculate").removeClass("hide");
            }
        });
    }

    // if ($("#down_payment").length > 0) {
    $("#down_payment").on("change", function () {
        nextButton("inactive");
        if (countCalculate > 0) {
            $(".warning-calculate").removeClass("hide");
        }
    });
    // }

    $("#pocket_money").on("change", function () {
        nextButton("inactive");
        if (countCalculate > 0) {
            $(".warning-calculate").removeClass("hide");
        }
    });

    $('.otp-number__verify input[type="tel"]').on("keyup", function () {
        // console.log(this.value.length, this.maxLength)
        if (this.value.length == this.maxLength) {
            var $next = $(this).next(".input-number");
            if ($next.length) {
                $(this).next(".input-number").focus();
            } else {
                $(this).blur();
            }
        } else {
            var $prev = $(this).prev(".input-number");
            if ($prev.length) {
                $(this).prev(".input-number").focus();
            } else {
                $(this).blur();
            }
        }
    });

    $(".formNoKtp").on("keydown", function (e) {
        if (
            e.which != 8 &&
            e.which != 0 &&
            e.which != 144 &&
            (e.which < 46 || e.which > 57) &&
            (e.which < 96 || e.which > 105)
        ) {
            // console.log('masuk sini')
            return false;
        }
    });
})(jQuery);

$(".form-control").on("select2:select", function (e) {
    var data = e.params.data;
    var nextEl = $(this)
        .parent()
        .nextAll(".form-group:eq(0)")
        .find(".input-step");
    if (data.selected == true) {
        $(this).next().find(".select2-selection").addClass("valid");
        nextEl.removeAttr("disabled");
    } else {
        {
        }
        nextEl.attr("disabled", true);
    }
});

$("input.form-control, textarea.form-control").on("keyup change", function () {
    var data = $(this).valid();
    var nextEl = $(this)
        .parent()
        .nextAll(".form-group:eq(0)")
        .find(".input-step");
    if (data == true) {
        $(this).prev("label").addClass("valids");
        nextEl.removeAttr("disabled");
    } else {
        $(this).prev("label").removeClass("valids");
        nextEl.attr("disabled", true);
    }
});

$("input[type='radio'], input[type='checkbox']").on("change", function () {
    var nextEl = $(this)
        .closest(".form-group")
        .next(".form-group")
        .find(".input-step");
    nextEl.removeAttr("disabled");
});

inputDisabled();
function inputDisabled() {
    $("input, select, textarea").addClass("input-step");
    $(".form-body--credit")
        .find(".input-step:not(:eq(0))")
        .attr("disabled", true);
    $(".form-body--credit .otp-number")
        .find(".input-step")
        .removeAttr("disabled");
}

function step(action, val) {
    scrollToTop();
    if (action == "next") {
        $(".nav-item-" + val).removeClass("active");
        $(".nav-item-" + val).addClass("done");
        $(`.nav-item-${val + 1}`).addClass("active");

        lang == "id"
            ? $(".nav-item-" + val)
                  .find(".nav-step-tag")
                  .text("Selesai")
            : $(".nav-item-" + val)
                  .find(".nav-step-tag")
                  .text("Done");

        lang == "id"
            ? $(`.nav-item-${val + 1}`)
                  .find(".nav-step-tag")
                  .text("Sedang Isi")
            : $(`.nav-item-${val + 1}`)
                  .find(".nav-step-tag")
                  .text("Onprogress");

        $("#menu" + val).removeClass("active");
        $(`#menu${val + 1}`)
            .addClass("active")
            .fadeIn();
    } else {
        $(`.nav-item-${val + 1}`).removeClass("active");
        $(".nav-item-" + val).removeClass("done");
        $(".nav-item-" + val).addClass("active");

        lang == "id"
            ? $(`.nav-item-${val + 1}`)
                  .find(".nav-step-tag")
                  .text("Belum Isi")
            : $(`.nav-item-${val + 1}`)
                  .find(".nav-step-tag")
                  .text("Pending");

        lang == "id"
            ? $(".nav-item-" + val)
                  .find(".nav-step-tag")
                  .text("Sedang Isi")
            : $(".nav-item-" + val)
                  .find(".nav-step-tag")
                  .text("Onprogress");

        $("#menu" + val)
            .addClass("active")
            .fadeIn();
        $(`#menu${val + 1}`).removeClass("active");
    }
}

function getAuthorizationToken() {
    if (!currentToken || new Date(expiredDate).getTime() < Date.now()) {
        $.ajax({
            type: "POST",
            url: "/credit/get_gateway_token",
            tryCount: 0,
            retryLimit: retryLimit,
            error: function (xhr, textStatus, errorThrown) {
                retryAjax(this, xhr);
            },
            fail: function (xhr, textStatus, error) {
                retryAjax(this, xhr);
            },
            success: function (result) {
                currentToken = result.data.access_token;
                expiredDate = result.data.expired_date;

                sessionStorage.setItem("token", currentToken);
                sessionStorage.setItem("expiredDate", expiredDate);
            },
        });
    }
    return currentToken;
}

function getListProvinsi(element) {
    dataProvinsi = [];
    $(element).empty();
    var provinsi_placeholder = $("#provinsi").attr("placeholder");

    $.ajax({
        type: "GET",
        url: "/credit/get-list-province",
        headers: { Authorization: "Basic " + currentToken },
        dataType: "json",
        error: function (xhr) {
            retryAjax(this, xhr);
        },
        fail: function (xhr, textStatus, error) {
            retryAjax(this, xhr);
        },
        success: function (result) {
            $.each(result.data, function (id, val) {
                dataProvinsi.push({
                    id: val.id,
                    text: val.description,
                });
            });
            $(element).select2({
                placeholder: provinsi_placeholder,
                dropdownParent: $(element).parent(),
                data: dataProvinsi,
                language: {
                    noResults: function () {
                        return lang === "id"
                            ? "Tidak Ada Hasil yang Ditemukan"
                            : "No Result Found";
                    },
                },
            });
        },
    });
}

function getListCity(element) {
    dataCity = [];
    $(element).empty();
    var city_placeholder = $("#kota").attr("placeholder");
    var prov = $("#provinsi").val().toString();
    $.ajax({
        type: "POST",
        url: "/credit/get-list-city",
        headers: { Authorization: "Basic " + currentToken },
        data: { province: prov },
        dataType: "json",
        error: function (xhr) {
            retryAjax(this, xhr);
        },
        fail: function (xhr, textStatus, error) {
            retryAjax(this, xhr);
        },
        success: function (result) {
            $.each(result.data, function (id, val) {
                dataCity.push({
                    id: val.city,
                    text: val.city,
                });
            });
            $(element).select2({
                placeholder: city_placeholder,
                dropdownParent: $(element).parent(),
                data: dataCity,
                language: {
                    noResults: function () {
                        return lang === "id"
                            ? "Tidak Ada Hasil yang Ditemukan"
                            : "No Result Found";
                    },
                },
            });
        },
    });
}

function getListDistrict(element) {
    dataDistrict = [];
    $(element).empty();
    var district_placeholder = $(element).attr("placeholder");
    var prov = $("#provinsi").val().toString();
    var city = $("#kota").val().toString();
    $.ajax({
        type: "POST",
        url: "/credit/get-list-district",
        headers: { Authorization: "Basic " + currentToken },
        data: { province: prov, city: city },
        dataType: "json",
        error: function (xhr) {
            retryAjax(this, xhr);
        },
        fail: function (xhr, textStatus, error) {
            retryAjax(this, xhr);
        },
        success: function (result) {
            $.each(result.data, function (id, val) {
                dataDistrict.push({
                    id: val.kecamatan,
                    text: val.kecamatan,
                });
            });
            $(element).select2({
                placeholder: district_placeholder,
                dropdownParent: $(element).parent(),
                data: dataDistrict,
                language: {
                    noResults: function () {
                        return lang === "id"
                            ? "Tidak Ada Hasil yang Ditemukan"
                            : "No Result Found";
                    },
                },
            });
        },
    });
}

function getListSubdistrict(element) {
    dataSubdistrict = [];
    $(element).empty();
    var subdistrict_placeholder = $(element).attr("placeholder");
    var prov = $("#provinsi").val().toString();
    var city = $("#kota").val().toString();
    var district = $("#kecamatan").val().toString();
    $.ajax({
        type: "POST",
        url: "/credit/get-list-subdistrict",
        headers: { Authorization: "Basic " + currentToken },
        data: { province: prov, city: city, district: district },
        dataType: "json",
        error: function (xhr) {
            retryAjax(this, xhr);
        },
        fail: function (xhr, textStatus, error) {
            retryAjax(this, xhr);
        },
        success: function (result) {
            $.each(result.data, function (id, val) {
                dataSubdistrict.push({
                    id: val.kelurahan,
                    text: val.kelurahan,
                });
            });
            $(element).select2({
                placeholder: subdistrict_placeholder,
                dropdownParent: $(element).parent(),
                data: dataSubdistrict,
                language: {
                    noResults: function () {
                        return lang === "id"
                            ? "Tidak Ada Hasil yang Ditemukan"
                            : "No Result Found";
                    },
                },
            });
        },
    });
}

function getListZipcode() {
    var city = $("#kota").val().toString();
    var district = $("#kecamatan").val().toString();
    var subdistrict = $("#kelurahan").val().toString();
    $.ajax({
        type: "POST",
        url: "/credit/get-list-zipcode",
        headers: { Authorization: "Basic " + currentToken },
        data: { city: city, district: district, subdistrict: subdistrict },
        dataType: "json",
        error: function (xhr) {
            retryAjax(this, xhr);
        },
        fail: function (xhr, textStatus, error) {
            retryAjax(this, xhr);
        },
        success: function (result) {
            if (result.message === "success") {
                $.each(result.data, function (id, val) {
                    $("#kode_pos").val(val.zip_code);
                });
            }
        },
    });
}

let dataAssets = [];
let rawAssetBrand = [];
let branch_id = "";

function getListAssets(assetType) {
    $.ajax({
        type: "POST",
        url: "/credit/get-list-assets",
        headers: { Authorization: "Basic " + currentToken },
        data: { asset_type: assetType },
        dataType: "json",
        error: function (xhr) {
            retryAjax(this, xhr);
        },
        fail: function (xhr, textStatus, error) {
            retryAjax(this, xhr);
        },
        success: function (result) {
            if (result.message === "success") {
                $.each(result.data.data, (i, val) => {
                    dataAssets.push({
                        category: val.category_id,
                        model: val.model,
                        model_desc: val.model_desc,
                        brand: val.brand,
                        brand_desc: val.brand_desc,
                        asset_group: val.asset_group,
                    });
                });
                filterAssetType();
            }
        },
    });
}

function filterAssetType() {
    var dataType = [];
    var type_placeholder = $("#type_kendaraan").attr("placeholder");

    // remove duplicate
    let assetType = dataAssets
        .map((item) => item.category)
        .filter((val, i, e) => e.indexOf(val) === i);

    $.each(assetType, function (id, val) {
        dataType.push({
            id: val,
            text: val,
        });
    });
    $("#type_kendaraan").select2({
        placeholder: type_placeholder,
        dropdownParent: $("#type_kendaraan").parent(),
        data: dataType,
        language: {
            noResults: function () {
                return lang === "id"
                    ? "Tidak Ada Hasil yang Ditemukan"
                    : "No Result Found";
            },
        },
    });
}

function filterAssetBrand(category) {
    var dataBrand = [];
    var brand_placeholder = $("#merk_kendaraan").attr("placeholder");
    rawAssetBrand = dataAssets.filter((e) => e.category === category);

    // remove duplicate
    let assetBrand = rawAssetBrand.filter(
        (val, i, e) => i === e.findIndex((t) => t.brand === val.brand)
    );

    $.each(assetBrand, function (id, val) {
        dataBrand.push({
            id: val.brand,
            text: val.brand_desc,
        });
    });
    $("#merk_kendaraan").select2({
        placeholder: brand_placeholder,
        dropdownParent: $("#merk_kendaraan").parent(),
        data: dataBrand,
        language: {
            noResults: function () {
                return lang === "id"
                    ? "Tidak Ada Hasil yang Ditemukan"
                    : "No Result Found";
            },
        },
    });
}

function filterAssetModel(brand) {
    var dataModel = [];
    var model_placeholder = $("#model_kendaraan").attr("placeholder");
    let assetModel = rawAssetBrand.filter((e) => e.brand === brand);

    $.each(assetModel, function (id, val) {
        dataModel.push({
            id: val.model,
            text: val.model_desc,
        });
    });
    $("#model_kendaraan").select2({
        placeholder: model_placeholder,
        dropdownParent: $("#model_kendaraan").parent(),
        data: dataModel,
        language: {
            noResults: function () {
                return lang === "id"
                    ? "Tidak Ada Hasil yang Ditemukan"
                    : "No Result Found";
            },
        },
    });
}

function getListBpkbOwnership(element) {
    dataBpkbOwnership = [];
    $(element).empty();
    var bpkb_placeholder = $(element).attr("placeholder");

    $.ajax({
        type: "GET",
        url: "/credit/get-list-bpkb-ownership",
        headers: { Authorization: "Basic " + currentToken },
        dataType: "json",
        error: function (xhr) {
            retryAjax(this, xhr);
        },
        fail: function (xhr, textStatus, error) {
            retryAjax(this, xhr);
        },
        success: function (result) {
            $.each(result.data, function (id, val) {
                dataBpkbOwnership.push({
                    id: val.id,
                    text: bpkbOwnershipTranslate(val.description),
                });
            });
            $(element).select2({
                placeholder: bpkb_placeholder,
                dropdownParent: $(element).parent(),
                data: dataBpkbOwnership,
                language: {
                    noResults: function () {
                        return lang === "id"
                            ? "Tidak Ada Hasil yang Ditemukan"
                            : "No Result Found";
                    },
                },
            });
        },
    });
}

function getListHouseOwnership(element) {
    dataHouseOwnership = [];
    $(element).empty();
    var house_placeholder = $(element).attr("placeholder");

    $.ajax({
        type: "GET",
        url: "/credit/get-list-house-ownership",
        headers: { Authorization: "Basic " + currentToken },
        dataType: "json",
        error: function (xhr) {
            retryAjax(this, xhr);
        },
        fail: function (xhr, textStatus, error) {
            retryAjax(this, xhr);
        },
        success: function (result) {
            $.each(result.data, function (id, val) {
                if (val.is_active === true) {
                    dataHouseOwnership.push({
                        id: val.id,
                        text: val.description,
                    });
                }
            });
            $(element).select2({
                placeholder: house_placeholder,
                dropdownParent: $(element).parent(),
                data: dataHouseOwnership,
                language: {
                    noResults: function () {
                        return lang === "id"
                            ? "Tidak Ada Hasil yang Ditemukan"
                            : "No Result Found";
                    },
                },
            });
        },
    });
}

function getBranchCoverage(fn) {
    let kelurahan = $("#kelurahan").val().toString();
    let kecamatan = $("#kecamatan").val().toString();
    let city = $("#kota").val().toString();
    let zipcode = $("#kode_pos").val();

    $.ajax({
        type: "POST",
        url: "/credit/get-branch-coverage",
        headers: { Authorization: "Basic " + currentToken },
        data: {
            kelurahan: kelurahan,
            kecamatan: kecamatan,
            city: city,
            zip_code: zipcode,
        },
        dataType: "json",
        error: function (xhr) {
            retryAjax(this, xhr);
        },
        fail: function (xhr, textStatus, error) {
            retryAjax(this, xhr);
        },
        success: function (result) {
            if (result.message === "success") {
                branch_id = result.data[0].branch_id;
                fn();
            }
        },
    });
}

function getAssetYear(asset_model, branch_id, fn) {
    let assetYears = [];
    let customerAssetYear = parseInt($("#tahun_kendaraan").val());
    var assetYearExists;

    $.ajax({
        type: "POST",
        url: "/credit/get-asset-year",
        headers: { Authorization: "Basic " + currentToken },
        // asset_code still static and need to be changed to parameter asset_model
        data: { asset_code: "CHEVROLET.SPARK.LS10MT", branch_id: branch_id },
        dataType: "json",
        error: function (xhr) {
            retryAjax(this, xhr);
        },
        fail: function (xhr, textStatus, error) {
            retryAjax(this, xhr);
        },
        success: function (result) {
            $.each(result.data.data, (i, val) => {
                assetYears.push(val.manufacturing_year);
            });
            if (assetYears.includes(customerAssetYear)) {
                assetYearExists = true;
                fn();
            } else {
                assetYearExists = false;
                $("#modal-not-cover").modal("show");
            }
        },
    });
}

$(".go-to-home").on("click", () => {
    window.location.href = "/";
});

function bpkbOwnershipTranslate(status) {
    switch (status) {
        case "Brother/Sister":
            return "Saudara kandung";
        case "Children":
            return "Anak";
        case "Family":
            return "Keluarga";
        case "Owner":
            return "Sendiri";
        case "Parent":
            return "Orang Tua";
        case "Spouse":
            return "Pasangan";
        case "Other":
            return "Lainnya";
        default:
            return status;
    }
}
