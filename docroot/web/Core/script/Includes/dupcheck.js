let lang = document.documentElement.lang;

$(document).ready(function () {
    let loanType = sessionStorage.getItem("loanType");
    if (loanType == "PBF") {
        lang == "id"
            ? $(".type").text("Jaminan Sertifikat Rumah")
            : $(".type").text("Collateral Financing House");
        $("#ctaNDFM").removeAttr("hidden");
        $("#ctaNDFC").removeAttr("hidden");
    } else if (loanType == "NDFC") {
        lang == "id"
            ? $(".type").text("Jaminan BPKB Mobil")
            : $(".type").text("Collateral Financing Vehicle Car");
        $("#ctaNDFM").removeAttr("hidden");
        $("#ctaPBF").removeAttr("hidden");
    } else {
        lang == "id"
            ? $(".type").text("Jaminan BPKB Motor")
            : $(".type").text("Collateral Financing Vehicle Motorcycle");
        $("#ctaPBF").removeAttr("hidden");
        $("#ctaNDFC").removeAttr("hidden");
    }
});
