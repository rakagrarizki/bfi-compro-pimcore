const lang = document.documentElement.lang;
let appId = null;
let size = 0;
let isAssetLoaded = false;

let dataStep1 = {
    appId: null,
    name: "",
    phone_number: "",
    email: "",
    utm_source: "",
    utm_campaign: "",
    utm_term: "",
    utm_medium: "",
    utm_content: "",
};

let dataStep2 = {
    appId: null,
    province: "",
    city: "",
    district: "",
    subdistrict: "",
    zipcode: "",
    fullAddress: "",
    assetBrand: "",
    assetModel: "",
    assetYear: 2010,
};

let dataStep3 = {
    appId: null,
    needs: "",
    detailNeeds: "",
    funding: "",
    tenor: 0,
    buyDate: "",
    disclaimer: null,
};

$(document).ready(function () {
    lang == "id"
        ? $(".nav-item-1.active").find(".nav-step-tag").text("Sedang Isi")
        : $(".nav-item-1.active").find(".nav-step-tag").text("Onprogress");

    $.when(getAuthorizationToken()).then((res) => {
        getListAssets(1);
    });

    sessionStorage.setItem("loanType", "Syariah");
    isProvinceLoaded = false;
    addSelectPlaceholder([
        "#provinsi",
        "#kota",
        "#kecamatan",
        "#kelurahan",
        "#merk_kendaraan",
        "#model_kendaraan",
        "#tahun_kendaraan",
        "#tenor",
        "#needs",
    ]);
});

const getTenorList = () => {
    const placeholder = $("#tenor").attr("placeholder");
    const values = [
        {
            id: 24,
            text: "24 Bulan",
        },
        {
            id: 32,
            text: "32 Bulan",
        },
        {
            id: 48,
            text: "48 Bulan",
        },
    ];

    $("#tenor").select2({
        placeholder: placeholder,
        data: values,
    });
};

const getNeedList = () => {
    const placeholder = $("#needs").attr("placeholder");
    const values = [
        {
            id: "Sewa Ruko",
            text: "Sewa Ruko",
        },
        {
            id: "Wedding Organizer",
            text: "Wedding Organizer",
        },
        {
            id: "Biaya sekolah",
            text: "Biaya sekolah",
        },
        {
            id: "Kursus Keahlian Khusus",
            text: "Kursus Keahlian Khusus",
        },
        {
            id: "Jasa Arsitek",
            text: "Jasa Arsitek",
        },
        {
            id: "Jasa Renovasi Rumah",
            text: "Jasa Renovasi Rumah",
        },
        {
            id: "Lainnya",
            text: "Lainnya",
        },
    ];

    $("#needs").select2({
        placeholder: placeholder,
        data: values,
    });
};

const getAssetYearList = () => {
    const placeholder = $("#tahun_kendaraan").attr("placeholder");
    let values = [];

    for (let i = CURRENT_YEAR; i >= CURRENT_YEAR - 10; i--) {
        values.push({
            id: i,
            text: i,
        });
    }

    $("#tahun_kendaraan").select2({
        placeholder: placeholder,
        data: values,
    });
};

const getListAssets = function (pageSize) {
    $.ajax({
        type: "POST",
        url: "/credit/get-list-assets",
        headers: { Authorization: "Basic " + currentToken },
        data: {
            isactive: true,
            asset_type: "mobil",
            page: 1,
            size: pageSize,
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
                size = result.data.total_record;
                if (pageSize !== 1) {
                    $.each(result.data.data, (i, val) => {
                        dataAssets.push({
                            category: val.category_id,
                            model: val.model,
                            model_desc: val.model_desc,
                            brand: val.brand,
                            brand_desc: val.brand_desc,
                            asset_code: val.asset_code,
                            asset_group: val.asset_group,
                            asset_type_id: val.asset_type_id,
                        });
                    });
                    filterAssetBrand();
                    isAssetLoaded = true;
                }
            } else {
                console.log("Data not found");
            }
        },
    });
};

const filterAssetBrand = function () {
    var dataBrand = [];
    $("#merk_kendaraan").empty();
    var brand_placeholder = $("#merk_kendaraan").attr("placeholder");
    rawAssetBrand = dataAssets;

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
};

const filterAssetModel = function (brand) {
    var dataModel = [];
    $("#model_kendaraan").empty();
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
};

const saveDataStep1 = function (fn) {
    const data = (dataStep1 = {
        appId: appId,
        name: $("#nama_lengkap").val(),
        phone_number: $("#no_handphone").val(),
        email: $("#email_pemohon").val(),
        utm_source: sessionStorage.getItem("utm_source"),
        utm_campaign: sessionStorage.getItem("utm_campaign"),
        utm_term: sessionStorage.getItem("utm_term"),
        utm_medium: sessionStorage.getItem("utm_medium"),
        utm_content: sessionStorage.getItem("utm_content"),
    });

    $.ajax({
        type: "POST",
        url: "/syariah/save-myhajat-step1",
        data: data,
        dataType: "json",
        tryCount: 0,
        retryLimit: retryLimit,
        error: function (xhr, textStatus, err) {
            retryAjax(this, xhr);
        },
        fail: function (xhr, textStatus, err) {
            retryAjax(this, xhr);
        },
        success: function (res) {
            if (res.message === "success") {
                appId = res.data[0].id;
                fn();
            }
        },
    });
};

