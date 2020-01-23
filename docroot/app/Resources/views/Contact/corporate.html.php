<?php

/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');
?>

<?php if (!$this->success) { ?>
    <?php
    $this->headScript()->offsetSetFile(100, '/static/js/Includes/contact-us.js');
    ?>

    <div class="container">
        <!-- <div class="col-xs-12"> -->

        <form id="contact" class="form-get--credit" name="corporate" method="POST" role="form">
            <input type="hidden" id="jenis_form" name="jenis_form" value="Contact">

            <div class="form-body--credit form-contact">
                <div class="text-head">
                    <?php if ($this->msg_error) {
                        echo '<div class="alert alert-danger" role="alert">' . $msg_error . '</div>';
                    } ?>
                    <h2 class="text-center">Hubungi Kami</h2>
                    <p class="text-center">Silahkan mengisi form dibawah ini, agen BFI akan menghubungi Anda</p>
                </div>

                <div class="form-group">
                    <label for="corporate[name]"><?= $this->translate('form-name') ?></label>
                    <input type="text" class="form-control formRequired formName" name="corporate[name]" id="nama_lengkap" placeholder="Masukkan nama lengkap Anda">
                    <div class="error-wrap"></div>
                </div>
                <div class="form-group">
                    <label for="corporate[phone]"><?= $this->translate('form-hp') ?></label>
                    <input type="text" class="form-control formRequired formPhoneNumber" name="corporate[phone]" id="no_handphone" maxlength="13" placeholder="Masukkan nomor handphone Anda">
                    <div class="error-wrap"></div>
                </div>
                <div class="form-group">
                    <label for="corporate[email]"><?= $this->translate('form-email') ?></label>
                    <input type="email" class="form-control formEmail" name="corporate[email]" id="email_penanya" placeholder="Masukkan email Anda">
                    <div class="error-wrap"></div>
                </div>
                <div class="form-group">
                    <label for="corporate[subject]"><?= $this->translate('Perihal') ?></label>
                    <input type="text" class="form-control formRequired formPerihal" name="corporate[subject]" id="perihal" maxlength="20" placeholder="Perihal">
                    <div class="error-wrap"></div>
                </div>
                <div class="form-group">
                    <label for="message"><?= $this->translate('Pesan') ?></label>
                    <textarea class="form-control formRequired formMessage" name="corporate[message]" id="message" placeholder="Masukkan Pesan Anda"></textarea>
                    <div class="error-wrap"></div>
                </div>
                <div class="form-group captcha">
                    <div class="g-recaptcha" id="g-recaptcha" data-sitekey="6Ldb1c8UAAAAALZP6FbNJAM7z8T-tPpkbJvjbJBW"></div>
                </div>
            </div>
            <div class="button-area text-center">
                <input type="hidden" name="lang" id="lang" value="<?= $this->getLocale(); ?>">
                <button class="cta cta-primary cta-big" type="submit">Kirim Pesan</button>
            </div>
        </form>
        <!-- </div> -->
    </div>

<?php } else { ?>
    <?= $this->template('Includes/success.html.php') ?>
<?php } ?>