let lang = document.documentElement.lang;

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
    step("next", 2);
    // if ($(this).closest("form").valid()) {
    //     pushDataStep1(() => {
    //         getAuthorizationToken();
    //         getListProvinsi("#provinsi");
    //     });
    // }
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
