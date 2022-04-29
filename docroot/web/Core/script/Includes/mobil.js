let lang = document.documentElement.lang;
var submission_id = undefined;

window.dataLayer = window.dataLayer || [];

let dataStep1 = {
    name: undefined,
    email: undefined,
    phone_number: undefined,
    wa_number: undefined,
    utm_source: undefined,
    utm_campaign: undefined,
    utm_term: undefined,
    utm_medium: undefined,
    utm_content: undefined,
};

let dataStep2 = {
    submission_id: undefined,
    info_address: {
        province_id_bfi: undefined,
        province_desc_bfi: undefined,
        city_id_bfi: undefined,
        city_desc_bfi: undefined,
        district_id_bfi: undefined,
        district_desc_bfi: undefined,
        subdistrict_id_bfi: undefined,
        subdistrict_desc_bfi: undefined,
        zipcode_id_bfi: undefined,
        zipcode_desc_bfi: undefined,
        full_address: undefined,
    },
    info_assets: {
        type_id_bfi: undefined,
        type_desc_bfi: undefined,
        brand_id_bfi: undefined,
        brand_desc_bfi: undefined,
        model_id_bfi: undefined,
        model_desc_bfi: undefined,
        vehicle_year_bfi: undefined,
        license_plate: undefined,
        asset_ownership_id_bfi: undefined,
        asset_ownership_desc_bfi: undefined,
    },
};

let dataStep3 = {
    submission_id: undefined,
    info_customer: {
        profession_id_bfi: undefined,
        profession_desc_bfi: undefined,
        salary: undefined,
        dob: undefined,
        marital_status_id_bfi: undefined,
        media_contact_option: undefined,
    },
    info_assets: {
        is_ktp_domicile_same: undefined,
        home_ownership_id_bfi: undefined,
        home_ownership_desc_bfi: undefined,
        asset_province_id_bfi: undefined,
        asset_province_desc_bfi: undefined,
        asset_city_id_bfi: undefined,
        asset_city_desc_bfi: undefined,
        asset_district_id_bfi: undefined,
        asset_district_desc_bfi: undefined,
        asset_subdistrict_id_bfi: undefined,
        asset_subdistrict_desc_bfi: undefined,
        asset_zipcode_id_bfi: undefined,
        asset_zipcode_desc_bfi: undefined,
        asset_full_address: undefined,
    },
    info_calculator: {
        funding: undefined,
        tenor: undefined,
        monthly_installment: undefined,
        vehicle_insurance: undefined,
        ltv_max: undefined,
        ntf_max: undefined,
    },
};

let dataStep4 = {
    submission_id: undefined,
    disclaimer: undefined,
};
window.onbeforeunload = null;
$(document).ready(function () {
    lang == "id"
        ? $(".nav-item-2.active").find(".nav-step-tag").text("Sedang Isi")
        : $(".nav-item-2.active").find(".nav-step-tag").text("Onprogress");

    getAuthorizationToken();
    $("#calcLoan").prop("disabled", false);
    sessionStorage.setItem("loanType", "NDFC");
    sessionStorage.setItem("submitStep1", "false");
    sessionStorage.setItem("submitStep2", "false");
    sessionStorage.setItem("submitStep3", "false");
    sessionStorage.setItem("submitStepOtp", "false");
});

$("input[name='is-wa-number']").click(function () {
    var is_WA = $(this).val();
    $(".wa-numbers").find("input").removeAttr("disabled");
    if (is_WA == "false") {
        $(".wa-numbers").removeAttr("hidden");
        // $("#email_pemohon").attr("disabled", true);
    } else {
        $(".wa-numbers").attr("hidden", true);
        $("#email_pemohon").removeAttr("disabled");
    }
});

var type_kendaraan = $("#type_kendaraan").attr("placeholder");
$("#type_kendaraan").select2({
    placeholder: type_kendaraan,
    dropdownParent: $("#type_kendaraan").parent(),
});

var merk_kendaraan = $("#merk_kendaraan").attr("placeholder");
$("#merk_kendaraan").select2({
    placeholder: merk_kendaraan,
    dropdownParent: $("#merk_kendaraan").parent(),
});

var model_kendaraan = $("#model_kendaraan").attr("placeholder");
$("#model_kendaraan").select2({
    placeholder: model_kendaraan,
    dropdownParent: $("#model_kendaraan").parent(),
});

var kepemilikan_bpkb = $("#kepemilikan_bpkb").attr("placeholder");
$("#kepemilikan_bpkb").select2({
    placeholder: kepemilikan_bpkb,
    dropdownParent: $("#kepemilikan_bpkb").parent(),
});

var kepemilikan_rumah = $("#kepemilikan_rumah").attr("placeholder");
$("#kepemilikan_rumah").select2({
    placeholder: kepemilikan_rumah,
    dropdownParent: $("#kepemilikan_rumah").parent(),
});

