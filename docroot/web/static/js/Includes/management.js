console.log('management js');
function getDetail(id, lang) {
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open("GET", '/management/get-detail?id=' + id + '&lang=' + lang, false); // false for synchronous request
    xmlHttp.send(null);

    document.getElementById('userImage').style.backgroundImage = 'url(' + JSON.parse(xmlHttp.responseText).data.Image + ')';
    document.getElementById('profileName').innerHTML = JSON.parse(xmlHttp.responseText).data.Nama;
    document.getElementById('profileJob').innerHTML = JSON.parse(xmlHttp.responseText).data.Jabatan;
    document.getElementById('profileBio').innerHTML = JSON.parse(xmlHttp.responseText).data.Biodata;
    document.getElementById('profileHistory').innerHTML = JSON.parse(xmlHttp.responseText).data.RiwayatKerja;
    document.getElementById('profileEducation').innerHTML = JSON.parse(xmlHttp.responseText).data.RiwayatPekerjaan;
    // console.log(JSON.parse(xmlHttp.responseText).data);
    return xmlHttp.responseText;
}