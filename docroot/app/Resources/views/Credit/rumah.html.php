<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
    integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
<!-- START Mobille -->
<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout-credit.html.php');
$this->headScript()
    ->offsetSetFile(100, '/static/js/Includes/rumah.js');
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
                                    <p class="nav-step-desc"><?=$this->translate('data-pbf-step-1') ?></p>
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
                                    <p class="nav-step-desc"><?=$this->translate('data-pbf-step-2') ?></p>
                                    <span class="nav-step-tag"><?=$this->translate('state-step') ?></span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item-3">
                            <a>
                                <span class="nav-icon">
                                    <i class="fas fa-check" aria-hidden="true"></i>
                                    <b><i class="fas fa-copy"></i></b>
                                </span>
                                <div class="nav-content">
                                    <span class="nav-step-text">Step 3</span>
                                    <p class="nav-step-desc"><?=$this->translate('data-pbf-step-3') ?></p>
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
                                    <p class="nav-step-desc"><?=$this->translate('data-pbf-step-4') ?></p>
                                    <span class="nav-step-tag"><?=$this->translate('state-step') ?></span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item-5">
                            <a>
                                <span class="nav-icon">
                                    <i class="fas fa-check" aria-hidden="true"></i>
                                    <b><i class="fas fa-clipboard-check"></i></b>
                                </span>
                                <div class="nav-content">
                                    <span class="nav-step-text">Step 5</span>
                                    <p class="nav-step-desc"><?=$this->translate('data-confirmation') ?>
                                    </p>
                                    <span class="nav-step-tag"><?=$this->translate('state-step') ?></span>
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
                                        <?=$this->translate('data-name') , $this->translate('data-name-rumah') ?>
                                    </h1>
                                    <p class="text-center"><?=$this->translate('input-data-name') ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="nama_lengkap"><?=$this->translate('form-name') ?></label>
                                    <input type="text" class="form-control inputs formRequired formAlphabet"
                                        name="nama_lengkap" id="nama_lengkap"
                                        placeholder="<?=$this->translate('placeholder-name') ?>">
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group">
                                    <label for="idnumber"><?= $this->translate('form-idnumber') ?></label>
                                    <input type="text" class="form-control inputs formIdnumber" name="idnumber" id="idnumber" placeholder="<?= $this->translate('placeholder-idnumber') ?>" maxlength="16">
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group">
                                    <label for="no_handphone"><?=$this->translate('form-hp') ?></label>
                                    <input type="tel" pattern="\d*" class="form-control inputs formPhoneNumber"
                                        name="no_handphone" id="no_handphone" maxlength="13"
                                        placeholder="<?=$this->translate('placeholder-hp') ?>">
                                    <div class="error-wrap"></div>
                                    <span><?=$this->translate('form-handphone-helper') ?></span>
                                </div>
                                <div class="form-group radio-group">
                                    <label><?= $this->translate('is-wa-number') ?></label>
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
                                    <label for="wa_number"><?= $this->translate('label-wa-number') ?></label>
                                    <input type="tel" pattern="\d*" class="form-control formPhoneNumber" name="wa-number" id="wa_number" maxlength="13" placeholder="<?= $this->translate('placeholder-wa-number') ?>">
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group">
                                    <label for="email"><?=$this->translate('form-email') ?></label>
                                    <input type="email" class="form-control inputs formRequired formEmail"
                                        name="email_pemohon" id="email_pemohon"
                                        placeholder="<?=$this->translate('placeholder-email') ?>">
                                    <div class="error-wrap"></div>
                                    <span><?=$this->translate('form-email-helper') ?></span>
                                    <div class="label-cekLogin hide">
                                        <?=$this->translate('text-cekLogin') ?><a href="#" class="logout"
                                            onclick="return logout('id');"><?=$this->translate('status-login') ?></a>
                                    </div>
                                </div>
                                <div class="form-group" hidden>
                                    <label for="category">category</label>
                                    <input type="category" class="form-control" name="category" id="category" placeholder="category" value="PBF" readonly>
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group form-btn side-right">
                                    <button class="cta cta-primary cta-big cta-see buttonnext" id="next1"
                                        type="button"><?=$this->translate('next') ?></button>
                                </div>
                            </div>

                        </div>
                        <div id="menu2" class="tab-pane slide-left ">
                            <div class="form-body--credit">
                                <div class="text-head">
                                    <h2 class="text-center"><?=$this->translate('title-pbf-step-2') ?></h2>
                                    <p class="text-center"><?=$this->translate('sub-pbf-step-2') ?></p>
                                </div>
                                <div class="text-title-form">
                                    <h3><?=$this->translate('title-form-address') ?></h3>
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
                                <div class="form-group row">
                                    <div class="col-md-6 col-xs-6">
                                        <div class="form-group-row">
                                            <label for="rt"><?=$this->translate('label-rt') ?></label>
                                            <input type="text" class="form-control inputs formRequired formNumber" maxlength="3" name="rt"
                                                id="rt" placeholder="<?=$this->translate('placeholder-rt') ?>"
                                                >
                                                <div class="error-wrap"></div>
                                            </div>
                                        </div>
                                    <div class="col-md-6 col-xs-6">
                                        <div class="form-group-row">
                                            <label for="rw"><?=$this->translate('label-rw') ?></label>
                                            <input type="text" class="form-control inputs formRequired formNumber" maxlength="3" name="rw"
                                                id="rw" placeholder="<?=$this->translate('placeholder-rw') ?>"
                                                >
                                                <div class="error-wrap"></div>
                                            </div>
                                        </div>
                                </div>
                                <div class="form-group">
                                    <label for="kode_pos"><?=$this->translate('label-postcode') ?></label>
                                    <input type="text" class="form-control inputs formKodePos" name="kode_pos"
                                        id="kode_pos"
                                        placeholder="<?=$this->translate('placeholder-postcode') ?>" readonly>
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group">
                                    <label class="label-place"
                                        for="alamat_lengkap"><?=$this->translate('label-place') ?></label>
                                    <textarea class="form-control inputs formAddress"
                                        name="alamat_lengkap" id="alamat_lengkap"
                                        placeholder="<?=$this->translate('placeholder-place') ?> Contoh: Jalan Rajawali 1 Blok A no.11 RT 01 RW 02"></textarea>
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group radio-group">
                                    <label for="addres_same"><?=$this->translate('title-form-address-asset') ?></label>
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
                                <div class="same-address" hidden>
                                    <div class="text-title-form">
                                        <h3><?= $this->translate('title-address-asset') ?></h3>
                                    </div>
                                    <div class="form-group">
                                        <label><?=$this->translate('label-provinsi') ?></label>
                                        <select class="form-control inputs formRequired"
                                            id="provinsi_sertificate" name="provinsi_sertificate"
                                            placeholder="<?=$this->translate('placeholder-provinsi') ?>"
                                            multiple="multiple" />
                                        <option value="" disabled selected>
                                            <?=$this->translate('placeholder-provinsi') ?></option>
                                        </select>
                                        <div class="error-wrap"></div>
                                    </div>
                                    <div class="form-group">
                                        <label><?=$this->translate('label-kota') ?></label>
                                        <select class="form-control inputs formRequired" id="kota_sertificate"
                                            name="kota_sertificate"
                                            placeholder="<?=$this->translate('placeholder-kota') ?>"
                                            multiple="multiple" />
                                        <option value="" disabled selected>
                                            <?=$this->translate('placeholder-kota') ?>
                                        </option>
                                        </select>
                                        <div class="error-wrap"></div>
                                    </div>
                                    <div class="form-group">
                                        <label><?=$this->translate('label-kecamatan') ?></label>
                                        <select class="form-control inputs formRequired"
                                            id="kecamatan_sertificate" name="kecamatan_sertificate"
                                            placeholder="<?=$this->translate('placeholder-kecamatan') ?>"
                                            multiple="multiple" />
                                        <option value="" disabled selected>
                                            <?=$this->translate('placeholder-kecamatan') ?></option>
                                        </select>
                                        <div class="error-wrap"></div>
                                    </div>
                                    <div class="form-group">
                                        <label><?=$this->translate('label-kelurahan') ?></label>
                                        <select class="form-control inputs formRequired"
                                            id="kelurahan_sertificate" name="kelurahan_sertificate"
                                            placeholder="<?=$this->translate('placeholder-kelurahan') ?>"
                                            multiple="multiple" />
                                        <option value="" disabled selected>
                                            <?=$this->translate('placeholder-kelurahan') ?></option>
                                        </select>
                                        <div class="error-wrap"></div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6 col-xs-6">
                                            <div class="form-group-row">
                                                <label for="rt"><?=$this->translate('label-rt') ?></label>
                                                <input type="text" class="form-control inputs formRequired formNumber" maxlength="4" name="rt_sertificate"
                                                    id="rt_sertificate" placeholder="<?=$this->translate('placeholder-rt') ?>"
                                                    >
                                                </div>
                                            </div>
                                            <div class="error-wrap"></div>
                                        <div class="col-md-6 col-xs-6">
                                            <div class="form-group-row">
                                                <label for="rw"><?=$this->translate('label-rw') ?></label>
                                                <input type="text" class="form-control inputs formRequired formNumber" maxlength="4" name="rw_sertificate"
                                                    id="rw_sertificate" placeholder="<?=$this->translate('placeholder-rw') ?>"
                                                    >
                                                </div>
                                            </div>
                                            <div class="error-wrap"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="kode_pos"><?=$this->translate('label-postcode') ?></label>
                                        <input type="text" class="form-control inputs formKodePos" name="kode_pos_sertificate"
                                            id="kode_pos_sertificate"
                                            placeholder="<?=$this->translate('placeholder-postcode') ?>" readonly>
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group">
                                        <label
                                            for="alamat_sertificate"><?=$this->translate('label-place') ?></label>
                                        <textarea class="form-control inputs formRequired formAddress"
                                            name="alamat_sertificate" id="alamat_sertificate"
                                            placeholder="<?=$this->translate('placeholder-place') ?>"></textarea>
                                        <div class="error-wrap"></div>
                                </div>
                                </div>
                                <div class="text-title-form">
                                    <h3><?=$this->translate('title-form-job') ?></h3>
                                </div>
                                <div class="form-group">
                                    <label for="occupation"><?=$this->translate('label-work') ?></label>
                                    <select class="form-control inputs formRequired" id="occupation"
                                        name="occupation" placeholder="<?=$this->translate('placeholder-work') ?>" multiple="multiple">
                                        <option value="" disabled selected><?=$this->translate('placeholder-work') ?></option>
                                    </select>
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group employee_status" hidden>
                                    <label for="employee_status"><?=$this->translate('label-employee-status') ?></label>
                                    <select class="form-control inputs formRequired" id="employee_status"
                                        name="employee_status" placeholder="<?=$this->translate('placeholder-employee-status') ?>" multiple="multiple">
                                        <option value="" disabled selected><?=$this->translate('placeholder-employee-status') ?></option>
                                    </select>
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group years_service" hidden>
                                    <label for="years_service"><?=$this->translate('label-years-service') ?></label>
                                    <select class="form-control inputs formRequired" id="years_service"
                                        name="years_service" placeholder="<?=$this->translate('placeholder-years-service') ?>" multiple="multiple">
                                        <option value="" disabled selected><?=$this->translate('placeholder-years-service') ?></option>
                                    </select>
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group">
                                    <label for="penghasilan"><?=$this->translate('label-income') ?></label>
                                    <input type="text"
                                        class="formatRibuan formMaxSalary form-control inputs formRequired"
                                        name="penghasilan" id="penghasilan"
                                        placeholder="<?=$this->translate('placeholder-income') ?>">
                                    <div class="error-wrap"></div>
                                    <span><?=$this->translate('helper-income') ?></span>
                                </div>
                                <div class="text-title-form">
                                    <h3><?=$this->translate('title-form-status-job') ?></h3>
                                </div>
                                <div class="form-group">
                                    <label for="umur"><?=$this->translate('label-age') ?></label>
                                    <input type="text" class="form-control inputs formRequired formNumber"
                                        name="umur" id="umur" maxlength="2" placeholder="<?=$this->translate('placeholder-age') ?>">
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group">    
                                    <label for="marital_status"><?= $this->translate('label-marital-state') ?></label>
                                    <select class="form-control inputs formRequired" id="marital_status"
                                        name="marital_status" placeholder="<?= $this->translate('placeholder-marital-state') ?>"
                                        multiple="multiple">
                                        <option value="" disabled selected><?= $this->translate('placeholder-marital-state') ?></option>
                                    </select>
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group spouse_name" hidden>
                                    <label for="spouse_name"><?= $this->translate('label-couple-name') ?></label>
                                    <input type="text" class="form-control inputs formRequired formAlphabet"
                                        name="spouse_name" id="spouse_name" placeholder="<?= $this->translate('placeholder-couple-name') ?>">
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group spouse_job" hidden>
                                    <label><?= $this->translate('label-couple-job') ?></label>
                                    <select class="form-control inputs formRequired" id="spouse_job"
                                        name="spouse_job" placeholder="<?= $this->translate('placeholder-couple-job') ?>" multiple="multiple">
                                        <option value="" disabled selected><?= $this->translate('placeholder-couple-job') ?></option>
                                    </select>
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group form-check">
                                    <input class="form-check-input formChecked" type="checkbox" value="true"
                                        id="disclaimer-1" name="disclaimer-1">
                                    <label class="form-check-label" for="disclaimer-1"> <?= $this->translate('disclaimer-step') ?>
                                        <div class="error-wrap"></div>
                                    </label>
                                </div> 
                                <div class="form-group form-btn side-right">
                                    <!-- <button class="cta cta-primary-outline cta-big cta-back buttonback"
                                        id="back2" type="button"><?=$this->translate('before') ?></button> -->
                                    <button class="cta cta-primary cta-big cta-see buttonnext" id="next2"
                                        type="button"><?=$this->translate('next') ?></button>
                                </div>
                            </div>
                        </div>
                        <div id="menu3" class="tab-pane slide-left ">
                            <div class="form-body--credit">
                                <div class="text-head">
                                    <h2 class="text-center"><?=$this->translate('title-pbf-step-3') ?></h2>
                                    <p class="text-center"><?=$this->translate('sub-pbf-step-3') ?>
                                    </p>
                                </div>
                                <div class="text-title-form">
                                    <h3><?= $this->translate('title-asset-information') ?></h3>
                                </div>
                                <div class="form-group">
                                    <label for="asset_type"><?= $this->translate('label-asset-type') ?></label>
                                    <select class=" form-control inputs formRequired"
                                        placeholder="<?= $this->translate('placeholder-asset-type') ?>" id="asset_type"
                                        name="asset_type" multiple="multiple">
                                        <option value="" disabled selected><?= $this->translate('placeholder-asset-type') ?></option>
                                    </select>
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group">
                                    <label for="certificate_status"><?= $this->translate('label-jenis-sertifikat') ?></label>
                                    <select class=" form-control inputs formRequired"
                                        placeholder="<?= $this->translate('placeholder-jenis-sertifikat') ?>" id="certificate_status"
                                        name="certificate_status" multiple="multiple">
                                        <option value="" disabled selected><?= $this->translate('placeholder-jenis-sertifikat') ?></option>
                                    </select>
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group">
                                    <label for="certificate_by_name"><?= $this->translate('label-atasnama-sertifikat') ?>a</label>
                                    <select class=" form-control inputs formRequired"
                                        placeholder=<?= $this->translate('placeholder-atasnama-sertifikat') ?>" id="certificate_by_name"" name="
                                        certificate_by_name"" multiple="multiple">
                                    </select>
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group radio-group">
                                    <label for="addres_same"><?= $this->translate('label-certificate-resence') ?></label>
                                    <div class="radio-button">
                                        <div class="radio-wrap">
                                            <input type="radio" class="inputs formRequired" id="where_certificate"
                                                name="where_certificate" value="on hand">
                                            <label for="where_certificate">On hand</label>
                                        </div>
                                        <div class="radio-wrap">
                                            <input type="radio" class="inputs formRequired" id="where_certificate1"
                                                name="where_certificate" value="take over">
                                            <label for="where_certificate1">Take Over</label>
                                        </div>
                                            <div class="error-wrap"></div>
                                    </div>
                                </div>
                                <div class="form-group radio-group">
                                    <label for="addres_same"><?= $this->translate('label-imb') ?></label>
                                    <div class="radio-button">
                                        <div class="radio-wrap">
                                            <input type="radio" class="inputs formRequired" id="is_have_imb"
                                                name="is_have_imb" value="true">
                                            <label
                                                for="is_have_imb"><?=$this->translate('option-text-yes') ?></label>
                                        </div>
                                        <div class="radio-wrap">
                                            <input type="radio" class="inputs formRequired" id="is_have_imb1"
                                                name="is_have_imb" value="false">
                                            <label
                                                for="is_have_imb1"><?=$this->translate('option-text-no') ?></label>
                                        </div>
                                            <div class="error-wrap"></div>
                                    </div>
                                </div>
                                <div class="form-group radio-group">
                                    <label for="addres_same"><?= $this->translate('label-pbb-uptodate') ?></label>
                                    <div class="radio-button">
                                        <div class="radio-wrap">
                                            <input type="radio" class="inputs formRequired" id="is_pbb_uptodate"
                                                name="is_pbb_uptodate" value="true">
                                            <label
                                                for="is_pbb_uptodate"><?=$this->translate('option-text-yes') ?></label>
                                        </div>
                                        <div class="radio-wrap">
                                            <input type="radio" class="inputs formRequired" id="is_pbb_uptodate1"
                                                name="is_pbb_uptodate" value="false">
                                            <label
                                                for="is_pbb_uptodate1"><?=$this->translate('option-text-no') ?></label>
                                        </div>
                                            <div class="error-wrap"></div>
                                    </div>
                                </div>
                                <div class="form-group radio-group">
                                    <label for="addres_same"><?= $this->translate('label-sales-period') ?></label>
                                    <div class="radio-button">
                                        <div class="radio-wrap">
                                            <input type="radio" class="inputs formRequired"
                                                id="is_sales_period_last_year_not"
                                                name="is_sales_period_last_year_not" value="true">
                                            <label
                                                for="is_sales_period_last_year_not"><?=$this->translate('option-text-yes') ?></label>
                                        </div>
                                        <div class="radio-wrap">
                                            <input type="radio" class="inputs formRequired"
                                                id="is_sales_period_last_year_not1"
                                                name="is_sales_period_last_year_not" value="false">
                                            <label
                                                for="is_sales_period_last_year_not1"><?=$this->translate('option-text-no') ?></label>
                                        </div>
                                            <div class="error-wrap"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="selectDihuni"><?= $this->translate('label-selectDihuni') ?></label>
                                    <select class=" form-control inputs formRequired" placeholder="<?= $this->translate('placeholder-selectDihuni') ?>"
                                        id="selectDihuni" name="selectDihuni" multiple="multiple">
                                    </select>
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="text-title-form">
                                    <h3><?= $this->translate('title-asset-location') ?></h3>
                                </div>
                                <div class="form-group">
                                    <label for="asset_location"><?= $this->translate('label-asset-location') ?></label>
                                    <select class=" form-control inputs formRequired" placeholder="<?= $this->translate('placeholder-asset-location') ?>"
                                        id="asset_location" name="asset_location" multiple="multiple">
                                    </select>
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group radio-group">
                                    <label for="addres_same"><?= $this->translate('label-other-asset') ?></label>
                                    <div class="radio-button">
                                        <div class="radio-wrap">
                                            <input type="checkbox" class="inputs formRequired" id="other_assets-mbl"
                                                name="other_assets" value="motor">
                                            <label for="other_assets-mbl"><?= $this->translate('option-other-asset2') ?></label>
                                        </div>
                                        <div class="radio-wrap">
                                            <input type="checkbox" class="inputs formRequired" id="other_assets-mbl1"
                                                name="other_assets" value="mobil">
                                            <label for="other_assets-mbl1"><?= $this->translate('option-other-asset1') ?></label>
                                        </div>
                                        <div class="radio-wrap">
                                            <input type="checkbox" class="inputs formRequired" id="other_assets-mbl2"
                                                name="other_assets" value="rumah">
                                            <label for="other_assets-mbl2"><?= $this->translate('option-other-asset3') ?></label>
                                        </div>
                                        <div class="radio-wrap">
                                            <input type="checkbox" class="inputs formRequired" id="other_assets-mbl3"
                                                name="other_assets" value="apartment">
                                            <label for="other_assets-mbl3"><?= $this->translate('option-other-asset4') ?></label>
                                        </div>
                                            <div class="error-wrap"></div>
                                    </div>
                                </div>
                                <div class="form-group radio-group">
                                    <label for="addres_same"><?= $this->translate('label-vehicle-road') ?></label>
                                    <div class="radio-button">
                                        <div class="radio-wrap">
                                            <input type="radio" class="inputs formRequired" id="is_vehicle_road"
                                                name="is_vehicle_road" value="true">
                                            <label
                                                for="is_vehicle_road"><?=$this->translate('option-text-yes') ?></label>
                                        </div>
                                        <div class="radio-wrap">
                                            <input type="radio" class="inputs formRequired" id="is_vehicle_road1"
                                                name="is_vehicle_road" value="false">
                                            <label
                                                for="is_vehicle_road1"><?=$this->translate('option-text-no') ?></label>
                                        </div>
                                            <div class="error-wrap"></div>
                                    </div>
                                </div>
                                <div class="form-group radio-group">
                                    <label for="addres_same"><?= $this->translate('label-near-river') ?></label>
                                    <div class="radio-button">
                                        <div class="radio-wrap">
                                            <input type="radio" class="inputs formRequired" id="is_near_river"
                                                name="is_near_river" value="true">
                                            <label
                                                for="is_near_river"><?=$this->translate('option-text-yes') ?></label>
                                        </div>
                                        <div class="radio-wrap">
                                            <input type="radio" class="inputs formRequired" id="is_near_river1"
                                                name="is_near_river" value="false">
                                            <label
                                                for="is_near_river1"><?=$this->translate('option-text-no') ?></label>
                                        </div>
                                            <div class="error-wrap"></div>
                                    </div>
                                </div>
                                <div class="form-group radio-group">
                                    <label for="addres_same"><?= $this->translate('label-near-railroad') ?></label>
                                    <div class="radio-button">
                                        <div class="radio-wrap">
                                            <input type="radio" class="inputs formRequired" id="is_near_railroads"
                                                name="is_near_railroads" value="true">
                                            <label
                                                for="is_near_railroads"><?=$this->translate('option-text-yes') ?></label>
                                        </div>
                                        <div class="radio-wrap">
                                            <input type="radio" class="inputs formRequired" id="is_near_railroads1"
                                                name="is_near_railroads" value="false">
                                            <label
                                                for="is_near_railroads1"><?=$this->translate('option-text-no') ?></label>
                                        </div>
                                            <div class="error-wrap"></div>
                                    </div>
                                </div>
                                <div class="form-group radio-group">
                                    <label for="addres_same"><?= $this->translate('label-near-sliktower') ?></label>
                                    <div class="radio-button">
                                        <div class="radio-wrap">
                                            <input type="radio" class="inputs formRequired" id="is_near_silk_tower"
                                                name="is_near_silk_tower" value="true">
                                            <label
                                                for="is_near_silk_tower"><?=$this->translate('option-text-yes') ?></label>
                                        </div>
                                        <div class="radio-wrap">
                                            <input type="radio" class="inputs formRequired" id="is_near_silk_tower1"
                                                name="is_near_silk_tower" value="false">
                                            <label
                                                for="is_near_silk_tower1"><?=$this->translate('option-text-no') ?></label>
                                        </div>
                                            <div class="error-wrap"></div>
                                    </div>
                                </div>
                                <div class="form-group radio-group">
                                    <label for="addres_same"><?= $this->translate('label-near-provide-tower') ?></label>
                                    <div class="radio-button">
                                        <div class="radio-wrap">
                                            <input type="radio" class="inputs formRequired" id="is_near_provider_tower"
                                                name="is_near_provider_tower" value="true">
                                            <label
                                                for="is_near_provider_tower"><?=$this->translate('option-text-yes') ?></label>
                                        </div>
                                        <div class="radio-wrap">
                                            <input type="radio" class="inputs formRequired" id="is_near_provider_tower1"
                                                name="is_near_provider_tower" value="false">
                                            <label
                                                for="is_near_provider_tower1"><?=$this->translate('option-text-no') ?></label>
                                        </div>
                                            <div class="error-wrap"></div>
                                    </div>
                                </div>
                                <div class="form-group radio-group">
                                    <label for="addres_same"><?= $this->translate('label-near-grave') ?></label>
                                    <div class="radio-button">
                                        <div class="radio-wrap">
                                            <input type="radio" class="inputs formRequired" id="is_near_grave"
                                                name="is_near_grave" value="true">
                                            <label
                                                for="is_near_grave"><?=$this->translate('option-text-yes') ?></label>
                                        </div>
                                        <div class="radio-wrap">
                                            <input type="radio" class="inputs formRequired" id="is_near_grave1"
                                                name="is_near_grave" value="false">
                                            <label
                                                for="is_near_grave1"><?=$this->translate('option-text-no') ?></label>
                                        </div>
                                            <div class="error-wrap"></div>
                                    </div>
                                </div>
                                <div class="form-group form-btn space-btn">
                                    <button class="cta cta-primary-outline cta-big cta-back buttonback3"
                                        id="back3" type="button"><?=$this->translate('before') ?></button>
                                            <button class="cta cta-primary cta-big cta-see buttonnext" id="next3"
                                        type="button"><?=$this->translate('next') ?></button>
                                </div>
                            </div>
                        </div>
                        <div id="menu4" class="tab-pane slide-left ">
                            <div class="form-body--credit">
                                <div class="text-head">
                                    <h2 class="text-center"><?= $this->translate('title-pbf-step-4') ?></h2>
                                    <p class="text-center"><?= $this->translate('sub-pbf-step-4') ?></p>
                                </div>
                                <div class="text-title-form">
                                    <h3><?= $this->translate('title-estimate-installment') ?></h3>
                                </div>
                                <div class="form-group simulasi-group">
                                    <label for="estimasi_harga"><?= $this->translate('estimated-house-price') ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1">Rp</span>
                                        <input type="text" id="estimate_price"
                                            class="formatRibuan form-control inputs formRequired addonInput c-input-trans minEstimatedPrice"
                                            placeholder="<?= $this->translate('estimated-house-price') ?>">
                                    </div>
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group simulasi-group sliderGroup inputsimulasi">
                                    <label for="PengajuanBiaya"><?= $this->translate('desired-financing') ?></label>
                                    <input type="tel" pattern="\d*" id="PengajuanBiaya"
                                        class="form-control inputs formRequired c-input-trans"
                                        aria-describedby="basic-addon1"
                                        placeholder="<?= $this->translate('desired-financing') ?>">
                                    <div class="slidecontainer ">
                                        <input id="funding" class="customslide" type="tel" pattern="\d*"
                                            data-slider-handle="custom" data-slider-tooltip="hide" />
                                        <div class="value-left valuemin">0</div>
                                        <div class="value-right valuemax">0</div>
                                    </div>
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group">
                                    <label for="tenorPbf">Tenor</label>
                                    <select class="form-control inputs formRequired" id="tenorPbf"
                                        name="tenorPbf" placeholder="Pilih Tenor"
                                        multiple="multiple" >
                                    <option value="" disabled selected>Tenor</option>
                                    </select>
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group  simulasi-group rincian">
                                    <div class="total-estimate">
                                        <p class="title-angsuran"><?=$this->translate('label-estimate') ?>
                                        </p>
                                        <p class="total">Rp 0</p>
                                        <button class="cta cta-primary cta-big absolutebutcalc" id="calcLoan"
                                            type="button" disabled><?=$this->translate('hitung') ?></button>
                                    </div>
                                    <p class="infotext"><?= $this->translate('estimated-Installments-info-pbf') ?></p>
                                </div>
                                <div class="form-group form-check">
                                    <input class="form-check-input formChecked" type="checkbox" value="true"
                                        id="disclaimer" name="disclaimer">
                                    <label class="form-check-label" for="disclaimer"> <?= $this->translate('disclaimer-end') ?>
                                        <div class="error-wrap"></div>
                                    </label>
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
                        <div id="menu5" class="tab-pane slide-left ">
                            <div class="form-body--credit">
                                <h2 class="text-center"><?=$this->translate('confirmation-otp') ?></h2>
                                <p class="text-center"><?=$this->translate('text-confirmation-otp') ?></p>

                                <div class="otp-number form-group">
                                    <div class="otp-number__verify">
                                        <input type="tel" pattern="\d*" class="input-number formRequired"
                                            maxlength="1" name="otp1">
                                        <input type="tel" pattern="\d*" class="input-number formRequired"
                                            maxlength="1" name="otp2">
                                        <input type="tel" pattern="\d*" class="input-number formRequired"
                                            maxlength="1" name="otp3">
                                        <input type="tel" pattern="\d*" class="input-number formRequired"
                                            maxlength="1" name="otp4">
                                    </div>
                                    <div class="error-wrap"></div>
                                    <div class="otp-number__text">
                                        <p class="otp-wait"><?= $this->translate('wait-otp')?> <span id="otp-counter" class="countdown"></span> </p>
                                        <p class="otp-resend"><?= $this->translate('dont-get-otp')?> <span id="resendOTP" class="countdown">Resend</span></p>
                                    </div>
                                </div>

                            </div>


                            <div class="button-area text-center">
                                <button class="cta cta-primary cta-big cta-see buttonnext" id="next5"
                                    type="button"><?=$this->translate('verifikasi') ?></button>
                            </div>

                        </div>

                        <div id="success" class="success-wrapper">
                            <div class="wrapper">
                                <div class="img-wrap">
                                    <img class="icon-thank-page" src="/static/images/icon/m_thank_you.png"
                                        alt="">
                                </div>
                                <div class="text-wrap text-center">
                                    <h3><?=$this->translate('data-step-finish') ?></h3>
                                    <p><?=$this->translate('sub-step-finish') ?></p>
                                </div>
                                <div id="box-document">
                                    <p><?=$this->translate('dokumen-persyaratan') ?></p>
                                    <div class="row">
                                        <div class="col-md-6 col-xs-12">
                                            <div class=" box-item">
                                                <div class="wrap-icon">
                                                    <i class="fa fa-check" aria-hidden="true"></i>
                                                </div>
                                                <div class="wrap-text">
                                                    <p><?=$this->translate('id-card') ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xs-12">
                                            <div class=" box-item">
                                                <div class="wrap-icon">
                                                    <i class="fa fa-check" aria-hidden="true"></i>
                                                </div>
                                                <div class="wrap-text">
                                                    <p><?=$this->translate('npwp-text') ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xs-12">
                                            <div class=" box-item">
                                                <div class="wrap-icon">
                                                    <i class="fa fa-check" aria-hidden="true"></i>
                                                </div>
                                                <div class="wrap-text">
                                                    <p><?=$this->translate('kk-text') ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xs-12">
                                            <div class=" box-item">
                                                <div class="wrap-icon">
                                                    <i class="fa fa-check" aria-hidden="true"></i>
                                                </div>
                                                <div class="wrap-text">
                                                    <p><?=$this->translate('rekening-text') ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xs-12">
                                            <div class=" box-item">
                                                <div class="wrap-icon">
                                                    <i class="fa fa-check" aria-hidden="true"></i>
                                                </div>
                                                <div class="wrap-text">
                                                    <p><?=$this->translate('buku-kepemilikan-rumah-text') ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xs-12">
                                            <div class=" box-item">
                                                <div class="wrap-icon">
                                                    <i class="fa fa-check" aria-hidden="true"></i>
                                                </div>
                                                <div class="wrap-text">
                                                    <p><?=$this->translate('selfie-text') ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xs-12">
                                            <div class=" box-item">
                                                <div class="wrap-icon">
                                                    <i class="fa fa-check" aria-hidden="true"></i>
                                                </div>
                                                <div class="wrap-text">
                                                    <p><?=$this->translate('foto-rumah-text') ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-button">
                                    <p><?=$this->translate('pertanyaan-wa') ?></p>
                                    <div class="button-area text-center">
                                        <a href="/id/" class="cta cta-success cta-big">
                                            <i class="fab fa-whatsapp"></i>
                                            <span><?=$this->translate('wa-number') ?></span></a>
                                    </div>
                                    <div class="button-area text-center">
                                        <a href="/id/" class="cta cta-primary-outline cta-big ">
                                            <span><?=$this->translate('cek-pengajuan-text') ?></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="wrongOtp" class="modal modal--failed fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content text-center">
            <div class="modal-body">
                <p><?=$this->translate('wrong-otp') ?></p>
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
                <p><?=$this->translate('wrong-server') ?></p>
                <button type="button" class="cta cta-orange" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal timeout -->
<div class="modal fade" id="modal-timeout" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h4 class="modal-body-title"><?= $this->translate('timeout-title') ?></h4>
                <p class="modal-body-text"><?= $this->translate('timeout-description') ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="cta cta-primary go-to-home" data-dismiss="modal" ><?=$this->translate('backtohome') ?></button>
            </div>
        </div>
    </div>
</div>
