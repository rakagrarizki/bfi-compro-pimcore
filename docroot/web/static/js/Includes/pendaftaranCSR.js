
////// switch stepper //////
var step1 = document.getElementById("stepper-csr-1");
var step2 = document.getElementById("stepper-csr-2");
var step3 = document.getElementById("stepper-csr-3");
var step4 = document.getElementById("stepper-csr-4");

//// next ////
function nextToStep2(){
    step1.classList.add("hide");
    step2.classList.remove("hide");
}

function nextToStep3(){
    step2.classList.add("hide");
    step3.classList.remove("hide");
    semester_count = $(".semester option:selected").val();
    loopSemester();
}

function nextToStep4(){
    step3.classList.add("hide");
    step4.classList.remove("hide");
    insertData();
    loopDataSemester();
}
//// prev ////

function backToStep1(){
    step1.classList.remove("hide");
    step2.classList.add("hide");
}

function backToStep2(){
    step2.classList.remove("hide");
    step3.classList.add("hide");
}

function backToStep3(){
    step3.classList.remove("hide");
    step4.classList.add("hide");
}