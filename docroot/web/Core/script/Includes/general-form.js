var retryLimit = 3;

let currentToken = undefined;
let expiredDate = undefined;

let dataAssets = [];
let rawAssetBrand = [];
let assetCode = "";
let branch_id = "";
let admin_fee = 0;
let min_effective_rate = 0;
let max_funding_percentage = 0;
let ntfLifeInsurance = 0;
let ntfProvisi = 0;
let life_insurance_rate = 0;
let total_ntf = 0;
let provision_fee = 0;
let tlpAmount = 0;
let is_coverage = true;
let assetTypeId = "";
let categoryId = "";
let assetGroup = "";

window.dataLayer = window.dataLayer || [];

let calculationParam = {
    effective_rate: 0,
    flat_rate: 0,
    nilai_taksaksi: 0,
    max_ltv: 0,
    admin_fee: 0,
    fiducia_fee: 0,
    installment_amount: 0,
    provisi_fee: 0,
    total_life_insurance_capitalize: 0,
    total_asset_insurance_capitalize: 0,
    rsa_fee: 0,
};

let lifeInsuranceRate = [];
let lifeInsuranceCoy = [];
let assetInsuranceRate = [];
let assetInsuranceCoy = [];
let loanTenor = [];
let assetSize = 10;
let minFunding = 1000000;

const NDFM_PRODUCT_ID = "3138";
const NDFM_PRODUCT_OFFERING_ID = "31380218QC";
const NDFC_PRODUCT_ID_SJMB = "2001";
const NDFC_PRODUCT_OFFERING_ID_SJMB = "20010121AI";
const NDFC_PRODUCT_ID_NON = "2005";
const NDFC_PRODUCT_OFFERING_ID_NON = "20050121AI";
const NDFC_TENOR = [12, 24, 36, 48];
const NDFM_TENOR = [6, 12, 18];
const NDFM_TENOR_2 = [6, 12, 18, 24, 36];
const CURRENT_YEAR = new Date().getFullYear();

let dataZeals = {
    encrypted_code: undefined,
    aff_id: undefined,
    campaign_id: undefined,
    unique_random_code: undefined,
};

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

$("select.form-control").on("select2:select change", function (e) {
    // var data = e.params.data;
    var isValid = $(this).valid();
    var nextEl = $(this)
        .parent()
        .nextAll(".form-group")
        .find("select.form-control");
    if (isValid == true) {
        $(this).next().find(".select2-selection").addClass("valid");
        $(this).nextAll("div").html("");
        // nextEl.removeAttr("disabled");
    } else {
        $.each(nextEl, function () {
            if ($(this).val() == "" || $(this).val() == []) {
                $(this).next().find(".select2-selection").removeClass("valid");
            }
        });
        $(this).next().find(".select2-selection").removeClass("valid");
        // nextEl.attr("disabled", true);
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

// inputDisabled();
// function inputDisabled() {
//     $("input, select, textarea").addClass("input-step");
//     $(".form-body--credit")
//         .find(".input-step:not(:eq(0))")
//         .attr("disabled", true);
//     $(".form-body--credit .otp-number")
//         .find(".input-step")
//         .removeAttr("disabled");
// }

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

                sessionStorage.setItem("gatewayToken", currentToken);
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
                getBranchCoverage(() => {
                    $("#merk_kendaraan").removeAttr("disabled");
                });
            } else {
                console.log("Data not found");
            }
        },
    });
}

function getAssetBrand(element, product) {
    const ASSET_BRAND = product === "MOBIL" ? CAR_BRAND : MOTOR_BRAND;
    let dataList = [];
    $(element).empty();
    var selectPlaceholder = $(element).attr("placeholder");

    $.each(ASSET_BRAND, function (id, val) {
        dataList.push({
            id: val.id,
            text: val.value,
        });
    });
    $(element).select2({
        placeholder: selectPlaceholder,
        dropdownParent: $(element).parent(),
        data: dataList,
        language: {
            noResults: function () {
                return lang === "id"
                    ? "Tidak Ada Hasil yang Ditemukan"
                    : "No Result Found";
            },
        },
    });
}

