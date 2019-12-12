<div class="container" id="stepper">
    <ul class="stepper-row">
        <li class="active">
            <span class="number">1</span>
            <span class="text">Data Pemohon</span>
        </li>
        <li>
            <span class="number">2</span>
            <span class="text">Data Universitas</span>
        </li>
        <li>
            <span class="number">3</span>
            <span class="text">Data Akademik</span>
        </li>
        <li>
            <span class="number">4</span>
            <span class="text">Konfirmasi Data</span>
        </li>
    </ul>

    <h3>Data Pemohon</h3>
    <p>Silahkan masukkan data diri anda</p>

    <form action="">
        <div class="input-text-group">
            <input id="name-input" class="style-input" type="text" onfocus="changeLabel(this.id)" onfocusout="deleteLabel(this.id)" required>
            <label id="name-label" class="input-label">Masukkan nama lengkap anda</label>
        </div>
        <div class="input-text-group">
            <input id="email-input" class="style-input" type="email" onfocus="changeLabel(this.id)" onfocusout="deleteLabel(this.id)" required>
            <label id="email-label" class="input-label">Masukkan email anda</label>
        </div>
        <div class="input-text-group">
            <input id="phone-input" class="style-input" type="number" onfocus="changeLabel(this.id)" onfocusout="deleteLabel(this.id)" required>
            <label id="phone-label" class="input-label">Masukkan nomor handphone anda</label>
        </div>
        <div class="input-text-group">
            <input id="alt-phone-input" class="style-input" type="number" onfocus="changeLabel(this.id)" onfocusout="deleteLabel(this.id)">
            <label id="alt-phone-label" class="input-label">Masukkan nomor handphone alternatif</label>
        </div>
        <div id="upload">
            <h5 id="upload-text">Unggah Foto 3x4</h5>
            <img id="preview-upload" src="">
            <div class="upload-content-wrapper">
                <div class="upload-btn-wrapper">
                    <button id="upload-button" class="btn-upload">
                        Pilih File
                    </button>
                    <input id="file-upload" class="hidden" type="file" name="myfile">  
                </div>
                <span id="file-upload-filename"></span>
            </div>
            <p>Pastikan foto KTP terlihat jelas (max. ukuran file adalah 300kB)</p>
        </div>
    </form>
    <div id="step-1" class="next-prev-container">
        <a href="#stepper-csr-2" class="btn-next-prev" onclick="nextToStep2()">
            <span>SELANJUTNYA</span>
            <i class="fas fa-chevron-right"></i>
        </a>
    </div>
</div>
