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
if ($_COOKIE['customer'] != null || $_COOKIE['customer'] != "") {
    header("Location: ". BASEURL . "/{$lang}/user/dashboard");
}
$this->headScript()->offsetSetFile(100, '/static/js/Includes/login.js');
$page = $_SERVER['REQUEST_URI'];
if (preg_match("/.\/service-contract/", $page)) {
    $trans1 = $this->translate('welcome-login-kontrak');
    $trans2 = $this->translate('welcome-login-sub-kontrak');
} else if (preg_match("/.\/service-status/", $page)) {
    $trans1 = $this->translate('welcome-login-status');
    $trans2 = $this->translate('welcome-login-sub-status');
} else {
    $trans1 = $this->translate('welcome-login');
    $trans2 = $this->translate('welcome-login-sub');
}
?>

<section id="login" class="container">
    <!-- <h3></?= $this->translate('welcome-login'); ?></h3>
    <p></?= $this->translate('welcome-login-sub'); ?></p> -->
    <h3><?= $trans1; ?></h3>
    <p><?= $trans2; ?></p>
    <form action="" id="login-form">
        <div class="input-login">
            <div class="input-text-group">
                <label id="phone-label" class="input-label"><?= $this->translate("form-hp"); ?></label>
                <input id="phone-input" class="style-input formPhoneNumber" type="tel" maxlength="13" placeholder="<?= $this->translate('input-phone') ?>" onkeydown="return isNumberKey(event);" required>
            </div>
            <div class="error-wrap"></div>
            <label class="checkbox-wrapper"><?= $this->translate('remember-me'); ?><input type="checkbox">
                <span class="checkmark"></span>
            </label>
        </div>
        <button id="btn-login" type="button" class="button-login" onclick="return loginCustomer()" style="background-color: rgb(221, 221, 221); border-color: rgb(221, 221, 221);" disabled="disabled"> <?= $this->translate('login'); ?></button>
    </form>
</section>
<section id="otp" class="container hide">
    <h3><?= $this->translate('confirmation-otp'); ?></h3>
    <p><?= $this->translate('text-confirmation-otp'); ?></p>
    <form action="" id="otp-form">
        <input type="number" id="digit-1" name="digit[]" data-next="digit-2" onkeydown="return isNumberKey(event);"/>
	    <input type="number" id="digit-2" name="digit[]" data-next="digit-3" data-previous="digit-1" disabled onkeydown="return isNumberKey(event);"/>
        <input type="number" id="digit-3" name="digit[]" data-next="digit-4" data-previous="digit-2" disabled onkeydown="return isNumberKey(event);"/>
        <input type="number" id="digit-4" name="digit[]" data-next="digit-5" data-previous="digit-3" disabled onkeydown="return isNumberKey(event);"/>
    </form>
    <p id="resend"><?= $this->translate('wait-otp'); ?></p>
    <p><small id="resend-notice"></small></p>
    <button id="btn-verify" class="button-login" onclick="verified('<?= $lang; ?>')" disabled style="opacity: .5;"> <?= $this->translate('verifikasi'); ?></button>
</section> <?php $this->headScript()->prependFile('/static/js/Includes/login.js'); ?>