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

    var name = document.getElementById("name-input").value;
    var email = document.getElementById("email-input").value;
    var phone = document.getElementById("phone-input").value;

    var univ = document.getElementById("univ-input").value;
    var nim = document.getElementById("nim-input" ).value;
    var fak = document.getElementById("fak-input").value;
    var prodi = document.getElementById("prodi-input").value;


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
        console.log(ipk['smt-ke-'+i]);
        if (ipk['smt-ke-'+i] === undefined){
            ipk['smt-ke-'+i] = '00';
        }
        else if (ipk['smt-ke-'+i] === ('01' || '02' || '03'|| '04'|| '05'|| '06'|| '07'|| '08'|| '09')){
            ipk['smt-ke-'+i] = ipk['smt-ke-'+i];
        }
        else if ( ipk['smt-ke-'+i] < 10){
            ipk['smt-ke-'+i] = ipk['smt-ke-'+i] * 10 ;
        }
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