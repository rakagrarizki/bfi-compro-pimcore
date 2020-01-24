var stepTitle = document.getElementById("step-title");
var stepSubtitle = document.getElementById("step-subtitle");
var listStep1 = document.getElementById("list-step1");
var listStep2 = document.getElementById("list-step2");
var listStep3 = document.getElementById("list-step3");
var listStep4 = document.getElementById("list-step4");


////// switch stepper //////
var step1 = document.getElementById("stepper-csr-1");
var step2 = document.getElementById("stepper-csr-2");
var step3 = document.getElementById("stepper-csr-3");
var step4 = document.getElementById("stepper-csr-4");

//// next ////
function nextToStep2(){
    step1.classList.add("hide");
    step2.classList.remove("hide");
    listStep1.classList.remove("active");
    listStep2.classList.add("active");
    document.getElementById("poin1").innerHTML = "<i class='fa fa-check'></i>";
    stepTitle.textContent = "Data Universitas";
    stepSubtitle.textContent = "Silahkan masukkan data universitas anda";
}

function nextToStep3(){
    step2.classList.add("hide");
    step3.classList.remove("hide");
    semester_count = $(".semester option:selected").val();
    loopSemester();
    listStep2.classList.remove("active");
    listStep3.classList.add("active");
    document.getElementById("poin1").innerHTML = "<i class='fa fa-check'></i>";
    document.getElementById("poin2").innerHTML = "<i class='fa fa-check'></i>";
    stepTitle.textContent = "Data Akademik";
    stepSubtitle.textContent = "Silahkan masukkan data akademik tiga semester terakhir anda";
}

function nextToStep4(){
    step3.classList.add("hide");
    step4.classList.remove("hide");
    insertData();
    loopDataSemester();
    listStep3.classList.remove("active");
    listStep4.classList.add("active");
    document.getElementById("poin1").innerHTML = "<i class='fa fa-check'></i>";
    document.getElementById("poin2").innerHTML = "<i class='fa fa-check'></i>";
    document.getElementById("poin3").innerHTML = "<i class='fa fa-check'></i>";
    stepTitle.textContent = "Konfirmasi Data";
    stepSubtitle.textContent = "Pastikan data yang anda masukkan sudah benar";
}
//// prev ////

function backToStep1(){
    step1.classList.remove("hide");
    step2.classList.add("hide");
    listStep1.classList.add("active");
    listStep2.classList.remove("active");
    document.getElementById("poin1").textContent = "1";
    stepTitle.textContent = "Data Pemohon";
    stepSubtitle.textContent = "Silahkan masukkan data diri anda";
}

function backToStep2(){
    step2.classList.remove("hide");
    step3.classList.add("hide");
    listStep2.classList.add("active");
    listStep3.classList.remove("active");
    document.getElementById("poin2").textContent = "2";
    stepTitle.textContent = "Data Universitas";
    stepSubtitle.textContent = "Silahkan masukkan data universitas anda";
    $("#form-semester-ipk .ipk-wrapper").remove();
}

function backToStep3(){
    step3.classList.remove("hide");
    step4.classList.add("hide");
    listStep3.classList.add("active");
    listStep4.classList.remove("active");
    document.getElementById("poin3").textContent = "3";
    stepTitle.textContent = "Data Akademik";
    stepSubtitle.textContent = "Silahkan masukkan data akademik tiga semester terakhir anda";
    $('#list-ipk #ipk').empty();
}