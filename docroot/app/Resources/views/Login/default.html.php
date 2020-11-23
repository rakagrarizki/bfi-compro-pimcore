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
// if ($_COOKIE['customer'] != null || $_COOKIE['customer'] != "") {
//     header("Location: ". BASEURL . "/{$lang}/user/dashboard");
// }
$this->headScript()->offsetSetFile(100, '/static/js/Includes/login.js');
?>

<section id="login" class="container">
    <!-- <h1></?= $this->translate('welcome-login'); ?></h1>
    <p></?= $this->translate('welcome-login-sub'); ?></p> -->
    <h1><?= $this->trans1; ?></h1>
    <p><?= $this->trans2; ?></p>
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
    <h2><?= $this->translate('confirmation-otp'); ?></h2>
    <p><?= $this->translate('text-confirmation-otp'); ?></p>

    <form action="" id="otp-form">
        <input type="tel" tabindex="1" class="input-number" id="digit-1" maxlength="1" name="digit[]" data-next="digit-2"/>
	    <input type="tel" class="input-number" id="digit-2" maxlength="1" name="digit[]" data-next="digit-3" data-previous="digit-1"/>
        <input type="tel" class="input-number" id="digit-3" maxlength="1" name="digit[]" data-next="digit-4" data-previous="digit-2"/>
        <input type="tel" class="input-number"  id="digit-4" maxlength="1" name="digit[]" data-next="digit-5" data-previous="digit-3"/>
    </form>

    <p id="resend"><?= $this->translate('wait-otp'); ?></p>
    <p><small id="resend-notice"></small></p>
    
    <button id="btn-verify" class="button-login" onclick="verified('<?= $lang; ?>')" style="background-color: rgb(221, 221, 221); border-color: rgb(221, 221, 221);" disabled="disabled">  <?= $this->translate('verifikasi'); ?></button>

</section> 

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

<?php $this->headScript()->prependFile('/static/js/Includes/login.js'); ?>
