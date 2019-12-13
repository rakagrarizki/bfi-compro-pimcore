function insertData(){
    var data_name = document.getElementById("nama-peserta");
    var data_email = document.getElementById("email-peserta");
    var data_hp = document.getElementById("hp-peserta");
    var data_foto = document.getElementById("foto-peserta");
    
    var data_univ = document.getElementById("univ-peserta");
    var data_nim = document.getElementById("nim-peserta");
    var data_fak = document.getElementById("fak-peserta");
    var data_prodi = document.getElementById("prodi-peserta");
    var data_smt = document.getElementById("smt-peserta");

    var data_transkrip = document.getElementById("transkrip-peserta");

    // Data Pemohon //
    data_name.textContent = ": "+name;
    data_email.textContent = ": "+email;
    data_hp.textContent = ": "+phone;
    data_foto.textContent = ": "+photo;
    // Data Universitas //
    data_univ.textContent = ": "+univ;
    data_nim.textContent = ": "+nim;
    data_fak.textContent = ": "+fak;
    data_prodi.textContent = ": "+prodi;
    data_smt.textContent = ": "+semester_count;
    // Data Akademik //
    data_transkrip.textContent = ": " +transkrip;
}

function loopDataSemester() {
    var stop=semester_count-1;
    for (i=stop;i>stop-3;i--){
        let asd = document.createElement("div");
        asd.setAttribute("id", "ipk")
        asd.innerHTML += (
            "<div class='detail-wrapper'>" +
                "<span class='label'>Semester</span>" +
                "<span class='input'>: "+i+"</span>" +
            "</div>" +
            "<div class='detail-wrapper'>" +
                "<span class='label'>IPK</span>" +
                "<span class='input'>: "+"3."+ipk['smt-ke-'+i]+"</span>" +
            "</div>");

        document.getElementById("list-ipk").prepend(asd);
    }
}

function jumpToStep1(){
    step1.classList.remove("hide");
    step4.classList.add("hide");
    semester_count = 0;
    $("#form-semester-ipk .ipk-wrapper").remove();
    $('#list-ipk #ipk').empty();
}

function jumpToStep2(){
    step2.classList.remove("hide");
    step4.classList.add("hide");
    $("#form-semester-ipk .ipk-wrapper").remove();
    $('#list-ipk #ipk').empty();
}

function jumpToStep3(){
    step3.classList.remove("hide");
    step4.classList.add("hide");
    $('#list-ipk #ipk').empty();
}