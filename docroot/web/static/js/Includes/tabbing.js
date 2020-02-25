var idnext = 1;
var idprev = 0;
var idclick = 'perkembangan-perusahaan';
console.log('tabbing js');
function scrollPosition(id){
    $("#outer-choice").scrollLeft($("#div"+id).position().left+document.getElementById('outer-choice').scrollLeft)
}

function setPreviewId(prev,next){
    idnext = next;
    idprev = prev;
    if(next){
        $('#nextButton').show();
    }else{
        $('#nextButton').hide();
    }
    if(prev !== ''){
        $('#prevButton').show();
    }else{
        $('#prevButton').hide();
    }
    console.log('setpriview');
}

function next(){
    scrollPosition(idnext);
    $('#href'+idnext).click();
}

function prev(){
    scrollPosition(idprev);
    $('#href'+idprev).click();
}

function getDetail(id, lang){
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", '/management/get-detail?id='+id+'&lang='+lang, false ); // false for synchronous request
    xmlHttp.send( null );

    document.getElementById('userImage').style.backgroundImage = 'url(' + JSON.parse(xmlHttp.responseText).data.Image + ')';
    document.getElementById('profileName').innerHTML  = JSON.parse(xmlHttp.responseText).data.Nama;
    document.getElementById('profileJob').innerHTML  = JSON.parse(xmlHttp.responseText).data.Jabatan;
    document.getElementById('profileBio').innerHTML  = JSON.parse(xmlHttp.responseText).data.Biodata;
    document.getElementById('profileHistory').innerHTML  = JSON.parse(xmlHttp.responseText).data.RiwayatKerja;
    document.getElementById('profileEducation').innerHTML  = JSON.parse(xmlHttp.responseText).data.RiwayatPekerjaan;
    console.log(JSON.parse(xmlHttp.responseText).data);
    return xmlHttp.responseText;
}

function updateQueryStringParameter(key, value) {
    var uri = window.location.href;
    var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
    var separator = uri.indexOf('?') !== -1 ? "&" : "?";
    if (uri.match(re)) {
        uri = uri.replace(re, '$1' + key + "=" + value + '$2');
    }
    else {
        uri = uri + separator + key + "=" + value;
    }

    window.history.pushState({},"", uri);
}