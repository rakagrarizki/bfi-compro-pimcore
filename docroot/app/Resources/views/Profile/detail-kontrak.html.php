<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout-credit.html.php');
?>

<div class="container detail-contract">
    <div class="row">
        <article class="title text-center">
            <h3 class="margin-top-10">Pembiayaan Agunan BPKB Mobil</h3>
            <p>Berikut ini detail kontrak Anda</p>
        </article>
    </div>
    <div class="row">
        <div class="table-container transaction-detail">
            <div class="table-content">
                <div class="content-wrapper">
                    <div class="detail-wrapper">
                        <span class="label">Jumlah Pembiayaan</span>
                        <span class="value-data total-installment">telah_dibayar+sisa_angsuran</span>
                    </div>
                    <div class="detail-wrapper">
                        <span class="label">Jumlah Sisa Angsuran</span>
                        <span class="value-data remaining-installment">sisa_angsuran</span>
                    </div>
                    <div class="detail-wrapper">
                        <span class="label">Jumlah Anda Bulan Ini*</span>
                        <span class="value-data have-paid-installment">angsuran_telah_dibayar</span>
                    </div>
                </div>
                <div class="keterangan">
                    <span>*Jumlah Tagihan = Jumlah pembiayaan per bulan + denda</span>
                </div>
            </div>
            <div class="table-content">
                <div class="content-wrapper">
                    <div class="detail-wrapper">
                        <span class="label">Tanggal Jatuh Tempo</span>
                        <span class="value-data due-date">tanggal_jatuh_tempo</span>
                    </div>
                    <div class="detail-wrapper">
                        <span class="label">Angsuran per Bulan</span>
                        <span class="value-data installment-per-month">angsuran_per_bulan</span>
                    </div>
                    <div class="detail-wrapper">
                        <span class="label">Denda Keterlambatan*</span>
                        <span class="value-data late-charge">denda_keterlambatan</span>
                    </div>
                </div>
                <div class="keterangan">
                    <span>*Denda keterlambatan per hari ini.</span>
                    <span>Untuk keterangan lebih lanjut silahkan hubungi <strong>Customer Care 1500018</strong></span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="sect-list">
            <div class="heading">
                <h3>Cara Pembayaran Angsuran</h3>
                <button class="cta cta-primary cta-big cta-see full" type="button">Selengkapnya</button>
                <button class="cta cta-primary cta-big cta-see short" type="button">Lihat</button>
            </div>
            <div class="list">
                <div class="list-wrapper">
                    <div class="detail-wrapper">
                        <span class="label">Nomor Virtual Account*</span>
                        <span class="value-data">112233445566778899 a/n BFI Finance</span>
                    </div>
                    <div class="detail-wrapper">
                        <span class="label">Nomor Kontrak**</span>
                        <span class="value-data">9876543210</span>
                    </div>
                </div>
                <div class="keterangan">
                    <div>
                        <span>*Nomor Virtual Account digunakan untuk pembayaran angsuran BFI Finance melalui Bank Permata dan Bank yang tergabung dalam ATM Bersama</span>
                    </div>
                    <div>
                        <span>**Nomor Kontrak digunakan untuk pembayaran angsuran BFI Finance melalui Kantor Pos, Alfa Group, Indomaret, Bank Mandiri dan BCA</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card">
            <div>
                <span>Lihat detail pembayaran angsuran Anda</span>
            </div>
            <div class="btn-container">
                <a class="button-detail full" href="">Detail Transaksi<i class="fa fa-angle-right"></i></a>
                <a class="button-detail short" href="">Lihat Detail<i class="fa fa-angle-right"></i></a>
            </div>
        </div>
        <hr>
        <div class="sect-list">
            <h3>Detail Kontrak</h3>
            <div class="list contract-detail">
                <div class="detail-wrapper">
                    <span class="label">Jenis Jaminan</span>
                    <span class="value-data product">BPKB Mobil</span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Nomor Kontrak</span>
                    <span class="value-data contract-number">1234567890</span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Nama Pemohon</span>
                    <span class="value-data name">Deborah T. Morris</span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Tanggal Jatuh Tempo</span>
                    <span class="value-data due-date-contract">11</span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Jumlah Pembayaran</span>
                    <span class="value-data total-installment-contract">Rp 80.000.000</span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Angsuran per Bulan</span>
                    <span class="value-data installment-per-month-contract">Rp 4.514.000</span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Jangka Waktu</span>
                    <span class="value-data jangka-on-month">12 Bulan</span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Cabang Pencairan</span>
                    <span class="value-data cabang-pencairan">Bogor</span>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row detail-jaminan">
        <div class="sect-list vehicle hide">
            <h3>Detail Jaminan</h3>
            <div class="list">
                <div class="detail-wrapper">
                    <span class="label">Merk Kendaraan</span>
                    <span class="value-data brand">Daihatsu</span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Tipe Kendaraan</span>
                    <span class="value-data type">CBS</span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Model Kendaraan</span>
                    <span class="value-data model">Ayla X10AT</span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Tahun Kendaraan</span>
                    <span class="value-data year">2013</span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Warna</span>
                    <span class="value-data color">Silver</span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">No. Polisi</span>
                    <span class="value-data vehicle-number">B 1234 CD</span>
                </div>
            </div>
        </div>
        <div class="sect-list land-certificate hide">
            <h3>Detail Jaminan</h3>
            <div class="list">
                <div class="detail-wrapper">
                    <span class="label">Alamat</span>
                    <span class="value-data address">Jl. Raya Kebon Jeruk No.1, RT.7/RW.1, Jakarta Barat</span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Luas Bangunan</span>
                    <span class="value-data building-area">278 m<sup>2</sup></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Luas Tanah</span>
                    <span class="value-data surface-area">201 m<sup>2</sup></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Harga Pasar Saat Pengajuan</span>
                    <span class="value-data price">Rp. 3.117.000.000</span>
                </div>
            </div>
        </div>
        <div class="sect-list asset hide">
            <h3>Detail Jaminan</h3>
            <div class="list">
                <div class="detail-wrapper">
                    <span class="label">Merk Aset</span>
                    <span class="value-data asset-brand">MK</span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Tipe Aset</span>
                    <span class="value-data asset-type">Machine Cutting</span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Model Aset</span>
                    <span class="value-data asset-model">Auto Platen Die Cutter W</span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Tahun Aset</span>
                    <span class="value-data asset-year">2013</span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Warna</span>
                    <span class="value-data asset-color">Abu-Abu</span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Buatan</span>
                    <span class="value-data made-in">China</span>
                </div>
            </div>
        </div>
    </div>