var marital_status = $("#marital_status").attr("placeholder");
$("#marital_status").select2({
    placeholder: marital_status,
    dropdownParent: $("#marital_status").parent(),
});

$("#next1").on("click", function (e) {
    e.preventDefault();
    if ($(this).closest("form").valid()) {
        pushDataStep1(() => {
            if (sessionStorage.getItem("submitStep1") === "false") {
                window.dataLayer.push({
                    event: "ValidFormNDFCStep1",
                });
                sessionStorage.setItem("submitStep1", "true");
            }
            step("next", 2);
            getAuthorizationToken();
            getListProvinsi("#provinsi");
            getListAssets("mobil");
            getListBpkbOwnership("#kepemilikan_bpkb");
        });
    }
});

$("#type_kendaraan").change(() => {
    filterAssetBrand($("#type_kendaraan").val().toString());
});

$("#merk_kendaraan").change(() => {
    filterAssetModel($("#merk_kendaraan").val().toString());
});

$("#next2").on("click", function (e) {
    e.preventDefault();
    if ($(this).closest("form").valid()) {
        pushDataStep2(() => {
            getDupcheck(() => {
                getBranchCoverage(() => {
                    getAssetYear(assetCode, branch_id, () => {
                        if ((assetYearExists = true)) {
                            if (
                                sessionStorage.getItem("submitStep2") ===
                                "false"
                            ) {
                                window.dataLayer.push({
                                    event: "ValidFormNDFCStep2",
                                });
                                sessionStorage.setItem("submitStep2", "true");
                            }
                            step("next", 3);
                            getListHouseOwnership("#kepemilikan_rumah");
                            getListMaritalStatus("#marital_status");
                            getMaxFunding();
                            $("#calcLoan").prop("disabled", false);
                            $("#brand-caption").text(
                                $("#merk_kendaraan").val().toString()
                            );
                            $("#model-caption").text(
                                $("#model_kendaraan option:selected").html()
                            );
                            $("#year-caption").text(
                                $("#tahun_kendaraan").val()
                            );
                        }
                    });
                });
            });
        });
    }
});
$("#next3").on("click", function (e) {
    e.preventDefault();
    if ($(this).closest("form").valid()) {
        $("#modal-konfirmasi").modal("show");
    }
});

$("#calcLoan").on("click", function () {
    getCalculationParams();
});

$("#confirm-data").on("click", function (e) {
    e.preventDefault();
    pushDataStep3(() => {
        if (sessionStorage.getItem("submitStep3") === "false") {
            window.dataLayer.push({
                event: "ValidFormNDFCStep3",
            });
            sessionStorage.setItem("submitStep3", "true");
        }
        pushDataStep4(() => {
            showOtpVer2();
        });
    });
    // step("next", 4);
    // $(".step-list").attr("hidden", "true");
});
$("#next5").on("click", function (e) {
    e.preventDefault();
    if ($(this).closest("form").valid()) {
        verificationOTP();
    }
});

$("#back2").on("click", function (e) {
    e.preventDefault();
    step("back", 2);
});
$("#back3").on("click", function (e) {
    e.preventDefault();
    step("back", 3);
});

function pushDataStep1(cb) {
    let result = (dataStep1 = {
        name: $("#nama_lengkap").val(),
        email: $("#email_pemohon").val(),
        phone_number: $("#no_handphone").val(),
        wa_number: $("#wa_number").val(),
        no_ktp: $("#idnumber").val(),
        utm_source: sessionStorage.getItem("utm_source"),
        utm_campaign: sessionStorage.getItem("utm_campaign"),
        utm_term: sessionStorage.getItem("utm_term"),
        utm_medium: sessionStorage.getItem("utm_medium"),
        utm_content: sessionStorage.getItem("utm_content"),
    });

    $.ajax({
        type: "POST",
        url: "/credit/save-car-leads1",
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
            if (res.message === "success") {
                submission_id = res.data.submission_id;
                cb(res);
            }
        },
    });
}

