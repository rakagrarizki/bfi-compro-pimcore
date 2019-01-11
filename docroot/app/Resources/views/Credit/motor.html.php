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
                                        <p>Data Pemohon</p>
                                    </a>
                                </li>
                                <li class="nav-item-2 disabled">
                                    <a href="#" id="tab2">
                                        <span class="number"><i class="fa fa-check" aria-hidden="true"></i><b>2</b></span>
                                        <p>Data Tempat Tinggal</p>
                                    </a>
                                </li>
                                <li class="nav-item-3 disabled">
                                    <a href="#" id="tab3">
                                        <span class="number"><i class="fa fa-check" aria-hidden="true"></i><b>3</b></span>
                                        <p>Data Kendaraan</p>
                                    </a>
                                </li>
                                <li class="nav-item-4 disabled">
                                    <a href="#" id="tab4">
                                        <span class="number"><i class="fa fa-check" aria-hidden="true"></i><b>4</b></span>
                                        <p>Jumlah Pembiayaan</p>
                                    </a>
                                </li>
                                <li class="nav-item-5 disabled">
                                    <a href="#" id="tab5">
                                        <span class="number"><i class="fa fa-check" aria-hidden="true"></i><b>5</b></span>
                                        <p>Konfirmasi Data</p>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <form action="#" id="getCredit" method="POST" class="form-get--credit" role="form">
                            <input type="hidden" id="jenis_form" name="jenis_form" value="MOTOR">
                            <div class="tab-content">
                                <div id="menu1" class="tab-pane fade in active form-group">
                                    <div class="form-body--credit">
                                        <div class="text-head">
                                            <h2 class="text-center">Data Pemohon</h2>
                                            <h2 class="text-center-edit">Ubah Data Pemohon</h2>
                                            <p class="text-center">Silahkan Masukan data diri Anda</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_lengkap">Nama Lengkap</label>
                                            <input type="text" class="form-control formRequired formAlphabet" name="nama_lengkap" id="nama_lengkap"
                                                   placeholder="Masukan nama lengkap Anda">
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control formRequired" name="email" id="email_pemohon"
                                                   placeholder="Masukan email Anda">
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="no_handphone">Nomor Handphone</label>
                                            <input type="text" class="form-control formPhoneNumber" name="no_handphone" id="no_handphone"
                                                   placeholder="Masukan nomor handphone Anda">
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

                                        <button class="cta cta-primary cta-big cta-see buttonnext" id="button1" type="button">SELANJUTNYA</button>
                                        <button class="cta cta-primary cta-big cta-see buttonnext hidesavebutton"  type="button">SIMPAN</button>

                                    </div>

                                </div>
                                <div id="menu2" class="tab-pane slide-left form-group ">
                                    <div class="form-body--credit">
                                        <div class="text-head">
                                            <h2 class="text-center">Data Tempat Tinggal</h2>
                                            <h2 class="text-center-edit">Ubah Data Tempat Tinggal</h2>
                                            <p class="text-center">Silahkan Masukan data tempat tinggal Anda</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Provinsi</label>
                                            <select class="c-custom-select formRequired" id="provinsi" name="provinsi"  data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}' />
                                                <option value="">Pilih Provinsi</option>
                                            </select>
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Kota</label>
                                            <select class="c-custom-select formRequired" id="kota" name="kota"  data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}' />
                                                <option value="">Pilih Kota</option>
                                            </select>
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Kecamatan</label>
                                            <select class="c-custom-select formRequired" id="kecamatan" name="kecamatan"  data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}' />
                                                <option value="">Pilih Kecamatan</option>
                                            </select>
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Kelurahan</label>
                                            <select class="c-custom-select formRequired" id="kelurahan" name="kelurahan"  data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}' />
                                                <option value="">Pilih Kelurahan</option>
                                            </select>
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="kode_pos">Kode Pos</label>
                                            <input type="text" class="form-control formKodePos" name="kode_pos" id="kode_pos"
                                                   placeholder="Masukkan kode pos">
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat_lengkap">Alamat Lengkap Rumah</label>
                                            <textarea class="form-control formRequired" name="alamat_lengkap" id="alamat_lengkap"
                                                      placeholder="Masukan alamat lengkap rumah"></textarea>
                                            <div class="error-wrap"></div>
                                        </div>
                                    </div>
                                    <div class="button-area text-left back">
                                        <button class="cta cta-primary cta-big cta-back buttonback" id="buttonback2"
                                                type="button">SEBELUMNYA</button>
                                    </div>
                                    <div class="button-area text-right next">
                                        <button class="cta cta-primary cta-big cta-see buttonnext" id="button2" type="button">SELANJUTNYA</button>
                                        <button class="cta cta-primary cta-big cta-see buttonnext hidesavebutton" type="button">SIMPAN</button>
                                    </div>

                                </div>
                                <div id="menu3" class="tab-pane slide-left">
                                    <div class="form-body--credit">
                                        <div class="text-head">
                                            <h2 class="text-center">Data Kendaraan</h2>
                                            <h2 class="text-center-edit">Ubah Data Kendaraan</h2>
                                            <p class="text-center">Silahkan Masukan data kendaraan Anda</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Merk Kendaraan</label>
                                            <select class="c-custom-select-trans formRequired" data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}' id="merk_kendaraan" name="merk_kendaraan">
                                                <option value=""> Pilih Merk Kendaraan</option>
                                            </select>
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Model Kendaraan</label>
                                            <select class="c-custom-select-trans formRequired" data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}' id="model_kendaraan"
                                                    name="model_kendaraan">
                                                <option value=""> Pilih Model Kendaraan</option>
                                            </select>
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Tahun Kendaraan</label>
                                            <select class="c-custom-select-trans formRequired" data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}' id="tahun_kendaraan"
                                                    name="tahun_kendaraan">
                                                <option value=""> Pilih Tahun Kendaraan</option>
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
                                            <label>Status Kepemilikan</label>
                                            <select class="c-custom-select-trans formRequired" data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}' id="status_kep" name="status_kep">
                                                <option value=""> Pilih Status Kepemilikan</option>
                                                <option value="Hak Milik">Hak Milik</option>
                                                <option value="Hak Milik Orang Lain">Hak Milik Orang Lain</option>
                                            </select>
                                            <div class="error-wrap"></div>
                                        </div>

                                    </div>
                                
                                    <div class="button-area text-left back">
                                        <button class="cta cta-primary cta-big cta-back buttonback" id="buttonback3"
                                                type="button">SEBELUMNYA</button>
                                    </div>

                                    <div class="button-area text-right next">
                                        <button class="cta cta-primary cta-big cta-see buttonnext" id="button3"
                                                type="button">SELANJUTNYA</button>
                                        <button class="cta cta-primary cta-big cta-see buttonnext hidesavebutton" type="button">SIMPAN</button>
                                    </div>
                                    

                                </div>
                                <div id="menu4" class="tab-pane slide-left">
                                    <div class="form-body--credit-simulasi row">
                                       
                                       <div class="text-head">
                                            <h2 class="text-center">Jumlah Pembiayaan</h2>
                                            <h2 class="text-center-edit">Ubah Jumlah Pembiayaan</h2>
                                            <p class="text-center">Hitung Jumlah Pembiayaan Anda</p>
                                       </div>

                                        <div class="col-md-6">
                                            <div class="form-group sliderGroup inputsimulasi">
                                                <label for="jml-biaya">Jumlah Pembiayaan</label>
                                                <div class="input-group inputform">
                                                    <span class="input-group-addon" id="basic-addon1">Rp</span>
                                                    <input type="text" id="ex6SliderVal" class="form-control formRequired c-input-trans"
                                                           aria-describedby="basic-addon1">

                                                    <div class="error-wrap"></div>

                                                </div>
                                                <div class="slidecontainer ">
                                                    <input id="ex11" class="customslide" type="text" data-slider-handle="custom" data-slider-tooltip="hide" />
                                                    <div class="value-left valuemin"></div>
                                                    <div class="value-right valuemax"></div>
                                                </div>
                                            </div>
                                            <div class="form-group sliderGroup inputsimulasi">
                                                <label>Jangka Waktu</label>
                                                <select class="c-custom-select-trans formRequired" data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}' id="jangka_waktu"
                                                        name="jangka-waktu">
                                                    <option value="6">6 Bulan</option>
                                                    <option value="12">12 Bulan</option>
                                                    <option value="18">18 Bulan</option>
                                                    <option value="24">24 Bulan</option>
                                                    <option value="30">30 Bulan</option>
                                                    <option value="36">36 Bulan</option>
                                                    <option value="42">42 Bulan</option>
                                                    <option value="48">48 Bulan</option>
                                                    <option value="54">54 Bulan</option>
                                                    <option value="60">60 Bulan</option>
                                                </select>
                                                <div class="error-wrap"></div>
                                                <!-- <div class="slidecontainer">
                                                    <input id="ex12" class="customslide" type="text" data-slider-handle="custom"
                                                           data-slider-min="12" data-slider-max="60" data-slider-step="12"
                                                           data-slider-tooltip="hide" />
                                                    <div class="value-left">12 Bulan</div>
                                                    <div class="value-right">60 Bulan</div>
                                                </div> -->
                                            </div>
                                            <div class="form-group inputsimulasi asuransi">
                                                <label>Asuransi</label>
                                                <div class="columnselect" ke="0">
                                                    <div class="list-select">
                                                        <label>Tahun ke - 1</label>
                                                    </div>
                                                    <div class="list-select">
                                                        <select class="c-custom-select-trans formRequired opsiasuransi" data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}'
                                                                name="status"></select>
                                                    </div>
                                                    <div class="error-wrap"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="rincian">
                                                <div class="rincian--content">
                                                    <p class="title-angsuran">Rincian Biaya Angsuran</p>
                                                    <table class="tableangsuran">
                                                         <tr>
                                                            <td>
                                                                Total pembiayaan *
                                                            </td>
                                                            <td class="currency" tahun="0">
                                                                Rp 0
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                Total asuransi yang harus dibayarkan *
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
                                                    <p class="title-angsuran">Total Estimasi Angsuran Per Bulan</p>
                                                    <p class="total">Rp 0</p>
                                                    <button class="cta cta-primary cta-big" id="recalc"
                                                        type="button">HITUNG</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="button-area text-left back">
                                        <button class="cta cta-primary cta-big cta-back buttonback" id="buttonback4"
                                                type="button">SEBELUMNYA</button>
                                    </div>

                                    <div class="button-area text-right next">
                                        <button class="cta cta-primary cta-big cta-see buttonnext" id="button4" type="button">SELANJUTNYA</button>
                                        <button class="cta cta-primary cta-big cta-see buttonnext hidesavebutton" type="button">SIMPAN</button>
                                    </div>

                                </div>
                                <div id="menu5" class="tab-pane slide-left">
                                    <div class="form-body--credit-simulasi">
                                        
                                        <div class="text-head">
                                            <h2 class="text-center">Konfirmasi Data</h2>
                                            <p class="text-center">Pastikan data yang Anda masukkan sudah benar</p>
                                        </div>

                                        <div class="biaya-agunan">
                                            <div class="cont-agunan">
                                                <p class="title-agunan">
                                                    A. Pembiayaan Agunan
                                                </p>
                                                <table>
                                                    <tr>
                                                        <td>Jenis Jaminan</td>

                                                        <td id="showAngunan" class="jenis_jaminan"></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="biaya-agunan">
                                            <div class="cont-agunan">
                                                <p class="title-agunan">
                                                    B. Data Pemohon
                                                </p>
                                                <div class="button-area text-right button-angsur">
                                                    <button id="btnDataPemohon" class="cta cta-primary cta-big cta-ubah" type="button"><i class="fa fa-pencil" aria-hidden="true"></i><b>UBAH</b></button>
                                                </div>
                                                <table>
                                                    <tr>
                                                        <td>Nama Lengkap</td>

                                                        <td id="showFullName" class="nama_lengkap"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Email</td>

                                                        <td id="showEmail" class="email"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>No Handphone</td>

                                                        <td id="showPhone" class="email"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Unggah Foto KTP</td>

                                                        <td class="unggah"></td>
                                                    </tr>
                                                </table>
                                            </div>

                                        </div>
                                        <div class="biaya-agunan">
                                            <div class="cont-agunan">
                                                <p class="title-agunan">
                                                    C. Data Tempat Tinggal
                                                </p>
                                                <div class="button-area text-right button-angsur">
                                                    <button id="btnDataTempatTinggal" class="cta cta-primary cta-big cta-ubah" type="button"><i class="fa fa-pencil" aria-hidden="true"></i><b>UBAH</b></button>
                                                </div>
                                                <table>
                                                    <tr>
                                                        <td>Provinsi</td>

                                                        <td id="showProvinsi" class="provinsi"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kota</td>

                                                        <td id="showKota" class="kota"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kecamatan</td>

                                                        <td id="showKecamatan" class="kecamatan"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kode Pos</td>

                                                        <td id="showKodePos" class="kodepos"></td>
                                                    </tr>

                                                </table>
                                            </div>

                                        </div>
                                        <div class="biaya-agunan">
                                            <div class="cont-agunan">
                                                <p class="title-agunan">
                                                    D. Data Kendaraan
                                                </p>
                                                <div class="button-area text-right button-angsur">
                                                    <button id="btnDataKendaraan" class="cta cta-primary cta-big cta-ubah" type="button"><i class="fa fa-pencil" aria-hidden="true"></i><b>UBAH</b></button>
                                                </div>
                                                <table>
                                                    <tr>
                                                        <td>Merk Kendaraan</td>

                                                        <td id="showMerkKendaraan" class="merk_kendaraan"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Model Kendaraan</td>

                                                        <td id="showModelKendaraan" class="model_kendaraaan"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tahun Kendaraan</td>

                                                        <td id="showTahunKendaraan" class="tahun_kendaraan"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Status Kepemilikan</td>

                                                        <td id="showStatusPemilik" class="status"></td>
                                                    </tr>

                                                </table>
                                            </div>

                                        </div>
                                        <div class="biaya-agunan">
                                            <div class="cont-agunan">
                                                <p class="title-agunan">
                                                    E. Jumlah Pembiayaan
                                                </p>
                                                <div class="button-area text-right button-angsur">
                                                    <button id="btnJumlahPembiayaan" class="cta cta-primary cta-big cta-ubah" type="button"><i class="fa fa-pencil" aria-hidden="true"></i><b>UBAH</b></button>
                                                </div>
                                                <table class="tablebiaya">
                                                    <tr>
                                                        <td>Jumlah Pembiayaan</td>

                                                        <td class="jml_biaya"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jangka Waktu</td>

                                                        <td class="jangka"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Angsuran per Bulan</td>

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
                                                <label for="agreement1" class="label-agreement">Anda bersedia menerima
                                                    informasi lebih lanjut terkait
                                                    pembiayaan melalui lelepon/sms/email</label>
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
                                                type="button">SEBELUMNYA</button>
                                    </div>

                                    <div class="button-area text-right next">
                                        <button class="cta cta-primary cta-big cta-see buttonnext" id="button5" type="button">SELANJUTNYA</button>
                                    </div>

                                </div>

                                <div id="menu6" class="tab-pane slide-left">
                                    <div class="form-body--credit">
                                        <h2 class="text-center">Konfirmasi OTP</h2>
                                        <p class="text-center">Silahkan Masukan 4-digit kode verifikasi yang telah
                                            dikirimkan ke nomor hendphone Anda</p>

                                        <div class="otp-number form-group">
                                            <div class="otp-number__phone disabled">
                                                <p id="showPhone"> <input type="text" id="otpPhone" disabled /> <img id="otpEditPhone" src="/static/images/icon/pencil.png" alt=""></p>
                                            </div>
                                            <div class="otp-number__verify">
                                                <input type="text" class="input-number formRequired" maxlength="1" name="otp1">
                                                <input type="text" class="input-number formRequired" maxlength="1" name="otp2">
                                                <input type="text" class="input-number formRequired" maxlength="1" name="otp3">
                                                <input type="text" class="input-number formRequired" maxlength="1" name="otp4">
                                            </div>
                                            <div class="error-wrap"></div>
                                            <div class="otp-number__text">
                                                <p>Tidak menerima 4-digit kode? <span class="countdown"></span> </p>
                                            </div>
                                        </div>

                                    </div>
                                    

                                    <div class="button-area text-right next">
                                        <button class="cta cta-primary cta-big cta-see buttonnext" id="button6"
                                                type="submit">VERIFIKASI</button>
                                    </div>
                                    
                                </div>

                                <div id="success" class="success-wrapper">
                                    <div class="img-wrap">
                                        <img class="icon-thank-page" src="/static/images/icon/m_thank_you.png" alt="">
                                    </div>
                                    <div class="text-wrap text-center">
                                        <h3>Terima Kasih telah Menghubungi Kami!</h3>
                                        <p>Agen BFI akan segera menghubungi Anda</p>
                                    </div>
                                    <div class="button-area text-center backtohome">
                                        <a href="/<?php echo $this->getLocale() ?>">
                                            <button class="cta cta-primary cta-big cta-see buttonnext backtohome" id="button7"
                                                type="button">KEMBALI KE BERANDA</button>
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
                <p>OTP Salah, Silahkan masukan ulang OTP !</p>
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
                <p>Terjadi Kesalahan, Silahkan kirim ulang OTP !</p>
                <button type="button" class="cta cta-orange" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>