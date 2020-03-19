<?php

/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');
?>

<section id="email-verify" class="container">
    <h3><?= $this->translate('verifikasi-email') ?></h3>
    <p><?= $this->translate('verifikasi-email-sub') ?></p>
    <form action="" id="login-form">
        <div class="input-login">
            <div class="input-text-group form-group">
                <label id="email-label" class="input-label">EMAIL</label>
                <input id="email-input" class="style-input form-control formRequired formEmail" type="email" placeholder="<?= $this->translate('email-input') ?>" >
                <div class="error-wrap"></div>
            </div>
        </div>
        <button id="btn-verify" type="button" class="button-login" onclick="verify()" disabled style="opacity: .5;"><?= $this->translate('send-email') ?></button>
    </form>
</section>

<section id="email-sent" class="container hide">
    <img src="/static/images/icon/emailsent.png" alt="">
    <h3><?= $this->translate('cek-email') ?></h3>
    <p><?= $this->translate('cek-email-sub') ?> <br> <?= $this->translate('verifikasi-profile') ?></p>
    <button id="back" class="button-login" onclick="back()">
        <?= $this->translate('backtohome') ?>
    </button>
</section>

<?php $this->headScript()->prependFile('/static/js/Includes/email.js'); ?>