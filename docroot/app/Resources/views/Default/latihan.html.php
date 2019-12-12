<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');
?>

<?php
    $this->headScript()->offsetSetFile(100, '/static/js/Includes/contact-us.js');
?>
<style>
    .sect-list {
        padding : 10px 20px;
    }

</style>

<div class="container">
    <div class="row">
        <article class="sect-title text-center">
            <h2 class="margin-top-10">Profile Anda</h2>
            <p>Berikut ini adalah profile Anda</p>
        </article>
        <div class="sect-list">
            <h3>Daftar Kontak</h3>
            <div class="list">
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
                Nama Lengkap : Deborah T. Morris
                Email : deborahmorris@gmail.com
                Nomor Handphone : 08124567890
                Nomor KTP : 1234567890987654
                Foto Ktp : Ktp.jpg
            </div>
        </div>
        <hr>
        <div class="sect-list">
            <h3>Data Tempat Tinggal</h3>
            <div class="list">
                Provinsi : DKI Jakarta
                Kecamatan : Kebon Jeruk
                Kelurahan : Kebon Jeruk
                Kode Pos : 11530
                Alamat Lengkap Rumah : Jl. Raya Kebon Jeruk No.1, RT.7/RW.1        
            </div>
        </div>
        <hr>
    </div>
</div>