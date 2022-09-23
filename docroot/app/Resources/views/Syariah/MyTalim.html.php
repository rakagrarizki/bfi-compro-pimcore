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
    ->offsetSetFile(100, '/static/js/Includes/syariah/my-talim.js');
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
                        <li class="nav-item-2 active">
                            <a>
                                <span class="nav-icon">
                                    <i class="fas fa-check" aria-hidden="true"></i>
                                    <b><i class="fas fa-file-signature"></i></b>
                                </span>
                                <div class="nav-content">
                                    <span class="nav-step-text">Step 1</span>
                                    <p class="nav-step-desc"><?= $this->translate('applicant-data') ?></p>
                                    <span class="nav-step-tag"><?= $this->translate('state-step') ?></span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item-3">
                            <a>
                                <span class="nav-icon">
                                    <i class="fas fa-check" aria-hidden="true"></i>
                                    <b><i class="fas fa-house-user"></i></b>
                                </span>
                                <div class="nav-content">
                                    <span class="nav-step-text">Step 2</span>
                                    <p class="nav-step-desc"><?= $this->translate('address-asset-data') ?></p>
                                    <span class="nav-step-tag"><?= $this->translate('state-step') ?></span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item-4">
                            <a>
                                <span class="nav-icon">
                                    <i class="fas fa-check" aria-hidden="true"></i>
                                    <b><i class="fas fa-calculator"></i></b>
                                </span>
                                <div class="nav-content">
                                    <span class="nav-step-text">Step 3</span>
                                    <p class="nav-step-desc"><?= $this->translate('financing-data') ?></p>
                                    <span class="nav-step-tag"><?= $this->translate('state-step') ?></span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </nav>
                <form action="#" id="getCredit" method="POST" class="form-get--credit" role="form">
                    <div class="tab-content">
                        <div id="menu1" class="tab-pane fade in active">
                            <div class="form-body--credit">
                                <div class="text-head">
                                    <h1 class="text-center">
                                        <?= $this->translate('applicant-data') ?>
                                    </h1>
                                    <p class="text-center"><?= $this->translate('data-name-sub') ?></p>
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
                                <div class="form-group">
                                    <label for="email"><?= $this->translate('form-email') ?></label>
                                    <input type="email" class="form-control formRequired formEmail" name="email" id="email_pemohon" placeholder="<?= $this->translate('placeholder-email') ?>">
                                    <div class="error-wrap"></div>
                                    <span class="input-helper"><?=$this->translate('form-email-helper') ?></span>
                                    <div class="label-cekLogin hide"><?= $this->translate('text-cekLogin') ?><a href="#" class="logout" onclick="return logout('id');"><?= $this->translate('status-login') ?></a></div>
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
                                        <?= $this->translate('ndfc-title-step-2') ?>
                                    </h2>
                                    <p class="text-center"><?= $this->translate('ndfc-subtitle-step-2') ?></p>
                                </div>
                                <div class="text-title-form">
                                    <h3><?= $this->translate('data-address-title') ?></h3>
                                    <p><?= $this->translate('data-address-subtitle') ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="provinsi"><?=$this->translate('label-provinsi') ?></label>
                                    <select class="form-control inputs formRequired" id="provinsi"
                                        name="provinsi" placeholder="<?=$this->translate('placeholder-provinsi') ?>"
                                        multiple="multiple" >
                                    <option value="" disabled selected>Provinsi</option>
                                    </select>
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group">
                                    <label><?=$this->translate('label-kota') ?></label>
                                    <select class="form-control inputs formRequired" id="kota" name="kota"
                                        placeholder="<?=$this->translate('placeholder-kota') ?>"
                                        multiple="multiple" />
                                    <option value="" disabled selected>
                                        <?=$this->translate('choose-kota') ?>
                                    </option>
                                    </select>
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group">
                                    <label><?=$this->translate('label-kecamatan') ?></label>
                                    <select class="form-control inputs formRequired" id="kecamatan"
                                        name="kecamatan"
                                        placeholder="<?=$this->translate('placeholder-kecamatan') ?>"
                                        multiple="multiple" />
                                    <option value="" disabled selected>
                                        <?=$this->translate('choose-kecamatan') ?></option>
                                    </select>
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group">
                                    <label><?=$this->translate('label-kelurahan') ?></label>
                                    <select class="form-control inputs formRequired" id="kelurahan"
                                        name="kelurahan"
                                        placeholder="<?=$this->translate('placeholder-kelurahan') ?>"
                                        multiple="multiple" />
                                    <option value="" disabled selected>
                                        <?=$this->translate('choose-kelurahan') ?></option>
                                    </select>
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group">
                                    <label for="kode_pos"><?=$this->translate('label-postcode') ?></label>
                                    <input type="text" class="form-control inputs formKodePos" name="kode_pos"
                                        id="kode_pos"
                                        placeholder="<?=$this->translate('placeholder-postcode') ?>" readonly>
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group">
                                    <label class="label-place" for="alamat_lengkap"><?= $this->translate('label-place') ?></label>
                                    <textarea class="form-control formRequired formAddress" name="alamat_lengkap" id="alamat_lengkap" placeholder="<?= $this->translate('placeholder-place') ?> Contoh: Jalan Rajawali 1 Blok A no.11 RT 01 RW 02"></textarea>
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="text-title-form">
                                    <h3><?= $this->translate('data-ndfc-title') ?></h3>
                                    <p><?= $this->translate('data-ndfc-subtitle') ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="merk_kendaraan_text"><?= $this->translate('label-merk') ?></label>
                                    <input type="text" class="form-control formRequired" name="merk_kendaraan_text" id="merk_kendaraan_text" placeholder="<?= $this->translate('placeholder-merk') ?>">
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group">
                                    <label for="tahun_kendaraan_text"><?= $this->translate('label-tahun') ?></label>
                                    <input type="text" class="form-control formYear formRequired" maxlength="4" name="tahun_kendaraan_text" id="tahun_kendaraan_text" maxlength="4" placeholder="<?= $this->translate('placeholder-tahun') ?>">
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group form-btn space-btn">
                                    <button class="cta cta-primary-outline cta-big cta-back buttonback"
                                        id="back1" type="button"><?=$this->translate('before') ?>
                                    </button>
                                    <button class="cta cta-primary cta-big cta-see buttonnext" id="next2"
                                        type="button" disabled><?=$this->translate('next') ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>