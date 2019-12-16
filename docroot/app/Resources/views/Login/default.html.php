<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout-branch.html.php');
?>
<?= $this->areablock('areaBlock');?>

<section id="login" class="container">
    <h3>Selamat Datang di BFI</h3>
    <p>Silahkan login ke akun anda</p>
    <form action="" id="login-form">
        <div class="input-login">
            <div class="input-text-group">
                <input id="phone-input" class="style-input" type="text" onfocus="changeLabel(this.id)" onfocusout="deleteLabel(this.id)" required>
                <label id="phone-label" class="input-label">Masukkan nomor handphone anda</label>
            </div>
            <label class="checkbox-wrapper">Ingat akun saya
                <input type="checkbox" checked="checked">
                <span class="checkmark"></span>
            </label>
        </div>
        <button type="submit" class="button-login" onclick="login()"> LOGIN </button>
    </form>
</section>

<section id="otp" class="hide">
    <h3>Konfirmasi OTP</h3>
    <p>Silahkan masukkan 4-digit kode verifikasi <br> yang telah dikirimkan ke nomor handphone anda</p>
    <form action="" id="otp-form">
        <input type="number" id="digit-1" name="digit-1" data-next="digit-2" />
	    <input type="number" id="digit-2" name="digit-2" data-next="digit-3" data-previous="digit-1" />
        <input type="number" id="digit-3" name="digit-3" data-next="digit-4" data-previous="digit-2" />
        <input type="number" id="digit-4" name="digit-4" data-next="digit-5" data-previous="digit-3" />
    </form>
    <p>Mohon menunggu <b>90 detik</b> untuk mengirim ulang</p>
    <button type="submit" class="button-login" onclick="login()"> VERIFIKASI </button>
</section>

<?php $this->headScript()->prependFile('/static/js/Includes/login.js'); ?>