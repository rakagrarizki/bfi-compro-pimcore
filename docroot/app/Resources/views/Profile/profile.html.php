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

<div class="container profile">
    <div class="row">
        <article class="sect-title text-center">
            <h2 class="margin-top-10">Profile Anda</h2>
            <p>Berikut ini adalah profile Anda</p>
        </article>
    </div>
    <div class="row">
        <div class="sect-list">
            <h3>Daftar Kontrak</h3>
            <div class="list contract">
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
    </div>
    <hr>
    <div class="row">
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
    </div>
    <hr>
    <div class="row">
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
                    <span class="label">Alamat</span>
                    <span class="value-data address">Rumah Jl. Raya Kebon Jeruk No.1, RT.7/RW.1</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card-update">
            <div class="icon">
                <img class="imggetcredit" src="/_default_upload_bucket/form_credit/Mobil.png" alt="">
            </div>
            <div class="content-text">
                <div class="title">
                    <h3>Update Data Anda</h3>
                </div>
                <div class="text">
                    <p><span>
                        Jika ada perubahan data profil Anda,
                        silahkan datang ke cabang BFI terdekat
                    </span></p>
                </div>
            </div>
            <div class="button-cabang">
                <button class="cta cta-primary cta-big">Lihat Cabang</button>
            </div> 
        </div>
    </div>
</div>