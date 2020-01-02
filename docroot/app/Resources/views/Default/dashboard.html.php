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

<section id="app-status">
    <div class="container">
        <div class="title">
            <h3>Cek Status Aplikasi</h3>
            <p>Berikut ini adalah status aplikasi anda</p>
        </div>
        <ul class="status-wrapper">
            <li class="status-box">
                <div class="detail">
                    <div class="assignment">
                        <h6>Assignment ID</h6>
                        <p>-</p>
                    </div>
                    <div class="credit-type">
                        <h6>Jenis Kredit</h6>
                        <p>Pembiayaan Agunan - Sertifikat Rumah</p>
                    </div>
                </div>
                <div class="status-step">
                    <ul class="stepper-row">
                        <li id="status-step" class="active">
                            <span id="step1" class="number">1</span>
                        </li>
                        <li id="status-step" class="active">
                            <span id="step2" class="number">2</span>
                        </li>
                        <li id="status-step">
                            <span id="step3" class="number">3</span>
                        </li>
                        <li id="status-step">
                            <span id="step4" class="number">4</span>
                        </li>
                        <li id="status-step">
                            <span id="step5" class="number">5</span>
                        </li>
                    </ul>
                </div>
                <div class="fail-notif">
                    <span>&#10005;</span>
                    <span>PENGAJUAN DITOLAK</span>
                </div>
            </li>

            <hr>

            <li class="status-box">
                <div class="detail">
                    <div class="assignment">
                        <h6>Assignment ID</h6>
                        <p>-</p>
                    </div>
                    <div class="credit-type">
                        <h6>Jenis Kredit</h6>
                        <p>Pembiayaan Agunan - Sertifikat Rumah</p>
                    </div>
                </div>
                <div class="status-step">
                    <ul class="stepper-row">
                        <li id="status-step" class="active">
                            <span class="number">1</span>
                        </li>
                        <li id="status-step" class="active">
                            <span class="number">2</span>
                        </li>
                        <li id="status-step" class="active">
                            <span class="number">3</span>
                        </li>
                        <li id="status-step">
                            <span class="number">4</span>
                        </li>
                        <li id="status-step">
                            <span class="number">5</span>
                        </li>
                    </ul>
                </div>
                <div class="fail-notif">
                    <span>&#10005;</span>
                    <span>PENGAJUAN DITOLAK</span>
                </div>
            </li>
        </ul>
    </div>
</section>

<section id="check-contract">
    <div class="container">
        <div class="title">
            <h3>Cek Kontrak</h3>
            <p>Berikut ini adalah informasi kontrak anda</p>
        </div>
        <ul class="contract-wrapper">
            <a class="contract-box" href="#">
                <li href="" class="contract-detail" id="telat"> <!--tambah id=telat utk tambah note telat bayar-->
                    <img src="/static/images/gedung.png" alt="">
                    <div class="contract-type">
                        <h5>Pembiayan Agunan</h5>
                        <h5>BPKB Mobil</h5>
                    </div>
                    <div class="details">
                        <div>
                            <h6>No. Kontrak</h6>
                            <p>1234567890</p>
                        </div>
                        <div>
                            <h6>Angsuran per Bulan</h6>
                            <p>Rp. 5.000.000,-</p>
                        </div>
                        <div>
                            <h6>Tanggal Jatuh Tempo</h6>
                            <p>11 November 2019</p>
                        </div>
                    </div>
                    <h5 class="more">LIHAT DETAIL &#62;</h5>
                </li>
            </a>
            <a class="contract-box" href="#">
                <li href="" class="contract-detail">
                    <img src="/static/images/gedung.png" alt="">
                    <div class="contract-type">
                        <h5>Pembiayan Agunan</h5>
                        <h5>BPKB Mobil</h5>
                    </div>
                    <div class="details">
                        <div>
                            <h6>No. Kontrak</h6>
                            <p>1234567890</p>
                        </div>
                        <div>
                            <h6>Angsuran per Bulan</h6>
                            <p>Rp. 5.000.000,-</p>
                        </div>
                        <div>
                            <h6>Tanggal Jatuh Tempo</h6>
                            <p>11 November 2019</p>
                        </div>
                    </div>
                    <h5 class="more">LIHAT DETAIL &#62;</h5>
                </li>
            </a>
            <a class="contract-box" href="#">
                <li href="" class="contract-detail" id="telat">
                    <img src="/static/images/gedung.png" alt="">
                    <div class="contract-type">
                        <h5>Pembiayan Agunan</h5>
                        <h5>BPKB Mobil</h5>
                    </div>
                    <div class="details">
                        <div>
                            <h6>No. Kontrak</h6>
                            <p>1234567890</p>
                        </div>
                        <div>
                            <h6>Angsuran per Bulan</h6>
                            <p>Rp. 5.000.000,-</p>
                        </div>
                        <div>
                            <h6>Tanggal Jatuh Tempo</h6>
                            <p>11 November 2019</p>
                        </div>
                    </div>
                    <h5 class="more">LIHAT DETAIL &#62;</h5>
                </li>
            </a>
            <a class="contract-box" href="#">
                <li href="" class="contract-detail">
                    <img src="/static/images/gedung.png" alt="">
                    <div class="contract-type">
                        <h5>Pembiayan Agunan</h5>
                        <h5>BPKB Mobil</h5>
                    </div>
                    <div class="details">
                        <div>
                            <h6>No. Kontrak</h6>
                            <p>1234567890</p>
                        </div>
                        <div>
                            <h6>Angsuran per Bulan</h6>
                            <p>Rp. 5.000.000,-</p>
                        </div>
                        <div>
                            <h6>Tanggal Jatuh Tempo</h6>
                            <p>11 November 2019</p>
                        </div>
                    </div>
                    <h5 class="more">LIHAT DETAIL &#62;</h5>
                </li>
            </a>
            <a href="" class="contract-box add-contract">
                <li class="">
                    <div class="box">
                        <div class="plus">
                            <h1>&#43;</h1>
                        </div>
                        <h3>AJUKAN KREDIT</h3>
                    </div>
                </li>
            </a>
        </ul>
    </div>
