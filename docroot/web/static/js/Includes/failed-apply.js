$(document).ready(function () {
    let loanType = sessionStorage.getItem("loanType");

    if (loanType == "PBF") {
        $("#ctaNDFM").removeAttr("hidden");
        $("#ctaNDFC").removeAttr("hidden");
    } else if (loanType == "NDFC") {
        $("#ctaNDFM").removeAttr("hidden");
        $("#ctaPBF").removeAttr("hidden");
    } else {
        $("#ctaPBF").removeAttr("hidden");
        $("#ctaNDFC").removeAttr("hidden");
    }
});
