<?php

/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');
?>

<style>

</style>

<div class="container profile">
    <div class="row">
        <article class="sect-title text-center">
            <h2 class="margin-top-10"><?= $this->translate('profil'); ?></h2>
            <p><?= $this->translate('profil-sub'); ?></p>
        </article>
    </div>
    <div class="row">
        <div class="sect-list">
            <h3><?= $this->translate('list-kontrak'); ?></h3>
            <div class="list contract">
                <ol>
                    <!-- here position list from API -->
                </ol>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="sect-list">
            <h3><?= $this->translate('data-name'); ?></h3>
            <div class="list profile">
                <div class="detail-wrapper">
                    <span class="label"><?= $this->translate('form-name'); ?></span>
                    <span class="value-data name">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label"><?= $this->translate('form-email'); ?></span>
                    <span class="value-data email">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label"><?= $this->translate('form-hp'); ?></span>
                    <span class="value-data phone">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label"><?= $this->translate('label-ktp'); ?></span>
                    <span class="value-data identity-number">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label"><?= $this->translate('photo-ktp'); ?></span>
                    <span class="value-data identity-img verified-false" style="display:none;">Belum diverifikasi</span>
                    <span class="value-data identity-img verified-true" style="display:none;">Diverifikasi</span>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="sect-list">
            <h3><?= $this->translate('data-place'); ?></h3>
            <div class="list profile-address">
                <div class="detail-wrapper">
                    <span class="label"><?= $this->translate('label-provinsi'); ?></span>
                    <span class="value-data province">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label"><?= $this->translate('label-kota'); ?></span>
                    <span class="value-data city">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label"><?= $this->translate('label-kecamatan'); ?></span>
                    <span class="value-data district">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label"><?= $this->translate('label-kelurahan'); ?></span>
                    <span class="value-data subdistrict">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label"><?= $this->translate('postcode'); ?></span>
                    <span class="value-data zip-code">
                        <!-- here position list from API --></span>
                </div>
                <div class="detail-wrapper">
                    <span class="label"><?= $this->translate('label-place'); ?></span>
                    <span class="value-data address">
                        <!-- here position list from API --></span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card-update">
            <div class="icon">
                <img class="imggetcredit" src="/_default_upload_bucket/form_credit/Mobil.png" alt="">
            </div>
            <div class="content-text">
                <div class="title-update">
                    <h3><?= $this->translate('update-data'); ?></h3>
                </div>
                <div class="text">
                    <p><span>
                            <?= $this->translate('petunjuk-update-data'); ?>
                        </span></p>
                </div>
            </div>
            <div class="button-cabang">
                <form action="<?= "/" . $this->getLocale() . "/branch-office"; ?>" target="_blank">
                    <button class="cta cta-primary cta-big"><?= $this->translate('branch'); ?></button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $this->headScript()->prependFile('/static/js/Includes/profile.js'); ?>