function pushDataStep2(cb) {
    assetCode = $("#model_kendaraan").val().toString();
    let result = (dataStep2 = {
        submission_id: submission_id,
        info_address: {
            province_id_bfi: $("#provinsi").val().toString(),
            province_desc_bfi: $("#provinsi option:selected").html(),
            city_id_bfi: $("#kota").val().toString(),
            city_desc_bfi: $("#kota option:selected").html(),
            district_id_bfi: $("#kecamatan").val().toString(),
            district_desc_bfi: $("#kecamatan option:selected").html(),
            subdistrict_id_bfi: $("#kelurahan").val().toString(),
            subdistrict_desc_bfi: $("#kelurahan option:selected").html(),
            zipcode_id_bfi: $("#kode_pos").val().toString(),
            zipcode_desc_bfi: $("#kode_pos").val().toString(),
            full_address: $("#alamat_lengkap").val(),
        },
        info_assets: {
            category_id_bfi: rawAssetBrand[0].asset_group,
            category_desc_bfi: rawAssetBrand[0].asset_group,
            type_id_bfi: $("#type_kendaraan").val().toString(),
            type_desc_bfi: $("#type_kendaraan").val().toString(),
            brand_id_bfi: $("#merk_kendaraan").val().toString(),
            brand_desc_bfi: $("#merk_kendaraan").val().toString(),
            model_id_bfi: $("#model_kendaraan").val().toString(),
            model_desc_bfi: $("#model_kendaraan option:selected").html(),
            vehicle_year_bfi: $("#tahun_kendaraan").val(), // setelah dupcheck baru cek pricelist
            license_plate: $("#plat-no").val(), // cek update dupcheck dulu
            asset_ownership_id_bfi: $("#kepemilikan_bpkb").val().toString(),
            asset_ownership_desc_bfi: $(
                "#kepemilikan_bpkb option:selected"
            ).html(),
        },
    });

    $.ajax({
        type: "POST",
        url: "/credit/save-car-leads2",
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
            if (res.message === "success") {
                cb(res);
            }
        },
    });
}

function pushDataStep3(cb) {
    var addres_same = $("input[name='addres_same']:checked").val();

    let result = (dataStep3 = {
        submission_id: submission_id,
        info_customer: {
            profession_id_bfi: $("input[name='occupation']:checked").val(),
            profession_desc_bfi: $("input[name='occupation']:checked").val(),
            salary: clearDot($("#penghasilan").val()),
            dob: $("#tgl_lahir").val(),
            marital_status_id_bfi: $("#marital_status").val().toString(),
            marital_status_desc_bfi: $(
                "#marital_status option:selected"
            ).html(),
            // TODO: change data below
            media_contact_option: "test",
        },
        info_assets: {
            is_ktp_domicile_same: addres_same,
            home_ownership_id_bfi: $("#kepemilikan_rumah").val().toString(),
            home_ownership_desc_bfi: $(
                "#kepemilikan_rumah option:selected"
            ).html(),
            asset_province_id_bfi:
                addres_same == "true" ? $("#provinsi").val().toString() : null,
            asset_province_desc_bfi:
                addres_same == "true"
                    ? $("#provinsi option:selected").html()
                    : null,
            asset_city_id_bfi:
                addres_same == "true" ? $("#kota").val().toString() : null,
            asset_city_desc_bfi:
                addres_same == "true"
                    ? $("#kota option:selected").html()
                    : null,
            asset_district_id_bfi:
                addres_same == "true" ? $("#kecamatan").val().toString() : null,
            asset_district_desc_bfi:
                addres_same == "true"
                    ? $("#kecamatan option:selected").html()
                    : null,
            asset_subdistrict_id_bfi:
                addres_same == "true" ? $("#kelurahan").val().toString() : null,
            asset_subdistrict_desc_bfi:
                addres_same == "true"
                    ? $("#kelurahan option:selected").html()
                    : null,
            asset_zipcode_id_bfi:
                addres_same == "true" ? $("#kode_pos").val().toString() : null,
            asset_zipcode_desc_bfi:
                addres_same == "true" ? $("#kode_pos").val().toString() : null,
            asset_full_address:
                addres_same == "true"
                    ? $("#alamat_lengkap").val().toString()
                    : null,
        },
        info_calculator: {
            funding: clearDot($("#pembiayaan").val()),
            tenor: reverseTenorFormatter($("#tenor").val()),
            // TODO: change data below
            monthly_installment: calculationParam.installment_amount,
            vehicle_insurance: "ARS-TLO",
            ltv_max: calculationParam.max_ltv,
            ntf_max: total_ntf,
        },
    });

    $.ajax({
        type: "POST",
        url: "/credit/save-car-leads3",
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
            if (res.message === "success") {
                cb(res);
            }
        },
    });
}

function pushDataStep4(cb) {
    let result = (dataStep4 = {
        submission_id: submission_id,
        disclaimer: true,
    });
    $.ajax({
        type: "POST",
        url: "/credit/save-car-leads4",
        data: result,
        dataType: "json",
        tryCount: 0,
        retryLimit: retryLimit,
        error: function (xhr, textStatus, errorThrown) {
            retryAjax(this, xhr);
        },
        fail: function (xhr, textStatus, error) {
            retryAjax(this, xhr);
        },
        success: function (result) {
            if (result.message === "success") {
                cb();
            }
        },
    });
}

