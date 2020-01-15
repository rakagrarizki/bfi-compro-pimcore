<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout-branch.html.php');
?>
<?= $this->areablock('areaBlock');?>
<?php $lang = $this->getLocale(); ?>

<?php
    $this->headScript()->offsetSetFile(100, '/static/js/Includes/login.js');
?>

<section id="login" class="container">
    <h3>Selamat Datang di BFI</h3>
    <p>Silahkan login ke akun anda</p>
    <form action="" id="login-form">
        <div class="input-login">
            <div class="input-text-group">
                <input id="phone-input" class="style-input" type="number" onfocus="changeLabel(this.id)" onfocusout="deleteLabel(this.id)" required>
                <label id="phone-label" class="input-label">Masukkan nomor handphone anda</label>
            </div>
            <label class="checkbox-wrapper">Ingat akun saya
                <input type="checkbox" checked="checked">
                <span class="checkmark"></span>
            </label>
        </div>
        <button id="btn-login" type="button" class="button-login" onclick="return loginCustomer()" disabled style="opacity: .5;"> LOGIN </button>
    </form>
</section>

<section id="otp" class="hide">
    <h3>Konfirmasi OTP</h3>
    <p>Silahkan masukkan 4-digit kode verifikasi <br> yang telah dikirimkan ke nomor handphone anda</p>
    <form action="" id="otp-form">
        <input type="number" id="digit-1" name="digit[]" data-next="digit-2" />
	    <input type="number" id="digit-2" name="digit[]" data-next="digit-3" data-previous="digit-1" disabled />
        <input type="number" id="digit-3" name="digit[]" data-next="digit-4" data-previous="digit-2" disabled />
        <input type="number" id="digit-4" name="digit[]" data-next="digit-5" data-previous="digit-3" disabled />
    </form>
    <p id="resend">Mohon menunggu <b>90 seconds</b> untuk mengirim ulang</p>
    <p><small id="resend-notice"></small></p>
    <button id="btn-verify" class="button-login" onclick="verified('<?= $lang ;?>')" disabled style="opacity: .5;"> VERIFIKASI </button>
</section>

<?php $this->headScript()->prependFile('/static/js/Includes/login.js'); ?>