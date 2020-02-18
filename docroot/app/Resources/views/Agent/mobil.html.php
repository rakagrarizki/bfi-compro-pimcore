<?php

/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout-credit.html.php');
$this->headScript()->offsetSetFile(100, '/static/js/Includes/agent-mobil.js');
$this->headScript()->offsetSetFile(101, '/static/js/Includes/general-form.js');
?>

<div class="container">
    <div class="col-xs-12">

        <form id="getCredit" class="form-get--credit" action="#">
            <input type="hidden" id="collateral_type" name="collateral_type_id" value="5B79398F-6824-41DC-8946-9F52C4E211D8" />
            <input type="hidden" id="jenis_form" name="jenis_form" value="EDUCATION">

            <!-- STEP 1 -->
            <h3><?= $this->translate('data-name') ?></h3>
            <fieldset>

                <div id="formStep1" class="form-body--credit">
                    <div class="text-head">
                        <h2 class="text-center"><?= $this->translate('data-name'), $this->translate('data-name-mobil') ?></h2>
                        <h2 class="text-center-edit"><?= $this->translate('change-data-name') ?></h2>
                        <p class="text-center"><?= $this->translate('input-data-name') ?></p>
                    </div>

                    <div class="form-group">
                        <label for="nama_lengkap"><?= $this->translate('form-name') ?></label>
                        <input type="text" class="form-control formRequired formAlphabet" name="nama_lengkap" id="nama_lengkap" placeholder="<?= $this->translate('placeholder-name') ?>">
                        <small><?= $this->translate('agent-note-name') ?></small>
                        <div class="error-wrap"></div>
                    </div>
                    <div class="form-group">
                        <label for="email_pemohon"><?= $this->translate('form-email') ?></label>
                        <input type="email" class="form-control formRequired formEmail" name="email_pemohon" id="email_pemohon" placeholder="<?= $this->translate('placeholder-email') ?>">
                        <div class="error-wrap"></div>
                    </div>
                    <div class="form-group">
                        <label for="no_handphone"><?= $this->translate('form-hp') ?></label>
                        <input type="tel" pattern="\d*" class="form-control formPhoneNumber" name="no_handphone" id="no_handphone" maxlength="13" placeholder="<?= $this->translate('placeholder-hp') ?>">
                        <div class="error-wrap"></div>
                    </div>

                    <div id="personal-detail" style="display: none;">

                        <div class="form-group">
                            <label><?= $this->translate('label-education') ?></label>
                            <select class="form-control formRequired" id="education" name="education" placeholder="<?= $this->translate('choose-education') ?>" multiple="multiple">
                            </select>
                            <div class="error-wrap"></div>
                        </div>
                        <div class="form-group">
                            <label><?= $this->translate('label-meried') ?></label>
                            <select class="form-control formRequired" id="meried" name="meried" placeholder="<?= $this->translate('choose-meried') ?>" multiple="multiple">
                            </select>
                            <div class="error-wrap"></div>
                        </div>
                        <div class="form-group">
                            <label><?= $this->translate('label-burden') ?></label>
                            <select class="form-control formRequired" id="burden" name="burden" placeholder="<?= $this->translate('choose-burden') ?>" multiple="multiple">
                            </select>
                            <div class="error-wrap"></div>
                        </div>
                        <div class="form-group">
                            <label><?= $this->translate('label-profession') ?></label>
                            <select class="form-control formRequired" id="profession" name="profession" placeholder="<?= $this->translate('choose-profession') ?>" multiple="multiple">
                            </select>
                            <div class="error-wrap"></div>
                        </div>
                        <div class="form-group">
                            <label><?= $this->translate('label-npwp') ?></label>
                            <input type="text" class="form-control formRequired formNpwp" name="npwp" id="npwp" placeholder="<?= $this->translate('placeholder-npwp') ?>">
                            <div class="error-wrap"></div>
                        </div>
                        <div class="form-group">
                            <label><?= $this->translate('labelNoktp') ?></label>
                            <input type="text" class="form-control formRequired formNoKtp" name="noKtp" id="noKtp"  minlength="16" maxlength="17" placeholder="<?= $this->translate('placeholderNoktp') ?>">
                            <div class="error-wrap"></div>
                        </div>

                        <div class="form-group upload-image">
                            <label><?= $this->translate('form-ktp') ?></label>
                            <div class="upload-file">
                                <img src="" />
                                <div class="upload-btn">
                                    <input type="file" class="file-input" accept="image/*" data-id="ktp" />
                                    <button type="button"><?= $this->translate('form-ktp') ?></button>
                                    <b></b>
                                </div>
                            </div>
                            <input type="hidden" class="form-control formRequired" name="ktp" id="ktp">
                            <div class="error-wrap"></div>
                            <span><?= $this->translate('placeholderNoktp') ?></span>
                        </div>

                        <div class="form-group">
                            <div class="title-input">
                                <?= $this->translate('label-member') ?>
                            </div>
                            <div class="radio-group formRequired">
                                <div class="radio-inside">
                                    <input type="radio" value="1" id="are-member" name="are_member">
                                    <label for="are-member"><?= $this->translate('sudah') ?></label>
                                </div>
                                <div class="radio-inside">
                                    <input type="radio" value="0" id="not-member" checked="checked" name="are_member">
                                    <label for="not-member"><?= $this->translate('belum') ?></label>
                                </div>
                            </div>
                            <div class="error-wrap"></div>
                        </div>

                        <div class="form-group" id="frmAreCode">
                            <input type="text" class="form-control" name="areCode" id="areCode" placeholder="<?= $this->translate('placeholder-areCode') ?>">
                            <div class="error-wrap"></div>
                        </div>

                        <div class="form-group">
                            <div class="title-input">
                                <?= $this->translate('label-smartphone') ?>
                            </div>
                            <div class="radio-group">
                                <div class="radio-inside">
                                    <input type="radio" value="1" id="smartphone-yes" name="haveSmartphone">
                                    <label for="smartphone-yes"><?= $this->translate('yes') ?></label>
                                </div>
                                <div class="radio-inside">
                                    <input type="radio" value="0" id="smartphone-no" name="haveSmartphone">
                                    <label for="smartphone-no"><?= $this->translate('no') ?></label>
                                </div>
                            </div>
                            <div class="error-wrap"></div>
                        </div>

                    </div>

                </div>

                <div id="step-otp" class="form-body--credit">
                    <h2 class="text-center"><?= $this->translate('confirmation-otp') ?></h2>
                    <p class="text-center"><?= $this->translate('text-confirmation-otp') ?></p>

                    <div class="otp-number form-group">
                        <div class="otp-number__verify">
                            <input type="tel" pattern="\d*" placeholder="0" class="input-number" maxlength="1" name="otp1">
                            <input type="tel" pattern="\d*" placeholder="0" class="input-number" maxlength="1" name="otp2">
                            <input type="tel" pattern="\d*" placeholder="0" class="input-number" maxlength="1" name="otp3">
                            <input type="tel" pattern="\d*" placeholder="0" class="input-number" maxlength="1" name="otp4">
                        </div>
                        <div class="error-wrap"></div>
                        <div class="otp-number__text">
                            <p class="otp-wait"><?= $this->translate('wait-otp') ?> <span id="otp-counter" class="countdown"></span> </p>
                            <p class="otp-resend"><?= $this->translate('dont-get-otp') ?> <span id="otp-resend" class="countdown">Resend</span></p>
                        </div>
                        <div class="otp-button margin-top-50">
                            <button class="cta cta-orange cta-big cta-see btn-verifikasi buttonnext" id="agentOtp-verification" type="button"><?= $this->translate('verifikasi') ?></button>
                        </div>
                    </div>
                </div>

            </fieldset>

            <!-- STEP 2 -->
            <h3><?= $this->translate('data-place') ?></h3>
            <fieldset>
                <div class="form-body--credit">
                    <div class="text-head">
                        <h2 class="text-center"><?= $this->translate('data-place') ?></h2>
                        <h2 class="text-center-edit"><?= $this->translate('change-data-place') ?></h2>
                        <p class="text-center"><?= $this->translate('input-data-place') ?></p>
                    </div>
                    <div class="form-group">
                        <label><?= $this->translate('label-provinsi') ?></label>
                        <select class="form-control formRequired" id="provinsi" name="provinsi" placeholder="<?= $this->translate('choose-provinsi') ?>" multiple="multiple">
                        </select>
                        <div class="error-wrap"></div>
                    </div>
                    <div class="form-group">
                        <label><?= $this->translate('label-kota') ?></label>
                        <select class="form-control formRequired" id="kota" name="kota" placeholder="<?= $this->translate('choose-kota') ?>" multiple="multiple">
                            <option value="" class="placeholder" disabled selected><?= $this->translate('choose-kota') ?></option>
                        </select>
                        <div class="error-wrap"></div>
                    </div>
                    <div class="form-group">
                        <label><?= $this->translate('label-kecamatan') ?></label>
                        <select class="form-control formRequired" id="kecamatan" name="kecamatan" placeholder="<?= $this->translate('choose-kecamatan') ?>" multiple="multiple">
                            <option value="" disabled selected><?= $this->translate('choose-kecamatan') ?></option>
                        </select>
                        <div class="error-wrap"></div>
                    </div>
                    <div class="form-group">
                        <label><?= $this->translate('label-kelurahan') ?></label>
                        <select class="form-control formRequired" id="kelurahan" name="kelurahan" placeholder="<?= $this->translate('choose-kelurahan') ?>" multiple="multiple">
                            <option value="" disabled selected><?= $this->translate('choose-kelurahan') ?></option>
                        </select>
                        <div class="error-wrap"></div>
                    </div>
                    <div class="form-group">
                        <label for="kode_pos"><?= $this->translate('label-postcode') ?></label>
                        <input type="text" class="form-control formKodePos" name="kode_pos" id="kode_pos" placeholder="<?= $this->translate('placeholder-postcode') ?>" disabled>
                        <div class="error-wrap"></div>
                    </div>
                    <div class="form-group">
                        <label for="alamat_lengkap"><?= $this->translate('label-place') ?></label>
                        <textarea class="form-control formRequired formAddress" name="alamat_lengkap" id="alamat_lengkap" placeholder="<?= $this->translate('placeholder-place') ?> Contoh: Jalan Rajawali 1 Blok A no.11 RT 01 RW 02"></textarea>
                        <div class="error-wrap"></div>
                    </div>
                </div>
            </fieldset>

            <!-- STEP 3 -->
            <h3><?= $this->translate('data-rekening') ?></h3>
            <fieldset>
                <div class="form-body--credit">
                    <div class="text-head">
                        <h2 class="text-center"><?= $this->translate('data-rekening') ?></h2>
                        <h2 class="text-center-edit"><?= $this->translate('change-data-rekening') ?></h2>
                        <p class="text-center"><?= $this->translate('input-data-rekening') ?></p>
                    </div>

                    <div class="form-group">
                        <label><?= $this->translate('label-bank') ?></label>
                        <select class="form-control formRequired" id="bank" name="bank" placeholder="<?= $this->translate('choose-bank') ?>" multiple="multiple">
                        </select>
                        <div class="error-wrap"></div>
                    </div>

                    <div class="form-group">
                        <label for="account_number"><?= $this->translate('label-account-number') ?></label>
                        <input type="text" class="form-control" name="account_number" id="account_number" placeholder="<?= $this->translate('placeholder-account-number') ?>">
                        <div class="error-wrap"></div>
                    </div>

                    <div class="form-group">
                        <label for="account_name"><?= $this->translate('label-account-name') ?></label>
                        <input type="text" class="form-control" name="account_name" id="account_name" placeholder="<?= $this->translate('placeholder-account-name') ?>">
                        <div class="error-wrap"></div>
                    </div>

                </div>
            </fieldset>

            <!-- STEP 4 -->
            <h3><?= $this->translate('data-tambahan') ?></h3>
            <fieldset>
                <div class="form-body--credit">
                    <div class="text-head">
                        <h2 class="text-center"><?= $this->translate('data-tambahan') ?></h2>
                        <h2 class="text-center-edit"><?= $this->translate('change-data-tambahan') ?></h2>
                        <p class="text-center"><?= $this->translate('input-data-tambahan') ?></p>
                    </div>

                    <div class="form-group">
                        <div class="title-input">
                            <?= $this->translate('label-financing') ?>
                        </div>
                        <div class="radio-group formRequired">
                            <div class="radio-inside">
                                <input type="radio" value="1" id="yes-financing" name="financing">
                                <label for="yes-financing">Ya</label>
                            </div>
                            <div class="radio-inside">
                                <input type="radio" value="0" id="not-financing" name="financing">
                                <label for="not-financing">Tidak</label>
                            </div>
                        </div>
                        <div class="error-wrap"></div>
                    </div>

                    <div class="form-group">
                        <div class="title-input">
                            <?= $this->translate('label-waktu-kerja') ?>
                        </div>
                        <div id="waktu-kerja" class="radio-group formRequired">
                        </div>
                        <div class="error-wrap"></div>
                    </div>

                    <div class="form-group">
                        <div class="title-input">
                            <?= $this->translate('label-selling-channel') ?>
                        </div>
                        <div id="selling-channel" class="checkbox-group formRequired">
                        </div>
                        <div class="error-wrap"></div>
                    </div>

                </div>
            </fieldset>

            <!-- STEP 5 -->
            <h3><?= $this->translate('data-confirmation') ?></h3>
            <fieldset>
                <div id="step-summary" class="form-body--credit-simulasi">
                    <div class="text-head">
                        <h2 class="text-center"><?= $this->translate('label-confirmation') ?></h2>
                        <p class="text-center"><?= $this->translate('text-confirmation') ?></p>
                    </div>

                    <div class="biaya-agunan">
                        <div class="cont-agunan">
                            <p class="title-agunan">
                                A. <?= $this->translate('data-name') ?>
                            </p>
                            <div class="button-area text-right button-angsur">
                                <button id="btnDataPemohon" onclick="editStep(0)" class="cta cta-primary cta-ubah" type="button"><i class="fa fa-pencil" aria-hidden="true"></i><b><?= $this->translate('ubah') ?></b></button>
                            </div>
                            <table>
                                <tr>
                                    <td><b><?= $this->translate('fullname') ?></b></td>

                                    <td id="showFullName" class="nama_lengkap"></td>
                                </tr>
                                <tr>
                                    <td><b><?= $this->translate('email') ?></b></td>

                                    <td id="showEmail" class="email"></td>
                                </tr>
                                <tr>
                                    <td><b><?= $this->translate('handphone') ?></b></td>

                                    <td id="showPhone" class="email"></td>
                                </tr>

                                <tr>
                                    <td><b><?= $this->translate('label-education') ?></b></td>

                                    <td id="showEducation"></td>
                                </tr>
                                <tr>
                                    <td><b><?= $this->translate('label-meried') ?></b></td>

                                    <td id="showMeried"></td>
                                </tr>
                                <tr>
                                    <td><b><?= $this->translate('label-burden') ?></b></td>

                                    <td id="showBurden"></td>
                                </tr>

                                <tr>
                                    <td><b><?= $this->translate('label-profession') ?></b></td>

                                    <td id="showProfession"></td>
                                </tr>
                                <tr>
                                    <td><b><?= $this->translate('label-npwp') ?></b></td>

                                    <td id="showNpwp"></td>
                                </tr>
                                <tr>
                                    <td><b><?= $this->translate('labelNoktp') ?></b></td>

                                    <td id="showNoKtp"></td>
                                </tr>

                                <tr>
                                    <td><b><?= $this->translate('label-member') ?></b></td>

                                    <td id="showAre_member"></td>
                                </tr>
                                <tr>
                                    <td><b><?= $this->translate('label-areCode') ?></b></td>

                                    <td id="showAreCode"></td>
                                </tr>
                                <tr>
                                    <td><b><?= $this->translate('label-smartphone') ?></b></td>

                                    <td id="showHaveSmartphone"></td>
                                </tr>
                                <!-- <tr>
                              <td>Unggah Foto KTP</td>

                              <td class="unggah"></td>
                          </tr> -->
                            </table>
                        </div>

                    </div>

                    <div class="biaya-agunan">
                        <div class="cont-agunan">
                            <p class="title-agunan">
                                B. <?= $this->translate('data-place') ?>
                            </p>
                            <div class="button-area text-right button-angsur">
                                <button id="btnDataTempatTinggal" onclick="editStep(1)" class="cta cta-primary cta-ubah" type="button"><i class="fa fa-pencil" aria-hidden="true"></i><b><?= $this->translate('ubah') ?></b></button>
                            </div>
                            <table>
                                <tr>
                                    <td><b><?= $this->translate('provinsi') ?></b></td>

                                    <td id="showProvinsi" class="provinsi"></td>
                                </tr>
                                <tr>
                                    <td><b><?= $this->translate('kota') ?></b></td>

                                    <td id="showKota" class="kota"></td>
                                </tr>
                                <tr>
                                    <td><b><?= $this->translate('kecamatan') ?></b></td>

                                    <td id="showKecamatan" class="kecamatan"></td>
                                </tr>
                                <tr>
                                    <td><b><?= $this->translate('kelurahan') ?></b></td>

                                    <td id="showKelurahan" class="kelurahan"></td>
                                </tr>
                                <tr>
                                    <td><b><?= $this->translate('postcode') ?></b></td>

                                    <td id="showKodePos" class="kodepos"></td>
                                </tr>
                                <tr>
                                    <td><b><?= $this->translate('address') ?></b></td>

                                    <td id="showAddress" class="address"></td>
                                </tr>
                            </table>
                        </div>

                    </div>

                    <div class="biaya-agunan">
                        <div class="cont-agunan">
                            <p class="title-agunan">
                                C. <?= $this->translate('data-rekening') ?>
                            </p>
                            <div class="button-area text-right button-angsur">
                                <button id="btnJumlahPembiayaan" onclick="editStep(2)" class="cta cta-primary cta-ubah" type="button"><i class="fa fa-pencil" aria-hidden="true"></i><b><?= $this->translate('ubah') ?></b></button>
                            </div>
                            <table>
                                <tr>
                                    <td><b><?= $this->translate('label-bank') ?></b></td>

                                    <td id="showBank"></td>
                                </tr>
                                <tr>
                                    <td><b><?= $this->translate('label-account-number') ?></b></td>

                                    <td id="showAccount_number"></td>
                                </tr>
                                <tr>
                                    <td><b><?= $this->translate('label-account-name') ?></b></td>

                                    <td id="showAccount_name"></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="biaya-agunan">
                        <div class="cont-agunan">
                            <p class="title-agunan">
                                D. <?= $this->translate('data-tambahan') ?>
                            </p>
                            <div class="button-area text-right button-angsur">
                                <button id="btnJumlahPembiayaan" onclick="editStep(3)" class="cta cta-primary cta-ubah" type="button"><i class="fa fa-pencil" aria-hidden="true"></i><b><?= $this->translate('ubah') ?></b></button>
                            </div>
                            <table>
                                <tr>
                                    <td>
                                        <b><?= $this->translate('label-financing') ?></b><br />
                                        <p id="showFinancing"></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b><?= $this->translate('label-waktu-kerja') ?></b><br />
                                        <p id="showWaktu-kerja"></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b><?= $this->translate('label-selling-channel') ?></b><br />
                                        <ul id="showChannel"></ul>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>


                    <div class="biaya-agunan">
                        <div class="form-group">
                            <div class="checkbox-group formRequired">
                                <div class="checkbox-inside full">
                                    <input type="checkbox" id="agreement1" name="agreement1" class="agreement">
                                    <label for="agreement1" class="label-agreement"><?= $this->translate('term-condition') ?></label>
                                </div>
                            </div>
                            <div class="error-wrap"></div>
                        </div>
                        <!-- <div class="form-group">
                      <input type="checkbox" id="agreement2" class="agreement">
                      <label for="agreement2" class="label-agreement">Lorem ipsum dolor sit
                          amet, consectetur
                          adipisicing elit. Odio reprehenderit iusto libero aliquid
                          temporibus vero, optio eveniet et, adipisci natus rem enim sequi
                          saepe expedita qui sunt exercitationem delectus. In?</label>
                      <div class="error-wrap"></div>
                  </div> -->
                    </div>
                </div>
                <div id="otp-success" class="success-wrapper">
                    <div class="img-wrap">
                        <img class="icon-thank-page" src="/static/images/icon/m_thank_you.png" alt="">
                    </div>
                    <div class="text-wrap text-center">
                        <h3><?= $this->translate('tq-text-1') ?></h3>
                        <p><?= $this->translate('tq-text-2') ?></p>
                    </div>
                    <div class="button-area text-center backtohome">
                        <button class="cta cta-primary cta-big cta-see buttonnext backtohome" id="button7" 
                            type="button" onclick="return checkStatusPengajuan()"><?= $this->translate('cek-status-aplikasi') ?></button>
                    </div>
                </div>
            </fieldset>

        </form>

    </div>
</div>

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