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

$(document).ready(function () {
    lang == "id"
        ? $(".nav-item-2.active").find(".nav-step-tag").text("Sedang Isi")
        : $(".nav-item-2.active").find(".nav-step-tag").text("Onprogress");

    getAuthorizationToken();
    setTimeout(function () {
        getListHouseOwnership("#kepemilikan_rumah");
        getListMaritalStatus("#marital_status");
    }, 1000);
    sessionStorage.setItem("loanType", "NDFC");
});

$("#tgl_lahir").datepicker({
    dateFormat: "yy-mm-dd",
});

$("input[name='is-wa-number']").click(function () {
    var is_WA = $(this).val();
    $(".wa-numbers").find("input").removeAttr("disabled");
    if (is_WA == "false") {
        $(".wa-numbers").removeAttr("hidden");
        $("#email_pemohon").attr("disabled", true);
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
            step("next", 2);
            window.dataLayer.push({
                event: "ValidFormNDFCStep1",
            });
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
            getBranchCoverage(() => {
<<<<<<< HEAD
                getAssetYear(
                    $("#model_kendaraan").val().toString(),
                    branch_id,
                    () => {
                        if ((assetYearExists = true)) {
                            step("next", 3);
                            window.dataLayer.push({
                                event: "ValidFormNDFCStep2",
                            });
                            getListHouseOwnership("#kepemilikan_rumah");
                            getListMaritalStatus("#marital_status");
                            getAuthorizationToken("bfidigital");
                            getDupcheck();
                        }
=======
                getAssetYear("CHEVROLET.SPARK.LS10MT", "401", () => {
                    if ((assetYearExists = true)) {
                        step("next", 3);
                        getAuthorizationToken();
                        getListHouseOwnership("#kepemilikan_rumah");
                        getListMaritalStatus("#marital_status");
                        // getAuthorizationToken("bfidigital");
                        // getDupcheck();
>>>>>>> bc4c445b (integration API submit step 3)
                    }
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
$("#confirm-data").on("click", function (e) {
    e.preventDefault();
<<<<<<< HEAD
    pushDataStep3();
    window.dataLayer.push({
        event: "ValidFormNDFCStep3",
    });
    // step("next", 4);
    // $(".step-list").attr("hidden", "true");
});
$("#next5").on("click", function (e) {
    e.preventDefault();

    // send data layer if otp success
    window.dataLayer.push({
        event: "ValidFormNDFCStepOTP",
    });
    $("#menu5").removeClass("active");
    $("#success").addClass("active");
=======
    pushDataStep3(() => {
        showOtpVer2();
        // step("next", 4);
        // $(".step-list").attr("hidden", "true");
    });
});
$("#next5").on("click", function (e) {
    e.preventDefault();
    if ($(this).closest("form").valid()) {
        verificationOTP();
        $("#menu5").removeClass("active");
        $("#success").addClass("active");
    }
>>>>>>> bc4c445b (integration API submit step 3)
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
            tenor: $("#tenor").val().toString(),
            monthly_installment: "40000000",
            vehicle_insurance: "ARS-TLO",
            ltv_max: 0.9,
            ntf_max: 100000000,
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

$("#search-address-btn").on("click", () => {
    $("#pagination-container").pagination({
        dataSource: [
            {
                subdistrict: "Legok",
                district: "England",
            },
            {
                subdistrict: "Legok",
                district: "Belgium",
            },
            {
                subdistrict: "Legok",
                district: "Ulan Bator",
            },
            {
                subdistrict: "Legok",
                district: "Wuhan",
            },
            {
                subdistrict: "Legok",
                district: "Pyongyang",
            },
            {
                subdistrict: "Legok",
                district: "Bali",
            },
            {
                subdistrict: "Legok",
                district: "Tangsel",
            },
            {
                subdistrict: "Legok",
                district: "NTT",
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
