<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout-credit.html.php');
$this->headScript()->offsetSetFile(100, '/static/js/Includes/mesin.js');
$this->headScript()->offsetSetFile(101, '/static/js/Includes/general-form.js');
?>

<div class="container">
  <div class="col-xs-12 no-padding-mobile">

    <form id="getCredit" class="form-get--credit mesin-page" action="#">
    <input type="hidden" id="jenis_form" name="jenis_form" value="EDUCATION">

        <!-- STEP 1 -->
        <h3><?= $this->translate('data-name')?></h3>
        <fieldset class="form-body--credit">
          <div class="text-head">
            <h2 class="text-center"><?= $this->translate('data-name'), $this->translate('data-name-mesin')?></h2>
            <h2 class="text-center-edit"><?= $this->translate('change-data-name')?></h2>
            <p class="text-center"><?= $this->translate('input-data-name')?></p>
          </div>
          <div class="form-group application-position">
                <label for="identitas"><?= $this->translate('appicant-position')?></label>
                <div class="input-group inputform">
                    <div class="ipt-radio">
                        <label>
                            <span>
                                <input type="radio" name="applicant_position" value="perorang" checked />
                            </span>
                            <?= $this->translate('perorangan')?>
                        </label>
                    </div>
                    <div class="ipt-radio">
                        <label>
                            <span>
                                <input type="radio" name="applicant_position" value="perusahaan" />
                            </span>
                            <?= $this->translate('perusahaan')?>
                        </label>
                    </div>
                </div>
                <div class="error-wrap"></div>
            </div>
          <!-- <div class="form-group">
              <div class="title-input">
                  <?= $this->translate('appicant-position')?>
              </div>
              <label for="nama_lengkap"><?= $this->translate('form-name')?></label>
              <div class="radio-group">
                  <div class="radio-inside">
                      <label class="container"> <?= $this->translate('perorangan')?>
                        <input type="radio" checked="checked" value="perorang" name="applicant_position">
                        <span class="checkmark"></span>
                      </label>
                  </div>
                  <div class="radio-inside">
                      <label class="container"> <?= $this->translate('perusahaan')?>
                        <input type="radio" value="perusahaan" name="applicant_position">
                        <span class="checkmark"></span>
                      </label>
                  </div>
              </div>
              <div class="error-wrap"></div>
          </div> -->
          <div class="form-group">
              <label for="nama_perusahaan"><?= $this->translate('form-name-company')?></label>
              <input type="text" class="form-control formRequired formAlphabet" name="nama_perusahaan" id="nama_perusahaan"
                      placeholder="<?= $this->translate('placeholder-name-company')?>" disabled>
              <div class="error-wrap"></div>
          </div>
          <div class="form-group">
              <label for="nama_lengkap"><?= $this->translate('form-name')?></label>
              <input type="text" class="form-control formRequired formAlphabet" name="nama_lengkap" id="nama_lengkap"
                      placeholder="<?= $this->translate('placeholder-name')?>">
              <div class="error-wrap"></div>
          </div>
          <div class="form-group">
              <label for="email_pemohon"><?= $this->translate('form-email')?></label>
              <input type="email" class="form-control formRequired formEmail" name="email_pemohon" id="email_pemohon"
                      placeholder="<?= $this->translate('placeholder-email')?>">
              <div class="error-wrap"></div>
          </div>
          <div class="form-group">
              <label for="no_handphone"><?= $this->translate('form-hp')?></label>
              <input type="tel" pattern="\d*" class="form-control formPhoneNumber" name="no_handphone" id="no_handphone" maxlength="13"
                      placeholder="<?= $this->translate('placeholder-hp')?>">
              <div class="error-wrap"></div>
          </div>

        </fieldset>

        <!-- STEP 2 -->
        <h3><?= $this->translate('data-place')?></h3>
        <fieldset class="form-body--credit">
          <div class="text-head">
              <h2 class="text-center"><?= $this->translate('data-place')?></h2>
              <h2 class="text-center-edit"><?= $this->translate('change-data-place')?></h2>
              <p class="text-center"><?= $this->translate('input-data-place')?></p>
          </div>
          <div class="form-group">
              <label><?= $this->translate('label-provinsi')?></label>
              <select class="form-control formRequired" id="provinsi" name="provinsi"
                      placeholder="<?= $this->translate('choose-provinsi')?>" multiple="multiple">
              </select>
              <div class="error-wrap"></div>
          </div>
          <div class="form-group">
              <label><?= $this->translate('label-kota')?></label>
              <select class="form-control formRequired" id="kota" name="kota"
                      placeholder="<?= $this->translate('choose-kota')?>" multiple="multiple">
                  <option value="" class="placeholder" disabled selected><?= $this->translate('choose-kota')?></option>
              </select>
              <div class="error-wrap"></div>
          </div>
          <div class="form-group">
              <label><?= $this->translate('label-kecamatan')?></label>
              <select class="form-control formRequired" id="kecamatan" name="kecamatan"
                      placeholder="<?= $this->translate('choose-kecamatan')?>" multiple="multiple">
                  <option value="" disabled selected><?= $this->translate('choose-kecamatan')?></option>
              </select>
              <div class="error-wrap"></div>
          </div>
          <div class="form-group">
              <label><?= $this->translate('label-kelurahan')?></label>
              <select class="form-control formRequired" id="kelurahan" name="kelurahan"
                      placeholder="<?= $this->translate('choose-kelurahan')?>" multiple="multiple">
                  <option value="" disabled selected><?= $this->translate('choose-kelurahan')?></option>
              </select>
              <div class="error-wrap"></div>
          </div>
          <div class="form-group">
              <label for="kode_pos"><?= $this->translate('label-postcode')?></label>
              <input type="text" class="form-control formKodePos" name="kode_pos" id="kode_pos"
                      placeholder="<?= $this->translate('placeholder-postcode')?>" disabled>
              <div class="error-wrap"></div>
          </div>
          <div class="form-group">
              <label id="label_alamat" for="alamat_lengkap"><?= $this->translate('label-place')?></label>
              <textarea class="form-control formRequired formAddress" name="alamat_lengkap" id="alamat_lengkap"
                        placeholder="<?= $this->translate('placeholder-place')?> Contoh: Jalan Rajawali 1 Blok A no.11 RT 01 RW 02" onfocus="alamatFocus()"></textarea>
              <div class="error-wrap"></div>
          </div>
        </fieldset>

        <!-- STEP 3 -->
        <h3><?= $this->translate('data-mesin-alat')?></h3>
        <fieldset class="form-body--credit machine-data">
          <div class="text-head">
              <h2 class="text-center"><?= $this->translate('data-mesin-alat')?></h2>
              <h2 class="text-center-edit"><?= $this->translate('change-data-place')?></h2>
              <p class="text-center"><?= $this->translate('input-data-mesin')?></p>
          </div>
          <div class="form-group">
              <label><?= $this->translate('layanan')?></label>
              <select class="form-control formRequired" id="layanan" name="layanan"
                      placeholder="<?= $this->translate('choose-layanan')?>" multiple="multiple">
                  <option value="" class="placeholder" disabled selected><?= $this->translate('choose-layanan')?></option>
              </select>
              <div class="error-wrap"></div>
          </div>
          <div class="form-group">
              <label><?= $this->translate('industri')?></label>
              <select class="form-control formRequired" id="industri" name="industri"
                      placeholder="<?= $this->translate('choose-industri')?>" multiple="multiple">
                  <option value="" class="placeholder" disabled selected><?= $this->translate('choose-industri')?></option>
              </select>
              <div class="error-wrap"></div>
          </div>
          <div class="form-group">
              <label><?= $this->translate('type')?></label>
              <select class="form-control formRequired" id="type" name="type"
                      placeholder="<?= $this->translate('choose-type')?>" multiple="multiple">
                  <option value="" class="placeholder" disabled selected><?= $this->translate('choose-type')?></option>
              </select>
              <div class="error-wrap"></div>
          </div>
          <div class="form-group">
              <label for="machine_qty"><?= $this->translate('label-machine-qty')?></label>
              <input type="text" class="form-control" name="machine_qty" id="machine_qty"
                      placeholder="<?= $this->translate('placeholder-machine-qty')?>">
              <div class="error-wrap"></div>
          </div>
          <div class="form-group">
              <label><?= $this->translate('brand')?></label>
              <select class="form-control formRequired" id="brand" name="brand"
                      placeholder="<?= $this->translate('choose-brand')?>" multiple="multiple">
                  <option value="" class="placeholder" disabled selected><?= $this->translate('choose-brand')?></option>
              </select>
              <div class="error-wrap"></div>
          </div>
          <div class="form-group">
              <label><?= $this->translate('model')?></label>
              <select class="form-control formRequired" id="model" name="model" disabled
                      placeholder="<?= $this->translate('choose-model')?>" multiple="multiple">
                  <option value="" class="placeholder" disabled selected><?= $this->translate('choose-model')?></option>
              </select>
              <div class="error-wrap"></div>
          </div>
          <div class="form-group">
              <label><?= $this->translate('year')?></label>
              <select class="form-control formRequired" id="year" name="year" disabled
                      placeholder="<?= $this->translate('choose-year')?>" multiple="multiple">
                  <option value="" class="placeholder" disabled selected><?= $this->translate('choose-year')?></option>
              </select>
              <div class="error-wrap"></div>
          </div>
          <div class="form-group">
              <label for="machine_estimated"><?= $this->translate('label-estimated-price')?></label>
              <input type="text" class="form-control formEstimate formatRibuan" name="machine_estimated" id="machine_estimated"
                      placeholder="<?= $this->translate('placeholder-estimated-price')?>">
              <div class="error-wrap"></div>
          </div>
        </fieldset>

        <!-- STEP 4 -->
        <h3><?= $this->translate('data-funding')?></h3>
        <fieldset class="machine-funding">
          <div class="form-body--credit-simulasi row">
              <div class="text-head">
                  <h2 class="text-center"><?= $this->translate('data-funding')?></h2>
                  <h2 class="text-center-edit"><?= $this->translate('change-data-funding')?></h2>
                  <p class="text-center"><?= $this->translate('input-data-funding')?></p>
              </div>

              <div class="col-md-6 no-padding-mobile">
                  <div class="form-group sliderGroup inputsimulasi">
                      <label for="jml-biaya"><?= $this->translate('label-data-funding')?></label>
                      <div class="input-group inputform">
                          <span class="input-group-addon" id="basic-addon1">Rp</span>
                          <input type="tel" pattern="\d*" id="ex7SliderVal" class="form-control formRequired formPrice c-input-trans" style="text-align: right;"
                                  aria-describedby="basic-addon1">

                          <div class="error-wrap"></div>

                      </div>
                      <div class="slidecontainer ">
                          <input id="calcSlider" class="calcslide" type="tel" pattern="\d*" data-slider-handle="custom" data-slider-tooltip="hide" />
                          <div class="value-left valuemin"></div>
                          <div class="value-right valuemax"></div>
                          <input type="hidden" id="otr">
                      </div>
                  </div>
                  <div class="form-group inputsimulasi mesin-down-payment">
                      <label for="jml-biaya"><?= $this->translate('label-edu-downpayment')?></label>
                      <div class="input-group inputform">
                          <span class="input-group-addon">Rp</span>
                          <input type="text" id="down_payment" name="down_payment" class="form-control minDownPaymentMachine formatRibuan">
                      </div>
                      <small><?= $this->translate('label-edu-downpayment-note')?></small>
                      <div class="error-wrap"></div>
                  </div>
                  <div class="form-group sliderGroup inputsimulasi">
                      <label><?= $this->translate('label-funding-year')?></label>
                      <div>
                        <select class="c-custom-select-trans form-control formRequired" id="jangka_waktu"
                                name="jangka-waktu" multiple="multiple" placeholder="<?= $this->translate('jangka-waktu') ?>">
                        </select>
                      </div>
                      <div class="error-wrap" id="error-tenor"></div>
                  </div>
              </div>
              <div class="col-md-6 no-padding-mobile">
                  <div class="rincian">
                      <div class="total-estimate">
                          <p class="title-angsuran"><?= $this->translate('label-estimate')?></p>
                          <p class="total">Rp <span id="permonth-estimation">0</span></p>
                          <p class="infotext">*<?= $this->translate('text-estimate')?></p>
                          <button class="cta cta-primary cta-big absolutebutcalc" id="recalc"
                                  type="button"><?= $this->translate('hitung')?></button>
                      </div>
                  </div>
                  <div class="warning-calculate hide"><label>Silahkan Klik hitung ulang sebelum melanjutkan.</label></div>
              </div>

          </div>
        </fieldset>

        <!-- STEP 5 -->
        <h3><?= $this->translate('data-confirmation')?></h3>
        <fieldset>
          <div id="step-summary" class="form-body--credit-simulasi">
              <div class="text-head">
                  <h2 class="text-center"><?= $this->translate('label-confirmation')?></h2>
                  <p class="text-center"><?= $this->translate('text-confirmation')?></p>
              </div>
              <div class="biaya-agunan-mesin">
                  <div class="cont-agunan">
                      <p class="title-agunan">
                          A. <?= $this->translate('data-name')?>
                      </p>
                      <div class="button-area text-right button-angsur">
                          <button id="btnDataPemohon" onclick="editStep(0)" class="cta cta-primary cta-ubah" type="button"><i class="fa fa-pencil" aria-hidden="true"></i><b><?= $this->translate('ubah')?></b></button>
                      </div>
                      <table>
                          <tr>
                              <td><?= $this->translate('fullname')?></td>

                              <td id="showFullName" class="nama_lengkap"></td>
                          </tr>
                          <tr>
                              <td><?= $this->translate('email')?></td>

                              <td id="showEmail" class="email"></td>
                          </tr>
                          <tr>
                              <td><?= $this->translate('handphone')?></td>

                              <td id="showPhone" class="email"></td>
                          </tr>
                          <!-- <tr>
                              <td>Unggah Foto KTP</td>

                              <td class="unggah"></td>
                          </tr> -->
                      </table>
                  </div>

              </div>
              <div class="biaya-agunan-mesin">
                  <div class="cont-agunan">
                      <p class="title-agunan">
                          B. <?= $this->translate('data-place')?>
                      </p>
                      <div class="button-area text-right button-angsur">
                          <button id="btnDataTempatTinggal" onclick="editStep(1)" class="cta cta-primary cta-ubah" type="button"><i class="fa fa-pencil" aria-hidden="true"></i><b><?= $this->translate('ubah')?></b></button>
                      </div>
                      <table>
                          <tr>
                              <td><?= $this->translate('provinsi')?></td>

                              <td id="showProvinsi" class="provinsi"></td>
                          </tr>
                          <tr>
                              <td><?= $this->translate('kota')?></td>

                              <td id="showKota" class="kota"></td>
                          </tr>
                          <tr>
                              <td><?= $this->translate('kecamatan')?></td>

                              <td id="showKecamatan" class="kecamatan"></td>
                          </tr>
                          <tr>
                              <td><?= $this->translate('kelurahan')?></td>

                              <td id="showKelurahan" class="kelurahan"></td>
                          </tr>
                          <tr>
                              <td><?= $this->translate('postcode')?></td>

                              <td id="showKodePos" class="kodepos"></td>
                          </tr>
                          <tr>
                              <td><?= $this->translate('address')?></td>

                              <td id="showAddress" class="address"></td>
                          </tr>
                      </table>
                  </div>

              </div>
              <div class="biaya-agunan-mesin">
                  <div class="cont-agunan">
                      <p class="title-agunan">
                          C. <?= $this->translate('data-mesin')?>
                      </p>
                      <div class="button-area text-right button-angsur">
                          <button id="btnJumlahPembiayaan" onclick="editStep(2)" class="cta cta-primary cta-ubah" type="button"><i class="fa fa-pencil" aria-hidden="true"></i><b><?= $this->translate('ubah')?></b></button>
                      </div>
                      <table class="tablebiaya">
                          <tr>
                              <td class="long"><?= $this->translate('service')?></td>

                              <td id="summary-service-mesin"></td>
                          </tr>
                          <tr>
                              <td class="long"><?= $this->translate('label-industri')?></td>

                              <td id="summary-industri"></td>
                          </tr>
                          <tr>
                              <td class="long separate-column"><?= $this->translate('label-mesin-type')?></td>

                              <td id="summary-mesin-type"></td>
                          </tr>
                          <tr>
                              <td class="long"><?= $this->translate('label-machine-qty')?></td>

                              <td id="summary-machine-qty"></td>
                          </tr>
                          <tr>
                              <td class="long"><?= $this->translate('label-mesin-brand')?></td>

                              <td id="summary-mesin-brand"></td>
                          </tr>
                          <tr>
                              <td class="long"><?= $this->translate('label-estimated-price')?></td>

                              <td id="summary-estimated-price"></td>
                          </tr>
                      </table>
                  </div>
              </div>
              <div class="biaya-agunan-mesin">
                  <div class="cont-agunan">
                      <p class="title-agunan">
                          D. <?= $this->translate('data-funding')?>
                      </p>
                      <div class="button-area text-right button-angsur">
                          <button id="btnJumlahPembiayaan" onclick="editStep(2)" class="cta cta-primary cta-ubah" type="button"><i class="fa fa-pencil" aria-hidden="true"></i><b><?= $this->translate('ubah')?></b></button>
                      </div>
                      <table class="tablebiaya">
                          <tr>
                              <td class="long"><?= $this->translate('label-travel-total-pembiayaan')?></td>

                              <td id="summary-total-pembiayaan"></td>
                          </tr>
                          <tr>
                              <td class="long"><?= $this->translate('label-travel-angsuran-bulanan')?></td>

                              <td id="summary-angsuran-bulanan"></td>
                          </tr>
                          <tr>
                              <td class="long"><?= $this->translate('label-travel-jangka-waktu')?></td>

                              <td id="summary-jangka-waktu"></td>
                          </tr>
                      </table>
                  </div>
              </div>
              <div class="biaya-agunan">
                  <div class="form-group">
                      <input type="checkbox" id="agreement1" name="agreement1" class="agreement formRequired">
                      <label for="agreement1" class="label-agreement"><?= $this->translate('term-condition')?></label>
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
          <div id="step-otp" class="form-body--credit">
            <h2 class="text-center"><?= $this->translate('confirmation-otp')?></h2>
            <p class="text-center"><?= $this->translate('text-confirmation-otp')?></p>

            <div class="otp-number form-group">
                <div class="otp-number__verify">
                    <input type="tel" pattern="\d*" placeholder="0" class="input-number formRequired" maxlength="1" name="otp1">
                    <input type="tel" pattern="\d*" placeholder="0" class="input-number formRequired" maxlength="1" name="otp2">
                    <input type="tel" pattern="\d*" placeholder="0" class="input-number formRequired" maxlength="1" name="otp3">
                    <input type="tel" pattern="\d*" placeholder="0" class="input-number formRequired" maxlength="1" name="otp4">
                </div>
                <div class="error-wrap"></div>
                <div class="otp-number__text">
                    <p class="otp-wait"><?= $this->translate('wait-otp')?> <span id="otp-counter" class="countdown"></span> </p>
                    <p class="otp-resend"><?= $this->translate('dont-get-otp')?> <span id="otp-resend" class="countdown">Resend</span></p>
                </div>
                <div class="otp-button margin-top-50">
                  <button class="cta cta-orange cta-big btn-verifikasi buttonnext" id="otp-verification" type="button"><?= $this->translate('verifikasi')?></button>
                </div>
            </div>
          </div>

          <div id="otp-success" class="success-wrapper">
              <div class="img-wrap">
                  <img class="icon-thank-page" src="/static/images/icon/m_thank_you.png" alt="">
              </div>
              <div class="text-wrap text-center">
                  <h3><?= $this->translate('tq-text-1')?></h3>
                  <p><?= $this->translate('tq-text-2')?></p>
              </div>
              <div class="button-area text-center backtohome">
                    <button class="cta cta-primary cta-big cta-see buttonnext backtohome" id="button7"
                            type="button" onclick="return checkStatusPengajuan()"><?= $this->translate('cek-status-aplikasi')?></button>
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
                <p><?= $this->translate('wrong-otp')?></p>
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
                <p><?= $this->translate('wrong-server')?></p>
                <button type="button" class="cta cta-orange" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal-branch -->
<div class="modal fade" id="modal-branch" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content branch">
      <div class="modal-body">
        <h4><?= $this->translate('Branch not available')?></h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal"><?= $this->translate('close')?></button>
      </div>
    </div>
  </div>
</div>
<!-- end Modal branch -->

