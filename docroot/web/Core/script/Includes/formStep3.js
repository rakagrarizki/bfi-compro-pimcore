var transkrip;
var ipk = [];

function loopSemester() {
    var stop=semester_count-1;
    for (i=stop;i>stop-3;i--){
        let asd = document.createElement("div");
        asd.setAttribute("class", "ipk-wrapper");
        asd.innerHTML += (
            "<div class='input-text-group'>" +
                "<label id='name-label' class='input-label exist' style='display: block;'>SEMESTER</label>" +
                "<input id='name-input' class='style-input exist-input' type='text' value="+i+" style='padding-left: 18px;' disabled>" +
            "</div>" +
            "<div class='input-ipk-wrapper'>" +
                "<p>IPK</p>" +
                "<input class='first-digit' type='number' disabled value='3'>" +
                "<input id='smt-ke-"+i+"' class='last-two-digit' maxlength='2' placeholder='00' type='number' oninput='javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);' onfocusout='getIpkValue(this.id)' onfocus='this.placeholder= \"\" ' onblur='this.placeholder= \"00\" ' onkeydown='return isNumberKey(event);'>" +
                "<span>Minimal IPK 3.00</span>"+
            "</div>");
        document.getElementById("form-semester-ipk").prepend(asd);
    }
}

var titlePDF = document.getElementById("upload-pdf-text");
var imagePDF = document.getElementById('preview-pdf-upload');
var buttonPDF = document.getElementById('upload-pdf-button');
var inputPDF = document.getElementById('file-pdf-upload');
var infoAreaPDF = document.getElementById('pdf-filename');
var showPDF = document.getElementById('show');

inputPDF.addEventListener( 'change', uploadPDF );
titlePDF.setAttribute("style", "margin-bottom: -15px;");

function uploadPDF(event) {
    var input = event.srcElement;
    var fileName = input.files[0].name;
    var trimName, ext;
    var lang = document.documentElement.lang

    titlePDF.setAttribute("style", "margin-bottom: 10px;");

    if(lang == 'id'){
        buttonPDF.textContent = "Pilih File";
    }else{
        buttonPDF.textContent = "Choose File";
    }
    // buttonPDF.textContent = "Ubah File";
    showPDF.classList.add("image-wrapper");
    imagePDF.src = "/static/images/pdf_logo.png";
    ext = fileName.split('.').pop();
    if (fileName.length > 15){
        trimName = fileName.substring(0 , 10) + ".." + ext;
        infoAreaPDF.textContent = trimName;
        return transkrip = trimName;
    }
    else{
        infoAreaPDF.textContent = fileName;
        return transkrip = fileName;
    }
}


function getIpkValue(id_smt){
    ipk[id_smt] = document.getElementById(id_smt).value;
    if (ipk[id_smt] < 9){
        var number = ipk[id_smt] + "0";
        document.getElementById(id_smt).value = number
        return number
    }
}
