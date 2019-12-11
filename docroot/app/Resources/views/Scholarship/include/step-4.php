<div class="container" id="stepper">
    <ul class="stepper-row">
        <li>
            <span class="number">&#10003</span>
            <span class="text">Data Pemohon</span>
        </li>
        <li>
            <span class="number">&#10003</span>
            <span class="text">Data Universitas</span>
        </li>
        <li>
            <span class="number">&#10003</span>
            <span class="text">Data Akademik</span>
        </li>
        <li class="active">
            <span class="number">4</span>
            <span class="text">Konfirmasi Data</span>
        </li>
    </ul>

    <h3>Konfirmasi Data</h3>
    <p>Pastikan data yang anda masukkan sudah benar</p>

    <section id="data-pemohon" class="data-wrapper">
        <div class="title-and-button">
            <h4 class="point">A.</h4>
            <h4 class="title">Data Pemohon</h4>
            <a href="#stepper-csr-1" onclick="jumpToStep1()">
                <i class="fas fa-pencil-alt"></i>
                <span>Ubah</span>
            </a>
        </div>
        <div class="data-detail">
            <div class="detail-wrapper">
                <span class="label">Nama Lengkap</span>
                <span id="nama-peserta" class="input"></span>
            </div>
            <div class="detail-wrapper">
                <span class="label">Email</span>
                <span id="email-peserta" class="input"></span>
            </div>
            <div class="detail-wrapper">
                <span class="label">Nomor Handphone</span>
                <span id="hp-peserta" class="input"></span>
            </div>
            <div class="detail-wrapper">
                <span class="label">Foto 3x4</span>
                <span id="foto-peserta" class="input">: PasPoto.jpg</span>
            </div>
        </div>
    </section>
    <hr>
    <section id="data-universitas" class="data-wrapper">
        <div class="title-and-button">
            <h4 class="point">B.</h4>
            <h4 class="title">Data Universitas</h4>
            <a href="#stepper-csr-2" onclick="jumpToStep2()">
                <i class="fas fa-pencil-alt"></i>
                <span>Ubah</span>
            </a>
        </div>
        <div class="data-detail">
            <div class="detail-wrapper">
                <span class="label">Universitas</span>
                <span id="univ-peserta" class="input"></span>
            </div>
            <div class="detail-wrapper">
                <span class="label">NIM / NPM</span>
                <span id="nim-peserta" class="input"></span>
            </div>
            <div class="detail-wrapper">
                <span class="label">Fakultas</span>
                <span id="fak-peserta" class="input"></span>
            </div>
            <div class="detail-wrapper">
                <span class="label">Jurusan</span>
                <span id="prodi-peserta" class="input"></span>
            </div>
            <div class="detail-wrapper">
                <span class="label">Semester</span>
                <span id="smt-peserta" class="input"></span>
            </div>
        </div>
    </section>
    <hr>
    <section id="data-akademik" class="data-wrapper">
        <div class="title-and-button">
            <h4 class="point">C.</h4>
            <h4 class="title">Data Akademik</h4>
            <a href="#stepper-csr-3" onclick="jumpToStep3()">
                <i class="fas fa-pencil-alt"></i>
                <span>Ubah</span>
            </a>
        </div>
        <div id="list-ipk" class="data-detail">
            <!-- Template sesuai dgn formstep4.js -->
            <!-- <div class="detail-wrapper">
                <span class="label">Semester</span>
                <span class="input">: 1</span>
            </div>
            <div class="detail-wrapper">
                <span class="label">IPK</span>
                <span class="input">: 3.25</span>
            </div> -->

            <div class="detail-wrapper">
                <span class="label">Transkrip Nilai</span>
                <span id="transkrip-peserta" class="input"></span>
            </div>
        </div>
    </section>

    <div id="step-3" class="next-prev-container">
        <a href="#stepper-csr-3" class="btn-next-prev" onclick="backToStep3()">
            <i class="fas fa-chevron-left"></i>
            <span>SEBELUMNYA</span>
        </a>
        <a href="#stepper-csr-4" class="btn-next-prev" onclick="nextToStep4()">
            <span>SELESAI</span>
            <i class="fas fa-chevron-right"></i>
        </a>
    </div>
</div>
