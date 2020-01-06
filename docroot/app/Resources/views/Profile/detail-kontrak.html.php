<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');
?>

<div class="container detail-contract">
    <div class="row">
        <article class="sect-title text-center">
            <h2 class="margin-top-10">Pembiayaan Agunan BPKB Mobil</h2>
            <p>Berikut ini detail kontrak Anda</p>
        </article>
    </div>
    <div class="row">
        <div class="table-container">
            <div class="table-content">
                <div class="content-wrapper">
                    <div class="detail-wrapper">
                        <span class="label">Jumlah Pembiayaan</span>
                        <span class="value-data">Rp 80.000.000</span>
                    </div>
                    <div class="detail-wrapper">
                        <span class="label">Jumlah Sisa Angsuran</span>
                        <span class="value-data">Rp 12.462.000</span>
                    </div>
                    <div class="detail-wrapper">
                        <span class="label">Jumlah Anda Bulan Ini*</span>
                        <span class="value-data">Rp 4.600.000</span>
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
                        <span class="value-data">11 November 2019</span>
                    </div>
                    <div class="detail-wrapper">
                        <span class="label">Angsuran per Bulan</span>
                        <span class="value-data">Rp 4.514.000</span>
                    </div>
                    <div class="detail-wrapper">
                        <span class="label">Denda Keterlambatan*</span>
                        <span class="value-data">Rp 82.000</span>
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
            <div class="list">
                <div class="detail-wrapper">
                    <span class="label">Jenis Jaminan</span>
                    <span class="value-data">BPKB Mobil</span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Nomor Kontrak</span>
                    <span class="value-data">1234567890</span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Nama Pemohon</span>
                    <span class="value-data">Deborah T. Morris</span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Tanggal Jatuh Tempo</span>
                    <span class="value-data">11</span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Jumlah Pembayaran</span>
                    <span class="value-data">Rp 80.000.000</span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Angsuran per Bulan</span>
                    <span class="value-data">Rp 4.514.000</span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Jangka Waktu</span>
                    <span class="value-data">12 Bulan</span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Cabang Pencairan</span>
                    <span class="value-data">Bogor</span>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="sect-list">
            <h3>Detail Jaminan</h3>
            <div class="list">
                <div class="detail-wrapper">
                    <span class="label">Merk Kendaraan</span>
                    <span class="value-data">Daihatsu</span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Tipe Kendaraan</span>
                    <span class="value-data">CBS</span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Model Kendaraan</span>
                    <span class="value-data">Ayla X10AT</span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Tahun Kendaraan</span>
                    <span class="value-data">2013</span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">Warna</span>
                    <span class="value-data">Silver</span>
                </div>
                <div class="detail-wrapper">
                    <span class="label">No. Polisi</span>
                    <span class="value-data">B 1234 CD</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <article class="sect-title text-center">
            <h2 class="margin-top-10">Cek Kontrak Lainnya</h2>
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