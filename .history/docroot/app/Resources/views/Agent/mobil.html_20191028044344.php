<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout-credit.html.php');
$this->headScript()->offsetSetFile(101, '/static/js/Includes/general-form.js');
$this->headScript()->offsetSetFile(100, '/static/js/Includes/agent-mobil.js');
?>

<div class="container">
  <div class="col-xs-12">

    <form id="getCredit" class="form-get--credit" action="#">
    <input type="hidden" id="jenis_form" name="jenis_form" value="EDUCATION">

        <!-- STEP 1 -->
        <h3><?= $this->translate('data-name')?></h3>
        <fieldset class="form-body--credit">
          <div class="text-head">
            <h2 class="text-center"><?= $this->translate('data-name')?></h2>
            <h2 class="text-center-edit"><?= $this->translate('change-data-name')?></h2>
            <p class="text-center"><?= $this->translate('input-data-name')?></p>
          </div>

          <div class="form-group">
              <label for="nama_lengkap"><?= $this->translate('form-name')?></label>
              <input type="text" class="form-control formRequired formAlphabet" name="nama_lengkap" id="nama_lengkap"
                      placeholder="<?= $this->translate('placeholder-name')?>">
              <small><?= $this->translate('agent-note-name')?></small>        
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
          
          <div id="personal-detail">

            <div class="form-group">
                <label><?= $this->translate('label-education')?></label>
                <select class="form-control formRequired" id="education" name="education"
                        placeholder="<?= $this->translate('choose-education')?>" multiple="multiple">
                </select>
                <div class="error-wrap"></div>
            </div>
            <div class="form-group">
                <label><?= $this->translate('label-meried')?></label>
                <select class="form-control formRequired" id="meried" name="meried"
                        placeholder="<?= $this->translate('choose-meried')?>" multiple="multiple">
                </select>
                <div class="error-wrap"></div>
            </div>
            <div class="form-group">
                <label><?= $this->translate('label-burden')?></label>
                <select class="form-control formRequired" id="burden" name="burden"
                        placeholder="<?= $this->translate('choose-burden')?>" multiple="multiple">
                </select>
                <div class="error-wrap"></div>
            </div>
            <div class="form-group">
                <label><?= $this->translate('label-profession')?></label>
                <select class="form-control formRequired" id="profession" name="profession"
                        placeholder="<?= $this->translate('choose-profession')?>" multiple="multiple">
                </select>
                <div class="error-wrap"></div>
            </div>
            <div class="form-group">
                <label><?= $this->translate('label-npwp')?></label>
                <input type="text" class="form-control formNpwp" name="npwp" id="npwp"
                        placeholder="<?= $this->translate('placeholder-npwp')?>">
                <div class="error-wrap"></div>
            </div>
            <div class="form-group">
                <label><?= $this->translate('label-noKtp')?></label>
                <input type="text" class="form-control formNoKtp" name="noKtp" id="noKtp"
                        placeholder="<?= $this->translate('placeholder-noKtp')?>">
                <div class="error-wrap"></div>
            </div>

            <div class="form-group upload-image">
                <label><?= $this->translate('form-ktp')?></label>
                <div class="upload-file">
                  <img src="" />
                  <div class="upload-btn">
                    <input type="file" class="file-input" accept="image/*" data-id="ktp" />
                    <button type="button">Ubah File</button>
                    <b></b>
                  </div>
                </div>
                <input type="hidden" class="form-control formRequired" name="ktp" id="ktp">
                <div class="error-wrap"></div>
                <span>Pastikan foto KTP terlihat jelas (max. ukuran file adalah 1MB)</span>
            </div>
            
            <div class="form-group">
              <div class="title-input">
                  <?= $this->translate('appicant-position')?>
              </div>
              <label for="nama_lengkap"><?= $this->translate('form-name')?></label>
              <div class="radio-group">
                  <div class="">
                      <label class=""> 
                        <input type="radio" value="perorang" name="applicant_position">
                        <?= $this->translate('perorangan')?>
                      </label>
                  </div>
                  <div class="">
                      <label class=""> 
                        <input type="radio" value="perusahaan" name="applicant_position">
                        <?= $this->translate('perusahaan')?>
                      </label>
                  </div>
              </div>
              <div class="error-wrap"></div>
          </div>

          </div>

          
          <div id="step-otp" class="form-body--credit">
            <h2 class="text-center"><?= $this->translate('confirmation-otp')?></h2>
            <p class="text-center"><?= $this->translate('text-confirmation-otp')?></p>

            <div class="otp-number form-group">
                <div class="otp-number__verify">
                    <input type="tel" pattern="\d*" placeholder="0" class="input-number" maxlength="1" name="otp1">
                    <input type="tel" pattern="\d*" placeholder="0" class="input-number" maxlength="1" name="otp2">
                    <input type="tel" pattern="\d*" placeholder="0" class="input-number" maxlength="1" name="otp3">
                    <input type="tel" pattern="\d*" placeholder="0" class="input-number" maxlength="1" name="otp4">
                </div>
                <div class="error-wrap"></div>
                <div class="otp-number__text">
                    <p class="otp-wait"><?= $this->translate('wait-otp')?> <span id="otp-counter" class="countdown"></span> </p>
                    <p class="otp-resend"><?= $this->translate('dont-get-otp')?> <span id="otp-resend" class="countdown">Resend</span></p>
                </div>
                <div class="otp-button margin-top-50">
                  <button class="cta cta-primary cta-big cta-see btn-verifikasi buttonnext" id="otp-verification" type="button"><?= $this->translate('verifikasi')?></button>
                </div>
            </div>
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
                      placeholder="<?= $this->translate('placeholder-postcode')?>">
              <div class="error-wrap"></div>
          </div>
          <div class="form-group">
              <label for="alamat_lengkap"><?= $this->translate('label-place')?></label>
              <textarea class="form-control formRequired formAddress" name="alamat_lengkap" id="alamat_lengkap"
                        placeholder="<?= $this->translate('placeholder-place')?> Contoh: Jalan Rajawali 1 Blok A no.11 RT 01 RW 02"></textarea>
              <div class="error-wrap"></div>
          </div>
        </fieldset>

        <!-- STEP 3 -->
        <h3><?= $this->translate('data-funding')?></h3>
        <fieldset>
          <div class="form-body--credit-simulasi row">
              <div class="text-head">
                  <h2 class="text-center"><?= $this->translate('data-funding')?></h2>
                  <h2 class="text-center-edit"><?= $this->translate('change-data-funding')?></h2>
                  <p class="text-center"><?= $this->translate('input-data-funding')?></p>
              </div>

              <div class="col-md-6">
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
                  <div class="form-group inputsimulasi">
                      <label for="jml-biaya"><?= $this->translate('label-edu-downpayment')?></label>
                      <div class="input-group inputform">
                          <span class="input-group-addon">Rp</span>
                          <input type="text" id="down_payment" name="down_payment" class="form-control minDownPayment formatRibuan">
                      </div>
                      <small><?= $this->translate('label-edu-downpayment-note')?></small>
                      <div class="error-wrap"></div>
                  </div>
                  <div class="form-group sliderGroup inputsimulasi">
                      <label><?= $this->translate('label-funding-year')?></label>
                      <select class="c-custom-select-trans form-control formRequired" id="jangka_waktu"
                              name="jangka-waktu">
                      </select>
                      <div class="error-wrap"></div>
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="rincian">
                      <div class="rincian--content">
                          <p class="title-angsuran"><?= $this->translate('label-rincian')?></p>
                          <table class="tableangsuran">
                              <tr>
                                  <td>
                                      <?= $this->translate('label-edu-total-pembiayaan')?> *
                                  </td>
                                  <td class="currency" id="total_funding">
                                      Rp 0
                                  </td>
                              </tr>
                              <tr>
                                  <td>
                                      <?= $this->translate('label-edu-angsuran-bulanan')?> *
                                  </td>
                                  <td class="currency" id="monthly_installment">
                                      Rp 0
                                  </td>
                              </tr>
                              <tr>
                                  <td>
                                      <?= $this->translate('label-edu-biaya-adm')?> *
                                  </td>
                                  <td class="currency" id="administrasi">
                                      Rp 0
                                  </td>
                              </tr>
                              <tr>
                                  <td>
                                      <?= $this->translate('label-edu-asuransi')?> *
                                  </td>
                                  <td class="currency" id="life_insurance">
                                      Rp 0
                                  </td>
                              </tr>
                              <!-- <tr>
                                  <td class="textsubcurrency">
                                      Tahun ke-1 [All Risk Only*]
                                  </td>
                                  <td class="currency" tahun="1">
                                      Rp 0
                                  </td>
                              </tr> -->
                              <!-- <tr>
                                  <td class="textsubcurrency">
                                      Tahun ke-2 [Total Cost Only*]
                                  </td>
                                  <td class="currency" tahun="2">
                                      Rp 205.000
                                  </td>
                              </tr> -->
                          </table>
                      </div>
                      <div class="total-estimate">
                          <p class="title-angsuran"><?= $this->translate('label-estimate')?></p>
                          <p class="total" id="monthly_installment_est_total">Rp 0</p>
                          <p class="infotext">*<?= $this->translate('text-estimate')?></p>
                          <button class="cta cta-primary cta-big absolutebutcalc" id="recalc"
                                  type="button"><?= $this->translate('hitung')?></button>
                      </div>
                  </div>
              </div>

          </div>
        </fieldset>

        <!-- STEP 4 -->
        <h3><?= $this->translate('data-confirmation')?></h3>
        <fieldset>
          <div id="step-summary" class="form-body--credit-simulasi">
              <div class="text-head">
                  <h2 class="text-center"><?= $this->translate('label-confirmation')?></h2>
                  <p class="text-center"><?= $this->translate('text-confirmation')?></p>
              </div>
              <div class="biaya-agunan">
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
              <div class="biaya-agunan">
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
              <div class="biaya-agunan">
                  <div class="cont-agunan">
                      <p class="title-agunan">
                          C. <?= $this->translate('data-funding')?>
                      </p>
                      <div class="button-area text-right button-angsur">
                          <button id="btnJumlahPembiayaan" onclick="editStep(2)" class="cta cta-primary cta-ubah" type="button"><i class="fa fa-pencil" aria-hidden="true"></i><b><?= $this->translate('ubah')?></b></button>
                      </div>
                      <table class="tablebiaya">
                          <tr>
                              <td class="long"><?= $this->translate('label-edu-angsuran-bulanan')?></td>

                              <td id="summary-angsuran-bulanan"></td>
                          </tr>
                          <tr>
                              <td class="long"><?= $this->translate('label-edu-jangka-waktu')?></td>

                              <td id="summary-jangka-waktu"></td>
                          </tr>
                          <tr>
                              <td class="long"><?= $this->translate('label-edu-downpayment')?></td>

                              <td id="summary-downpayment"></td>
                          </tr>
                          <tr>
                              <td class="long"><?= $this->translate('label-edu-life-insurance')?></td>

                              <td id="summary-life-insurance"></td>
                          </tr>
                          <tr>
                              <td class="long"><?= $this->translate('label-edu-total-pembiayaan')?></td>

                              <td id="summary-total-pembiayaan"></td>
                          </tr>
                          <tr>
                              <td class="long"><?= $this->translate('label-data-funding')?></td>

                              <td id="summary-funding"></td>
                          </tr>
                          <!--  <tr>
                                <td>Asuransi Tahun ke-1</td>

                                <td class="tahun1">All Risk</td>
                            </tr>
                            <tr>
                                <td>Asuransi Tahun ke-2</td>

                                <td class="tahun1">Total Lost Only</td>
                            </tr> -->
                      </table>
                  </div>
              </div>
              <div class="biaya-agunan">
                  <div class="form-group">
                      <input type="checkbox" id="agreement1" name="agreement1" class="agreement">
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

          <div id="otp-success" class="success-wrapper">
              <div class="img-wrap">
                  <img class="icon-thank-page" src="/static/images/icon/m_thank_you.png" alt="">
              </div>
              <div class="text-wrap text-center">
                  <h3><?= $this->translate('tq-text-1')?></h3>
                  <p><?= $this->translate('tq-text-2')?></p>
              </div>
              <div class="button-area text-center backtohome">
                  <a href="/<?php echo $this->getLocale() ?>">
                      <button class="cta cta-primary cta-big cta-see buttonnext backtohome" id="button7"
                              type="button"><?= $this->translate('backtohome')?></button>
                  </a>
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