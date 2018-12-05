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
                                        <p>Data Kendaraan</p>
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
                                            <input type="email" class="form-control formRequired" name="email" id="email1"
                                                   placeholder="Masukan email Anda">
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="no_handphone">Nomor Handphone</label>
                                            <input type="text" class="form-control formNumber" name="no_handphone" id="no_handphone"
                                                   placeholder="Masukan nomor handphone Anda">
                                            <div class="error-wrap"></div>
                                        </div>
                                        <!--<div class="form-group">
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



                                        </div>-->
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
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                            </select>
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="kota">Kota</label>
                                            <select class="c-custom-select formRequired" id="kota" name="kota">
                                                <option value=""> Pilih Kota</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                            </select>
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="kecamatan">Kecamatan</label>
                                            <select class="c-custom-select formRequired" id="kecamatan" name="kecamatan">
                                                <option value=""> Pilih Kecamatan</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                            </select>
                                            <div class="error-wrap"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="kelurahan">Kelurahan</label>
                                            <select class="c-custom-select formRequired" id="kelurahan" name="kelurahan">
                                                <option value=""> Pilih Kelurahan</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
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

                                                        <td class="jenis_jaminan">BPKB Mobil</td>
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
                                                    <button class="cta cta-primary cta-big cta-ubah" type="button">UBAH</button>
                                                </div>
                                                <table>
                                                    <tr>
                                                        <td>Nama Lengkap</td>

                                                        <td class="nama_lengkap">Deborah T. Morris</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Email</td>

                                                        <td class="email">deborahmorris@gmail.com</td>
                                                    </tr>
                                                    <tr>
                                                        <td>No Handphone</td>

                                                        <td class="email">02135464646</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Unggah Foto KTP</td>

                                                        <td class="unggah">ktp.jpeg</td>
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
                                                    <button class="cta cta-primary cta-big cta-ubah" type="button">UBAH</button>
                                                </div>
                                                <table>
                                                    <tr>
                                                        <td>Provinsi</td>

                                                        <td class="provinsi">DKI Jakarta</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kota</td>

                                                        <td class="kota">Jakarta Barat</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kecamatan</td>

                                                        <td class="kecamatan">Kebon Jeruk</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kode Pos</td>

                                                        <td class="kodepos">11264</td>
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
                                                    <button class="cta cta-primary cta-big cta-ubah" type="button">UBAH</button>
                                                </div>
                                                <table>
                                                    <tr>
                                                        <td>Merk Kendaraan</td>

                                                        <td class="merk_kendaraan">Daihatsu</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Model Kendaraan</td>

                                                        <td class="model_kendaraaan">Ayla</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tahun Kendaraan</td>

                                                        <td class="tahun_kendaraan">2017</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Status Kepemilikan</td>

                                                        <td class="status">Milik Pribadi</td>
                                                    </tr>

                                                </table>
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
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>