function getAssetType(element, product) {
    var dataAssetType = [];
    $(element).empty();
    var elm_placeholder = $(element).attr("placeholder");
    const assetParent = $("#merk_kendaraan").val().toString();

    $.ajax({
        type: "POST",
        url: "/credit/get-list-asset-type",
        headers: { Authorization: "Basic " + currentToken },
        data: { asset_type_id: product, asset_parent: assetParent },
        dataType: "json",
        error: function (xhr) {
            retryAjax(this, xhr);
        },
        fail: function (xhr, textStatus, error) {
            retryAjax(this, xhr);
        },
        success: function (result) {
            const filterByType =
                product === "MOBIL" ? CAR_FILTERED_TYPE : MOTOR_FILTERED_TYPE;
            $.each(result.data.data, function (id, val) {
                if (!filterByType.includes(val.id)) {
                    dataAssetType.push({
                        id: val.id,
                        text: val.value,
                    });
                }
            });
            $(element).select2({
                placeholder: elm_placeholder,
                dropdownParent: $(element).parent(),
                data: dataAssetType,
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

function getAssetModel(element, product) {
    var dataAssetModel = [];
    $(element).empty();
    var elm_placeholder = $(element).attr("placeholder");
    const assetParent = $("#type_kendaraan").val().toString();

    $.ajax({
        type: "POST",
        url: "/credit/get-list-asset-model",
        headers: { Authorization: "Basic " + currentToken },
        data: { asset_type_id: product, asset_parent: assetParent },
        dataType: "json",
        error: function (xhr) {
            retryAjax(this, xhr);
        },
        fail: function (xhr, textStatus, error) {
            retryAjax(this, xhr);
        },
        success: function (result) {
            const filterByModel =
                product === "MOBIL" ? CAR_FILTERED_MODEL : MOTOR_FILTERED_MODEL;
            $.each(result.data.data, function (id, val) {
                if (!filterByModel.includes(val.id)) {
                    dataAssetModel.push({
                        id: val.id,
                        text: val.value,
                    });
                }
            });
            $(element).select2({
                placeholder: elm_placeholder,
                dropdownParent: $(element).parent(),
                data: dataAssetModel,
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

function getAssetModelDetail(product) {
    const model = $("#model_kendaraan").val().toString();

    $.ajax({
        type: "POST",
        url: "/credit/get-list-asset-detail-model",
        headers: { Authorization: "Basic " + currentToken },
        data: { asset_type_id: product, model: model },
        dataType: "json",
        error: function (xhr) {
            retryAjax(this, xhr);
        },
        fail: function (xhr, textStatus, error) {
            retryAjax(this, xhr);
        },
        success: function (result) {
            if (result.message === "success") {
                assetTypeId = result.data.data[0].asset_type_id;
                categoryId = result.data.data[0].category_id;
                assetGroup = result.data.data[0].asset_group;
            }
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
            $.each(result.data.data, function (id, val) {
                if (val.is_active === true) {
                    dataHouseOwnership.push({
                        id: val.an_bkr_id,
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

function getHouseOwnership(element, category) {
    let dataHouseOwnership = [];
    $(element).empty();
    var house_placeholder = $(element).attr("placeholder");

    $.ajax({
        type: "GET",
        url: "/credit/get-house-ownership",
        data: { category: category },
        dataType: "json",
        error: function (xhr) {
            retryAjax(this, xhr);
        },
        fail: function (xhr, textStatus, error) {
            retryAjax(this, xhr);
        },
        success: function (result) {
            if (result.success === 1) {
                $.each(result.data, function (id, val) {
                    dataHouseOwnership.push({
                        id: val.id,
                        text: val.desc,
                    });
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
            }
        },
    });
}

function getListMaritalStatus(element) {
    dataMaritalStatus = [];
    $(element).empty();
    var marital_status_placeholder = $(element).attr("placeholder");

    $.ajax({
        type: "GET",
        url: "/credit/get-list-data-marital-status",
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
                dataMaritalStatus.push({
                    id: val.id,
                    text: maritalStatusTranslate(val.description),
                });
            });
            $(element).select2({
                placeholder: marital_status_placeholder,
                dropdownParent: $(element).parent(),
                data: dataMaritalStatus,
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
            customer_type: "P",
            lead_program_id: 1,
            kelurahan: kelurahan,
            kecamatan: kecamatan,
            city: city,
            zipcode: zipcode,
            is_branch_ho: true,
            customer_status: "NEW",
            is_ro_exp: false,
            lead_id: 0,
            idnumber: $("#idnumber").val(),
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
                if (result.data !== null) {
                    branch_id = result.data.branch_booking_id;
                    fn();
                } else {
                    $("#modal-branch").modal("show");
                }
            } else {
                loanType = sessionStorage.getItem("loanType");
                if (loanType == "NDFC") {
                    window.dataLayer.push({
                        event: "ValidNDFCAssetNotCover",
                    });
                } else {
                    window.dataLayer.push({
                        event: "ValidNDFMAssetNotCover",
                    });
                }
                $("#modal-branch").modal("show");
            }
        },
    });
}

function getAssetYear(asset_model, branch_id) {
    const dropdownYears = $("#tahun_kendaraan");
    const dropdownPlaceholder = dropdownYears.attr("placeholder");
    let listYears = [];
    dropdownYears.empty();

    $.ajax({
        type: "POST",
        url: "/credit/get-asset-year",
        headers: { Authorization: "Basic " + currentToken },
        data: { asset_code: asset_model, branch_id: branch_id },
        dataType: "json",
        error: function (xhr) {
            retryAjax(this, xhr);
        },
        fail: function (xhr, textStatus, error) {
            retryAjax(this, xhr);
        },
        success: function (result) {
            if (result.message === "success" && result.data !== null) {
                $.each(result.data.data, (i, val) => {
                    listYears.push({
                        id: val.manufacturing_year,
                        text: val.manufacturing_year,
                    });
                });

                dropdownYears.select2({
                    placeholder: dropdownPlaceholder,
                    dropdownParent: dropdownYears.parent(),
                    data: listYears,
                    language: {
                        noResults: function () {
                            return lang === "id"
                                ? "Tidak Ada Hasil yang Ditemukan"
                                : "No Result Found";
                        },
                    },
                });
                is_coverage = true;
            } else {
                listYears = [];
                is_coverage = false;
            }
            toggleInputYear(is_coverage);
        },
    });
}

function getProductDetail() {
    let assetYear = parseInt($("#tahun_kendaraan").val().toString());
    let assetAge = CURRENT_YEAR - assetYear;
    let tenor = loanTenor[$("#tenor2").val() - 1];
    let amount_funding =
        $("#pembiayaan").val() === ""
            ? minFunding
            : clearDot($("#pembiayaan").val());
    let param = {
        product_id: productIdFilter(categoryId),
        asset_group: assetGroup,
        customer_rating: "2",
        asset_age: assetAge,
        tenor: tenor,
        amount_funding_to: amount_funding,
    };

    return $.ajax({
        type: "POST",
        url: "/credit/get-list-product-detail",
        headers: { Authorization: "Basic " + currentToken },
        data: param,
        dataType: "json",
        error: function (xhr) {
            retryAjax(this, xhr);
        },
        fail: function (xhr, textStatus, error) {
            retryAjax(this, xhr);
        },
        success: function (result) {
            if (result.message !== "success") {
                console.log("Failed to fetch data");
            }
        },
    });
}

function getProductBranchDetail() {
    let assetYear = parseInt($("#tahun_kendaraan").val().toString());
    let assetAge = CURRENT_YEAR - assetYear;
    let tenor = loanTenor[$("#tenor2").val() - 1];
    let amount_funding =
        $("#pembiayaan").val() === ""
            ? minFunding
            : clearDot($("#pembiayaan").val());
    let param = {
        branch_id: branch_id,
        product_id: productIdFilter(categoryId),
        asset_group: assetGroup,
        customer_rating: "2",
        asset_age: assetAge,
        tenor: tenor,
        amount_funding_to: amount_funding,
    };

    return $.ajax({
        type: "POST",
        url: "/credit/get-list-product-branch-detail",
        headers: { Authorization: "Basic " + currentToken },
        data: param,
        dataType: "json",
        error: function (xhr) {
            retryAjax(this, xhr);
        },
        fail: function (xhr, textStatus, error) {
            retryAjax(this, xhr);
        },
        success: function (result) {
            if (result.message !== "success") {
                console.log("Failed to fetch data");
            }
        },
    });
}

function getProductOfferingDetail() {
    let assetYear = parseInt($("#tahun_kendaraan").val().toString());
    let assetAge = CURRENT_YEAR - assetYear;
    let tenor = loanTenor[$("#tenor2").val() - 1];
    let amount_funding =
        $("#pembiayaan").val() === ""
            ? minFunding
            : clearDot($("#pembiayaan").val());
    let param = {
        branch_id: branch_id,
        product_id: productIdFilter(categoryId),
        product_offering_id: productOfferingIdFilter(
            productIdFilter(categoryId)
        ),
        asset_group: assetGroup,
        customer_rating: "2",
        asset_age: assetAge,
        tenor: tenor,
        amount_funding_to: amount_funding,
        is_current_setting_value: true,
        is_active: true,
    };

    return $.ajax({
        type: "POST",
        url: "/credit/get-product-offer-detail",
        headers: { Authorization: "Basic " + currentToken },
        data: param,
        dataType: "json",
        error: function (xhr) {
            retryAjax(this, xhr);
        },
        fail: function (xhr, textStatus, error) {
            retryAjax(this, xhr);
        },
        success: function (result) {
            if (result.message !== "success") {
                console.log("Failed to fetch data");
            }
            provision_fee = result.data.data[0].provision_fee;
        },
    });
}

function getFiduciaFee() {
    let param = {
        branch_id: branch_id,
        asset_type_id: assetTypeId,
        category_id: categoryId,
        otr: calculationParam.nilai_taksaksi,
    };

    return $.ajax({
        type: "POST",
        url: "/credit/get-fiducia-fee",
        headers: { Authorization: "Basic " + currentToken },
        data: param,
        dataType: "json",
        error: function (xhr) {
            retryAjax(this, xhr);
        },
        fail: function (xhr, textStatus, error) {
            retryAjax(this, xhr);
        },
        success: function (result) {
            if (result.success === 1) {
                if (result.data !== null) {
                    calculationParam.fiducia_fee =
                        sessionStorage.getItem("loanType") === "NDFM"
                            ? result.data.data[0].fiducia_fee
                            : result.data.data[0].notary_fee;
                } else {
                    calculationParam.fiducia_fee = 0;
                }
            } else {
                console.log("Failed to fetch data");
            }
        },
    });
}

function getPricelistPaging() {
    let assetYear = $("#tahun_kendaraan").val().toString();
    $.ajax({
        type: "POST",
        url: "/credit/get-list-price",
        headers: { Authorization: "Basic " + currentToken },
        data: {
            asset_code: assetCode,
            manufacturing_year: assetYear,
            branch_id: branch_id,
        },
        dataType: "json",
        error: function (xhr) {
            retryAjax(this, xhr);
        },
        fail: function (xhr, textStatus, error) {
            retryAjax(this, xhr);
        },
        success: function (result) {
            if (result.success === 1) {
                if (result.data !== null) {
                    calculationParam.nilai_taksaksi = result.data.data[0].price;
                    getMaxFunding();
                } else {
                    $("#modal-pricing").modal("show");
                }
            } else {
                console.log("Failed to fetch data");
            }
        },
    });
}

function getLifeInsuranceCoy() {
    let param = {
        branch_id: branch_id,
        is_active: true,
    };

    return $.ajax({
        type: "POST",
        url: "/credit/get-life-insurance-coy-branch",
        headers: {
            Authorization: "Basic " + currentToken,
        },
        data: param,
        dataType: "json",
        error: function (xhr) {
            retryAjax(this, xhr);
        },
        fail: function (xhr, textStatus, error) {
            retryAjax(this, xhr);
        },
        success: function (result) {
            if (result.success === 1) {
                if (result.data !== null) {
                    lifeInsuranceCoy = result.data.data;
                } else {
                    lifeInsuranceCoy = null;
                }
            } else {
                console.log("Failed to fetch data");
            }
        },
    });
}

function getLifeInsuranceRate() {
    let fund = clearDot($("#pembiayaan").val());
    let ntfAwal =
        (fund +
            calculationParam.admin_fee +
            calculationParam.fiducia_fee +
            calculationParam.rsa_fee) /
        (1 - provision_fee / 100);

    let paramInsuranceRateNew = {
        branch_id: branch_id,
        age: 25,
        si: ntfAwal,
        tenor: reverseTenorFormatter($("#tenor").val()),
    };

    let paramInsuranceRate = {
        branch_id: branch_id,
        age: 25,
        tenor: reverseTenorFormatter($("#tenor").val()),
        insurance_branch_active: true,
        asset_type_id: assetTypeId,
    };

    let param = fund > 20000000 ? paramInsuranceRate : paramInsuranceRateNew;
    let url =
        fund > 20000000
            ? "/credit/get-life-insurance-rate"
            : "/credit/get-life-insurance-rate-new";

    return $.ajax({
        type: "POST",
        url: url,
        headers: { Authorization: "Basic " + currentToken },
        data: param,
        dataType: "json",
        error: function (xhr) {
            retryAjax(this, xhr);
        },
        fail: function (xhr, textStatus, error) {
            retryAjax(this, xhr);
        },
        success: function (result) {
            if (result.success === 1) {
                if (result.data !== null) {
                    lifeInsuranceRate = result.data.data;
                } else {
                    lifeInsuranceRate = null;
                }
            } else {
                console.log("Failed to fetch data");
            }
        },
    });
}

function getLifeInsuranceAmount() {
    let fund = clearDot($("#pembiayaan").val());
    if (lifeInsuranceRate !== null) {
        let result = lifeInsuranceRate.filter(function (arr1) {
            return lifeInsuranceCoy.some(function (arr2) {
                return (
                    arr1.life_insurance_coy_id === arr2.life_insurance_coy_id &&
                    arr1.life_insurance_coy_branch_id ===
                        arr2.life_insurance_coy_branch_id
                );
            });
        });
        life_insurance_rate =
            fund > 20000000
                ? result[0].ins_rate_to_cust
                : result[0].ins_amount_to_cust;
        //     calculationParam.total_life_insurance_capitalize =
        //         fund > 20000000
        //             ? (result[0].ins_rate_to_cust * ntf) / 100
        //             : result[0].ins_amount_to_cust;
    }
}

function getMaxFunding() {
    $.when(
        getProductOfferingDetail(),
        getProductBranchDetail(),
        getProductDetail()
    ).then(function (res1, res2, res3) {
        if (!res1[0].data || !res2[0].data || !res3[0].data) {
            $("#modal-pricing").modal("show");
            return;
        }
        admin_fee =
            res1[0].data.data[0].admin_fee +
            res2[0].data.data[0].admin_fee +
            res3[0].data.data[0].admin_fee;

        min_effective_rate =
            res1[0].data.data[0].min_effective_rate +
            res2[0].data.data[0].min_effective_rate +
            res3[0].data.data[0].min_effective_rate;

        max_funding_percentage = $("#ndf_max_fund").val();

        calculationParam.max_ltv =
            (max_funding_percentage / 100) * calculationParam.nilai_taksaksi;

        $(".ndfc-simulasi .total").text(
            "Rp " + separatordot(calculationParam.max_ltv)
        );

        $("#funding").slider({
            min: minFunding,
            max: calculationParam.max_ltv,
            step: 100000,
        });

        $(".min-fund").text("Rp " + separatordot(minFunding));
        $(".max-fund").text("Rp " + separatordot(calculationParam.max_ltv));
    });
}

function getCalculationParams() {
    let tenor = reverseTenorFormatter($("#tenor").val());
    let fund = clearDot($("#pembiayaan").val());
    $.when(getFiduciaFee(), getLifeInsuranceRate(), getLifeInsuranceCoy()).then(
        function (res1, res2, res3) {
            calculationParam.effective_rate = min_effective_rate / 100;
            calculationParam.admin_fee = admin_fee + tlpAmount;
            calculationParam.flat_rate =
                ((pmt(calculationParam.effective_rate / 12, tenor, 1, 0, 0) *
                    -1 *
                    tenor -
                    1) *
                    12) /
                tenor;

            getLifeInsuranceAmount();

            if (fund > 20000000) {
                ntfLifeInsurance =
                    (fund +
                        calculationParam.admin_fee +
                        calculationParam.fiducia_fee +
                        calculationParam.rsa_fee) /
                    (1 - provision_fee / 100 + life_insurance_rate / 100);
            } else {
                ntfLifeInsurance =
                    (fund +
                        calculationParam.admin_fee +
                        calculationParam.fiducia_fee +
                        calculationParam.rsa_fee +
                        life_insurance_rate) /
                    (1 - provision_fee / 100);
            }

            calculationParam.total_life_insurance_capitalize =
                fund > 20000000
                    ? (life_insurance_rate / 100) * ntfLifeInsurance
                    : life_insurance_rate;
            calculationParam.provisi_fee =
                ntfLifeInsurance * (provision_fee / 100);

            // getProvisionAmout();
            getEstimateInstallment();
        }
    );
}

function getProvisionAmout() {
    let fund = clearDot($("#pembiayaan").val());
    let tenor = reverseTenorFormatter($("#tenor").val());
    let provisi_fee_percentage = ((tenor / 12) * provision_fee) / 100;
    // calculationParam.provisi_fee = provisi_fee_percentage * ntf;
}

function getEstimateInstallment() {
    let param = {
        funding_amount: clearDot($("#pembiayaan").val()),
        tenor: reverseTenorFormatter($("#tenor").val()),
        effective_rate: calculationParam.effective_rate,
        flat_rate: calculationParam.flat_rate,
        installment_type: 0,
        payment_fequency: 1,
        calcualte_by: 1,
        grace_periode_type: 0,
        grace_periode: 0,
        nilai_taksaksi: calculationParam.nilai_taksaksi,
        max_ltv: calculationParam.max_ltv,
        admin_fee: calculationParam.admin_fee,
        fiducia_fee: calculationParam.fiducia_fee,
        provisi_fee: calculationParam.provisi_fee,
        total_life_insurance_capitalize:
            calculationParam.total_life_insurance_capitalize,
        total_asset_insurance_capitalize:
            calculationParam.total_asset_insurance_capitalize,
        rsa_fee: calculationParam.rsa_fee,
        other_fee: 0,
        survey_fee: 0,
        notary_fee: 0,
        admin_on_loan: true,
        fiducia_on_loan: true,
        provisi_on_loan: true,
        other_on_loan: true,
        survey_on_loan: true,
        notary_on_loan: true,
        rsa_on_loan: true,
        round: 500,
    };

    $.ajax({
        type: "POST",
        url: "/credit/get-estimate-installment",
        headers: { Authorization: "Basic " + currentToken },
        data: param,
        dataType: "json",
        error: function (xhr) {
            retryAjax(this, xhr);
        },
        fail: function (xhr) {
            retryAjax(this, xhr);
        },
        success: function (result) {
            if (result.message === "success") {
                calculationParam.installment_amount = result.data.installment;
                total_ntf = result.data.total_ntf;
                $("p.estimate-installment").text(
                    "Rp " + separatordot(calculationParam.installment_amount)
                );
            } else {
                console.log("Data not found");
            }
        },
    });
}

function productIdFilter(category) {
    const categorySJMB = ["SEDAN", "JEEP", "MNBUS"];
    if (sessionStorage.getItem("loanType") === "NDFM") {
        return NDFM_PRODUCT_ID;
    }
    return categorySJMB.includes(category)
        ? NDFC_PRODUCT_ID_SJMB
        : NDFC_PRODUCT_ID_NON;
}

function productOfferingIdFilter(productId) {
    if (productId === NDFM_PRODUCT_ID) {
        return NDFM_PRODUCT_OFFERING_ID;
    } else if (productId === NDFC_PRODUCT_ID_SJMB) {
        return NDFC_PRODUCT_OFFERING_ID_SJMB;
    }
    return NDFC_PRODUCT_OFFERING_ID_NON;
}

function pmt(
    rate_per_period,
    number_of_payments,
    present_value,
    future_value,
    type
) {
    future_value = typeof future_value !== "undefined" ? future_value : 0;
    type = typeof type !== "undefined" ? type : 0;

    if (rate_per_period != 0.0) {
        // Interest rate exists
        var q = Math.pow(1 + rate_per_period, number_of_payments);
        return (
            -(rate_per_period * (future_value + q * present_value)) /
            ((-1 + q) * (1 + rate_per_period * type))
        );
    } else if (number_of_payments != 0.0) {
        // No interest rate, but number of payments exists
        return -(future_value + present_value) / number_of_payments;
    }

    return 0;
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
function maritalStatusTranslate(status) {
    switch (status) {
        case "Divorce":
            return "Cerai";
        case "Married":
            return "Menikah";
        case "Single":
            return "Belum Menikah";
        case "Widow":
            return "Janda";
        default:
            return status;
    }
}

function clearDot(x) {
    let removeDot = x.replace(/\./g, "");
    let result = validNumber(parseInt(removeDot));
    return result;
}

function validNumber(value) {
    var clearVal = "";
    return Number.isInteger(value) == true ? value : clearVal;
}

function tenorFormatter(x) {
    x = x + " Bulan";
    return x;
}

function reverseTenorFormatter(x) {
    try {
        x = parseInt(x.replace(" Bulan", ""));
    } catch (e) {
        x = 0;
    }
    return x;
}

$("#tenor2").on("change", function () {
    let selectedTenor = parseInt($(this).val());
    $("#tenor").val(tenorFormatter(loanTenor[selectedTenor - 1]));
});

function toggleInputYear(isCover) {
    if (isCover) {
        $("#tahun_kendaraan").closest(".form-group").removeAttr("hidden");
        $("#tahun_kendaraan_text")
            .closest(".form-group")
            .attr("hidden", "hidden");
    } else {
        $("#tahun_kendaraan").closest(".form-group").attr("hidden", "hidden");
        $("#tahun_kendaraan_text").closest(".form-group").removeAttr("hidden");
    }
}

function submissionRegister(submission_id) {
    var submissionId = {
        submission_id: submission_id,
    };

    $.ajax({
        type: "POST",
        url: "/submission-register",
        data: submissionId,
        dataType: "json",
        error: function (data) {
            // console.log("error" + data);
        },
        fail: function (xhr, textStatus, error) {
            // console.log("request failed");
        },
        success: function (data) {
            if (data.success === "1") {
                phone_number = data.data.phone_number;
            }
        },
    });
}

function submissionLogin(phone) {
    var lang = document.documentElement.lang;
    var phoneNumber = {
        phone_number: phone,
    };

    $.ajax({
        type: "POST",
        url: "/submission-login",
        data: phoneNumber,
        dataType: "json",
        error: function (data) {
            // console.log("error" + data);
        },
        fail: function (xhr, textStatus, error) {
            // console.log("request failed");
        },
        success: function (data) {
            if (data.success === "1") {
                var token = data.data.customer_token;
                localStorage.setItem("token", token);
                getCustomer(token);
                window.location = "/" + lang + "/user/dashboard";
            } else {
                // console.log(data);
            }
        },
    });
}

function CbTransactionZeals() {
    const loanType = sessionStorage.getItem("loanType");
    if (loanType == "PBF") {
        campaign_id = "30092";
    } else if (loanType == "NDFC") {
        campaign_id = "82771";
    } else {
        campaign_id = "98392";
    }

    let result = (dataZeals = {
        encrypted_code: sessionStorage.getItem("encrypted_code"),
        aff_id: "89621771",
        campaign_id: campaign_id,
        unique_random_code: "encrypt_code_zeal",
    });

    $.ajax({
        type: "POST",
        url: "/credit/data-zeals",
        data: result,
        dataType: "json",
        tryCount: 0,
        retryLimit: retryLimit,
        error: (xhr, textStatus, err) => {
            retryAjax(this, xhr);
        },
        fail: (xhr, textStatus, err) => {
            retryAjax(this, xhr);
        },
        success: (res) => {
            if (res.status === "success") {
                console.log(res);
            }
            console.log("sukses");
        },
    });
}

function errorHandling(element, button) {
    const errorPos = $(element).find(".inputs.error")[0];
    const nextBtn = $(`#${button}`);

    $("html, body").animate(
        {
            scrollTop: $(errorPos).offset().top - 130,
        },
        400
    );

    nextBtn.addClass("btn-danger").css({
        width: "185px",
        padding: "13px 0px",
        "font-weight": "bold",
        "font-size": "16px",
        "text-transform": "uppercase",
        "margin-bottom": "1.5rem",
        height: "50px",
    });
    nextBtn.removeClass("cta-primary");
    setTimeout(function () {
        nextBtn.removeClass("btn-danger");
        nextBtn.addClass("cta-primary");
    }, 2000);
}
