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
                <div class="form-group customer-type">
                    <label for="identitas">Identitas Anda</label>
                    <div class="input-group inputform biaya-agunan">
                        <div class="ipt-radio">
                            <label>
                            <span>
                                <input id="type" type="radio" name="tipe_nasabah" value="nasabah" checked/>
                            </span>
                            Nasabah
                            </label>
                        </div>
                        <div class="ipt-radio">
                            <label>
                            <span>
                                <input id="type" type="radio" name="tipe_nasabah" value="non-nasabah" />
                            </span>
                            Non-Nasabah
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="no_kontrak"><?= $this->translate('Nomor Kontrak')?></label>
                    <input type="tel" pattern="\d*" class="form-control formEmail" name="no_kontrak" id="no_kontrak" maxlength="13"
                            placeholder="Masukkan nomor kontrak">
                    <div class="error-wrap"></div>
                </div>
                <div class="form-group">
                    <label for="customer_name"><?= $this->translate('Nama Pelanggan')?></label>
                    <input type="tel" pattern="\d*" class="form-control formEmail" name="customer_name" id="customer_name" maxlength="13"
                            placeholder="Masukkan nama pelanggan" disabled>
                    <div class="error-wrap"></div>
                </div>
                <div class="form-group">
                    <label for="type_message" class="type_message"><?= $this->translate('Jenis Pesan')?></label>
                    <select class="form-control formRequired type-message" id="pekerjaan" name="type_message"
                            placeholder="Pilih jenis pesan"/>
                        <option value="" disabled selected>Pilih jenis pesan</option>
                        <option value="1">Keluhan</option>
                        <option value="2">Saran</option>
                    </select>
                    <div class="error-wrap"></div>
                </div>
                <div class="form-group">
                    <label for="message"><?= $this->translate('label-place')?></label>
                    <textarea class="form-control formRequired formMessage" name="message" id="message"
                                placeholder="Masukkan Pesan Anda"></textarea>
                    <div class="error-wrap"></div>
                </div>
                <div class="form-group upload-image">
                    <label><?= $this->translate('Dokumen Pendukung')?></label>
                    <div class="upload-file">
                        <img src="" />
                        <div class="upload-btn">
                        <input type="file" class="file-input" accept="image/*" data-id="document" />
                        <button type="button">Pilih File</button>
                        <b></b>
                        </div>
                    </div>
                    <input type="hidden" class="form-control formRequired" name="document" id="document">
                    <div class="error-wrap"></div>
                    <span>Max. ukuran file adalah 500kb</span>
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