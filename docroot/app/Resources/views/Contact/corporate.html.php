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
                    <h2 class="text-center"><?= $this->translate('contact'); ?></h2>
                    <p class="text-center"><?= $this->translate('contact-sub'); ?></p>
                </div>

                <div class="form-group">
                    <label for="corporate[name]"><?= $this->translate('form-name') ?></label>
                    <input type="text" class="form-control formRequired formName" name="corporate[name]" id="contact_nama_lengkap" placeholder="<?= $this->translate('placeholder-name') ?>">
                    <div class="error-wrap"></div>
                </div>
                <div class="form-group">
                    <label for="corporate[phone]"><?= $this->translate('form-hp') ?></label>
                    <input type="text" class="form-control formRequired formPhoneNumber" name="corporate[phone]" id="contact_no_handphone" maxlength="13" placeholder="<?= $this->translate('placeholder-phone') ?>">
                    <div class="error-wrap"></div>
                </div>
                <div class="form-group">
                    <label for="contact_email_pemohon"><?= $this->translate('form-email') ?></label>
                    <input type="email" class="form-control formEmail" name="corporate[email]" id="contact_email_pemohon" placeholder="<?= $this->translate('placeholder-email') ?>">
                    <div class="error-wrap"></div>
                </div>
                <div class="form-group">
                    <label for="corporate[subject]"><?= $this->translate('Perihal') ?></label>
                    <input type="text" class="form-control formRequired formPerihal" name="corporate[subject]" id="perihal" maxlength="20" placeholder="<?= $this->translate('Perihal') ?>">
                    <div class="error-wrap"></div>
                </div>
                <div class="form-group">
                    <label for="message"><?= $this->translate('Pesan') ?></label>
                    <textarea class="form-control formRequired formMessage" name="corporate[message]" id="message" placeholder="<?= $this->translate('placeholder-pesan') ?>"></textarea>
                    <div class="error-wrap"></div>
                </div>
                <div class="form-group captcha">
                    <div class="g-recaptcha" id="g-recaptcha" data-sitekey="<?= $this->captcha; ?>"></div>
                </div>
            </div>
            <div class="button-area text-center">
                <button id="submitPersonal" class="cta cta-primary cta-big" type="button"><?= $this->translate('submit-contact'); ?></button>
            </div>
        </form>
        <!-- </div> -->
    </div>

<?php } else { ?>
    <?= $this->template('Contact/success-corporate.html.php') ?>
<?php } ?>