</div>
<section id="check-contract">
    <div class="container">
        <div class="title">
            <h3 class="margin-top-10">Cek Kontrak Lainnya</h3>
            <p>Berikut ini adalah informasi kontrak anda</p>
        </div>
        <ul class="contract-wrapper">
            <a class="contract-box hide" id="contract" href="#">
                <li href="" class="contract-detail contract-detail-mobile" id="telat"> <!--tambah id=telat utk tambah note telat bayar-->
                    <div class="icon-wrapper">
                        <div class="icon">
                            <img src="/_default_upload_bucket/form_credit/Rumah.png" alt="">
                        </div>
                        <div class="status">
                            <span>Telat Bayar</span> 
                        </div>
                    </div>
                    <div class="contract-type">
                        <h5 class="category"></h5>
                        <h5 class="product"></h5>
                    </div>
                    <div class="details">
                        <div>
                            <h6>No. Kontrak</h6>
                            <p class="contract_number"></p>
                        </div>
                        <div>
                            <h6>Angsuran per Bulan</h6>
                            <p class="angsuran_perbulan"></p>
                        </div>
                        <div>
                            <h6>Tanggal Jatuh Tempo</h6>
                            <p class="tanggal_jatuh_tempo"></p>
                        </div>
                    </div>
                    <div class="warning">
                        <div class='circle'>
                            <i class='fa fa-exclamation'></i>
                        </div>
                        <span>Anda terlambat membayar 5 hari</span>
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

<?php $this->headScript()->prependFile('/static/js/Includes/contract.js'); ?>