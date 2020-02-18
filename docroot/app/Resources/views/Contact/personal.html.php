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

        <form method="POST" name="personal" id="contact" class="form-get--credit" enctype="multipart/form-data">
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
                    <label for="nama_lengkap"><?= $this->translate('form-name') ?></label>
                    <input type="text" class="form-control formRequired formAlphabet formName" name="personal[name]" id="nama_lengkap" placeholder="<?= $this->translate('placeholder-name') ?>">
                    <div class="error-wrap"></div>
                </div>
                <div class="form-group">
                    <label for="no_handphone"><?= $this->translate('form-hp') ?></label>
                    <input type="text" class="form-control formRequired formPhoneNumber" name="personal[phone]" id="no_handphone" maxlength="13" placeholder="<?= $this->translate('placeholder-phone') ?>">
                    <div class="error-wrap"></div>
                </div>
                <div class="form-group">
                    <label for="email_penanya"><?= $this->translate('form-email') ?></label>
                    <input type="email" class="form-control formRequired formEmail" name="personal[email]" id="email_penanya" placeholder="<?= $this->translate('placeholder-email') ?>">
                    <div class="error-wrap"></div>
                </div>
                <div class="form-group customer-type">
                    <label for="identitas"><?= $this->translate('identity'); ?></label>
                    <div class="input-group inputform biaya-agunan">
                        <div class="ipt-radio">
                            <label>
                                <span>
                                    <input id="type" type="radio" name="personal[identity]" value="nasabah" checked />
                                </span>
                                <?= $this->translate('nasabah'); ?>
                            </label>
                        </div>
                        <div class="ipt-radio">
                            <label>
                                <span>
                                    <input id="type" type="radio" name="personal[identity]" value="non-nasabah" />
                                </span>
                                <?= $this->translate('non-nasabah'); ?>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="no_kontrak"><?= $this->translate('Nomor Kontrak') ?></label>
                    <input type="tel" class="form-control formRequired" name="personal[no_kontrak]" id="no_kontrak" placeholder="<?= $this->translate('Nomor Kontrak'); ?>">
                    <div class="error-wrap"></div>
                </div>
                <div class="form-group">
                    <label for="customer_name"><?= $this->translate('Nama Pelanggan') ?></label>
                    <input type="text" class="form-control formAlphabet formName formRequired" name="personal[customer_name]" id="customer_name" placeholder="<?= $this->translate('Nama Pelanggan') ?>">
                    <div class="error-wrap"></div>
                </div>
                <div class="form-group">
                    <label for="type_message" class="type_message"><?= $this->translate('Jenis Pesan') ?></label>
                    <select class="form-control formRequired type-message" id="type_message" name="personal[type_message]" placeholder="<?= $this->translate('Jenis Pesan') ?>" />
                    <option value="" disabled selected><?= $this->translate('jenis-pesan'); ?></option>
                    <option value="keluhan"><?= $this->translate('keluhan'); ?></option>
                    <option value="layanan-purna-jual"><?= $this->translate('layanan-purna'); ?></option>
                    <option value="informasi-produk"><?= $this->translate('informasi-produk'); ?></option>
                    <option value="registrasi"><?= $this->translate('ebilling'); ?></option>
                    </select>
                    <div class="error-wrap"></div>
                </div>
                <div class="form-group">
                    <label for="message"><?= $this->translate('Pesan') ?></label>
                    <textarea class="form-control formRequired formMessage" name="personal[message]" id="message" placeholder="<?= $this->translate('Pesan') ?>"></textarea>
                    <div class="error-wrap"></div>
                </div>
                <div class="form-group upload-image">
                    <label><?= $this->translate('Dokumen Pendukung') ?></label>
                    <div class="upload-file">
                        <div class="upload-btn">
                            <input type="file" id="files" class="file-input" accept="image/*,application/pdf" data-id="document">
                            <button type="button"><?= $this->translate('choose-file') ?></button>
                        </div>
                    </div>
                    <input type="hidden" class="form-control formRequired" name="document" id="document">
                    <div class="error-wrap"></div>
                    <span>Max. ukuran file adalah 500kb</span>
                </div>
                <div class="form-group captcha formRequired">
                    <div class="g-recaptcha" id="g-recaptcha" data-sitekey="6Ldb1c8UAAAAALZP6FbNJAM7z8T-tPpkbJvjbJBW"></div>
                      <span class="msg-error error"></span>
                </div>
            </div>
            <div class="button-area text-center">
                <button id="submitPersonal" class="cta cta-primary cta-big" type="submit"><?= $this->translate('submit-contact'); ?></button>
            </div>
        </form>
    </div>

<?php } else { ?>
    <?= $this->template('Contact/success.html.php') ?>
<?php } ?>


