<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout-credit.html.php');

$is_dupcheck = $_GET['dupcheck'];
$is_product = $_GET['product'];
?>
<div class="container">
    <div class="form-body--credit fluid">
        <div class="text-head">
            <h2 class="text-center product-title">
                <?php if($is_product == "pbf"){?>
                    <?=$this->translate('failedPBF')?>
                <?php } ?>
            </h2>
            <p class="text-center product-subtitle">
                <?php if($is_dupcheck == "true"){?>
                    <?=$this->translate('dupcheck')?>
                <?php } ?>
            </p>
        </div>
        <div class="wrap-content-fail">
            <img src="/static/images/fail.png" class="img-responsive" alt="">
            <p class="text-center">Klik nomor di bawah ini untuk chat pertanyaan seputar proses pengajuan:</p>
            <a href="tel:02150860777">(021) 50860777</a>
        </div>
    </div>
    <div class="simulasi_pbf">
        <div class="container">
            <div class="row">
                <div class="col-md-4 calc-sect smallContent" id="ctaNDFM" hidden>
                    <div class="list-item">
                        <p>Merk</p>
                        <p class="price">
                            Honda NEW Supra X 125
                        </p>
                    </div>
                    <div class="list-item">
                        <p>Jumlah Pinjaman</p>
                        <p class="price">
                            Rp 1.500.000
                        </p>
                    </div>
                    <div class="list-item">
                        <p>Tenor</p>
                        <p class="price">
                           18 Bulan
                        </p>
                    </div>
                            <div class="estimasi">
                                <p class="text-center">Estimasi Angsuran per Bulan</p>
                                <p id="result-estimasi" class="text-center">Rp 148.500</p>
                            </div>
                     <div class="wrap-btn">
                         <a href="" class="cta cta-orange" id="">Ajukan Pengajuan</a>
                     </div>
                </div>
                <div class="col-md-4 calc-sect smallContent" id="ctaNDFC" hidden>
                    <div class="list-item">
                        <p>Merk</p>
                        <p class="price">
                            Toyota All New Avanza VVTI
                        </p>
                    </div>
                    <div class="list-item">
                        <p>Jumlah Pinjaman</p>
                        <p class="price">
                            Rp 16.000.000
                        </p>
                    </div>
                    <div class="list-item">
                        <p>Tenor</p>
                        <p class="price">
                            24 Bulan
                        </p>
                    </div>
                            <div class="estimasi">
                                <p class="text-center">Estimasi Angsuran per Bulan</p>
                                <p id="result-estimasi" class="text-center">Rp 1.358.000</p>
                            </div>
                     <div class="wrap-btn">
                         <a href="" class="cta cta-orange" id="">Ajukan Pengajuan</a>
                     </div>
                </div>
                <div class="col-md-4 calc-sect smallContent" id="ctaPBF" hidden>
                    <div class="list-item">
                        <p>Estimasi Harga Rumah</p>
                        <p class="price">
                            Rp 400.000.000
                        </p>
                    </div>
                    <div class="list-item">
                        <p>Jumlah Pinjaman</p>
                        <p class="price">
                            Rp 200.000.000
                        </p>
                    </div>
                    <div class="list-item">
                        <p>Tenor</p>
                        <p class="price">
                            48 Bulan
                        </p>
                    </div>
                            <div class="estimasi">
                                <p class="text-center">Estimasi Angsuran per Bulan</p>
                                <p id="result-estimasi" class="text-center">Rp 5.668.500</p>
                            </div>
                     <div class="wrap-btn">
                         <a href="" class="cta cta-orange" id="">Ajukan Pengajuan</a>
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>