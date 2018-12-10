
<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');
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
                                        <span class="number">1</span>
                                        <p>Data Pemohon</p>
                                    </a>
                                </li>
                                <li class="nav-item-2 disabled">
                                    <a href="#" id="tab2">
                                        <span class="number">2</span>
                                        <p>Data Tempat Tinggal</p>
                                    </a>
                                </li>
                                <li class="nav-item-3 disabled">
                                    <a href="#" id="tab3">
                                        <span class="number">3</span>
                                        <p>Data Bangunan</p>
                                    </a>
                                </li>
                                <li class="nav-item-4 disabled">
                                    <a href="#" id="tab4">
                                        <span class="number">4</span>
                                        <p>Konfirmasi Data</p>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <form action="#" id="getCredit" method="POST" class="form-get--credit" role="form">
                            <input type="hidden" id="jenis_form" name="jenis_form" value="SURAT BANGUNAN">
                            <div class="tab-content">
                                <div id="menu1" class="tab-pane fade in active form-group">
                                    <div class="form-body--credit">
                                        <h2 class="text-center">Data Pemohon</h2>
                                        <p class="text-center">Silahkan Masukan data diri Anda</p>
                                        <div class="form-group">
                                            <label for="nama_lengkap">Nama Lengkap</label>
                                            <input type="text" class="form-control formRequired" name="nama_lengkap" id="nama_lengkap"
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
                                            <input type="text" class="form-control formNumber" name="no_handphone" id="no_handphone"
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

                                    </div>

                                </div>
                                <div id="menu2" class="tab-pane slide-left form-group ">
                                    <div class="form-body--credit">
                                        <h2 class="text-center">Data Tempat Tinggal</h2>
                                        <p class="text-center">Silahkan Masukan data tempat tinggal Anda</p>
                                        <div class="form-group">
                                            <label for="provinsi">Provinsi</label>
                                            <select class="c-custom-select formRequired" id="provinsi" name="provinsi">
                                                <option value=""> Pilih Provinsi</option>
                                                <option value="DKI Jakarta">DKI Jakarta</option>
                                                <option value="Jawa Barat">Jawa Barat</option>
                                            </select>
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="kota">Kota</label>
                                            <select class="c-custom-select formRequired" id="kota" name="kota">
                                                <option value=""> Pilih Kota</option>
                                                <option value="Jakarta Utara">Jakarta Utara</option>
                                                <option value="Jakarta Selatan">Jakarta Selatan</option>
                                            </select>
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="kecamatan">Kecamatan</label>
                                            <select class="c-custom-select formRequired" id="kecamatan" name="kecamatan">
                                                <option value=""> Pilih Kecamatan</option>
                                                <option value="Kebon Jeruk">Kebon Jeruk</option>
                                                <option value="Kemanggisan">Kemanggisan</option>
                                            </select>
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="kelurahan">Kelurahan</label>
                                            <select class="c-custom-select formRequired" id="kelurahan" name="kelurahan">
                                                <option value=""> Pilih Kelurahan</option>
                                                <option value="Kelurahan 1">Kelurahan 1</option>
                                                <option value="Kelurahan 2">Kelurahan 2</option>
                                            </select>
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="kode_pos">Kode Pos</label>
                                            <input type="text" class="form-control formNumber" name="kode_pos" id="kode_pos"
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
                                    </div>

                                </div>
                                <div id="menu3" class="tab-pane slide-left">
                                    <div class="form-body--credit">
                                        <h2 class="text-center">Data Bangunan</h2>
                                        <p class="text-center">Silahkan Masukan data bangunan Anda</p>
                                        <div class="form-group">
                                            <label for="merk_kendaraan">Status Sertifikat</label>
                                            <select class="c-custom-select-trans formRequired" id="status_sertificate" name="status_sertificate">
                                                <option value=""> Pilih merk kendaraan</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                            </select>
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="model_kendaraan">Sertifikat Atas Nama</label>
                                            <select class="c-custom-select-trans formRequired" id="own_sertificate"
                                                    name="own_sertificate">
                                                <option value=""> Pilih Model Kendaraan</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                            </select>
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="provinsi_sertificate">Provinsi</label>
                                            <select class="c-custom-select formRequired" id="provinsi_sertificate" name="provinsi_sertificate">
                                                <option value=""> Pilih Provinsi</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                            </select>
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="kota_sertificate">Kota</label>
                                            <select class="c-custom-select formRequired" id="kota_sertificate" name="kota_sertificate">
                                                <option value=""> Pilih Kota</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                            </select>
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="kecamatan_sertificate">Kecamatan</label>
                                            <select class="c-custom-select formRequired" id="kecamatan_sertificate" name="kecamatan_sertificate">
                                                <option value=""> Pilih Kecamatan</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                            </select>
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="kelurahan">Kelurahan</label>
                                            <select class="c-custom-select formRequired" id="kelurahan_sertificate" name="kelurahan_sertificate">
                                                <option value=""> Pilih Kelurahan</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                            </select>
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="kode_pos">Kode Pos</label>
                                            <input type="text" class="form-control formNumber" name="kode_pos_sertificate" id="kode_pos_sertificate"
                                                   placeholder="Masukkan kode pos">
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat_lengkap">Alamat Lengkap Rumah</label>
                                            <textarea class="form-control formRequired" name="alamat_lengkap_sertificate" id="alamat_lengkap_sertificate"
                                                      placeholder="Masukan alamat lengkap rumah"></textarea>
                                            <div class="error-wrap"></div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="button-area text-left back">
                                            <button class="cta cta-primary cta-big cta-back buttonback" id="buttonback3"
                                                    type="button">SEBELUMNYA</button>
                                        </div>

                                        <div class="button-area text-right next">
                                            <button class="cta cta-primary cta-big cta-see buttonnext" id="button3"
                                                    type="button">SELANJUTNYA</button>
                                        </div>
                                    </div>


                                </div>

                                <div id="menu4" class="tab-pane slide-left">
                                    <div class="form-body--credit-simulasi">
                                        <h2 class="text-center">Konfirmasi Data</h2>
                                        <p class="text-center">Pastikan data yang Anda masukkan sudah benar</p>
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
                                                    <button id="btnDataPemohon" class="cta cta-primary cta-big cta-ubah" type="button">UBAH</button>
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
                                                    <button id="btnDataTempatTinggal" class="cta cta-primary cta-big cta-ubah" type="button">UBAH</button>
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
                                                    D. Data Bangunan
                                                </p>
                                                <div class="button-area text-right button-angsur">
                                                    <button id="btnDataKendaraan" class="cta cta-primary cta-big cta-ubah" type="button">UBAH</button>
                                                </div>
                                                <table>
                                                    <tr>
                                                        <td>Status Bangunan</td>

                                                        <td id="status_sertificate" class="status_sertificate"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Status Kepemilikan</td>

                                                        <td id="own_sertificate" class="own_sertificate"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Provinsi</td>

                                                        <td id="provinsi_sertificate" class="provinsi_sertificate"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kota</td>

                                                        <td id="kota_sertificate" class="kota_sertificate"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kecamatan</td>

                                                        <td id="kecamatan_sertificate" class="kecamatan_sertificate"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kelurahan</td>

                                                        <td id="kelurahan_sertificate" class="kelurahan_sertificate"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kode Pos</td>

                                                        <td id="kode_pos_sertificate" class="kode_pos_sertificate"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Alamat Bangunan</td>

                                                        <td id="alamat_lengkap_sertificate" class="alamat_lengkap_sertificate"></td>
                                                    </tr>

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
                                            <div class="form-group">
                                                <input type="checkbox" id="agreement2" class="agreement">
                                                <label for="agreement2" class="label-agreement">Lorem ipsum dolor sit
                                                    amet, consectetur
                                                    adipisicing elit. Odio reprehenderit iusto libero aliquid
                                                    temporibus vero, optio eveniet et, adipisci natus rem enim sequi
                                                    saepe expedita qui sunt exercitationem delectus. In?</label>
                                                <div class="error-wrap"></div>
                                            </div>
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
                                            <div class="otp-number__phone">
                                                <p id="showPhone"> <img src="/static/images/icon/pencil.png" alt=""></p>
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
                                    <div class="row">

                                        <div class="button-area text-right next">
                                            <button class="cta cta-primary cta-big cta-see buttonnext" id="button6"
                                                    type="submit">VERIFIKASI</button>
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