const saveDataStep2 = function (fn) {
    const assetBrand = $("#merk_kendaraan").select2("data");
    const assetModel = $("#model_kendaraan").select2("data");
    const assetYear = $("#tahun_kendaraan").select2("data");

    const data = (dataStep2 = {
        appId: appId,
        province_id: $("#provinsi").val().toString(),
        province: $("#provinsi option:selected").html(),
        city_id: $("#kota").val().toString(),
        city: $("#kota option:selected").html(),
        district_id: $("#kecamatan").val().toString(),
        district: $("#kecamatan option:selected").html(),
        subdistrict_id: $("#kelurahan").val().toString(),
        subdistrict: $("#kelurahan option:selected").html(),
        zipcode_id: $("#kode_pos").val().toString(),
        zipcode: $("#kode_pos").val().toString(),
        fullAddress: $("#alamat_lengkap").val(),
        assetBrand: assetBrand[0].text,
        assetModel: assetModel[0].text,
        assetYear: assetYear[0].text,
    });

    $.ajax({
        type: "POST",
        url: "/syariah/save-myhajat-step2",
        data: data,
        dataType: "json",
        tryCount: 0,
        retryLimit: retryLimit,
        error: function (xhr, textStatus, err) {
            retryAjax(this, xhr);
        },
        fail: function (xhr, textStatus, err) {
            retryAjax(this, xhr);
        },
        success: function (res) {
            if (res.message === "success") {
                fn();
            }
        },
    });
};

const saveDataStep3 = function (fn) {
    const selectedNeeds = $("#needs").select2("data");
    const selectedTenor = $("#tenor").select2("data");

    const data = (dataStep3 = {
        appId: appId,
        needs: selectedNeeds[0].text,
        detailNeeds: $("#detail-financing").val(),
        funding: clearDot($("#pembiayaan").val()),
        tenor: reverseTenorFormatter(selectedTenor[0].text),
        buyDate: $("#buy-date").val(),
        disclaimer:
            $("input[name='disclaimer']:checked").val() == "true"
                ? true
                : false,
    });

    $.ajax({
        type: "POST",
        url: "/syariah/save-myhajat-step3",
        data: data,
        dataType: "json",
        tryCount: 0,
        retryLimit: retryLimit,
        error: function (xhr, textStatus, err) {
            retryAjax(this, xhr);
        },
        fail: function (xhr, textStatus, err) {
            retryAjax(this, xhr);
        },
        success: function (res) {
            if (res.message === "success") {
                fn();
            }
        },
    });
};

const saveDataStep4 = function (fn) {
    const data = {
        appId: appId,
    };

    $.ajax({
        type: "POST",
        url: "/syariah/save-myhajat-step4",
        data: data,
        dataType: "json",
        tryCount: 0,
        retryLimit: retryLimit,
        error: function (xhr, textStatus, err) {
            retryAjax(this, xhr);
        },
        fail: function (xhr, textStatus, err) {
            retryAjax(this, xhr);
        },
        success: function (res) {
            if (res.message === "success") {
                fn();
            }
        },
    });
};

const saveDataStep5 = function (fn) {
    const data = {
        appId: appId,
    };

    $.ajax({
        type: "POST",
        url: "/syariah/save-myhajat-step5",
        data: data,
        dataType: "json",
        tryCount: 0,
        retryLimit: retryLimit,
        error: function (xhr, textStatus, err) {
            retryAjax(this, xhr);
        },
        fail: function (xhr, textStatus, err) {
            retryAjax(this, xhr);
        },
        success: function (res) {
            if (res.message === "success") {
                fn();
            }
        },
    });
};

$("#next1").on("click", function (e) {
    e.preventDefault();
    if ($(this).closest("form").valid()) {
        saveDataStep1(function () {
            if (!isAssetLoaded) {
                getListAssets(size);
            }
            if (!isProvinceLoaded) {
                getListProvinsi("#provinsi");
            }
            step("next", 1);
        });
    }
});

$("#next2").on("click", function (e) {
    e.preventDefault();
    if ($(this).closest("form").valid()) {
        saveDataStep2(() => {
            step("next", 2);
            getTenorList();
            getNeedList();
        });
    }
});

$("#next3").on("click", function (e) {
    e.preventDefault();
    if ($(this).closest("form").valid()) {
        saveDataStep3(() => {
            $("#modal-konfirmasi").modal("show");
        });
    }
});

$("#confirm-data").on("click", function (e) {
    e.preventDefault();
    saveDataStep4(() => {
        showOtpVer2();
    });
});

$("#next4").on("click", function (e) {
    e.preventDefault();
    if ($(this).closest("form").valid()) {
        verificationOTP(() => {
            saveDataStep5(() => {
                $("#menu4").removeClass("active");
                $("#success").addClass("active");
            })
        });
    }
});

$("#back1").on("click", function (e) {
    e.preventDefault();
    step("back", 1);
});

$("#back2").on("click", function (e) {
    e.preventDefault();
    step("back", 2);
});

$("#provinsi").change(function () {
    if ($(this).valid()) {
        getListCity("#kota");
    }
});

$("#kota").change(function () {
    if ($(this).valid()) {
        getListDistrict("#kecamatan");
    }
});

$("#kecamatan").change(function () {
    if ($(this).valid()) {
        getListSubdistrict("#kelurahan");
    }
});

$("#kelurahan").change(function () {
    if ($(this).valid()) {
        getListZipcode();
    }
});

$("#merk_kendaraan").change(() => {
    $("#model_kendaraan").empty();
    filterAssetModel($("#merk_kendaraan").val().toString());
});

$("#model_kendaraan").change(function () {
    if ($(this).valid()) {
        getAssetYearList();
    }
});
