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
        <li class="active">
            <span class="number">3</span>
            <span class="text">Data Akademik</span>
        </li>
        <li>
            <span class="number">4</span>
            <span class="text">Konfirmasi Data</span>
        </li>
    </ul>

    <h3>Data Akademik</h3>
    <p>Silahkan masukkan data akademik tiga semester terakhir anda</p>

    <form id="form-semester-ipk" action="">
        <!-- Template sesuai dgn formstep3.js -->
        <!-- <div class="ipk-wrapper">
            <div class="input-text-group">
                <input id="name-input" class="style-input exist-input" type="text" value="3" disabled>
                <label id="name-label" class="input-label exist">SEMESTER</label>
            </div>
            <div class="input-ipk-wrapper">
                <p>IPK</p>
                <input class="first-digit" type="number" disabled value="3">
                <input class="last-two-digit" 
                type="number"
                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                maxlength="2"
                value="00">
                <span>Minimal IPK 3.00</span>
            </div>
        </div> -->
        <!-- Template sesuai dgn formstep3.js -->

        <div id="upload">
            <h5 id="upload-pdf-text">Unggah Transkrip Nilai</h5>
            <div id="show">
                <img id="preview-pdf-upload" src="">
                <span id="pdf-filename"></span>
            </div>
            <div class="upload-content-wrapper">
                <div class="upload-btn-wrapper">
                    <button id="upload-pdf-button" class="btn-upload">
                        Pilih File
                    </button>
                    <input id="file-pdf-upload" class="hidden" type="file" name="myfile">  
                </div>
            </div>
            <p>Mohon file disatukan dalam PDF (Ukuran Maksimal 5 MB)</p>
        </div>
    </form>

    <div id="step-3" class="next-prev-container">
        <a href="#stepper-csr-2" class="btn-next-prev" onclick="backToStep2()">
            <i class="fas fa-chevron-left"></i>
            <span>SEBELUMNYA</span>
        </a>
        <a href="#stepper-csr-4" class="btn-next-prev" onclick="nextToStep4()">
            <span>SELANJUTNYA</span>
            <i class="fas fa-chevron-right"></i>
        </a>
    </div>
</div>
