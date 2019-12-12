<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');
?>

<div class="container">
    <div class="row">
        <article class="sect-title text-center">
            <h2 class="margin-top-10">Profile Anda</h2>
            <p>Berikut ini adalah profile Anda</p>
        </article>
        <div class="sect-list">
            <h3>Daftar Kontak</h3>
            <div class="list contact">
                <ol>
                    <li><a href="">1234567890 Pembayaran Berjamin - BPKB Mobil</a></li>
                    <li><a href="">1234567890 Pembayaran Berjamin - Sertifikat Rumah</a></li>
                    <li><a href="">1234567890 Pembayaran Berjamin - BPKB Motor</a></li>
                    <li><a href="">1234567890 Pembiayaan Lainnya - Pendidikan</a></li>
                    <li><a href="">1234567890 Pembiayaan Lainnya - Travel & Wisata</a></li>
                    <li><a href="">1234567890 Pembiayaan Lainnya - Alat Berat & Mesin</a></li>
                </ol>            
            </div>
        </div>
        <hr>
        <div class="sect-list">
            <h3>Data Pemohon</h3>
            <div class="list">
                <div class="detail-wrapper">
                    <span class="label">Nama Lengkap</span>
                    <span class="value-data">Deborah T. Morris</span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Email</span>
                    <span class="value-data">deborahmorris@gmail.com</span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Nomor Handphone</span>
                    <span class="value-data">08124567890</span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Nomor KTP</span>
                    <span class="value-data">1234567890987654</span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Foto Ktp</span>
                    <span class="value-data">Ktp.jpg</span>
                </div>
            </div>
        </div>
        <hr>
        <div class="sect-list">
            <h3>Data Tempat Tinggal</h3>
            <div class="list">
                <div class="detail-wrapper">
                    <span class="label">Provinsi</span>
                    <span class="value-data">DKI Jakarta</span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Kecamatan</span>
                    <span class="value-data">Kebon Jeruk</span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Kelurahan</span>
                    <span class="value-data">Kebon Jeruk</span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Kode Pos</span>
                    <span class="value-data">11530</span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Alamat Lengkap</span>
                    <span class="value-data">Rumah Jl. Raya Kebon Jeruk No.1, RT.7/RW.1</span>
                </div>
            </div>
        </div>
        <hr>
    </div>
</div>