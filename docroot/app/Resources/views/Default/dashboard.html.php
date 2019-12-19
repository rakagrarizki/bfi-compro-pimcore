<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');
?>

<section id="verify-section">
    <div class="container">
        <div class="verify-wrapper">
            <div class="col-lg-4 col-md-4 col-xs-12">
                <h4>Verifikasi akun Anda</h4>
                <p>Pastikan data anda benar untuk melihat kontrak</p>
            </div>
            <div class="col-lg-8 col-md-8 col-xs-12 step-wrapper">
                <ul class="stepper-row">
                    <li id="list-step" class="active">
                        <span id="poin1" class="number">1</span>
                    </li>
                    <li id="list-step">
                        <span id="poin2" class="number">2</span>
                        <a href="/test3" class="tool-tip">
                            <p class="email">Email</p>
                            <p class="verifikasi"><u>VERIFIKASI</u> &#62;</p>
                        </a>
                    </li>
                    <li id="list-step">
                        <span id="poin3" class="number"><i class="fa fa-star"></i></span>
                        <a id="ktp" class="tool-tip" data-toggle="modal" data-target="#popup-ktp">
                            <p class="email">Nomor KTP</p>
                            <p class="verifikasi"><u>VERIFIKASI</u> &#62;</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="popup-ktp">
    <div class="modal-dialog">
        <div class="modal-content">
            <h3>Lengkapi Data Pemohon</h3>
            <p>Silahkan lengkapi data pemohon anda</p>
            <form action="">
                <div class="form-wrapper">
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
                        <input id="ktp-input" class="style-input" type="number" onfocus="changeLabel(this.id)" onfocusout="deleteLabel(this.id)">
                        <label id="ktp-label" class="input-label">Masukkan nomor KTP anda</label>
                    </div>
                    <div id="upload-ktp">
                        <h5 id="upload-text">Unggah Foto KTP</h5>
                        <img id="preview-upload" src="">
                        <div class="upload-content-wrapper">
                            <div class="upload-btn-wrapper">
                                <button id="upload-button" class="btn-upload">
                                    Pilih File
                                </button>
                                <input id="file-upload" class="hide-input" type="file" name="myfile">  
                            </div>
                            <span id="file-upload-filename"></span>
                        </div>
                        <p>Pastikan foto KTP terlihat jelas (max. ukuran file adalah 1MB)</p>
                    </div>
                </div>
                <button id="btn-submit" class="button-login"> SIMPAN </button>
            </form>
        </div>
    </div>
</div>

<?php $this->headScript()->prependFile('/static/js/Includes/dashboard.js'); ?>