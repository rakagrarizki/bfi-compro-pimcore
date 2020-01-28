<?php

/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');
?>
<?php $lang = $this->getLocale(); ?>

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
                        <span class="value-data total-installment">
                            <!-- here position list from API --></span>
                    </div>
                    <div class="detail-wrapper">
                        <span class="label">Jumlah Sisa Angsuran</span>
                        <span class="value-data remaining-installment">
                            <!-- here position list from API --></span>
                    </div>
                    <div class="detail-wrapper">
                        <span class="label">Tagihan Anda Bulan Ini*</span>
                        <span class="value-data have-paid-installment">
                            <!-- here position list from API --></span>
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
                        <span class="value-data due-date">
                            <!-- here position list from API --></span>
                    </div>
                    <div class="detail-wrapper">
                        <span class="label">Angsuran per Bulan</span>
                        <span class="value-data installment-per-month">
                            <!-- here position list from API --></span>
                    </div>
                    <div class="detail-wrapper">
                        <span class="label">Denda Keterlambatan*</span>
                        <span class="value-data late-charge">
                            <!-- here position list from API --></span>
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
                <a href="<?= "/" . $lang . "/user/layanan"; ?>" class="cta cta-primary cta-big cta-see full" type="button">Selengkapnya</a>
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
                        <span class="value-data contract-number">
                            <!-- here position list from API --></span>
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
                    <span class="value-data product">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Nomor Kontrak</span>
                    <span class="value-data contract-number">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Nama Pemohon</span>
                    <span class="value-data name">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Tanggal Jatuh Tempo</span>
                    <span class="value-data due-date-contract">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Jumlah Pembayaran</span>
                    <span class="value-data total-installment-contract">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Angsuran per Bulan</span>
                    <span class="value-data installment-per-month-contract">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Jangka Waktu</span>
                    <span class="value-data jangka-on-month">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Cabang Pencairan</span>
                    <span class="value-data cabang-pencairan">
                        <!-- here position list from API --></span>
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
                    <span class="value-data brand">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Tipe Kendaraan</span>
                    <span class="value-data type">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Model Kendaraan</span>
                    <span class="value-data model">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Tahun Kendaraan</span>
                    <span class="value-data year">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Warna</span>
                    <span class="value-data color">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">No. Polisi</span>
                    <span class="value-data vehicle-number">
                        <!-- here position list from API --></span>
                </div>
            </div>
        </div>
        <div class="sect-list land-certificate hide">
            <h3>Detail Jaminan</h3>
            <div class="list">
                <div class="detail-wrapper">
                    <span class="label">Alamat</span>
                    <span class="value-data address">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Luas Bangunan</span>
                    <span class="value-data building-area">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Luas Tanah</span>
                    <span class="value-data surface-area">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Harga Pasar Saat Pengajuan</span>
                    <span class="value-data price">
                        <!-- here position list from API --></span>
                </div>
            </div>
        </div>
        <div class="sect-list asset hide">
            <h3>Detail Jaminan</h3>
            <div class="list">
                <div class="detail-wrapper">
                    <span class="label">Merk Aset</span>
                    <span class="value-data asset-brand">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Tipe Aset</span>
                    <span class="value-data asset-type">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Model Aset</span>
                    <span class="value-data asset-model">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Tahun Aset</span>
                    <span class="value-data asset-year">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Warna</span>
                    <span class="value-data asset-color">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Buatan</span>
                    <span class="value-data made-in">
                        <!-- here position list from API --></span>
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
                <li href="" class="contract-detail contract-detail-mobile" id="telat">
                    <!--tambah id=telat utk tambah note telat bayar-->
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
                        <span>
                            <!-- here position list from API --></span>
                    </div>
                    <h5 class="more">LIHAT DETAIL &#62;</h5>
                </li>
            </a>
            <a href="/<?= $lang; ?>/credit" class="contract-box add-contract">
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