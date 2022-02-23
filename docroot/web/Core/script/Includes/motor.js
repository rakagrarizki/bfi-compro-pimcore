let lang = document.documentElement.lang;
var submission_id = "";

let dataStep1 = {
    name: undefined,
    email: undefined,
    phone_number: undefined,
    utm_source: undefined,
    utm_campaign: undefined,
    utm_term: undefined,
    utm_medium: undefined,
    utm_content: undefined,
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
var tahun_kendaraan = $("#tahun_kendaraan").attr("placeholder");
$("#tahun_kendaraan").select2({
    placeholder: tahun_kendaraan,
    dropdownParent: $("#tahun_kendaraan").parent(),
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

var occupation = $("#occupation").attr("placeholder");
$("#occupation").select2({
    placeholder: occupation,
    dropdownParent: $("#occupation").parent(),
});

$("#next1").on("click", function (e) {
    e.preventDefault();
    if ($(this).closest("form").valid()) {
        pushDataStep1(() => {
            step("next", 2);
            getAuthorizationToken();
        });
    }
});
$("#next2").on("click", function (e) {
    e.preventDefault();
    step("next", 3);
});
$("#next2").on("click", function (e) {
    e.preventDefault();
    step("next", 3);
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

function pushDataStep1(cb) {
    let result = (dataStep1 = {
        name: $("#nama_lengkap").val(),
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
