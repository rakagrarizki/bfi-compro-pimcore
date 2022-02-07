let lang = document.documentElement.lang;
var submission_id = undefined;

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
    funding: undefined,
    tenor: undefined,
    monthly_installment: undefined,
    vehicle_insurance: undefined,
};

$(document).ready(function () {
    lang == "id"
        ? $(".nav-item-2.active").find(".nav-step-tag").text("Sedang Isi")
        : $(".nav-item-2.active").find(".nav-step-tag").text("Onprogress");

    sessionStorage.setItem("loanType", "NDFC");
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

$("#next1").on("click", function (e) {
    e.preventDefault();
    if ($(this).closest("form").valid()) {
        pushDataStep1(() => {
            getAuthorizationToken();
            getListProvinsi("#provinsi");
            getListAssets("mobil");
            getListBpkbOwnership("#kepemilikan_bpkb");
            step("next", 2);
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
            step("next", 3);
            getListHouseOwnership("#kepemilikan_rumah");
        });
    }
});
$("#next3").on("click", function (e) {
    e.preventDefault();
    $("#modal-konfirmasi").modal("show");
});
$("#confirm-data").on("click", function (e) {
    e.preventDefault();
    step("next", 4);
    $(".step-list").attr("hidden", "true");
});
$("#next5").on("click", function (e) {
    e.preventDefault();
    $("#menu5").removeClass("active");
    $("#success").addClass("active");
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
            city_desc_bfi: $("#kota").val().toString(),
            district_id_bfi: $("#kecamatan").val().toString(),
            district_desc_bfi: $("#kecamatan option:selected").html(),
            subdistrict_id_bfi: $("#kelurahan").val().toString(),
            subdistrict_desc_bfi: $("#kelurahan option:selected").html(),
            zipcode_id_bfi: $("#kode_pos").val().toString(),
            zipcode_desc_bfi: $("#kode_pos").val().toString(),
            full_address: $("#alamat_lengkap").val(),
        },
        info_assets: {
            category_id_bfi: asset_group, // ambil dari asset group
            category_desc_bfi: asset_group, // ambil dari asset group
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
