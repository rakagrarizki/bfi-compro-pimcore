`<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout-credit.html.php');
// echo $this->headScript()->prependFile('/static/js/Includes/homepage1.js');

$blogList = new Pimcore\Model\DataObject\BlogArticle\Listing();
$blogList->setOrderKey("Date");
$blogList->setOrder("desc");
$blogList->setLimit(4);
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
                                        <p><?= $this->translate('data-vehicle')?></p>
                                    </a>
                                </li>
                                <li class="nav-item-4 disabled">
                                    <a href="#" id="tab4">
                                        <span class="number"><i class="fa fa-check" aria-hidden="true"></i><b>4</b></span>
                                        <p><?= $this->translate('data-funding')?></p>
                                    </a>
                                </li>
                                <li class="nav-item-5 disabled">
                                    <a href="#" id="tab5">
                                        <span class="number"><i class="fa fa-check" aria-hidden="true"></i><b>5</b></span>
                                        <p><?= $this->translate('data-confirmation')?></p>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <form action="#" id="getCredit" method="POST" class="form-get--credit" role="form">
                            <input type="hidden" id="jenis_form" name="jenis_form" value="MOTOR">
                            <div class="tab-content">
                                <div id="menu1" class="tab-pane fade in active">
                                    <div class="form-body--credit">
                                        <div class="text-head">
                                            <h2 class="text-center"><?= $this->translate('data-name'), $this->translate('data-name-motor')?></h2>
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
                                        <button class="cta cta-primary cta-big cta-see buttonnext hidesavebutton"  type="button"><?= $this->translate('save')?></button>

                                    </div>

                                </div>
                                <div id="menu2" class="tab-pane slide-left">
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
                                                   placeholder="<?= $this->translate('placeholder-postcode')?>" disabled>
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat_lengkap"><?= $this->translate('label-place')?></label>
                                            <textarea class="form-control formRequired formAddress" name="alamat_lengkap" id="alamat_lengkap"
                                                      placeholder="<?= $this->translate('placeholder-place')?>, Contoh: Jalan Rajawali 1 Blok A no.11 RT 01 RW 02"></textarea>
                                            <div class="error-wrap"></div>
                                        </div>
                                    </div>
                                    <div class="button-area text-left back">
                                        <button class="cta cta-primary cta-big cta-back buttonback" id="buttonback2"
                                                type="button"><?= $this->translate('before')?></button>
                                    </div>
                                    <div class="button-area text-right next">
                                        <button class="cta cta-primary cta-big cta-see buttonnext" id="button2" type="button"><?= $this->translate('next')?></button>
                                        <button class="cta cta-primary cta-big cta-see buttonnext hidesavebutton" type="button"><?= $this->translate('save')?></button>
                                    </div>

                                </div>
                                <div id="menu3" class="tab-pane slide-left">
                                    <div class="form-body--credit">
                                        <div class="text-head">
                                            <h2 class="text-center"><?= $this->translate('data-vehicle')?></h2>
                                            <h2 class="text-center-edit"><?= $this->translate('change-data-vehicle')?></h2>
                                            <p class="text-center"><?= $this->translate('input-data-vehicle')?></p>
                                        </div>
                                        <div class="form-group">
                                            <label><?= $this->translate('label-type-motor')?></label>
                                            <select class="c-custom-select-trans form-control formRequired"
                                                    placeholder="<?= $this->translate('placeholder-type-motor')?>" id="type_kendaraan"
                                                    name="type_kendaraan" multiple="multiple">
                                                <option value="" disabled selected> <?= $this->translate('placeholder-type-motor')?></option>
                                            </select>
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label><?= $this->translate('label-merk')?></label>
                                            <select class="c-custom-select-trans form-control formRequired"
                                                    placeholder="<?= $this->translate('placeholder-merk')?>" id="merk_kendaraan"
                                                    name="merk_kendaraan" multiple="multiple">
                                                <option value="" disabled selected> <?= $this->translate('placeholder-merk')?></option>
                                            </select>
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label><?= $this->translate('label-model')?></label>
                                            <select class="c-custom-select-trans form-control formRequired"
                                                    placeholder="<?= $this->translate('placeholder-model')?>" id="model_kendaraan"
                                                    name="model_kendaraan" multiple="multiple">
                                                <option value="" disabled selected> <?= $this->translate('placeholder-model')?></option>
                                            </select>
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label><?= $this->translate('label-tahun')?></label>
                                            <select class="c-custom-select-trans form-control formRequired"
                                                    placeholder="<?= $this->translate('placeholder-tahun')?>" id="tahun_kendaraan"
                                                    name="tahun_kendaraan" multiple="multiple">
                                                <option value="" disabled selected> <?= $this->translate('placeholder-tahun')?></option>
                                                <?php
                                                $tahunNow = date("Y");
                                                for ($i = 2000; $i <= (int)$tahunNow; $i++) {
                                                    echo '<option value="' . $i . '">' . $i . '</option>';
                                                }
                                                ?>
                                            </select>
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label><?= $this->translate('label-status')?></label>
                                            <select class="c-custom-select-trans form-control formRequired"
                                                    placeholder="<?= $this->translate('placeholder-status')?>" id="status_kep"
                                                    name="status_kep" multiple="multiple" data-status-self="<?= $this->translate('placeholder-status-self')?>" data-status-other="<?=$this->translate('placeholder-status-other');?>">
                                                <option value="" disabled selected> <?= $this->translate('placeholder-status')?></option>
                                            </select>
                                            <div class="error-wrap"></div>
                                        </div>

                                    </div>

                                    <div class="button-area text-left back">
                                        <button class="cta cta-primary cta-big cta-back buttonback" id="buttonback3"
                                                type="button"><?= $this->translate('before')?></button>
                                    </div>

                                    <div class="button-area text-right next">
                                        <button class="cta cta-primary cta-big cta-see buttonnext" id="button3"
                                                type="button"><?= $this->translate('next')?></button>
                                        <button class="cta cta-primary cta-big cta-see buttonnext hidesavebutton" type="button"><?= $this->translate('save')?></button>
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
                                            <div class="form-group sliderGroup inputsimulasi">
                                                <label for="jml-biaya"><?= $this->translate('label-data-funding')?></label>
                                                <div class="input-group inputform ">
                                                    <span class="input-group-addon" id="basic-addon1">Rp</span>
                                                    <input type="tel" pattern="\d*" id="ex6SliderVal" class="form-control formPrice1000 formRequired c-input-trans"
                                                           aria-describedby="basic-addon1">

                                                    <div class="error-wrap"></div>

                                                </div>
                                                <div class="slidecontainer ">
                                                    <input id="ex11" class="customslide" type="tel" pattern="\d*" data-slider-handle="custom" data-slider-tooltip="hide" />
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
                                            <div class="form-group inputsimulasi asuransi hidden">
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
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="rincian">
                                                <div class="rincian--content hide">
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
                                                <div class="total-estimate mt-30">
                                                    <p class="title-angsuran"><?= $this->translate('label-estimate')?></p>
                                                    <p class="total">Rp 0</p>
                                                    <p class="infotext">*<?= $this->translate('text-estimate')?></p>
                                                    <button class="cta cta-primary cta-big absolutebutcalc" id="recalc"
                                                            type="button"><?= $this->translate('hitung')?></button>
                                                </div>
                                            </div>
                                            <div class="warning-calculate hide"><label><?= $this->translate("calculate-again"); ?></label></div>
                                        </div>
                                    </div>

                                    <div class="button-area text-left back">
                                        <button class="cta cta-primary cta-big cta-back buttonback" id="buttonback4"
                                                type="button"><?= $this->translate('before')?></button>
                                    </div>

                                    <div class="button-area text-right next">
                                        <button class="cta cta-primary cta-big cta-see buttonnext" id="button4" type="button"><?= $this->translate('next')?></button>
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

                                                        <td id="showAngunan" class="jenis_jaminan"><?= $this->translate('jenis-jaminan-motor')?></td>
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
                                                        <td><?/*= $this->translate('upload-ktp')*/?></td>

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
                                                    D. <?= $this->translate('data-vehicle')?>
                                                </p>
                                                <div class="button-area text-right button-angsur">
                                                    <button id="btnDataKendaraan" class="cta cta-primary cta-big cta-ubah" type="button"><i class="fa fa-pencil" aria-hidden="true"></i><b><?= $this->translate('ubah')?></b></button>
                                                </div>
                                                <table>
                                                    <tr>
                                                        <td class="medium"><?= $this->translate('merk-kendaraan')?></td>

                                                        <td id="showMerkKendaraan" class="merk_kendaraan"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="medium"><?= $this->translate('model-kendaraan')?></td>

                                                        <td id="showModelKendaraan" class="model_kendaraaan"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="medium"><?= $this->translate('year-kendaraan')?></td>

                                                        <td id="showTahunKendaraan" class="tahun_kendaraan"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="medium"><?= $this->translate('status-kendaraan')?></td>

                                                        <td id="showStatusPemilik" class="status"></td>
                                                    </tr>

                                                </table>
                                            </div>

                                        </div>
                                        <div class="biaya-agunan">
                                            <div class="cont-agunan">
                                                <p class="title-agunan">
                                                    E. <?= $this->translate('data-funding')?>
                                                </p>
                                                <div class="button-area text-right button-angsur">
                                                    <button id="btnJumlahPembiayaan" class="cta cta-primary cta-big cta-ubah" type="button"><i class="fa fa-pencil" aria-hidden="true"></i><b><?= $this->translate('ubah')?></b></button>
                                                </div>
                                                <table class="tablebiaya">
                                                    <tr>
                                                        <td class="long"><?= $this->translate('data-funding')?></td>

                                                        <td class="jml_biaya"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="long"><?= $this->translate('periode')?></td>

                                                        <td class="jangka"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="long"><?= $this->translate('installment')?></td>

                                                        <td class="angsuran"></td>
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
                                                <input type="checkbox" id="agreement1" class="agreement">
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
                                            <!-- <div class="otp-number__phone disabled">
                                                <p id="showPhone"> <input type="tel" pattern="\d*" id="otpPhone" disabled /> <img id="otpEditPhone" src="/static/images/icon/pencils.png" alt=""></p>
                                            </div> -->
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


                                    <div class="button-area text-center">
                                        <button class="cta cta-primary cta-big cta-see btn-verifikasi buttonnext" id="button6"
                                                type="button"><?= $this->translate('verifikasi')?></button>
                                    </div>

                                </div>

                                <div id="success" class="success-wrapper">
                                    <div class="wrapper">
                                        <div class="img-wrap">
                                            <img class="icon-thank-page" src="/static/images/icon/m_thank_you.png" alt="">
                                        </div>
                                        <div class="text-wrap text-center">
                                            <h3><?= $this->translate('tq-text-1')?></h3>
                                            <p><?= $this->translate('tq-text-2')?></p>
                                        </div>
                                        <div class="button-area text-center backtohome">
                                            <button class="cta cta-primary cta-big cta-see buttonnext btn-check" id="button7"
                                                    type="button" onclick="return checkStatusPengajuan()"><?= $this->translate('cek-status-aplikasi')?></button>
                                        </div>
                                    </div>
                                    <div class="blog-promo">
                                        <article class="sect-title text-center">
                                            <h2 class="title"><?= $this->t('berita_head'); ?></h2>
                                            <p class="subtitle"><?= $this->t('berita_sub_head'); ?></p>
                                        </article>
                                        <div class="list-card success-news">
                                            <?php foreach($blogList as $blog) : ?>
                                                <a href="<?= '/' . $this->getLocale() . '/blog/' . $blog->getSlug(); ?>" class="card-item">
                                                    <picture>
                                                        <img src="<?= $blog->getImage(); ?>" alt="">
                                                    </picture>
                                                    <div class="caption">
                                                        <h3 class="tag"><?= $blog->getBlogCategory()->getName(); ?></h3>
                                                        <h2 class="title"><?= $blog->getTitle(); ?></h2>
                                                        <div class="dateview">
                                                            <span class="date"><?= date('Y-m-d', strtotime($blog->getDate())); ?></span>
                                                            <span class="view"><i class="fa fa-eye"></i><?= $blog->getViews(); ?></span>
                                                        </div>
                                                    </div>
                                                </a>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="button-area text-center btn-beranda">
                                            <a href="<?php echo "/" . $this->getLocale() . '/' . $link; ?>" class="cta cta-primary cta-big cta-see buttonnext backtohome">
                                                <span><?= $this->translate('backtohome') ?></span></a>
                                        </div>
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

<!-- Modal-branch -->
<div class="modal fade" id="modal-branch" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content branch">
      <div class="modal-body">
        <h4><?= $this->translate('Branch not available')?></h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- end Modal branch -->

<!-- Modal-pricing -->
<div class="modal fade" id="modal-pricing" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content branch">
      <div class="modal-body">
        <h4><?= $this->translate('pricing-not-found')?></h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal"><?= $this->translate('close')?></button>
      </div>
    </div>
  </div>
</div>
<!-- end modal pricing -->