</section>


<!-- Pop-up -->
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

<div class="container detail-contract">
    <div class="row">
        <article class="sect-title text-center">
            <h2 class="margin-top-10">Cek Status Aplikasi</h2>
            <p>Berikut ini adalah status aplikasi Anda</p>
        </article>
    </div>
    <div class="row">
        <div class="progress-container">
            <div class="header-progress">
                <div class="md-stepper-horizontal orange">
                    <div class="md-step active done">
                        <div class="md-step-circle"><span>1</span></div>
                        <div class="md-step-title">Ajukan Kredit</div>
                        <div class="md-step-bar-left"></div>
                        <div class="md-step-bar-right"></div>
                    </div>
                    <div class="md-step active">
                        <div class="md-step-circle"><span>2</span></div>
                        <div class="md-step-title">Verifikasi Telepon</div>
                        <div class="md-step-bar-left"></div>
                        <div class="md-step-bar-right"></div>
                    </div>
                    <div class="md-step active fail">
                        <div class="md-step-circle"><span>3</span></div>
                        <div class="md-step-title">Survey</div>
                        <div class="md-step-bar-left"></div>
                        <div class="md-step-bar-right"></div>
                    </div>
                    <div class="md-step">
                        <div class="md-step-circle"><span>4</span></div>
                        <div class="md-step-title">Disetujui</div>
                        <div class="md-step-bar-left"></div>
                        <div class="md-step-bar-right"></div>
                    </div>
                    <div class="md-step">
                        <div class="md-step-circle"><span>5</span></div>
                        <div class="md-step-title">Pendanaan</div>
                        <div class="md-step-bar-left"></div>
                        <div class="md-step-bar-right"></div>
                    </div>
                </div>
                <div class="status">
                    <div>
                        <span><i class="fa fa-close"></i>Pengajuan Ditolak</span>    
                    </div>
                </div>
            </div>
            <div class="footer-progress">
                <div class="title-stepper footer-content">
                    <h4>Assignment ID</h4>
                    <p>9876543210</p> 
                </div>
                <div class="detail footer-content">
                    <h4>Jenis Kredit</h4>
                    <p>Pembiayaan Agunan - Sertifikat Rumah</p> 
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <article class="sect-title text-center">
            <h2 class="margin-top-10">Cek Kontrak</h2>
            <p>Berikut ini adalah informasi kontrak Anda</p>
        </article>
    </div>
    <div class="row card-contract">
        <div class="card-icon">
            <div class="icon-wrapper">
                <div class="icon">
                    <img class="imggetcredit" src="/_default_upload_bucket/form_credit/Rumah.png" alt="">
                </div>
                <div class="status">
                    <span>Telat Bayar</span> 
                </div>
            </div>
            <div class="title">
                <h4>Pembiayaan Agunan Sertifikat Rumah</h4>
            </div>
            <div class="label-value">
                <span class="label">No.Kontrak</span>
                <span class="value-data">9876543210</span> 
            </div>
            <div class="label-value">
                <span class="label">Angsuran per Bulan</span>
                <span class="value-data">Rp 5.000.000</span> 
            </div>
            <div class="label-value">
                <span class="label">Tanggal Jatuh Tempo</span>
                <span class="value-data">15 November 2019</span> 
            </div>
            <div class="warning">
                <i class="fa fa-warning"></i><span>Anda terlambat membayar 5 hari</span>
            </div>
            <div class="button">
                <a class="button-detail" href="">Lihat Detail</a>
            </div>
        </div>
        <div class="card-icon">
            <div class="icon-wrapper">
                <div class="icon">
                    <img class="imggetcredit" src="/_default_upload_bucket/form_credit/Rumah.png" alt="">
                </div>
                <div class="status">
                    <span>Telat Bayar</span> 
                </div>
            </div>
            <div class="title">
                <h4>Pembiayaan Agunan Sertifikat Rumah</h4>
            </div>
            <div class="label-value">
                <span class="label">No.Kontrak</span>
                <span class="value-data">9876543210</span> 
            </div>
            <div class="label-value">
                <span class="label">Angsuran per Bulan</span>
                <span class="value-data">Rp 5.000.000</span> 
            </div>
            <div class="label-value">
                <span class="label">Tanggal Jatuh Tempo</span>
                <span class="value-data">15 November 2019</span> 
            </div>
            <div class="warning">
                <i class="fa fa-warning"></i><span>Anda terlambat membayar 5 hari</span>
            </div>
            <div class="button">
                <a class="button-detail" href="">Lihat Detail</a>
            </div>
        </div>
        <div class="card-icon add">
            <div class="plus-container">
                <div class="image">
                    <a href=""><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                </div>
                <div class="text">
                    <a href=""><span>Ajukan Kredit</span></a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->headScript()->prependFile('/static/js/Includes/dashboard.js'); ?>