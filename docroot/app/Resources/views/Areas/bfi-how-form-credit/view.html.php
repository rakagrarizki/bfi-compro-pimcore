<?php
/**
 * Created by PhpStorm.
 * User: salt
 * Date: 03/12/18
 * Time: 17:15
 */
?>

<div class="container pengajuan">
    <div class="row">
        <div class="cek-pengajuan">
            <p class="title"><?= $this->input('title'); ?></p>
            <form action="#">
                <div class="row">
                    <div class="col-md-12">
                        <div class="_parentboxkirikanan">
                            <div class="_boxkiri">
                                <div class="input-group">
                                    <div class="plaintext-cekpengajuan">Pilih jenis jaminan yang Anda ajukan</div>
                                </div>
                            </div>
                            <div class="_boxkanan">
                                <div class="_boxkananchild1">
                                    <div class="input-group inputform">
                                        <select class="c-custom-select-home" id="sel-how-form-credit">
                                            <option value=""> Untuk Keperluan apa ?</option>
                                            <?php
                                            while ($this->block("contentblock")->loop()) {
                                                $url = $this->link('url')->isEmpty() ? $this->link('url')->getHref() : "";
                                                ?>
                                                <option value="<?= $url ?>"><?= $this->input('text'); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="_boxkananchild2 soloboxarrow-cekpengajuan">
                                    <button disabled class="btn-kotak btn-submit btn-submit-how-form-credit"
                                            type="submit"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
