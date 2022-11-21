const lang = document.documentElement.lang;
let appId = null;

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
};

let dataStep3 = {
    appId: null,
    assetBrand: "",
    assetYear: 2010,
    isAvailable: "",
    needs: "",
    estimatePriceVehicle: "",
    tenor: 0,
    buyDate: "",
    disclaimer: null,
};

$(document).ready(function () {
    lang == "id"
        ? $(".nav-item-1.active").find(".nav-step-tag").text("Sedang Isi")
        : $(".nav-item-1.active").find(".nav-step-tag").text("Onprogress");

    getAuthorizationToken();

    sessionStorage.setItem("loanType", "Syariah");
    isProvinceLoaded = false;
    addSelectPlaceholder([
        "#provinsi",
        "#kota",
        "#kecamatan",
        "#kelurahan",
        "#tenor",
        "#needs",
    ]);

    $("#funding").slider({});
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
        {
            id: 60,
            text: "60 Bulan",
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
            id: "Uang Muka Pendidikan",
            text: "Uang Muka Pendidikan",
        },
        {
            id: "Kursus",
            text: "Kursus",
        },
        {
            id: "Pendidikan S1/S2/S3",
            text: "Pendidikan S1/S2/S3",
        },
        {
            id: "Pesantren/Boarding School",
            text: "Pesantren/Boarding School",
        },
    ];

    $("#needs").select2({
        placeholder: placeholder,
        data: values,
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
        url: "/syariah/save-mycars-step1",
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
                appId = res.data.appId;
                fn();
            }
        },
    });
};

const saveDataStep2 = function (fn) {
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
    });

    $.ajax({
        type: "POST",
        url: "/syariah/save-mycars-step2",
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
    const selectedTenor = $("#tenor").select2("data");

    const data = (dataStep3 = {
        appId: appId,
        assetBrand: $("#merk_kendaraan").val(),
        assetYear: $("#tahun_kendaraan_text").val(),
        isAvailable: $("input[name='is-asset-available']:checked").val(),
        estimatePriceVehicle:
            clearDot($("#minimum").val()) +
            "-" +
            clearDot($("#maksimum").val()),
        tenor: reverseTenorFormatter(selectedTenor[0].text),
        buyDate: $("#buy-date").val(),
        disclaimer:
            $("input[name='disclaimer']:checked").val() == "true"
                ? true
                : false,
    });

    $.ajax({
        type: "POST",
        url: "/syariah/save-mycars-step3",
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
        url: "/syariah/save-mycars-step4",
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
        url: "/syariah/save-mycars-step5",
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
            $("#minimum").val(separatordot(50000000));
            $("#maksimum").val(separatordot(100000000));
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

$("#funding").on("change", function () {
    const min = separatordot($(this).val().split(",")[0]);
    const max = separatordot($(this).val().split(",")[1]);

    $("#minimum").val(min);
    $("#maksimum").val(max);
});
