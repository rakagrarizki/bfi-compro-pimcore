<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
    integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
<?php

/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout-credit.html.php');
$this->headScript()
    ->offsetSetFile(100, '/static/js/Includes/mobil.js');
$this->headScript()
    ->offsetSetFile(101, '/static/js/Includes/general-form.js');
$this->headScript()
    ->offsetSetFile(102, '/static/js/Includes/general-otp.js');

?>

<div class="container">
    <div class="row">
        <div class="col-md-12 no-padding">
            <div class="tab-get--credit">
                <nav class="step-list">
                    <ul class="nav nav-tab">
                        <li class="nav-item-1 active">
                            <a>
                                <span class="nav-icon">
                                    <i class="fas fa-check" aria-hidden="true"></i>
                                    <b><i class="fas fa-file-signature"></i></b>
                                </span>
                                <div class="nav-content">
                                    <span class="nav-step-text">Step 1</span>
                                    <p class="nav-step-desc">Data Pemohon</p>
                                    <span class="nav-step-tag"><?=$this->translate('state-step') ?></span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item-2">
                            <a>
                                <span class="nav-icon">
                                    <i class="fas fa-check" aria-hidden="true"></i>
                                    <b><i class="fas fa-house-user"></i></b>
                                </span>
                                <div class="nav-content">
                                    <span class="nav-step-text">Step 2</span>
                                    <p class="nav-step-desc">Data Alamat & Asset</p>
                                    <span class="nav-step-tag"><?=$this->translate('state-step') ?></span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item-3">
                            <a>
                                <span class="nav-icon">
                                    <i class="fas fa-check" aria-hidden="true"></i>
                                    <b><i class="fas fa-calculator"></i></b>
                                </span>
                                <div class="nav-content">
                                    <span class="nav-step-text">Step 3</span>
                                    <p class="nav-step-desc">Data Pendukung & Perhitungan</p>
                                    <span class="nav-step-tag"><?=$this->translate('state-step') ?></span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item-4">
                            <a>
                                <span class="nav-icon">
                                    <i class="fas fa-check" aria-hidden="true"></i>
                                    <b><i class="fas fa-calculator" aria-hidden="true"></i></b>
                                </span>
                                <div class="nav-content">
                                    <span class="nav-step-text">Step 4</span>
                                    <p class="nav-step-desc">Verifikasi Pengajuan</p>
                                    <span class="nav-step-tag"><?=$this->translate('state-step') ?></span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </nav>
                <form action="#" id="getCredit" method="POST" class="form-get--credit" role="form">
                    <input type="hidden" id="jenis_form" name="jenis_form" value="MOBIL">
                    <div class="tab-content">
                        <div id="menu1" class="tab-pane fade in active">
                            <div class="form-body--credit">
                                <div class="text-head">
                                    <h2 class="text-center">
                                        Data Pemohon Jaminan BPKB Mobil
                                    </h2>
                                    <p class="text-center">Silahkan masukkan data diri Anda.</p>
                                </div>
                                <div class="form-group">
                                    <label for="nama_lengkap"><?= $this->translate('form-name') ?></label>
                                    <input type="text" class="form-control formRequired formAlphabet" name="nama_lengkap" id="nama_lengkap" placeholder="<?= $this->translate('placeholder-name') ?>">
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group">
                                    <label for="no_handphone"><?= $this->translate('form-hp') ?></label>
                                    <input type="tel" pattern="\d*" class="form-control formPhoneNumber" name="no_handphone" id="no_handphone" maxlength="13" placeholder="<?= $this->translate('placeholder-hp') ?>">
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group radio-group">
                                    <label>Apakah nomor ini terhubung dengan whatsapp ?</label>
                                    <div class="radio-button">
                                        <div class="radio-wrap">
                                            <input type="radio" class="inputs formRequired" id="is-wa-number"
                                                name="is-wa-number" value="true">
                                            <label
                                                for="is-wa-number"><?=$this->translate('option-text-yes') ?></label>
                                        </div>
                                        <div class="radio-wrap">
                                            <input type="radio" class="inputs formRequired" id="is-wa-number1"
                                                name="is-wa-number" value="false">
                                            <label
                                                for="is-wa-number1"><?=$this->translate('option-text-no') ?></label>
                                        </div>
                                        <div class="error-wrap"></div>
                                    </div>
                                </div>
                                <div class="form-group wa-numbers" hidden>
                                    <label for="wa-number">Nomor Whatsapp</label>
                                    <input type="tel" pattern="\d*" class="form-control formPhoneNumber" name="wa-number" id="wa-number" maxlength="13" placeholder="Ketik Nomor Whatsapp">
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group">
                                    <label for="email"><?= $this->translate('form-email') ?></label>
                                    <input type="email" class="form-control formRequired formEmail" name="email" id="email_pemohon" placeholder="<?= $this->translate('placeholder-email') ?>">
                                    <div class="error-wrap"></div>
                                    <span><?=$this->translate('form-email-helper') ?></span>
                                    <div class="label-cekLogin hide"><?= $this->translate('text-cekLogin') ?><a href="#" class="logout" onclick="return logout('id');"><?= $this->translate('status-login') ?></a></div>
                                </div>
                                <div class="form-group" hidden>
                                    <label for="utm_source">utm_source</label>
                                    <input type="utm_source" class="form-control" name="utm_source" id="utm_source" placeholder="utm_source" readonly>
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group" hidden>
                                    <label for="utm_campaign">utm_campaign</label>
                                    <input type="utm_campaign" class="form-control" name="utm_campaign" id="utm_campaign" placeholder="utm_campaign" readonly>
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group" hidden>
                                    <label for="utm_term">utm_term</label>
                                    <input type="utm_term" class="form-control" name="utm_term" id="utm_term" placeholder="utm_term" readonly>
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group" hidden>
                                    <label for="utm_medium">utm_medium</label>
                                    <input type="utm_medium" class="form-control" name="utm_medium" id="utm_medium" placeholder="utm_medium" readonly>
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group" hidden>
                                    <label for="utm_content">utm_content</label>
                                    <input type="utm_content" class="form-control" name="utm_content" id="utm_content" placeholder="utm_content" readonly>
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group form-btn side-right">
                                    <button class="cta cta-primary cta-big cta-see buttonnext" id="next1"
                                        type="button"><?=$this->translate('next') ?></button>
                                </div>
                            </div>
                        </div>
                        <div id="menu2" class="tab-pane slide-left">
                            <div class="form-body--credit">
                                <div class="text-head">
                                    <h2 class="text-center">
                                        Alamat Lengkap & Asset Kendaraan
                                    </h2>
                                    <p class="text-center">Isi alamat lengkap Anda, untuk dapat melanjutkan step selanjutnya</p>
                                </div>
                                <div class="text-title-form">
                                    <h3>Data Domisili Saat Ini</h3>
                                    <p>Isi data alamat domisili Anda untuk cek ketersediaan profil mobil yang akan dijaminkan</p>
                                </div>
                                <div class="form-group">
                                    <button type="button" class="cta cta-primary cta-block" id="address-btn" data-toggle="modal" data-target="#addressModal"><i class="fas fa-search"></i> CARI ALAMAT</button>
                                </div>
                                <div class="form-group" hidden>
                                    <label><?= $this->translate('label-provinsi') ?></label>
                                    <select class="form-control formRequired" id="provinsi" name="provinsi" placeholder="<?= $this->translate('choose-provinsi') ?>" multiple="multiple">
                                    </select>
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group" hidden>
                                    <label><?= $this->translate('label-kota') ?></label>
                                    <select class="form-control formRequired" id="kota" name="kota" placeholder="<?= $this->translate('choose-kota') ?>" multiple="multiple">
                                        <option value="" class="placeholder" disabled selected><?= $this->translate('choose-kota') ?></option>
                                    </select>
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group" hidden>
                                    <label><?= $this->translate('label-kecamatan') ?></label>
                                    <select class="form-control formRequired" id="kecamatan" name="kecamatan" placeholder="<?= $this->translate('choose-kecamatan') ?>" multiple="multiple">
                                        <option value="" disabled selected><?= $this->translate('choose-kecamatan') ?></option>
                                    </select>
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group" hidden>
                                    <label><?= $this->translate('label-kelurahan') ?></label>
                                    <select class="form-control formRequired" id="kelurahan" name="kelurahan" placeholder="<?= $this->translate('choose-kelurahan') ?>" multiple="multiple">
                                        <option value="" disabled selected><?= $this->translate('choose-kelurahan') ?></option>
                                    </select>
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group" hidden>
                                    <label for="kode_pos"><?= $this->translate('label-postcode') ?></label>
                                    <input type="text" class="form-control formKodePos" name="kode_pos" id="kode_pos" placeholder="<?= $this->translate('placeholder-postcode') ?>" disabled>
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group" hidden>
                                    <label class="label-place" for="alamat_lengkap"><?= $this->translate('label-place') ?></label>
                                    <textarea class="form-control formRequired formAddress" name="alamat_lengkap" id="alamat_lengkap" placeholder="<?= $this->translate('placeholder-place') ?> Contoh: Jalan Rajawali 1 Blok A no.11 RT 01 RW 02"></textarea>
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="text-title-form">
                                    <h3>Data Asset Mobil</h3>
                                    <p>Isi profil mobil Anda sesuai STNK untuk hitung simulasi pinjaman pada step selanjutnya</p>
                                </div>
                                <div class="form-group">
                                    <label><?= $this->translate('label-type') ?></label>
                                    <select class="c-custom-select-trans form-control formRequired" placeholder="<?= $this->translate('placeholder-type') ?>" id="type_kendaraan" name="type_kendaraan" multiple="multiple">
                                        <option value="" disabled selected> <?= $this->translate('placeholder-type') ?></option>
                                    </select>
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group">
                                    <label><?= $this->translate('label-merk') ?></label>
                                    <select class="c-custom-select-trans form-control formRequired" placeholder="<?= $this->translate('placeholder-merk') ?>" id="merk_kendaraan" name="merk_kendaraan" multiple="multiple">
                                        <option value="" disabled selected> <?= $this->translate('placeholder-merk') ?></option>
                                    </select>
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group">
                                    <label><?= $this->translate('label-model') ?></label>
                                    <select class="c-custom-select-trans form-control formRequired" placeholder="<?= $this->translate('placeholder-model') ?>" id="model_kendaraan" name="model_kendaraan" multiple="multiple">
                                        <option value="" disabled selected> <?= $this->translate('placeholder-model') ?></option>
                                    </select>
                                    <div class="error-wrap"></div>
                                    <span>Lihat STNK untuk memudahkan pencarian</span>
                                </div>
                                 <div class="form-group">
                                    <label for="tahun_kendaraan"><?= $this->translate('label-tahun') ?></label>
                                    <input type="text" class="form-control formRequired" name="tahun_kendaraan" id="tahun_kendaraan" placeholder="<?= $this->translate('placeholder-tahun') ?>">
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group">
                                    <label for="plat-no">Plat Nomor Kendaraan</label>
                                    <input type="text" class="form-control formRequired" name="plat-no" id="plat-no" placeholder="Plat Nomor Kendaraan">
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group">
                                    <label for="kepemilikan_bpkb">Kepemilikan BPKB</label>
                                    <select class="c-custom-select-trans form-control formRequired" placeholder="Pilih Kepemilikan BPKB" id="kepemilikan_bpkb" name="kepemilikan_bpkb" multiple="multiple" >
                                        <option value="" disabled selected> <?= $this->translate('placeholder-status') ?></option>
                                    </select>
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group form-btn space-btn">
                                    <button class="cta cta-primary-outline cta-big cta-back buttonback"
                                        id="back2" type="button"><?=$this->translate('before') ?></button>
                                   <button class="cta cta-primary cta-big cta-see buttonnext" id="next2"
                                        type="button"><?=$this->translate('next') ?></button>
                                </div>
                            </div>
                        </div>
                        <div id="menu3" class="tab-pane slide-left">
                            <div class="form-body--credit">
                                <div class="text-head">
                                    <h2 class="text-center">Tambahan Informasi & Perhitungan</h2>
                                    <p class="text-center">Lengkapi data dan hitung pembiayaan yang Anda inginkan</p>
                                </div>
                                <div class="text-title-form">
                                    <h3>Informasi Tambahan</h3>
                                    <p>Mohon isi beberapa informasi singkat berikut untuk proses persetujuan pengajuan</p>
                                </div>
                                <div class="form-group">
                                    <label for="kepemilikan_rumah">Kepemilikan Rumah</label>
                                    <select class="c-custom-select-trans form-control formRequired" placeholder="Pilih Kepemikikan Rumah" id="kepemilikan_rumah" name="kepemilikan_rumah" multiple="multiple">
                                        <option value="" disabled selected></option>
                                    </select>
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group radio-group">
                                    <label >Alamat sesuai dengan KTP</label>
                                    <div class="radio-button">
                                        <div class="radio-wrap">
                                            <input type="radio" class="inputs formRequired" id="addres_same"
                                                name="addres_same" value="true">
                                            <label
                                                for="addres_same"><?=$this->translate('option-text-yes') ?></label>
                                        </div>
                                        <div class="radio-wrap">
                                            <input type="radio" class="inputs formRequired" id="addres_same1"
                                                name="addres_same" value="false">
                                            <label
                                                for="addres_same1"><?=$this->translate('option-text-no') ?></label>
                                        </div>
                                         <div class="error-wrap"></div>
                                    </div>
                                </div>
                                <div class="form-group radio-group">
                                    <label >Pekerjaan</label>
                                    <div class="radio-button">
                                        <div class="radio-wrap">
                                            <input type="radio" class="inputs formRequired" id="occupation"
                                                name="occupation" value="Karyawan">
                                            <label
                                                for="occupation">Karyawan</label>
                                        </div>
                                        <div class="radio-wrap">
                                            <input type="radio" class="inputs formRequired" id="occupation1"
                                                name="occupation" value="Wiraswasta">
                                            <label
                                                for="occupation1">Wiraswasta</label>
                                        </div>
                                         <div class="error-wrap"></div>
                                    </div>
                                </div>
                                <div class="text-title-form">
                                    <h3>Perhitungan Pembiayaan</h3>
                                </div>
                                <div class="form-group simulasi-group sliderGroup inputsimulasi">
                                    <label for="pembiayaan">Pembiayaan yang diinginkan</label>
                                    <input type="tel" pattern="\d*" id="pembiayaan"
                                        class="form-control inputs formRequired c-input-trans"
                                        aria-describedby="basic-addon1"
                                        placeholder="Pembiayaan yang diinginkan">
                                    <div class="slidecontainer ">
                                        <input id="funding" class="customslide" type="tel" pattern="\d*"
                                            data-slider-handle="custom" data-slider-tooltip="hide" />
                                        <div class="value-left valuemin">0</div>
                                        <div class="value-right valuemax">0</div>
                                    </div>
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group simulasi-group sliderGroup inputsimulasi">
                                    <label for="tenor">Masa Pembiayaan yang diinginkan</label>
                                    <input type="tel" pattern="\d*" id="tenor"
                                        class="form-control inputs formRequired c-input-trans"
                                        aria-describedby="basic-addon1"
                                        placeholder="Masa Pembiayaan yang diinginkan">
                                    <div class="slidecontainer ">
                                        <input id="tenor2" class="customslide" type="tel" pattern="\d*"
                                            data-slider-handle="custom" data-slider-tooltip="hide" />
                                        <div class="value-left valuemin">0</div>
                                        <div class="value-right valuemax">0</div>
                                    </div>
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group radio-group">
                                    <label>Asuransi Tahun 1</label>
                                    <div class="radio-button">
                                        <div class="radio-wrap">
                                            <input type="radio" class="inputs formRequired" id="occupation"
                                                name="occupation" value="All Risk">
                                            <label
                                                for="occupation">All Risk</label>
                                        </div>
                                        <div class="radio-wrap">
                                            <input type="radio" class="inputs formRequired" id="occupation1"
                                                name="occupation" value="Total Lost Only">
                                            <label
                                                for="occupation1">Total Lost Only</label>
                                        </div>
                                         <div class="error-wrap"></div>
                                    </div>
                                </div>
                                <div class="form-group radio-group">
                                    <label>Asuransi Tahun 2</label>
                                    <div class="radio-button">
                                        <div class="radio-wrap">
                                            <input type="radio" class="inputs formRequired" id="occupation"
                                                name="occupation" value="All Risk">
                                            <label
                                                for="occupation">All Risk</label>
                                        </div>
                                        <div class="radio-wrap">
                                            <input type="radio" class="inputs formRequired" id="occupation1"
                                                name="occupation" value="Total Lost Only">
                                            <label
                                                for="occupation1">Total Lost Only</label>
                                        </div>
                                         <div class="error-wrap"></div>
                                    </div>
                                </div>
                                <div class="form-group radio-group">
                                    <label>Asuransi Tahun 3</label>
                                    <div class="radio-button">
                                        <div class="radio-wrap">
                                            <input type="radio" class="inputs formRequired" id="occupation"
                                                name="occupation" value="All Risk">
                                            <label
                                                for="occupation">All Risk</label>
                                        </div>
                                        <div class="radio-wrap">
                                            <input type="radio" class="inputs formRequired" id="occupation1"
                                                name="occupation" value="Total Lost Only">
                                            <label
                                                for="occupation1">Total Lost Only</label>
                                        </div>
                                         <div class="error-wrap"></div>
                                    </div>
                                </div>
                                <div class="form-group radio-group">
                                    <label>Asuransi Tahun 4</label>
                                    <div class="radio-button">
                                        <div class="radio-wrap">
                                            <input type="radio" class="inputs formRequired" id="occupation"
                                                name="occupation" value="All Risk">
                                            <label
                                                for="occupation">All Risk</label>
                                        </div>
                                        <div class="radio-wrap">
                                            <input type="radio" class="inputs formRequired" id="occupation1"
                                                name="occupation" value="Total Lost Only">
                                            <label
                                                for="occupation1">Total Lost Only</label>
                                        </div>
                                         <div class="error-wrap"></div>
                                    </div>
                                </div>
                                <div class="form-group  simulasi-group rincian">
                                    <div class="total-estimate">
                                        <p class="title-angsuran">Estimasi Angsuran per Bulan</p>
                                        <p class="total">Rp 0</p>
                                        <button class="cta cta-primary cta-big absolutebutcalc" id="calcLoan"
                                            type="button" disabled><?=$this->translate('hitung') ?></button>
                                    </div>
                                    <p class="infotext">*Biaya angsuran dapat berubah sesuai dengan hasil verifikasi kondisi fisik kendaraan di kantor cabang.</p>
                                </div>
                                <div class="form-group form-btn space-btn">
                                    <button class="cta cta-primary-outline cta-big cta-back buttonback"
                                        id="back4" type="button"><?=$this->translate('before') ?>
                                    </button>
                                    <button class="cta cta-primary cta-big cta-see buttonnext" id="next4"
                                        type="button"><?=$this->translate('next') ?></button>
                                </div>
                            </div>
                        </div>
                        <div id="menu4" class="tab-pane slide-left">
                            <div class="form-body--credit-simulasi row">
                                <div class="text-head">
                                    <h2 class="text-center"><?= $this->translate('data-funding') ?></h2>
                                    <h2 class="text-center-edit"><?= $this->translate('change-data-funding') ?></h2>
                                    <p class="text-center"><?= $this->translate('input-data-funding') ?></p>
                                </div>
                                <div class="col-md-6 col-xs-12 no-padding-mobile">
                                    <div class="form-group sliderGroup inputsimulasi">
                                        <label for="jml-biaya"><?= $this->translate('label-data-funding') ?></label>
                                        <div class="input-group inputform">
                                            <span class="input-group-addon" id="basic-addon1">Rp</span>
                                            <input type="tel" pattern="\d*" id="ex6SliderVal" class="form-control formRequired formPrice formPrice1000 c-input-trans" aria-describedby="basic-addon1">
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="slidecontainer ">
                                            <input id="funding" class="customslide" type="tel" pattern="\d*" data-slider-handle="custom" data-slider-tooltip="hide" />
                                            <div class="value-left valuemin"></div>
                                            <div class="value-right valuemax"></div>
                                            <input type="hidden" id="otr">
                                        </div>
                                    </div>
                                    <div class="form-group sliderGroup inputsimulasi">
                                        <label><?= $this->translate('label-funding-year') ?></label>
                                        <select class="c-custom-select-trans form-control formRequired" id="jangka_waktu" name="jangka-waktu">
                                            <?php
                                            // for ($i = 12 ; $i <= 48; $i++) {
                                            //     if($i % 12 == 0){
                                            //         echo '<option value="' . $i . '">' . $i . ' ' .$this->translate('label-month') .'</option>';
                                            //     }
                                            // }
                                            ?>
                                        </select>
                                        <div class="error-wrap"></div>
                                        <!-- <div class="slidecontainer">
                                            <input id="installment" class="customslide" type="text" data-slider-handle="custom"
                                                   data-slider-min="12" data-slider-max="60" data-slider-step="12"
                                                   data-slider-tooltip="hide" />
                                            <div class="value-left">12 Bulan</div>
                                            <div class="value-right">60 Bulan</div>
                                        </div> -->
                                    </div>
                                    <input type="hidden" id="tahunke" value="<?= $this->translate('label-next-year') ?>">
                                    <div class="form-group inputsimulasi asuransi">
                                        <label><?= $this->translate('label-asuransi') ?></label>
                                        <div class="columnselect" ke="0">
                                            <div class="list-select">
                                                <label><?= $this->translate('label-next-year') ?> - 1</label>
                                            </div>
                                            <div class="list-select">
                                                <select class="c-custom-select-trans form-control formRequired opsiasuransi" name="status"></select>
                                            </div>
                                        </div>
                                        <div class="error-wrap"></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12 no-padding-mobile">
                                    <div class="rincian">
                                        <div class="rincian--content">
                                            <p class="title-angsuran"><?= $this->translate('label-rincian') ?></p>
                                            <table class="tableangsuran">
                                                <tr>
                                                    <td>
                                                        <?= $this->translate('label-total') ?> *
                                                    </td>
                                                    <td class="currency" tahun="0">
                                                        Rp 0
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <?= $this->translate('label-total-asuransi') ?> *
                                                    </td>
                                                    <td class="currency" tahun="1">
                                                        Rp 0
                                                    </td>
                                                </tr>
                                                <!-- <tr>
                                                    <td class="textsubcurrency">
                                                        Tahun ke-1 [All Risk Only*]
                                                    </td>
                                                    <td class="currency" tahun="1">
                                                        Rp 0
                                                    </td>
                                                </tr> -->
                                                <!-- <tr>
                                                    <td class="textsubcurrency">
                                                        Tahun ke-2 [Total Cost Only*]
                                                    </td>
                                                    <td class="currency" tahun="2">
                                                        Rp 205.000
                                                    </td>
                                                </tr> -->
                                            </table>
                                        </div>
                                        <div class="total-estimate">
                                            <p class="title-angsuran"><?= $this->translate('label-estimate') ?></p>
                                            <p class="total">Rp 0</p>
                                            <p class="infotext">*<?= $this->translate('text-estimate') ?></p>
                                            <button class="cta cta-primary cta-big absolutebutcalc" id="recalc" type="button"><?= $this->translate('hitung') ?></button>
                                        </div>
                                    </div>
                                    <div class="warning-calculate hide"><label><?= $this->translate("calculate-again"); ?></label></div>
                                </div>
                            </div>
                            <div class="button-area text-left back">
                                <button class="cta cta-primary cta-big cta-back buttonback" id="buttonback4" type="button"><?= $this->translate('before') ?></button>
                            </div>
                            <div class="button-area text-right next">
                                <button class="cta cta-primary cta-big cta-see buttonnext" id="button4" type="button"><?= $this->translate('next') ?></button>
                                <button class="cta cta-primary cta-big cta-see buttonnext hidesavebutton" type="button"><?= $this->translate('save') ?></button>
                            </div>
                        </div>
                        <div id="menu6" class="tab-pane slide-left">
                            <div class="form-body--credit">
                                <h2 class="text-center"><?= $this->translate('confirmation-otp') ?></h2>
                                <p class="text-center"><?= $this->translate('text-confirmation-otp') ?></p>
                                <div class="otp-number form-group">
                                    <!-- <div class="otp-number__phone disabled" hidden>
                                        <p id="showPhone"> <input type="tel" pattern="\d*" id="otpPhone" disabled /> <img id="otpEditPhone" src="/static/images/icon/pencils.png" alt=""></p>
                                    </div> -->
                                    <div class="otp-number__verify">
                                        <input type="tel" pattern="\d*" class="input-number formRequired" maxlength="1" name="otp1">
                                        <input type="tel" pattern="\d*" class="input-number formRequired" maxlength="1" name="otp2">
                                        <input type="tel" pattern="\d*" class="input-number formRequired" maxlength="1" name="otp3">
                                        <input type="tel" pattern="\d*" class="input-number formRequired" maxlength="1" name="otp4">
                                    </div>
                                    <div class="error-wrap"></div>
                                    <div class="otp-number__text">
                                        <p><?= $this->translate('dont-get-otp') ?> <span class="countdown"></span> </p>
                                    </div>
                                </div>
                            </div>
                            <div class="button-area text-center">
                                <button class="cta cta-primary cta-big cta-see btn-verifikasi buttonnext" id="button6" type="button" style="background-color: rgb(221, 221, 221); border-color: rgb(221, 221, 221);" disabled="disabled"><?= $this->translate('verifikasi') ?></button>
                            </div>
                        </div>
                        <div id="success" class="success-wrapper">
                            <div class="wrapper">
                                <div class="img-wrap">
                                    <img class="icon-thank-page" src="/static/images/icon/m_thank_you.png" alt="">
                                </div>
                                <div class="text-wrap text-center">
                                    <h3><?= $this->translate('tq-text-1') ?></h3>
                                    <p><?= $this->translate('tq-text-2') ?></p>
                                </div>
                                <div class="button-area text-center backtohome">
                                    <button class="cta cta-primary cta-big cta-see buttonnext btn-check" id="button7" type="button" onclick="return checkStatusPengajuan()"><?= $this->translate('cek-status-aplikasi') ?></button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="button-area text-center btn-beranda">
                                    <a href="<?php echo "/" . $this->getLocale() . '/' . $link; ?>" class="cta cta-primary cta-big cta-see buttonnext backtohome">
                                        <span><?= $this->translate('backtohome') ?></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Address Modal -->
