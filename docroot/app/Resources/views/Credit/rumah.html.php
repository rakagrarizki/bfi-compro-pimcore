<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout-credit.html.php');
?>
<div id="myModal">
    <div class="form-dialog">

        <div class="container">
            <div class="row">

                <div class="col-md-12 no-padding">
                    <a href="index.html">
                        <button type="button" class="close" data-dismiss="modal">
                            <span class="flaticon-cancel"></span>
                        </button>
                    </a>

                    <div class="tab-get--credit">
                        <nav class="horizontal-scroll">
                            <ul class="nav nav-tabs">
                                <li class="nav-item-1 active">
                                    <a href="#" id="tab1">
                                        <span class="number"><i class="fa fa-check" aria-hidden="true"></i><b>1</b></span>
                                        <p><?= $this->translate('data-name')?></p>
                                    </a>
                                </li>
                                <li class="nav-item-2 disabled">
                                    <a href="#" id="tab2">
                                        <span class="number"><i class="fa fa-check" aria-hidden="true"></i><b>2</b></span>
                                        <p><?= $this->translate('data-place')?></p>
                                    </a>
                                </li>
                                <li class="nav-item-3 disabled">
                                    <a href="#" id="tab3">
                                        <span class="number"><i class="fa fa-check" aria-hidden="true"></i><b>3</b></span>
                                        <p><?= $this->translate('data-bangunan')?></p>
                                    </a>
                                </li>
                                <li class="nav-item-4 disabled">
                                    <a href="#">
                                        <span class="number"><i class="fa fa-check" aria-hidden="true"></i><b>4</b></span>
                                        <p><?= $this->translate('data-funding')?></p>
                                    </a>
                                </li>
                                <li class="nav-item-5 disabled">
                                    <a href="#" id="tab4">
                                        <span class="number"><i class="fa fa-check" aria-hidden="true"></i><b>5</b></span>
                                        <p><?= $this->translate('data-confirmation')?></p>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <form action="#" id="getCredit" method="POST" class="form-get--credit" role="form">
                            <input type="hidden" id="jenis_form" name="jenis_form" value="SURAT BANGUNAN">
                            <div class="tab-content">
                                <div id="menu1" class="tab-pane fade in active form-group">
                                    <div class="form-body--credit">
                                        <div class="text-head">
                                            <h2 class="text-center"><?= $this->translate('data-name')?></h2>
                                            <h2 class="text-center-edit"><?= $this->translate('change-data-name')?></h2>
                                            <p class="text-center"><?= $this->translate('input-data-name')?></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_lengkap"><?= $this->translate('form-name')?></label>
                                            <input type="text" class="form-control formRequired formAlphabet" name="nama_lengkap" id="nama_lengkap"
                                                   placeholder="<?= $this->translate('placeholder-name')?>">
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group date">
                                              <label for="tgl_lahir"><?= $this->translate('form-birthDate')?></label>
                                              <input type="text" class="iptDate form-control formRequired" name="tgl_lahir" id="tgl_lahir"
                                                    placeholder="<?= $this->translate('placeholder-birthDate')?>">
                                            </div>
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label><?= $this->translate('form-work')?></label>
                                            <select class="form-control formRequired" id="pekerjaan" name="pekerjaan"
                                                    placeholder="<?= $this->translate('placeholder-work')?>" multiple="multiple" />
                                                <option value="" disabled selected><?= $this->translate('placeholder-work')?></option>
                                            </select>
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="penghasilan"><?= $this->translate('form-penghasilan')?></label>
                                            <input type="text" class="formatRibuan form-control formRequired" name="penghasilan" id="penghasilan"
                                                   placeholder="<?= $this->translate('placeholder-penghasilan')?>">
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email"><?= $this->translate('form-email')?></label>
                                            <input type="email" class="form-control formRequired formEmail" name="email" id="email_pemohon"
                                                   placeholder="<?= $this->translate('placeholder-email')?>">
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="no_handphone"><?= $this->translate('form-hp')?></label>
                                            <input type="tel" pattern="\d*" class="form-control formPhoneNumber" name="no_handphone" id="no_handphone" maxlength="13"
                                                   placeholder="<?= $this->translate('placeholder-hp')?>">
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
                                        <!-- <div class="form-group">
                                            <label for="foto_ktp">Unggah Foto KTP</label>
                                            <label class="form-input">
                                                <div class="file-upload">
                                                    <div class="file-select">
                                                        <div class="file-select-button" id="fileName">Ubah File</div>
                                                        <div class="file-select-name" id="noFile">No file chosen...</div>
                                                        <input type="file" class="formRequired" name="chooseFile" id="chooseFile">
                                                    </div>
                                                </div>
                                            </label>
                                            <p id="nama-file"></p>
                                            <div class="error-wrap"></div>
                                            <span>Pastikan foto KTP terlihat jelas (max. ukuran file adalah 1MB)</span>
                                        </div> -->
                                    </div>
                                    <div class="button-area text-right next">

                                        <button class="cta cta-primary cta-big cta-see buttonnext" id="button1" type="button"><?= $this->translate('next')?></button>
                                        <button class="cta cta-primary cta-big cta-see buttonnext hidesavebuttonhome" type="button"><?= $this->translate('save')?></button>

                                    </div>

                                </div>
                                <div id="menu2" class="tab-pane slide-left form-group ">
                                    <div class="form-body--credit">
                                        <div class="text-head">
                                            <h2 class="text-center"><?= $this->translate('data-place')?></h2>
                                            <h2 class="text-center-edit"><?= $this->translate('change-data-place')?></h2>
                                            <p class="text-center"><?= $this->translate('input-data-place')?></p>
                                        </div>
                                        <div class="form-group">
                                            <label><?= $this->translate('label-provinsi')?></label>
                                            <select class="form-control formRequired" id="provinsi" name="provinsi"
                                                    placeholder="<?= $this->translate('choose-provinsi')?>" multiple="multiple" />
                                            <option value="" disabled selected><?= $this->translate('choose-provinsi')?></option>
                                            </select>
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label><?= $this->translate('label-kota')?></label>
                                            <select class="form-control formRequired" id="kota" name="kota"
                                                    placeholder="<?= $this->translate('choose-kota')?>" multiple="multiple" />
                                            <option value="" disabled selected><?= $this->translate('choose-kota')?></option>
                                            </select>
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label><?= $this->translate('label-kecamatan')?></label>
                                            <select class="form-control formRequired" id="kecamatan" name="kecamatan"
                                                    placeholder="<?= $this->translate('choose-kecamatan')?>" multiple="multiple" />
                                            <option value="" disabled selected><?= $this->translate('choose-kecamatan')?></option>
                                            </select>
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label><?= $this->translate('label-kelurahan')?></label>
                                            <select class="form-control formRequired" id="kelurahan" name="kelurahan"
                                                    placeholder="<?= $this->translate('choose-kelurahan')?>" multiple="multiple" />
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
                                    </div>
                                    <div class="button-area text-left back">
                                        <button class="cta cta-primary cta-big cta-back buttonback" id="buttonback2"
                                                type="button"><?= $this->translate('before')?></button>
                                    </div>
                                    <div class="button-area text-right next">
                                        <button class="cta cta-primary cta-big cta-see buttonnext" id="button2" type="button"><?= $this->translate('next')?></button>
                                        <button class="cta cta-primary cta-big cta-see buttonnext hidesavebuttonhome" type="button"><?= $this->translate('save')?></button>
                                    </div>

                                </div>
                                <div id="menu3" class="tab-pane slide-left">
                                    <div class="form-body--credit">
                                        <div class="text-head">
                                            <h2 class="text-center"><?= $this->translate('data-bangunan')?></h2>
                                            <h2 class="text-center-edit"><?= $this->translate('change-data-bangunan')?></h2>
                                            <p class="text-center"><?= $this->translate('input-data-bangunan')?></p>
                                        </div>
                                        
                                        <div class="form-group chk-label">
                                            <input type="checkbox" id="chkSameAddress" value="true" class="agreement" />
                                            <label for="chkSameAddress" class="label-agreement agreement1"><?= $this->translate('same-address')?></label>
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label><?= $this->translate('label-jenis-property')?></label>
                                            <select class="c-custom-select-trans form-control formRequired"
                                                    placeholder="<?= $this->translate('placeholder-jenis-property')?>" id="jenis_properti"
                                                    name="jenis_properti" multiple="multiple">
                                            </select>
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label><?= $this->translate('label-provinsi')?></label>
                                            <select class="form-control formRequired" id="provinsi_sertificate" name="provinsi_sertificate"
                                                    placeholder="<?= $this->translate('choose-provinsi')?>" multiple="multiple" />
                                                <option value="" disabled selected><?= $this->translate('choose-provinsi')?></option>
                                            </select>
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label><?= $this->translate('label-kota')?></label>
                                            <select class="form-control formRequired" id="kota_sertificate" name="kota_sertificate"
                                                    placeholder="<?= $this->translate('choose-kota')?>" multiple="multiple" />
                                                <option value="" disabled selected><?= $this->translate('choose-kota')?></option>
                                            </select>
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label><?= $this->translate('label-kecamatan')?></label>
                                            <select class="form-control formRequired" id="kecamatan_sertificate" name="kecamatan_sertificate"
                                                    placeholder="<?= $this->translate('choose-kecamatan')?>" multiple="multiple" />
                                                <option value="" disabled selected><?= $this->translate('choose-kecamatan')?></option>
                                            </select>
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label><?= $this->translate('label-kelurahan')?></label>
                                            <select class="form-control formRequired" id="kelurahan_sertificate" name="kelurahan_sertificate"
                                                    placeholder="<?= $this->translate('choose-kelurahan')?>" multiple="multiple" />
                                                <option value="" disabled selected><?= $this->translate('choose-kelurahan')?></option>
                                            </select>
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="kode_pos"><?= $this->translate('label-postcode')?></label>
                                            <input type="text" class="form-control formKodePos" name="kode_pos_sertificate" id="kode_pos_sertificate"
                                                   placeholder="<?= $this->translate('placeholder-postcode')?>">
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat_lengkap"><?= $this->translate('label-place')?></label>
                                            <textarea class="form-control formRequired formAddress" name="alamat_lengkap_sertificate" id="alamat_lengkap_sertificate"
                                                      placeholder="<?= $this->translate('placeholder-place')?>"></textarea>
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label><?= $this->translate('label-status-bangunan')?></label>
                                            <select class="c-custom-select-trans form-control formRequired"
                                                    placeholder="<?= $this->translate('placeholder-bangunan')?>" id="status_sertificate"
                                                    name="status_sertificate" multiple="multiple">
                                            </select>
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label><?= $this->translate('label-property-condition')?></label>
                                            <select class="c-custom-select-trans form-control formRequired"
                                                    placeholder="<?= $this->translate('placeholder-property-condition')?>" id="property_condition"
                                                    name="property_condition" multiple="multiple">
                                            </select>
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label><?= $this->translate('label-status-sertifikat')?></label>
                                            <select class="c-custom-select-trans form-control formRequired"
                                                    placeholder="<?= $this->translate('placeholder-sertifikat')?>" id="own_sertificate"
                                                    name="own_sertificate" multiple="multiple">
                                            </select>
                                            <div class="error-wrap"></div>
                                        </div>

                                    </div>

                                    <div class="button-area text-left back">
                                        <button class="cta cta-primary cta-big cta-back buttonback" id="buttonback3"
                                                type="button"><?= $this->translate('before')?></button>
                                    </div>

                                    <div class="button-area text-right next">
                                        <button class="cta cta-primary cta-big cta-see buttonnext" id="button3rumah"
                                                type="button"><?= $this->translate('next')?></button>
                                        <button class="cta cta-primary cta-big cta-see buttonnext hidesavebuttonhome" type="button"><?= $this->translate('save')?></button>
                                    </div>

                                </div>

                                
                                <div id="menu4" class="tab-pane slide-left">
                                    <div class="form-body--credit-simulasi row">

                                        <div class="text-head">
                                            <h2 class="text-center"><?= $this->translate('data-funding')?></h2>
                                            <h2 class="text-center-edit"><?= $this->translate('change-data-funding')?></h2>
                                            <p class="text-center"><?= $this->translate('input-data-funding')?></p>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                              <label for="tipe_paket"><?= $this->translate('label-tipe-paket')?></label>
                                              <div class="input-group inputform">
                                                <div class="ipt-radio">
                                                  <label>
                                                    <span>
                                                      <input type="radio" name="tipe_paket" value="apprisal" />
                                                    </span>
                                                    Apprisal
                                                  </label>
                                                </div>
                                                <div class="ipt-radio">
                                                  <label>
                                                    <span>
                                                      <input type="radio" name="tipe_paket" value="non-apprisal" />
                                                    </span>
                                                    Non-Apprisal
                                                  </label>
                                                </div>
                                              </div>
                                              <div class="error-wrap"></div>
                                            </div>
                                            <div class="form-group">
                                                <label for="estimasi_harga"><?= $this->translate('label-estimasi-harga')?></label>
                                                <div class="input-group inputform">
                                                    <span class="input-group-addon" id="basic-addon1">Rp</span>
                                                    <input type="text" id="estimasi_harga" class="formatRibuan form-control formRequired c-input-trans" >
                                                    <div class="error-wrap"></div>
                                                </div>
                                            </div>
                                            <div class="form-group sliderGroup inputsimulasi">
                                                <label for="jml-biaya"><?= $this->translate('label-data-funding')?></label>
                                                <div class="input-group inputform">
                                                    <span class="input-group-addon" id="basic-addon1">Rp</span>
                                                    <input type="tel" pattern="\d*" id="ex6SliderVal" class="form-control formRequired c-input-trans"
                                                           aria-describedby="basic-addon1">

                                                    <div class="error-wrap"></div>

                                                </div>
                                                <div class="slidecontainer ">
                                                    <input id="funding" class="customslide" type="tel" pattern="\d*" data-slider-handle="custom" data-slider-tooltip="hide" />
                                                    <div class="value-left valuemin"></div>
                                                    <div class="value-right valuemax"></div>
                                                </div>
                                            </div>
                                            <div class="form-group sliderGroup inputsimulasi">
                                                <label><?= $this->translate('label-funding-year')?></label>
                                                <select class="c-custom-select-trans form-control formRequired" id="jangka_waktu"
                                                        name="jangka-waktu">
                                                    <?php
                                                    // for ($i = 6 ; $i <= 24; $i++) {
                                                    //     if($i % 6 == 0){
                                                    //         echo '<option value="' . $i . '">' . $i . ' ' .$this->translate('label-month') .'</option>';
                                                    //     }
                                                    // }
                                                    ?>
                                                </select>
                                                <div class="error-wrap"></div>
                                            </div>
                                            <!-- <div class="form-group inputsimulasi asuransi hidden">
                                                <label><?= $this->translate('label-asuransi')?></label>
                                                <div class="columnselect" ke="0">
                                                    <div class="list-select">
                                                        <label><?= $this->translate('label-next-year')?> - 1</label>
                                                    </div>
                                                    <div class="list-select">
                                                        <select class="c-custom-select-trans form-control formRequired opsiasuransi"
                                                                name="status"></select>
                                                    </div>
                                                    <div class="error-wrap"></div>
                                                </div>
                                            </div> -->
                                        </div>
                                        <div class="col-md-6">
                                            <div class="rincian">
                                                <div class="rincian--content">
                                                    <p class="title-angsuran"><?= $this->translate('label-rincian')?></p>
                                                    <table class="tableangsuran">
                                                        <tr>
                                                            <td>
                                                                <?= $this->translate('label-total')?> *
                                                            </td>
                                                            <td class="currency" tahun="0">
                                                                Rp 0
                                                            </td>
                                                        </tr>
                                                        <tr class="hidden">
                                                            <td>
                                                                <?= $this->translate('label-total-asuransi')?> *
                                                            </td>
                                                            <td class="currency" tahun="1">
                                                                Rp 0
                                                            </td>
                                                        </tr>
                                                        <!--  <tr>
                                                             <td class="textsubcurrency">
                                                                 Tahun ke-1 [All Risk Only*]
                                                             </td>
                                                             <td class="currency" tahun="1">
                                                                 Rp 0
                                                             </td>
                                                         </tr> -->
                                                        <!--  <tr>
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
                                                    <p class="total">Rp 0</p>
                                                    <p class="infotext">*<?= $this->translate('text-estimate')?></p>
                                                    <button class="cta cta-primary cta-big absolutebutcalc" id="recalc"
                                                            type="button"><?= $this->translate('hitung')?></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="button-area text-left back">
                                        <button class="cta cta-primary cta-big cta-back buttonback" id="buttonback4"
                                                type="button"><?= $this->translate('before')?></button>
                                    </div>

                                    <div class="button-area text-right next">
                                        <button class="cta cta-primary cta-big cta-see buttonnext" id="button4rumah" type="button"><?= $this->translate('next')?></button>
                                        <button class="cta cta-primary cta-big cta-see buttonnext hidesavebutton" type="button"><?= $this->translate('save')?></button>
                                    </div>

                                </div>

                                <div id="menu5" class="tab-pane slide-left">
                                    <div class="form-body--credit-simulasi">
                                        <div class="text-head">
                                            <h2 class="text-center"><?= $this->translate('label-confirmation')?></h2>
                                            <p class="text-center"><?= $this->translate('text-confirmation')?></p>
                                        </div>
                                        <div class="biaya-agunan">
                                            <div class="cont-agunan">
                                                <p class="title-agunan">
                                                    A. <?= $this->translate('label-angunan')?>
                                                </p>
                                                <table>
                                                    <tr>
                                                        <td><?= $this->translate('label-jenis')?></td>

                                                        <td id="showAngunan" class="jenis_jaminan"><?= $this->translate('jenis-jaminan-rumah')?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="biaya-agunan">
                                            <div class="cont-agunan">
                                                <p class="title-agunan">
                                                    B. <?= $this->translate('data-name')?>
                                                </p>
                                                <div class="button-area text-right button-angsur">
                                                    <button id="btnDataPemohon" class="cta cta-primary cta-big cta-ubah" type="button"><i class="fa fa-pencil" aria-hidden="true"></i><b><?= $this->translate('ubah')?></b></button>
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
                                                    <!--<tr>
                                                        <td>Unggah Foto KTP</td>

                                                        <td class="unggah"></td>
                                                    </tr>-->
                                                </table>
                                            </div>

                                        </div>
                                        <div class="biaya-agunan">
                                            <div class="cont-agunan">
                                                <p class="title-agunan">
                                                    C. <?= $this->translate('data-place')?>
                                                </p>
                                                <div class="button-area text-right button-angsur">
                                                    <button id="btnDataTempatTinggal" class="cta cta-primary cta-big cta-ubah" type="button"><i class="fa fa-pencil" aria-hidden="true"></i><b><?= $this->translate('ubah')?></b></button>
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
                                                    D. <?= $this->translate('data-bangunan')?>
                                                </p>
                                                <div class="button-area text-right button-angsur">
                                                    <button id="btnDataBangunan" class="cta cta-primary cta-big cta-ubah" type="button"><i class="fa fa-pencil" aria-hidden="true"></i><b><?= $this->translate('ubah')?></b></button>
                                                </div>
                                                <table>
                                                    <tr>
                                                        <td><?= $this->translate('label-jenis-property')?></td>

                                                        <td id="showJenis_properti" class="jenis_properti"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?= $this->translate('provinsi')?></td>

                                                        <td id="showProvinsi_sertificate" class="provinsi_sertificate"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?= $this->translate('kota')?></td>

                                                        <td id="showKota_sertificate" class="kota_sertificate"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?= $this->translate('kecamatan')?></td>

                                                        <td id="showKecamatan_sertificate" class="kecamatan_sertificate"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?= $this->translate('kelurahan')?></td>

                                                        <td id="showKelurahan_sertificate" class="kelurahan_sertificate"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?= $this->translate('postcode')?></td>

                                                        <td id="showKode_pos_sertificate" class="kode_pos_sertificate"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?= $this->translate('address')?></td>

                                                        <td id="showAlamat_lengkap_sertificate" class="alamat_lengkap_sertificate"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?= $this->translate('label-status-bangunan')?></td>

                                                        <td id="showStatus_sertificate" class="status_sertificate"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?= $this->translate('label-property-condition')?></td>

                                                        <td id="showProperty_condition" class="showProperty_condition"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?= $this->translate('label-status-sertifikat')?></td>

                                                        <td id="showOwn_sertificate" class="own_sertificate"></td>
                                                    </tr>

                                                </table>
                                            </div>

                                        </div>
                                        <div class="biaya-agunan">
                                            <div class="form-group">
                                                <input type="checkbox" id="agreement1" class="agreement" checked>
                                                <label for="agreement1" class="label-agreement agreement1"><?= $this->translate('term-condition')?></label>
                                                <div class="error-wrap"></div>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="agreement2" class="agreement">
                                                <label for="agreement2" class="label-agreement agreement2"><?= $this->translate('term-condition-2')?></label>
                                                <div class="error-wrap"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="button-area text-left back">
                                        <button class="cta cta-primary cta-big cta-back buttonback" id="buttonback5"
                                                type="button"><?= $this->translate('before')?></button>
                                    </div>

                                    <div class="button-area text-right next">
                                        <button class="cta cta-primary cta-big cta-see buttonnext" id="button5" type="button"><?= $this->translate('next')?></button>
                                    </div>

                                </div>

                                <div id="menu6" class="tab-pane slide-left">
                                    <div class="form-body--credit">
                                        <h2 class="text-center"><?= $this->translate('confirmation-otp')?></h2>
                                        <p class="text-center"><?= $this->translate('text-confirmation-otp')?></p>

                                        <div class="otp-number form-group">
                                            <div class="otp-number__phone disabled">
                                                <p id="showPhone"> <input type="tel" pattern="\d*" id="otpPhone" disabled /> <img id="otpEditPhone" src="/static/images/icon/pencils.png" alt=""></p>
                                            </div>
                                            <div class="otp-number__verify">
                                                <input type="tel" pattern="\d*" class="input-number formRequired" maxlength="1" name="otp1">
                                                <input type="tel" pattern="\d*" class="input-number formRequired" maxlength="1" name="otp2">
                                                <input type="tel" pattern="\d*" class="input-number formRequired" maxlength="1" name="otp3">
                                                <input type="tel" pattern="\d*" class="input-number formRequired" maxlength="1" name="otp4">
                                            </div>
                                            <div class="error-wrap"></div>
                                            <div class="otp-number__text">
                                                <p><?= $this->translate('dont-get-otp')?> <span class="countdown"></span> </p>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="button-area text-right next">
                                        <button class="cta cta-primary cta-big cta-see btn-verifikasi buttonnext" id="button6"
                                                type="button"><?= $this->translate('verifikasi')?></button>
                                    </div>

                                </div>

                                <div id="success" class="success-wrapper">
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

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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