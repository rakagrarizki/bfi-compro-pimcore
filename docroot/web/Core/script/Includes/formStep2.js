var univ_label_element = document.getElementById("univ-label");
var nim_label_element = document.getElementById("nim-label");
var fak_label_element = document.getElementById("fak-label");
var prodi_label_element = document.getElementById("prodi-label");
var default_univ_label = univ_label_element.textContent;
var default_nim_label = nim_label_element.textContent;
var default_fak_label = fak_label_element.textContent;
var default_prodi_label = prodi_label_element.textContent;

var semester_count = 0;
var univ,nim,fak,prodi;

//// select2 semester ////
$(document).ready(function() {
    var semester_label_element = document.getElementById("semester-label");
    var default_semester_label = semester_label_element.textContent;

    $('.semester').select2({
        minimumResultsForSearch: Infinity,
        placeholder: "",
        allowClear: true
    });
    $('.semester').on('select2:open', function (e) {
        semester_label_element.textContent = "SEMESTER"
        semester_label_element.classList.add("exist");
    });
    $('.semester').on('select2:closing', function () {
        var selected_item = $(".semester option:selected").val();
        semester_count = parseInt(selected_item);
        if(selected_item.length > 0){
            $('.select2-selection__rendered').text(selected_item);
            $('.select2-selection').css({"padding-bottom": "5px"});
        }
        else{
            semester_label_element.classList.remove("exist");
            semester_label_element.textContent = default_semester_label;
        }

        return semester_count;
    });
});

function changeLabelAcademic(ele_id) {
    if (ele_id == "univ-input"){
        univ_label_element.textContent = "UNIVERSITAS";
    }
    else if(ele_id == "nim-input"){
        nim_label_element.textContent = "NIM / NPM";
    }
    else if(ele_id == "fak-input"){
        fak_label_element.textContent = "FAKULTAS";
    }
    else if(ele_id == "prodi-input"){
        prodi_label_element.textContent = "JURUSAN / PROGRAM STUDI";
    }
}

function deleteLabelAcademic(ele_id) {
    if (ele_id == "univ-input" && document.getElementById(ele_id).value.length > 0){
        univ_label_element.classList.add("exist");
        document.getElementById(ele_id).classList.add("exist-input");
        return univ = document.getElementById(ele_id).value;
    }
    else if (ele_id == "nim-input" && document.getElementById(ele_id).value.length > 0) {
        nim_label_element.classList.add("exist");
        document.getElementById(ele_id).classList.add("exist-input");
        return nim = document.getElementById(ele_id).value;
    }
    else if (ele_id == "fak-input" && document.getElementById(ele_id).value.length > 0) {
        fak_label_element.classList.add("exist");
        document.getElementById(ele_id).classList.add("exist-input");
        return fak = document.getElementById(ele_id).value;
    }
    else if (ele_id == "prodi-input" && document.getElementById(ele_id).value.length > 0) {
        prodi_label_element.classList.add("exist");
        document.getElementById(ele_id).classList.add("exist-input");
        return prodi = document.getElementById(ele_id).value;
    }
    else {
        if (ele_id == "univ-input"){
            univ_label_element.classList.remove("exist");
            univ_label_element.textContent = default_univ_label;
        }
        else if(ele_id == "nim-input"){
            nim_label_element.classList.remove("exist");
            nim_label_element.textContent = default_nim_label;
        }
        else if(ele_id == "fak-input"){
            fak_label_element.classList.remove("exist");
            fak_label_element.textContent = default_fak_label;
        }
        else if(ele_id == "prodi-input"){
            prodi_label_element.classList.remove("exist");
            prodi_label_element.textContent = default_prodi_label;
        }
    }
}