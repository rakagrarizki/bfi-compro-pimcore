let lang = document.documentElement.lang;
var submission_id = "";

window.dataLayer = window.dataLayer || [];

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
    sessionStorage.setItem("submitStep1", "false");
    sessionStorage.setItem("submitStep2", "false");
    sessionStorage.setItem("submitStep3", "false");
    sessionStorage.setItem("submitStepOtp", "false");
    loanTenor = NDFM_TENOR;
    assetSize = 685;
    minFunding = 1000000;

    $("#tenor2").slider({
        min: 1,
        max: loanTenor.length,
        value: 1,
    });

    $(".min-tenor").text(loanTenor[0] + " Bulan");
    $(".max-tenor").text(loanTenor.slice(-1) + " Bulan");
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
    $("#model_kendaraan").empty();
    filterAssetModel($("#merk_kendaraan").val().toString());
});

$("#calcLoan").on("click", function () {
    if ($(this).closest("form").valid()) {
        if (lang === "id") {
            $(this).text("HITUNG ULANG");
        } else {
            $(this).text("RECALCULATE");
        }
        CalcBtn("hide");
        getCalculationParams();
    }
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
            getOccupationList();
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
                            getPricelistPaging();
                            getProductOffering();

                            $("#tenor").val(tenorFormatter(loanTenor[0]));
                            $("#tenor2").val(1);
                            $("#pembiayaan").val(separatordot(minFunding));
                            $("p.estimate-installment").text("Rp 0");
                            $("#calcLoan").removeAttr("disabled");
                            $("#next3").attr("disabled","disabled");

                            let brandData = $("#merk_kendaraan").select2('data');
                            $("#brand-caption").text(
                                brandData[0].text
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
        pushDataStep3(() => {
            if (sessionStorage.getItem("submitStep3") === "false") {
                window.dataLayer.push({
                    event: "ValidFormNDFMStep3",
                });
                sessionStorage.setItem("submitStep3", "true");
            }
            $("#modal-konfirmasi").modal("show");
        });
    }
});

$("#confirm-data").on("click", function (e) {
    e.preventDefault();
    pushDataStep4(() => {
        showOtpVer2();
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

function pushDataStep1(cb) {
    let result = (dataStep1 = {
        name: $("#nama_lengkap").val(),
        no_ktp: $("#idnumber").val(),
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
    assetCode = $("#model_kendaraan").val().toString();
    let brandData = $("#merk_kendaraan").select2('data');
    let modelData = $("#model_kendaraan").select2('data');
    let occupationData = $("#occupation").select2('data');
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
            brand_id_bfi: brandData[0].id,
            brand_desc_bfi: brandData[0].text,
            model_id_bfi: modelData[0].id,
            model_desc_bfi: modelData[0].text,
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
            profession_id_bfi: occupationData[0].id,
            profession_desc_bfi: occupationData[0].text,
            salary: "100000000",
            dob: "1992-02-23",
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
            funding: clearDot($("#pembiayaan").val()),
            tenor: reverseTenorFormatter($("#tenor").val()),
            monthly_installment: calculationParam.installment_amount,
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
                submissionRegister(submission_id);
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
                }
            }
        },
    });
}

function getListAssets(assetType) {
    $.ajax({
        type: "POST",
        url: "/credit/get-list-assets",
        headers: { Authorization: "Basic " + currentToken },
        data: {
            isactive: true,
            asset_type: assetType,
            page: 1,
            size: assetSize,
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
            } else {
                console.log("Data not found");
            }
        },
    });
}

function filterAssetBrand() {
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
}

function filterAssetModel(brand) {
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
}

function getProductOffering() {
    let param = {
        branch_id: branch_id,
        asset_type_id: "MOTOR",
        product_id: NDFM_PRODUCT_ID,
        // product_offering_id: "31780621A1",
        product_offering_id: NDFM_PRODUCT_OFFERING_ID,
        is_active: "true",
    };
    $.ajax({
        type: "POST",
        url: "/credit/get-product-offering",
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
                    provision_fee = result.data.data[0].provision_fee;
                } else {
                    console.log("Data not found");
                }
            } else {
                console.log("Failed to fetch data");
            }
        },
    });
}

function getOccupationList() {
    let param = {
        category: "MOTOR",
    };
    $.ajax({
        type: "POST",
        url: "/credit/get-list-profession",
        data: param,
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
            var listOccupation = [];
            if (result.success === "1") {
                $.each(result.data, function (id, val) {
                    if (val.desc != "") {
                        listOccupation.push({
                            id: val.id,
                            text: val.desc,
                        });
                    }
                });
                $("#occupation").select2({
                    placeholder: $("#occupation").attr("placeholder"),
                    dropdownParent: $("#occupation").parent(),
                    data: listOccupation,
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

$("#tenor2").on("change", function (e) {
    if ($(this).closest("form").valid()) {
        let tenorValue = $(this).val();
        tenorValue == 0 || tenorValue == "" ? CalcBtn("hide") : CalcBtn("show");
        e.preventDefault();
        getMaxFunding();
    }
});

$("#funding").on("change", function (e) {
    if ($(this).closest("form").valid()) {
        e.preventDefault();
        $("#pembiayaan").val() == 0 || $("#pembiayaan").val() == ""
            ? CalcBtn("hide")
            : CalcBtn("show");
        getMaxFunding();
    }
});

$("#pembiayaan").on("change", function (e) {
    if ($(this).closest("form").valid()) {
        e.preventDefault();
        $(this).val() == 0 || $(this).val() == ""
            ? CalcBtn("hide")
            : CalcBtn("show");
        getMaxFunding();
    }
});

$("#provinsi").change(function() {
    if($(this).valid()){
        getListCity("#kota");
    }
});

$("#kota").change(function() {
    if($(this).valid()){
        getListDistrict("#kecamatan");
    }
});

$("#kecamatan").change(function() {
    if($(this).valid()){
        getListSubdistrict("#kelurahan");
    }
});

$("#kelurahan").change(function() {
    if($(this).valid()){
        getListZipcode();
    }
});

function CalcBtn(action) {
    if (action == "hide") {
        $("#calcLoan").attr("disabled", "disabled");
        $("#next3").removeAttr("disabled");
        $("#warning-calc").attr("hidden", "hidden");
    } else {
        $("#calcLoan").removeAttr("disabled");
        $("#next3").attr("disabled", "disabled");
        $("#warning-calc").removeAttr("hidden");
        $("#warning-calc").html(
            '<label id="warning-text" class="error" for="calcLoan" style="display: inline-block;"> Anda belum menghitung estimasi angsuran </label>'
        );
    };
}

$("#btn-check").on("click", () => {
    submissionLogin(dataStep1.phone_number);
});