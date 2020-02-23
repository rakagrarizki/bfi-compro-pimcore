// preview uploaded image //
var title = document.getElementById("upload-text");
var image = document.getElementById('preview-upload');
var button = document.getElementById( 'upload-button' );
var input = document.getElementById( 'file-upload-csr' );
var infoArea = document.getElementById( 'file-upload-filename' );

input.addEventListener( 'change', showFileName );
title.setAttribute("style", "margin-bottom: -15px;");

function showFileName( event ) {    
    var input = event.srcElement;
    var fileName = input.files[0].name;
    var lang = document.documentElement.lang

    title.setAttribute("style", "margin-bottom: 10px;");
    if(lang == 'id'){
        button.textContent = "Pilih File";
    }else{
        button.textContent = "Choose File";
    }
    image.src = URL.createObjectURL(event.target.files[0]);
    infoArea.textContent = fileName;
    return photo = fileName;
}