<div class="modal fade" id="addressModal" tabindex="-1" role="dialog" aria-labelledby="addressModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content address-modal">
      <div class="modal-header">
        <h5 class="modal-title" id="addressModalLabel">Cari Alamat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <input type="text" class="form-control formAlphabet" name="nama_lengkap" id="nama_lengkap" placeholder="<?= $this->translate('placeholder-name') ?>">
            <button class="cta cta-primary"><i class="fas fa-search"></i></button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal timeout -->
<div class="modal fade" id="modal-timeout" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h4 class="modal-body-title">Mohon maaf sesi Anda telah berakhir</h4>
                <p class="modal-body-text">Tapi jangan khawatir data Anda sudah kami terima. Tim kami akan segera menghubungi Anda</p>
            </div>
        </div>
    </div>
</div>
<!-- Modal Konfirmasi -->
<div class="modal fade" id="modal-konfirmasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h4 class="modal-body-title">Apakah Anda yakin semua data yang diisi sudah benar?</h4>
                <p class="modal-body-text">Cek kembali data Anda sebelum lanjut ke tahap selanjutnya</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="cta cta-block cta-primary-outline" data-dismiss="modal">Cek Kembali</button>
                <button type="button" class="cta cta-block cta-primary" data-dismiss="modal">Ya, Lanjutkan</button>
            </div>
        </div>
    </div>
</div>

<div id="wrongOtp" class="modal modal--failed fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content text-center">
            <div class="modal-body">
                <p><?= $this->translate('wrong-otp') ?></p>
                <button type="button" class="cta cta-orange" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>

<div id="failedOtp" class="modal modal--failed fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content text-center">
            <div class="modal-body">
                <p><?= $this->translate('wrong-server') ?></p>
                <button type="button" class="cta cta-orange" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal-branch -->
<div class="modal fade" id="modal-branch" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content branch">
            <div class="modal-body">
                <h4><?= $this->translate('Branch not available'); ?></h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal"><?= $this->translate('close'); ?></button>
            </div>
        </div>
    </div>
</div>
<!-- end Modal branch -->

<!-- Modal-pricing -->
<div class="modal fade" id="modal-pricing" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content branch">
            <div class="modal-body">
                <h4><?= $this->translate('pricing-not-found'); ?></h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal"><?= $this->translate('close'); ?></button>
            </div>
        </div>
    </div>
</div>
<!-- end modal pricing -->

<?= $this->template('Includes/request-otp.html.php'); ?>