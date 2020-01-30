<?php

/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout-branch.html.php');
?>
<?= $this->areablock('areaBlock'); ?>
<?php $lang = $this->getLocale(); ?>

<?php
$this->headScript()->offsetSetFile(100, '/static/js/Includes/login.js');
?>

<section id="login" class="container">
    <h3><?= $this->translate('welcome-login'); ?></h3>
    <p><?= $this->translate('welcome-login-sub'); ?></p>
    <form action="" id="login-form">
        <div class="input-login">
            <div class="input-text-group">
                <input id="phone-input" class="style-input" type="number" onfocus="changeLabel(this.id)" onfocusout="deleteLabel(this.id)" onkeydown="return isNumberKey(event);" required>
                <label id="phone-label" class="input-label"><?= $this->translate('input-phone') ?></label>
            </div>
            <label class="checkbox-wrapper"><?= $this->translate('remember-me'); ?><input type="checkbox" checked="checked">
                <span class="checkmark"></span>
            </label>
        </div>
        <button id="btn-login" type="button" class="button-login" onclick="return loginCustomer()" disabled style="opacity: .5;"> <?= $this->translate('login'); ?></button>
    </form>
</section>
<section id="otp" class="container hide">
    <h3><?= $this->translate('confirmation-otp'); ?></h3>
    <p><?= $this->translate('text-confirmation-otp'); ?></p>
    <form action="" id="otp-form">
        <input type="number" id="digit-1" name="digit[]" data-next="digit-2" />
        <input type="number" id="digit-2" name="digit[]" data-next="digit-3" data-previous="digit-1" disabled />
        <input type="number" id="digit-3" name="digit[]" data-next="digit-4" data-previous="digit-2" disabled />
        <input type="number" id="digit-4" name="digit[]" data-next="digit-5" data-previous="digit-3" disabled />
    </form>
    <p id="resend"><?= $this->translate('wait-otp'); ?></p>
    <p><small id="resend-notice"></small></p>
    <button id="btn-verify" class="button-login" onclick="verified('<?= $lang; ?>')" disabled style="opacity: .5;"> <?= $this->translate('verifikasi'); ?></button>
</section> <?php $this->headScript()->prependFile('/static/js/Includes/login.js'); ?>