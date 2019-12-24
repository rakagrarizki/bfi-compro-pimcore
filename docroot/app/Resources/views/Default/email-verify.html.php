<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');
?>

<section id="email-verify">
    <h3>Verifikasi Email Anda</h3>
    <p>Pastikan email yang tertera sudah benar</p>
    <form action="" id="login-form">
        <div class="input-login">
            <div class="input-text-group">
                <input id="email-input" class="style-input" type="email" onfocus="changeLabel(this.id)" onfocusout="deleteLabel(this.id)" required>
                <label id="email-label" class="input-label">Masukkan email anda</label>
            </div>
        </div>
        <button id="btn-verify" type="button" class="button-login" onclick="verify()" disabled style="opacity: .5;"> KIRIM EMAIL </button>
    </form>
</section>

<section id="email-sent" class="hide">
    <img src="/static/images/icon/emailsent.png" alt="">
    <h3>Check Email Anda</h3>
    <p>Silahkan cek email anda untuk <br> verifikasi profil anda</p>
    <button id="back" class="button-login" onclick="back()">
        BACK TO HOME
    </button>
</section>

<?php $this->headScript()->prependFile('/static/js/Includes/email.js'); ?>