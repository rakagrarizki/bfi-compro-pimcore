let lang = document.documentElement.lang;

let dataStep1 = {
    name: undefined,
    phone_number: undefined,
    wa_number: undefined,
    email: undefined,
    utm_source: undefined,
    utm_campaign: undefined,
    utm_term: undefined,
    utm_medium: undefined,
    utm_content: undefined,
};

$(document).ready(function () {
    lang == "id"
        ? $(".nav-item-1.active").find(".nav-step-tag").text("Sedang Isi")
        : $(".nav-item-1.active").find(".nav-step-tag").text("Onprogress");

    sessionStorage.setItem("loanType", "NDFC");
});

$("input[name='is-wa-number']").click(function () {
    var is_WA = $(this).val();
    {
        is_WA == "false"
            ? $(".wa-numbers").removeAttr("hidden")
            : $(".wa-numbers").attr("hidden", true);
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
    step("next", 1);
});
$("#next2").on("click", function (e) {
    e.preventDefault();
    step("next", 2);
});
$("#next3").on("click", function (e) {
    e.preventDefault();
    step("next", 3);
});

$("#back2").on("click", function (e) {
    e.preventDefault();
    step("back", 1);
});
$("#back3").on("click", function (e) {
    e.preventDefault();
    step("back", 2);
});
