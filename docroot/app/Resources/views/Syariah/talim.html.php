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
                        <li class="nav-item-1 active">
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
                        <li class="nav-item-2">
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
                        <li class="nav-item-3">
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
                                        <?= $this->translate('syariah-title-step-2') ?>
                                    </h2>
                                    <p class="text-center"><?= $this->translate('syariah-subtitle-step-2') ?></p>
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
                                    <label><?= $this->translate('label-merk') ?></label>
                                    <select class="c-custom-select-trans form-control formRequired" placeholder="<?= $this->translate('placeholder-merk') ?>" id="merk_kendaraan" name="merk_kendaraan" multiple="multiple">
                                        <option value="" disabled> <?= $this->translate('placeholder-merk') ?></option>
                                    </select>
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group">
                                    <label><?= $this->translate('label-model') ?></label>
                                    <select class="c-custom-select-trans form-control formRequired" placeholder="<?= $this->translate('placeholder-model') ?>" id="model_kendaraan" name="model_kendaraan" multiple="multiple">
                                        <option value="" disabled selected> <?= $this->translate('placeholder-model') ?></option>
                                    </select>
                                    <div class="error-wrap"></div>
                                    <span><?= $this->translate('model-helper') ?></span>
                                </div>
                                <div class="form-group">
                                    <label><?= $this->translate('label-tahun') ?></label>
                                    <select class="c-custom-select-trans form-control formRequired" placeholder="<?= $this->translate('placeholder-tahun') ?>" id="tahun_kendaraan" name="tahun_kendaraan" multiple="multiple">
                                        <option value="" disabled> <?= $this->translate('placeholder-tahun') ?></option>
                                    </select>
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group form-btn space-btn">
                                    <button class="cta cta-primary-outline cta-big cta-back buttonback"
                                        id="back1" type="button"><?=$this->translate('before') ?>
                                    </button>
                                    <button class="cta cta-primary cta-big cta-see buttonnext" id="next2"
                                        type="button"><?=$this->translate('next') ?></button>
                                </div>
                            </div>
                        </div>
                        <div id="menu3" class="tab-pane slide-left">
                            <div class="form-body--credit">
                                <div class="text-head">
                                    <h1 class="text-center">
                                        <?= $this->translate('syariah-title-step-3') ?>
                                    </h1>
                                    <p class="text-center"><?= $this->translate('syariah-subtitle-step-3') ?></p>
                                </div>
                                <div class="form-group">
                                    <label><?=$this->translate('label-needs') ?></label>
                                    <select class="form-control inputs formRequired" id="needs"
                                        name="kebutuhan"
                                        placeholder="<?=$this->translate('placeholder-needs') ?>"
                                        multiple="multiple" />
                                    <option value="" disabled>
                                        <?=$this->translate('choose-needs') ?></option>
                                    </select>
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group">
                                    <label for="instansi"><?= $this->translate('form-name-instansi') ?></label>
                                    <input type="text" class="form-control formRequired formAlphabet" name="instansi" id="instansi" placeholder="<?= $this->translate('placeholder-name-instansi') ?>">
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group simulasi-group sliderGroup inputsimulasi">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1">Rp</span>
                                        <label for="pembiayaan"><?= $this->translate('desired-financing') ?></label>
                                        <input type="tel" pattern="\d*" id="pembiayaan" name="pembiayaan"
                                            class="form-control inputs formatRibuan formRequired c-input-trans"
                                            aria-describedby="basic-addon1"
                                            placeholder="<?= $this->translate('desired-financing') ?>">
                                    </div>
                                    <div class="slidecontainer ">
                                        <div class="value-left valuemin min-fund">Rp 40.000.000</div>
                                        <div class="value-right valuemax max-fund">Rp 500.000.000</div>
                                        <input id="funding" class="customslide" type="range"
                                        data-slider-min="40000000" data-slider-max="500000000" data-slider-step="100000" data-slider-value="100000000" data-slider-handle="custom" data-slider-tooltip="hide" />
                                    </div>
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group">
                                    <label><?=$this->translate('label-tenor') ?></label>
                                    <select class="form-control inputs formRequired" id="tenor"
                                        name="tenor"
                                        placeholder="<?=$this->translate('placeholder-tenor') ?>"
                                        multiple="multiple" />
                                    <option value="" disabled>
                                        <?=$this->translate('choose-tenor') ?></option>
                                    </select>
                                    <div class="error-wrap"></div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group date">
                                        <label for="buy-date"><?= $this->translate('form-buyDate') ?></label>
                                        <input type="text" class="iptDate form-control formRequired" name="tgl_beli" id="buy-date" placeholder="<?= $this->translate('placeholder-buyDate') ?>">
                                    </div>
                                    <div class="error-wrap"></div>
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
                                        id="back2" type="button"><?=$this->translate('before') ?>
                                    </button>
                                    <button class="cta cta-primary cta-big cta-see buttonnext" id="next3"
                                        type="button"><?=$this->translate('next') ?></button>
                                </div>
                            </div>
                        </div>
                        <div id="menu4" class="tab-pane slide-left">
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
                                <button class="cta cta-primary cta-big cta-see buttonnext" id="next4"
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
                                    <h3>Terima kasih telah melakukan pengajuan di BFI Finance</h3>
                                    <p>Anda akan segera dihubungi pada jam 08:00 - 17:00 di hari senin - jumat
                                        dan jam 08:00 - 11:00 di hari sabtu. </p>
                                </div>
                                <div class="box-button socmed-group">
                                    <p>Kunjungi Sosial Media Kami Untuk Mendapatkan Info Menarik seputar BFI Finance</p>
                                    <div class="button-area text-center">
                                        <a href="/id/" class="cta cta-primary">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                        <a href="/id/" class="cta cta-primary">
                                            <i class="fab fa-youtube"></i>
                                        </a>
                                        <a href="/id/" class="cta cta-primary">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                        <a href="/id/" class="cta cta-primary">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                        <a href="/id/" class="cta cta-primary">
                                            <i class="fab fa-tiktok"></i>
                                        </a>
                                    </div>
                                    <div class="button-area text-center">
                                        <a href="<?php echo "/" . $this->getLocale() . '/'; ?>" class="cta cta-primary-text cta-big ">
                                            <span>Kembali ke Beranda</span></a>
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
                <button type="button" class="cta cta-block cta-primary" data-dismiss="modal" id="confirm-data">Ya, Lanjutkan</button>
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