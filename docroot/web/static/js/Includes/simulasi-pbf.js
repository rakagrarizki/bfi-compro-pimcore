$(document).ready(() => {
    var opt = $(".tenor-item:first");
    opt.attr("checked", true);
    $("#result-estimasi").html(
        "Rp " + currency(parseInt(opt.val())) + "<span>*</span>"
    );
});

$(".tenor-item").click((el) => {
    var est = el.target.value;
    $("#result-estimasi").html(
        "Rp " + currency(parseInt(est)) + "<span>*</span>"
    );
});

function currency(x) {
    var x = new Intl.NumberFormat("id-Id").format(x);
    return x;
}
