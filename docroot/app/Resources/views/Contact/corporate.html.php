<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');
?>

<?php
    $this->headScript()->offsetSetFile(100, '/static/js/Includes/contact-us.js');
?>

<style>

</style>

<div class="container">
    <div class="col-xs-12">

        <form id="contact" class="form-get--credit" action="#">
        <input type="hidden" id="jenis_form" name="jenis_form" value="Contact">
        
            <div class="form-body--credit form-contact">
                <div class="text-head">
                    <h2 class="text-center">Hubungi Kami</h2>
                    <p class="text-center">Silahkan mengisi form dibawah ini, agen BFI akan menghubungi Anda</p>
                </div>

                <div class="form-group">
                    <label for="nama_lengkap"><?= $this->translate('form-name')?></label>
                    <input type="text" class="form-control formRequired formName" name="nama_lengkap" id="nama_lengkap"
                            placeholder="Masukkan nama lengkap Anda">
                    <div class="error-wrap"></div>
                </div>
                <div class="form-group">
                    <label for="no_handphone"><?= $this->translate('form-hp')?></label>
                    <input type="email" class="form-control formRequired formPhoneNumber" name="no_handphone" id="no_handphone"
                            placeholder="Masukkan nomor handphone Anda">
                    <div class="error-wrap"></div>
                </div>
                <div class="form-group">
                    <label for="email_penanya"><?= $this->translate('form-email')?></label>
                    <input type="tel" pattern="\d*" class="form-control formEmail" name="email_penanya" id="email_penanya" maxlength="13"
                            placeholder="Masukkan email Anda">
                    <div class="error-wrap"></div>
                </div>
                <div class="form-group">
                    <label for="perihal"><?= $this->translate('Perihal')?></label>
                    <input type="tel" pattern="\d*" class="form-control formEmail" name="perihal" id="perihal" maxlength="13"
                            placeholder="Perihal">
                    <div class="error-wrap"></div>
                </div>
                <div class="form-group">
                    <label for="message"><?= $this->translate('Pesan')?></label>
                    <textarea class="form-control formRequired formMessage" name="message" id="message"
                                placeholder="Masukkan Pesan Anda"></textarea>
                    <div class="error-wrap"></div>
                </div>
                <div class="form-group captcha">
                    <div class="g-recaptcha" id="g-recaptcha" data-sitekey="6LcsxcUUAAAAAO22We2mizM6KrBMmPECFMVMJ4NE"></div>
                </div>
            </div>
            <div class="button-area text-center">
                <button class="cta cta-primary cta-big" id="button1" type="button">Kirim Pesan</button>
            </div>
        </form>
    </div>
</div>