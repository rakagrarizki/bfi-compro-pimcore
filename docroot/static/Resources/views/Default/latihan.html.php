<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');
?>

<style>

</style>

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