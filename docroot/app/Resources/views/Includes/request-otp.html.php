<?php

/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

// $this->extend('layout-branch.html.php');
?>
<?= $this->areablock('areaBlock'); ?>
<?php $lang = $this->getLocale(); ?>
<section id="otp" class="container hide" style="margin: 40px auto 80px auto;text-align: center;">
    <h3><?= $this->translate('credit-confirmation-otp'); ?></h3>
    <p><?= $this->translate('credit-text-confirmation-otp'); ?></p>
    <form action="" id="otp-form">
        <input type="tel" class="input-number" id="digit-1" name="digit[]" data-next="digit-2" onkeydown="return isNumberKey(event);"/>
	    <input type="tel" class="input-number" id="digit-2" name="digit[]" data-next="digit-3" data-previous="digit-1" disabled onkeydown="return isNumberKey(event);"/>
        <input type="tel" class="input-number" id="digit-3" name="digit[]" data-next="digit-4" data-previous="digit-2" disabled onkeydown="return isNumberKey(event);"/>
        <input type="tel" class="input-number" id="digit-4" name="digit[]" data-next="digit-5" data-previous="digit-3" disabled onkeydown="return isNumberKey(event);"/>
    </form>
    <input id="phone-input" class="hide" />
    <p id="resend"><?= $this->translate('wait-otp'); ?></p>
    <p><small id="resend-notice"></small></p>
   
    <button id="btn-verify" class="button-login" onclick="verifiedOTPCredit()" type="button" style="background-color: rgb(221, 221, 221); border-color: rgb(221, 221, 221);" disabled="disabled"> 
        <?= $this->translate('verifikasi'); ?>
    </button>
</section>