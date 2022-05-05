let lang = document.documentElement.lang;
var submission_id = "";

let dataStep1 = {
    name: undefined,
    email: undefined,
    phone_number: undefined,
    no_ktp: undefined,
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
        home_ownership_id_bfi: undefined,
        home_ownership_desc_bfi: undefined,
        tax_is_active: undefined,
    },
    info_customer: {
        profession_id_bfi: undefined,
        profession_desc_bfi: undefined,
        salary: undefined,
        dob: undefined,
    },
};

let dataStep3 = {
    submission_id: undefined,
    info_calculator: {
        funding: undefined,
        tenor: undefined,
        monthly_installment: undefined,
    },
};
let dataStep4 = {
    submission_id: undefined,
    disclaimer: undefined,
};

$(document).ready(function () {
    lang == "id"
        ? $(".nav-item-2.active").find(".nav-step-tag").text("Sedang Isi")
        : $(".nav-item-2.active").find(".nav-step-tag").text("Onprogress");

    sessionStorage.setItem("loanType", "NDFM");
});

var nearBranch = $("#near_branch").attr("placeholder");
$("#near_branch").select2({
    placeholder: nearBranch,
    dropdownParent: $("#near_branch").parent(),
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
// var tahun_kendaraan = $("#tahun_kendaraan").attr("placeholder");
// $("#tahun_kendaraan").select2({
//     placeholder: tahun_kendaraan,
//     dropdownParent: $("#tahun_kendaraan").parent(),
// });

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

var occupation = $("#occupation").attr("placeholder");
$("#occupation").select2({
    placeholder: occupation,
    dropdownParent: $("#occupation").parent(),
});

$("#merk_kendaraan").change(() => {
    filterAssetModel($("#merk_kendaraan").val().toString());
});

$("#next1").on("click", function (e) {
    e.preventDefault();
    if ($(this).closest("form").valid()) {
        pushDataStep1(() => {
            if (sessionStorage.getItem("submitStep1") === "false") {
                window.dataLayer.push({
                    event: "ValidFormNDFMStep1",
                });
                sessionStorage.setItem("submitStep1", "true");
            }
            step("next", 2);
            getAuthorizationToken();
            getListProvinsi("#provinsi");
            getListAssets("motor");
            getListBpkbOwnership("#kepemilikan_bpkb");
            getListHouseOwnership("#kepemilikan_rumah");
        });
    }
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
                                    event: "ValidFormNDFMStep2",
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
    $("#modal-konfirmasi").modal("show");
});

$("#confirm-data").on("click", function (e) {
    e.preventDefault();
    pushDataStep3(() => {
        if (sessionStorage.getItem("submitStep3") === "false") {
            window.dataLayer.push({
                event: "ValidFormNDFMStep3",
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
        $("#menu5").removeClass("active");
        $("#success").addClass("active");
    }
});

function pushDataStep1(cb) {
    let result = (dataStep1 = {
        name: $("#nama_lengkap").val(),
        no_ktp: $("#idnumber").val(),
        email: $("#email_pemohon").val(),
        phone_number: $("#no_handphone").val(),
        utm_source: sessionStorage.getItem("utm_source"),
        utm_campaign: sessionStorage.getItem("utm_campaign"),
        utm_term: sessionStorage.getItem("utm_term"),
        utm_medium: sessionStorage.getItem("utm_medium"),
        utm_content: sessionStorage.getItem("utm_content"),
    });

    $.ajax({
        type: "POST",
        url: "/credit/save-motorcycle-leads1",
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
            type_id_bfi: rawAssetBrand[0].asset_group,
            type_desc_bfi: rawAssetBrand[0].asset_group,
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
            home_ownership_id_bfi: $("#kepemilikan_rumah").val().toString(),
            home_ownership_desc_bfi: $(
                "#kepemilikan_rumah option:selected"
            ).html(),
            tax_is_active: $("input[name='tax_is_active']:checked").val(),
        },
        info_customer: {
            profession_id_bfi: "KRY",
            profession_desc_bfi: "Karyawan Swasta",
            salary: "12000000",
            dob: "1995-12-28",
        },
    });

    $.ajax({
        type: "POST",
        url: "/credit/save-motorcycle-leads2",
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
    let result = (dataStep3 = {
        submission_id: submission_id,
        info_calculator: {
            funding: "500000000",
            tenor: "24",
            monthly_installment: "40000000",
        },
    });

    $.ajax({
        type: "POST",
        url: "/credit/save-motorcycle-leads3",
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
        url: "/credit/save-motorcycle-leads4",
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
                cb();
            }
        },
    });
}

function pushDataStep5() {
    $.ajax({
        type: "POST",
        url: "/credit/save-motorcycle-leads5",
        data: { submission_id: submission_id },
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
                if (sessionStorage.getItem("submitStepOtp") === "false") {
                    window.dataLayer.push({
                        event: "ValidFormNDFMStepOTP",
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
        lead_program_id: "2",
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
                if (result.data.is_duplicate == true) {
                    window.location =
                        "/" +
                        lang +
                        "/credit/pengajuan-gagal?dupcheck=true&product=" +
                        sessionStorage.getItem("loanType");
                } else {
                    cb();
                    console.log(result);
                }
            }
        },
    });
}

$("#back2").on("click", function (e) {
    e.preventDefault();
    step("back", 2);
});
$("#back3").on("click", function (e) {
    e.preventDefault();
    step("back", 3);
});

$("input[name='action-call']").click(function () {
    var isWa = $(this).val();
    if (isWa == "whatsapp") {
        $(".wa-number-same").removeAttr("hidden");
    } else {
        $(".wa-number-same").attr("hidden", true);
    }
});

$("input[name='is-wa-number-same']").click(function () {
    var isWaSame = $(this).val();
    if (isWaSame == "false") {
        $(".wa-numbers").removeAttr("hidden");
    } else {
        $(".wa-numbers").attr("hidden", true);
    }
});

$("#tenor2").on("change", function () {
    getMaxFunding();
});

$("#funding").on("change", function () {
    getMaxFunding();
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
