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
            <h3 class="margin-top-10"><?= $this->translate('detail-contract-head'); ?></h3>
            <p><?= $this->translate('detail-contract-sub'); ?></p>
        </article>
    </div>
    <div class="row">
        <div class="table-container transaction-detail">
            <div class="table-content">
                <div class="content-wrapper">
                    <div class="detail-wrapper">
                        <span class="label"><?= $this->translate('label-data-funding'); ?></span>
                        <span class="value-data total-installment">
                            <!-- here position list from API --></span>
                    </div>
                    <div class="detail-wrapper">
                        <span class="label"><?= $this->translate('label-sisa-angsuran'); ?></span>
                        <span class="value-data remaining-installment">
                            <!-- here position list from API --></span>
                    </div>
                    <div class="detail-wrapper">
                        <span class="label"><?= $this->translate('label-tagihan-bulan-ini'); ?></span>
                        <span class="value-data this-month-bill">
                            <!-- here position list from API --></span>
                    </div>
                </div>
                <div class="keterangan">
                    <span><?= $this->translate('label-jumlah-tagihan'); ?></span>
                </div>
            </div>
            <div class="table-content">
                <div class="content-wrapper">
                    <div class="detail-wrapper">
                        <span class="label"><?= $this->translate('label-jatuh-tempo'); ?></span>
                        <span class="value-data due-date">
                            <!-- here position list from API --></span>
                    </div>
                    <div class="detail-wrapper">
                        <span class="label"><?= $this->translate('installment'); ?></span>
                        <span class="value-data installment-per-month">
                            <!-- here position list from API --></span>
                    </div>
                    <div class="detail-wrapper">
                        <span class="label"><?= $this->translate('label-denda-terlambat'); ?></span>
                        <span class="value-data late-charge">
                            <!-- here position list from API --></span>
                    </div>
                </div>
                <div class="keterangan">
                    <span><?= $this->translate('keterangan-denda'); ?></span> <strong><?= $this->translate('customer-care'); ?></strong>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="sect-list">
            <div class="heading">
                <h3><?= $this->translate('cara-bayar'); ?></h3>
                <button class="cta cta-primary cta-big cta-see full" type="button" onlick="window.location.href='<?= "/" . $lang . "/user/layanan"; ?>'"><?= $this->translate('more'); ?></button>
                <button class="cta cta-primary cta-big cta-see short" type="button" onlick="window.location.href='<?= "/" . $lang . "/user/layanan"; ?>'">Lihat</button>
            </div>
            <div class="list">
                <div class="list-wrapper">
                    <div class="detail-wrapper">
                        <span class="label"><?= $this->translate('virtual-account'); ?></span>
                        <span class="value-data"><?= $this->translate('value-virtual-account'); ?></span>
                    </div>
                    <div class="detail-wrapper">
                        <span class="label"><?= $this->translate('Nomor Kontrak'); ?>**</span>
                        <span class="value-data contract-number">
                            <!-- here position list from API --></span>
                    </div>
                </div>
                <div class="keterangan">
                    <div>
                        <span>*<?= $this->translate('keterangan-virtual-account'); ?></span>
                    </div>
                    <div>
                        <span>**<?= $this->translate('keterangan-nomor-kontrak'); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card">
            <div>
                <span><?= $this->translate('detail-angsuran'); ?></span>
            </div>
            <div class="btn-container">
                <a class="button-detail full" href=""><?= $this->translate('detail-transaksi'); ?><i class="fa fa-angle-right"></i></a>
                <a class="button-detail short" href=""><?= $this->translate('detail-transaksi'); ?><i class="fa fa-angle-right"></i></a>
            </div>
        </div>
        <hr>
        <div class="sect-list">
            <h3><?= $this->translate('detail-kontrak'); ?></h3>
            <div class="list contract-detail">
                <div class="detail-wrapper">
                    <span class="label"><?= $this->translate('label-jenis'); ?></span>
                    <span class="value-data product">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label"><?= $this->translate('Nomor Kontrak'); ?></span>
                    <span class="value-data contract-number">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label"><?= $this->translate('nama-pemohon'); ?></span>
                    <span class="value-data name">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label"><?= $this->translate('label-jatuh-tempo'); ?></span>
                    <span class="value-data due-date-contract">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label"><?= $this->translate('label-pembayaran'); ?></span>
                    <span class="value-data total-installment-contract">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label"><?= $this->translate('installment'); ?></span>
                    <span class="value-data installment-per-month-contract">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label"><?= $this->translate('periode'); ?></span>
                    <span class="value-data jangka-on-month">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label"><?= $this->translate('cabang-pencairan'); ?></span>
                    <span class="value-data cabang-pencairan">
                        <!-- here position list from API --></span>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row detail-jaminan">
        <div class="sect-list vehicle hide">
            <h3><?= $this->translate('detail-jaminan'); ?></h3>
            <div class="list">
                <div class="detail-wrapper">
                    <span class="label"><?= $this->translate('merk-kendaraan'); ?></span>
                    <span class="value-data brand">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label"><?= $this->translate('tipe-kendaraan'); ?></span>
                    <span class="value-data type">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label"><?= $this->translate('model-kendaraan'); ?></span>
                    <span class="value-data model">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label"><?= $this->translate('year-kendaraan'); ?></span>
                    <span class="value-data year">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label"><?= $this->translate('warna'); ?></span>
                    <span class="value-data color">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label"><?= $this->translate('nomor-polisi'); ?></span>
                    <span class="value-data vehicle-number">
                        <!-- here position list from API --></span>
                </div>
            </div>
        </div>
        <div class="sect-list land-certificate hide">
            <h3><?= $this->translate('detail-jaminan'); ?></h3>
            <div class="list">
                <div class="detail-wrapper">
                    <span class="label"><?= $this->translate('address'); ?></span>
                    <span class="value-data address">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label"><?= $this->translate('luas-bangunan'); ?></span>
                    <span class="value-data building-area">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label"><?= $this->translate('luas-tanah'); ?></span>
                    <span class="value-data surface-area">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label"><?= $this->translate('harga-pasar-pengajuan'); ?></span>
                    <span class="value-data price">
                        <!-- here position list from API --></span>
                </div>
            </div>
        </div>
        <div class="sect-list asset hide">
            <h3><?= $this->translate('detail-jaminan'); ?></h3>
            <div class="list">
                <div class="detail-wrapper">
                    <span class="label"><?= $this->translate('merk-aset'); ?></span>
                    <span class="value-data asset-brand">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label"><?= $this->translate('tipe-aset'); ?></span>
                    <span class="value-data asset-type">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label"><?= $this->translate('model-aset'); ?></span>
                    <span class="value-data asset-model">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label"><?= $this->translate('year-aset'); ?></span>
                    <span class="value-data asset-year">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label"><?= $this->translate('warna-aset'); ?></span>
                    <span class="value-data asset-color">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label"><?= $this->translate('label-buatan'); ?></span>
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
            <h3 class="margin-top-10"><?= $this->translate('cek-kontrak-lain'); ?></h3>
            <p><?= $this->translate('informasi-kontrak'); ?></p>
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
                            <span><?= $this->translate('telat-bayar'); ?></span>
                        </div>
                    </div>
                    <div class="contract-type">
                        <h5 class="category"></h5>
                        <h5 class="product"></h5>
                    </div>
                    <div class="details">
                        <div>
                            <h6><?= $this->translate('Nomor Kontrak'); ?></h6>
                            <p class="contract_number"></p>
                        </div>
                        <div>
                            <h6><?= $this->translate('installment'); ?></h6>
                            <p class="angsuran_perbulan"></p>
                        </div>
                        <div>
                            <h6><?= $this->translate('label-jatuh-tempo'); ?></h6>
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
                    <h5 class="more"><?= $this->translate('more'); ?> &#62;</h5>
                </li>
            </a>
            <a href="/<?= $lang; ?>/credit" class="contract-box add-contract">
                <li class="">
                    <div class="box">
                        <div class="plus">
                            <h1>&#43;</h1>
                        </div>
                        <h3><?= $this->translate('ajukan-kredit'); ?></h3>
                    </div>
                </li>
            </a>
        </ul>
    </div>
</section>

<?php $this->headScript()->prependFile('/static/js/Includes/contract.js'); ?>