function pushDataStep5() {
    $.ajax({
        type: "POST",
        url: "/credit/save-car-leads5",
        data: { submission_id: submission_id },
        dataType: "json",
        tryCount: 0,
        retryLimit: retryLimit,
        error: function (xhr, textStatus, errorThrown) {
            retryAjax(this, xhr);
        },
        fail: function (xhr, textStatus, error) {
            retryAjax(this, xhr);
        },
        success: function (result) {
            if (result.message === "success") {
                loginCust(dataStep1.phone_number);
                if (sessionStorage.getItem("submitStepOtp") === "false") {
                    window.dataLayer.push({
                        event: "ValidFormNDFCStepOTP",
                    });
                    sessionStorage.setItem("submitStepOtp", "true");
                }
                $("#menu5").removeClass("active");
                $("#success").addClass("active");
            }
        },
    });
}

function getDupcheck(cb) {
    let license_plate = $("#plat-no").val().replaceAll(" ", "");
    let phone_number = parseInt(dataStep1.phone_number);
    let dataDupcheck = {
        is_prospect: false,
        lead_program_id: "1",
        data_type_2: "Database",
        customer_type: "P",
        license_plate: license_plate,
        mobile_phone_1: phone_number,
    };

    $.ajax({
        type: "POST",
        url: "/credit/get-duplicate-leads",
        headers: { Authorization: "Basic " + currentToken },
        data: dataDupcheck,
        dataType: "json",
        error: function (xhr) {
            retryAjax(this, xhr);
        },
        fail: function (xhr, textStatus, error) {
            retryAjax(this, xhr);
        },
        success: function (result) {
            if (result.message === "success") {
                if (result.data.is_duplicate === true) {
                    window.location =
                        "/" +
                        lang +
                        "credit/pengajuan-gagal?dupcheck=true&product=" +
                        sessionStorage.getItem("loanType");
                } else {
                    cb();
                }
            }
        },
    });
}

function paginationList(data) {
    var html = "<ul>";
    $.each(data, function (index, item) {
        html +=
            "<li class='data-list' data-dismiss='modal'>" +
            item.subdistrict +
            "<p>" +
            item.district +
            "</p></li>";
    });
    html += "</ul>";
    $(".paginationjs-page").wrapAll("<div></div>");
    return html;
}

function clearPagination() {
    var pageContainer = $("#pagination-container");
    pageContainer.prev().html("");
    pageContainer.pagination("destroy");
}

function hideInsurance(element) {
    element.closest(".form-group").prop("hidden", true);
    element.prop("checked", false);
}

function showInsurance(element) {
    element.closest(".form-group").prop("hidden", false);
}

$("#tenor2").on("change", function () {
    let tenorValue = $(this).val();
    if (tenorValue === "1") {
        showInsurance($('input[name="assurance1"]'));
        hideInsurance($('input[name="assurance2"]'));
        hideInsurance($('input[name="assurance3"]'));
        hideInsurance($('input[name="assurance4"]'));
    } else if (tenorValue === "2") {
        showInsurance($('input[name="assurance1"]'));
        showInsurance($('input[name="assurance2"]'));
        hideInsurance($('input[name="assurance3"]'));
        hideInsurance($('input[name="assurance4"]'));
    } else if (tenorValue === "3") {
        showInsurance($('input[name="assurance1"]'));
        showInsurance($('input[name="assurance2"]'));
        showInsurance($('input[name="assurance3"]'));
        hideInsurance($('input[name="assurance4"]'));
    } else {
        showInsurance($('input[name="assurance1"]'));
        showInsurance($('input[name="assurance2"]'));
        showInsurance($('input[name="assurance3"]'));
        showInsurance($('input[name="assurance4"]'));
    }
    getMaxFunding();
});

$("#funding").on("change", function () {
    getMaxFunding();
});

$("#search-address-btn").on("click", () => {
    $("#pagination-container").pagination({
        dataSource: [
            {
                subdistrict: "Legok",
                district: "England",
            },
        ],
        pageSize: 5,
        pageRange: 1,
        callback: function (data, pagination) {
            var html = paginationList(data);
            $("#data-container").html(html);
        },
    });
});

$("#provinsi").change(() => {
    getListCity("#kota");
});

$("#kota").change(() => {
    getListDistrict("#kecamatan");
});

$("#kecamatan").change(() => {
    getListSubdistrict("#kelurahan");
});

$("#kelurahan").change(() => {
    getListZipcode();
});

$("body").on("click", ".data-list", (e) => {
    var kelurahan = e.currentTarget.firstChild.textContent;
    $("#kelurahan2").parent().removeAttr("hidden");
    $("#kelurahan2").removeAttr("disabled");
    $("#kelurahan2").val(kelurahan);
    $("#kelurahan2").addClass("valid");
    $("#kelurahan2").prev("label").addClass("valids");
    $("#kelurahan2").focus();
    $("#address-btn").parent().attr("hidden", true);
});
