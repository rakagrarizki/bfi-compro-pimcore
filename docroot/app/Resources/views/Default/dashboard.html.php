<?php

/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');
?>

<section id="verify-section">
    <div class="container">
        <div class="verify-wrapper">
            <div class="col-lg-4 col-md-4 col-xs-12">
                <h4><?= $this->translate('verifikasi-akun') ?></h4>
                <p><?= $this->translate('verifikasi-akun-sub') ?></p>
            </div>
            <div class="col-lg-8 col-md-8 col-xs-12 step-wrapper">
                <ul class="stepper-row">
                    <li id="list-step" class="active">
                        <span id="poin1" class="number">1</span>
                    </li>
                    <li id="list-step">
                        <span id="poin2" class="number">2</span>
                        <a href="/<?= $this->getLocale() ?>/user/verify-email" class="tool-tip">
                            <p class="email"><?= $this->translate('email') ?></p>
                            <p class="verifikasi"><u><?= $this->translate('verifikasi') ?></u> &#62;</p>
                        </a>
                    </li>
                    <li id="list-step">
                        <span id="poin3" class="number"><i class="fa fa-star"></i></span>
                        <a id="ktp" class="tool-tip" data-toggle="modal" data-target="#popup-ktp">
                            <p class="email"><?= $this->translate('label-ktp') ?></p>
                            <p class="verifikasi"><u><?= $this->translate('verifikasi') ?></u> &#62;</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section id="app-status">
    <div class="container">
        <div class="title">
            <h3><?= $this->translate('cek-status-aplikasi'); ?></h3>
            <p><?= $this->translate('cek-status-aplikasi-sub'); ?></p>
        </div>
        <ul class="status-wrapper">
            <li class="status-box hide" id="status">
                <div class="status-step">
                    <div class="">
                        <ul class="stepper-row">
                            <li id="status-step">
                                <span id="step1" class="number"></span>
                                <span id="label-step1" class="label-step"></span>
                            </li>
                            <li id="status-step">
                                <span id="step2" class="number"></span>
                                <span id="label-step2" class="label-step"></span>
                            </li>
                            <li id="status-step">
                                <span id="step3" class="number"></span>
                                <span id="label-step3" class="label-step"></span>
                            </li>
                            <li id="status-step">
                                <span id="step4" class="number"></span>
                                <span id="label-step4" class="label-step"></span>
                            </li>
                            <li id="status-step">
                                <span id="step5" class="number"></span>
                                <span id="label-step5" class="label-step"></span>
                            </li>
                        </ul>
                    </div>
                    <div class="fail-notif">
                        <span class="icon">&#10005;</span>
                        <span><?= $this->translate('pengajuan-tolak'); ?></span>
                    </div>
                </div>
                <div class="detail">
                    <div class="assignment">
                        <h6><?= $this->translate('assigment-id'); ?></h6>
                        <p>-</p>
                    </div>
                    <div class="credit-type">
                        <h6><?= $this->translate('jenis-kredit'); ?></h6>
                        <p>
                            <!-- Pembiayaan Agunan - Sertifikat Rumah -->
                        </p>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</section>

<section id="check-contract">
    <div class="container">
        <div class="title">
            <h3 class="margin-top-10"><?= $this->translate('cek-kontrak-title'); ?></h3>
            <p class="not-verify"><?= $this->translate('cek-kontrak-sub1'); ?><br> <?= $this->translate('cek-kontrak-sub2'); ?> <a href="#verify-section"><?= $this->translate('verifikasi-profile'); ?></a></p>
            <p class="verify hide"><?= $this->translate('informasi-kontrak'); ?></p>
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
                            <!-- Anda terlambat membayar 5 hari --></span>
                    </div>
                    <h5 class="more"><?= $this->translate('lihat-detail'); ?> &#62;</h5>
                </li>
            </a>
            <a href="/<?= $this->getLocale() ?>/credit" class="contract-box add-contract">
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


<!-- Pop-up -->
<div class="modal fade" id="popup-ktp">
    <div class="modal-dialog">
        <div class="modal-content">
            <h3><?= $this->translate('lengkapi-data-pemohon'); ?></h3>
            <p><?= $this->translate('lengkapi-data-pemohon-sub'); ?></p>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <form action="">
                <div class="form-wrapper">
                    <div class="input-text-group">
                        <label id="name-label" class="input-label">NAMA LENGKAP</label>
                        <input id="name-input" class="style-input" type="text" placeholder="<?= $this->translate('form-name'); ?>" required>
                    </div>
                    <div class="input-text-group">
                        <label id="email-label" class="input-label">EMAIL</label>
                        <input id="email-input" class="style-input" type="email" placeholder="<?= $this->translate('email'); ?>" required>
                    </div>
                    <div class="input-text-group">
                        <label id="phone-label" class="input-label">NOMOR HANDPHONE</label>
                        <input id="phone-input" class="style-input" type="number" placeholder="<?= $this->translate('form-hp'); ?>" required>
                    </div>
                    <div class="input-text-group">
                        <label id="ktp-label" class="input-label">NOMOR KTP</label>
                        <input id="ktp-input" class="style-input" type="number" placeholder="<?= $this->translate('label-ktp'); ?>">
                    </div>
                    <div id="upload-ktp">
                        <h5 id="upload-text"><?= $this->translate('labelNoktp'); ?></h5>
                        <img id="preview-upload" src="">
                        <div class="upload-content-wrapper">
                            <div class="upload-btn-wrapper">
                                <button id="upload-button" class="btn-upload">
                                    <?= $this->translate('choose-file') ?>
                                </button>
                                <input id="file-upload" class="hide-input" accept="image/*" type="file" name="myfile">
                            </div>
                            <span id="file-upload-filename"></span>
                        </div>
                        <p><?= $this->translate('placeholderNoktp') ?></p>
                    </div>
                    <div class="error-wrap"></div>
                </div>
                <input id="btn-submit" class="button-login" type="button" value="SIMPAN">
            </form>
        </div>
    </div>
</div>

<!-- Pop-up -->

<?php $this->headScript()->prependFile('/static/js/Includes/dashboard.js'); ?>