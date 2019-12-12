<div class="container" id="stepper">
    <ul class="stepper-row">
        <li>
            <span class="number">&#10003</span>
            <span class="text">Data Pemohon</span>
        </li>
        <li class="active">
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

    <h3>Data Universitas</h3>
    <p>Silahkan masukkan data universitas anda</p>

    <form action="">
        <div class="input-text-group">
            <input id="univ-input" class="style-input" type="text" onfocus="changeLabelAcademic(this.id)" onfocusout="deleteLabelAcademic(this.id)" required>
            <label id="univ-label" class="input-label">Masukkan nama universitas anda</label>
        </div>
        <div class="input-text-group">
            <input id="nim-input" class="style-input" type="text" onfocus="changeLabelAcademic(this.id)" onfocusout="deleteLabelAcademic(this.id)" required>
            <label id="nim-label" class="input-label">Masukkan nomor NIM / NPM</label>
        </div>
        <div class="input-text-group">
            <input id="fak-input" class="style-input" type="text" onfocus="changeLabelAcademic(this.id)" onfocusout="deleteLabelAcademic(this.id)" required>
            <label id="fak-label" class="input-label">Masukkan fakultas anda</label>
        </div>
        <div class="input-text-group">
            <input id="prodi-input" class="style-input" type="text" onfocus="changeLabelAcademic(this.id)" onfocusout="deleteLabelAcademic(this.id)">
            <label id="prodi-label" class="input-label">Masukkan program studi anda</label>
        </div>
        <div class="input-text-group">
            <select class="semester style-input" name="state" data-placeholder="">
                <option></option>
                <option value="4">Semester 4</option>
                <option value="5">Semester 5</option>
                <option value="6">Semester 6</option>
                <option value="7">Semester 7</option>
                <option value="8">Semester 8</option>
            </select>
            <label id="semester-label" class="input-label">Pilih Semester</label>
        </div>
    </form>

    <div id="step-2" class="next-prev-container">
        <a href="#stepper-csr-1" class="btn-next-prev" onclick="backToStep1()">
            <i class="fas fa-chevron-left"></i>
            <span>SEBELUMNYA</span>
        </a>
        <a href="#stepper-csr-3" class="btn-next-prev" onclick="nextToStep3()">
            <span>SELANJUTNYA</span>
            <i class="fas fa-chevron-right"></i>
        </a>
    </div>
</div>
