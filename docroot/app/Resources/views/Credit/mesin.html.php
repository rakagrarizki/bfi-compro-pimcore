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
  <div class="col-xs-12">

    <form id="getCredit" class="form-get--credit mesin-page" action="#">
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
              <div>
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
          </div>
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
        <h3><?= $this->translate('machine-data')?></h3>
        <fieldset class="form-body--credit">
          <div class="text-head">
              <h2 class="text-center"><?= $this->translate('data-place')?></h2>
              <h2 class="text-center-edit"><?= $this->translate('change-data-place')?></h2>
              <p class="text-center"><?= $this->translate('input-data-place')?></p>
          </div>
          <div class="form-group">
              <label><?= $this->translate('layanan')?></label>
              <select class="form-control formRequired" id="layanan" name="layanan"
                      placeholder="<?= $this->translate('choose-layanan')?>" multiple="multiple">
              </select>
              <div class="error-wrap"></div>
          </div>
          <div class="form-group">
              <label><?= $this->translate('industri')?></label>
              <select class="form-control formRequired" id="industri" name="industri"
                      placeholder="<?= $this->translate('choose-industri')?>" multiple="multiple">
              </select>
              <div class="error-wrap"></div>
          </div>
          <div class="form-group">
              <label><?= $this->translate('type')?></label>
              <select class="form-control formRequired" id="type" name="type"
                      placeholder="<?= $this->translate('choose-type')?>" multiple="multiple">
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
              </select>
              <div class="error-wrap"></div>
          </div>
          <div class="form-group">
              <label><?= $this->translate('model')?></label>
              <select class="form-control formRequired" id="model" name="model" disabled
                      placeholder="<?= $this->translate('choose-model')?>" multiple="multiple">
              </select>
              <div class="error-wrap"></div>
          </div>
          <div class="form-group">
              <label><?= $this->translate('year')?></label>
              <select class="form-control formRequired" id="year" name="year" disabled
                      placeholder="<?= $this->translate('choose-year')?>" multiple="multiple">
              </select>
              <div class="error-wrap"></div>
          </div>
          <div class="form-group">
              <label for="machine_estimated"><?= $this->translate('label-estimated-price')?></label>
              <input type="text" class="form-control formatRibuan" name="machine_estimated" id="machine_estimated"
                      placeholder="<?= $this->translate('placeholder-estimated-price')?>">
              <div class="error-wrap"></div>
          </div>
        </fieldset>

        <!-- STEP 4 -->
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
                      <div>
                        <select class="c-custom-select-trans form-control formRequired" id="jangka_waktu"
                                name="jangka-waktu" multiple="multiple">
                        </select>
                      </div>
                      <div class="error-wrap"></div>
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="rincian">
                      <div class="total-estimate">
                          <p class="title-angsuran"><?= $this->translate('label-estimate')?></p>
                          <p class="total">Rp 0</p>
                          <p class="infotext">*<?= $this->translate('text-estimate')?></p>
                          <button class="cta cta-primary cta-big absolutebutcalc" id="recalc"
                                  type="button"><?= $this->translate('hitung')?></button>
                      </div>
                  </div>
              </div>

          </div>
        </fieldset>

        <!-- STEP 5 -->
        <h3><?= $this->translate('data-confirmation')?></h3>
        <fieldset class="form-body--credit">
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