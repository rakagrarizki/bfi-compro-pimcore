<?php

/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout-credit.html.php');

?>

<?php if (!$this->success) { ?>

    <div class="stepper-wrapper container">
        <nav>
            <ul class="stepper-row">
                <li id="list-step1" class="active">
                    <span id="poin1" class="number">1</span>
                    <span class="text"><?= $this->translate('data-name') ?></span>
                </li>
                <li id="list-step2">
                    <span id="poin2" class="number">2</span>
                    <span class="text"><?= $this->translate('data-univ') ?></span>
                </li>
                <li id="list-step3">
                    <span id="poin3" class="number">3</span>
                    <span class="text"><?= $this->translate('data-akademik') ?></span>
                </li>
                <li id="list-step4">
                    <span id="poin4" class="number">4</span>
                    <span class="text"><?= $this->translate('data-confirmation') ?></span>
                </li>
            </ul>
        </nav>

        <div id="stepper">
            <?php if ($this->msg_error) {
                echo '<div class="alert alert-danger" role="alert">' . $msg_error . '</div>';
            } ?>
            <h3 id="step-title"><?= $this->translate('data-name') ?></h3>
            <p id="step-subtitle"><?= $this->translate('data-name-sub') ?></p>

            <form method="POST" id="scholarship" name="scholarship" enctype="multipart/form-data">
                <div class="step-content" id="stepper-csr-1">
                    <div class="form-wrapper">
                        <div class="input-text-group">
                            <input name="scholarship[name]" id="name-input" class="style-input formAlphabet formName formRequired" type="text" onfocus="changeLabel(this.id)" onfocusout="deleteLabel(this.id)" required>
                            <label id="name-label" class="input-label"><?= $this->translate('form-name') ?></label>
                            <div class="error-wrap"></div>
                        </div>
                        <div class="input-text-group">
                            <input name="scholarship[email]" id="email-input" class="style-input formEmail formRequired" type="email" onfocus="changeLabel(this.id)" onfocusout="deleteLabel(this.id)" required>
                            <label id="email-label" class="input-label"><?= $this->translate('email-input') ?></label>
                            <div class="error-wrap"></div>
                        </div>
                        <div class="input-text-group">
                            <input name="scholarship[phone]" id="phone-input" class="style-input formRequired formPhoneNumber" type="text" onfocus="changeLabel(this.id)" onfocusout="deleteLabel(this.id)" maxlength="13" required>
                            <label id="phone-label" class="input-label"><?= $this->translate('input-phone') ?></label>
                            <div class="error-wrap"></div>
                        </div>
                        <div class="input-text-group">
                            <input name="scholarship[phone2]" id="alt-phone-input" class="style-input formRequired formPhoneNumber" type="text" onfocus="changeLabel(this.id)" onfocusout="deleteLabel(this.id)" maxlength="13">
                            <label id="alt-phone-label" class="input-label"><?= $this->translate('input-phone-alternatif') ?></label>
                            <div class="error-wrap"></div>
                        </div>
                        <div id="upload">
                            <h5 id="upload-text"><?= $this->translate('upload-photo-3x4') ?></h5>
                            <img id="preview-upload" src="">
                            <div class="upload-content-wrapper">
                                <div class="upload-btn-wrapper">
                                    <button id="upload-button" class="btn-upload">
                                        <?= $this->translate('choose-file') ?>
                                    </button>
                                    <input id="file-upload" class="hide-input formRequired" accept="image/*" type="file" name="photo" id="photo">
                                </div>
                                <span id="file-upload-filename"></span>
                            </div>
                            <div class="error-wrap"></div>
                            <!-- <p>Pastikan foto KTP terlihat jelas (max. ukuran file adalah 300kB)</p> -->
                            <p><?= $this->translate('upload-photo-max') ?></p>
                        </div>
                    </div>
                    <div id="step-1" class="next-prev-container">
                        <a href="#stepper-csr-2" id="button1next" class="btn-next-prev" onclick="nextToStep2()">
                            <span><?= $this->translate('next') ?></span>
                            <i class="fa fa-chevron-right"></i>
                        </a>
                    </div>
                </div>

                <div class="step-content hide" id="stepper-csr-2">
                    <div class="form-wrapper">
                        <div class="input-text-group">
                            <input name="scholarship[university]" id="univ-input" class="style-input formAlphabet formRequired" type="text" onfocus="changeLabelAcademic(this.id)" onfocusout="deleteLabelAcademic(this.id)" required>
                            <label id="univ-label" class="input-label"><?= $this->translate('univ-name') ?></label>
                            <div class="error-wrap"></div>
                        </div>
                        <div class="input-text-group">
                            <input name="scholarship[nim]" id="nim-input" class="style-input formNumber formRequired" type="text" onfocus="changeLabelAcademic(this.id)" onfocusout="deleteLabelAcademic(this.id)" required>
                            <label id="nim-label" class="input-label"><?= $this->translate('input-nim') ?></label>
                            <div class="error-wrap"></div>
                        </div>
                        <div class="input-text-group">
                            <input name="scholarship[faculty]" id="fak-input" class="style-input formAlphabet formRequired" type="text" onfocus="changeLabelAcademic(this.id)" onfocusout="deleteLabelAcademic(this.id)" required>
                            <label id="fak-label" class="input-label"><?= $this->translate('input-fakultas') ?></label>
                            <div class="error-wrap"></div>
                        </div>
                        <div class="input-text-group">
                            <input name="scholarship[prodi]" id="prodi-input" class="style-input formAlphabet formRequired" type="text" onfocus="changeLabelAcademic(this.id)" onfocusout="deleteLabelAcademic(this.id)">
                            <label id="prodi-label" class="input-label"><?= $this->translate('input-prodi') ?></label>
                            <div class="error-wrap"></div>
                        </div>
                        <div class="input-text-group">
                            <select class="semester style-input formRequired" name="scholarship[semester]" id="semester-input">
                                <option></option>
                                <option value="4"><?= $this->translate('label-semester') ?> 4</option>
                                <option value="5"><?= $this->translate('label-semester') ?> 5</option>
                                <option value="6"><?= $this->translate('label-semester') ?> 6</option>
                                <option value="7"><?= $this->translate('label-semester') ?> 7</option>
                                <option value="8"><?= $this->translate('label-semester') ?> 8</option>
                            </select>
                            <label id="semester-label" class="input-label"><?= $this->translate('choose-semester') ?></label>
                            <div class="error-wrap"></div>
                        </div>
                    </div>
                    <div id="step-2" class="next-prev-container">
                        <a href="#stepper-csr-1" id="button1prev" class="btn-next-prev" onclick="backToStep1()">
                            <i class="fa fa-chevron-left"></i>
                            <span><?= $this->translate('before') ?></span>
                        </a>
                        <a href="#stepper-csr-3" id="button2next" class="btn-next-prev" onclick="nextToStep3()">
                            <span><?= $this->translate('next') ?></span>
                            <i class="fa fa-chevron-right"></i>
                        </a>
                    </div>
                </div>

                <div class="step-content hide" id="stepper-csr-3">
                    <div class="form-wrapper" id="form-semester-ipk">

                        <!-- input template generated from js -->

                        <!-- input template generated from js -->

                        <div id="upload">
                            <h5 id="upload-pdf-text"><?= $this->translate('unggah-transkrip') ?></h5>
                            <div id="show">
                                <img id="preview-pdf-upload" src="">
                                <span id="pdf-filename"></span>
                            </div>
                            <div class="upload-content-wrapper">
                                <div class="upload-btn-wrapper">
                                    <button id="upload-pdf-button" class="btn-upload">
                                        <?= $this->translate('choose-file') ?>
                                    </button>
                                    <input id="file-pdf-upload" class="hide-input" type="file" name="transcript">
                                </div>
                            </div>
                            <div class="error-wrap"></div>
                            <p><?= $this->translate('ket-file-pdf') ?></p>
                        </div>
                    </div>
                    <div id="step-3" class="next-prev-container">
                        <a href="#stepper-csr-2" id="button2prev" class="btn-next-prev" onclick="backToStep2()">
                            <i class="fa fa-chevron-left"></i>
                            <span><?= $this->translate('before') ?></span>
                        </a>
                        <a href="#stepper-csr-4" id="button3next" class="btn-next-prev" onclick="nextToStep4()">
                            <span><?= $this->translate('next') ?></span>
                            <i class="fa fa-chevron-right"></i>
                        </a>
                    </div>
                </div>

                <div class="step-content hide" id="stepper-csr-4">
                    <div class="form-wrapper">
                        <section id="data-pemohon" class="data-wrapper">
                            <div class="title-and-button">
                                <h4 class="point">A.</h4>
                                <h4 class="title"><?= $this->translate('data-name') ?></h4>
                                <a href="#stepper-csr-1" onclick="jumpToStep1()">
                                    <!-- <i class="fa fa-pencil"></i> -->
                                    <span><?= $this->translate('ubah') ?></span>
                                </a>
                            </div>
                            <div class="data-detail">
                                <div class="detail-wrapper">
                                    <span class="label"><?= $this->translate('form-name') ?></span>
                                    <span id="nama-peserta" class="input"></span>
                                </div>
                                <div class="detail-wrapper">
                                    <span class="label"><?= $this->translate('form-email') ?></span>
                                    <span id="email-peserta" class="input"></span>
                                </div>
                                <div class="detail-wrapper">
                                    <span class="label"><?= $this->translate('form-hp') ?></span>
                                    <span id="hp-peserta" class="input"></span>
                                </div>
                                <div class="detail-wrapper">
                                    <span class="label"><?= $this->translate('label-foto-3x4') ?></span>
                                    <span id="foto-peserta" class="input">: PasPoto.jpg</span>
                                </div>
                            </div>
                        </section>
                        <hr>
                        <section id="data-universitas" class="data-wrapper">
                            <div class="title-and-button">
                                <h4 class="point">B.</h4>
                                <h4 class="title"><?= $this->translate('data-univ') ?></h4>
                                <a href="#stepper-csr-2" onclick="jumpToStep2()">
                                    <!-- <i class="fa fa-pencil"></i> -->
                                    <span>Ubah</span>
                                </a>
                            </div>
                            <div class="data-detail">
                                <div class="detail-wrapper">
                                    <span class="label"><?= $this->translate('input-univ') ?></span>
                                    <span id="univ-peserta" class="input"></span>
                                </div>
                                <div class="detail-wrapper">
                                    <span class="label"><?= $this->translate('input-nim') ?></span>
                                    <span id="nim-peserta" class="input"></span>
                                </div>
                                <div class="detail-wrapper">
                                    <span class="label"><?= $this->translate('input-fakultas') ?></span>
                                    <span id="fak-peserta" class="input"></span>
                                </div>
                                <div class="detail-wrapper">
                                    <span class="label"><?= $this->translate('input-jurusan') ?></span>
                                    <span id="prodi-peserta" class="input"></span>
                                </div>
                                <div class="detail-wrapper">
                                    <span class="label"><?= $this->translate('input-semester') ?></span>
                                    <span id="smt-peserta" class="input"></span>
                                </div>
                            </div>
                        </section>
                        <hr>
                        <section id="data-akademik" class="data-wrapper">
                            <div class="title-and-button">
                                <h4 class="point">C.</h4>
                                <h4 class="title"><?= $this->translate('data-akademik') ?></h4>
                                <a href="#stepper-csr-3" onclick="jumpToStep3()">
                                    <!-- <i class="fa fa-pencil"></i> -->
                                    <span><?= $this->translate('ubah') ?></span>
                                </a>
                            </div>
                            <div id="list-ipk" class="data-detail">
                                <!-- Template sesuai dgn formstep4.js -->
                                <!-- <div class="detail-wrapper">
                                <span class="label">Semester</span>
                                <span class="input">: 1</span>
                            </div>
                            <div class="detail-wrapper">
                                <span class="label">IPK</span>
                                <span class="input">: 3.25</span>
                            </div> -->

                                <div class="detail-wrapper">
                                    <span class="label"><?= $this->translate('input-transkrip') ?></span>
                                    <span id="transkrip-peserta" class="input"></span>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div id="step-3" class="next-prev-container">
                        <a href="#stepper-csr-3" id="button3prev" class="btn-next-prev" onclick="backToStep3()">
                            <i class="fa fa-chevron-left"></i>
                            <span><?= $this->translate('before') ?></span>
                        </a>
                        <!-- <a href="#stepper-csr-4" class="btn-next-prev" onclick="nextToStep4()">
                        <span>SELESAI</span>
                        <i class="fa fa-chevron-right"></i>
                    </a> -->
                        <button class="btn-next-prev" id="button4next" type="submit">
                            <span><?= $this->translate('selesai') ?></span>
                            <i class="fa fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php $this->headScript()->prependFile('/static/js/Includes/pendaftaranCSR.js'); ?>
    <?php $this->headScript()->prependFile('/static/js/Includes/formStep1.js'); ?>
    <?php $this->headScript()->prependFile('/static/js/Includes/formStep2.js'); ?>
    <?php $this->headScript()->prependFile('/static/js/Includes/formStep3.js'); ?>
    <?php $this->headScript()->prependFile('/static/js/Includes/formStep4.js'); ?>


<?php } else { ?>
    <?= $this->template('Includes/success.html.php') ?>
<?php } ?>